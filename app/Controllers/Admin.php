<?php

namespace App\Controllers;
use Config\Services;
use CodeIgniter\Session\Session;
use App\Models\KelasModel;
use App\Models\UserModel;
use App\Models\ScheduleModel;
use App\Models\ActualScheduleModel;
use App\Models\CustomerModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;


class Admin extends BaseController
{

    protected Session $session;
    public function __construct()
    {
        // Initialize the session
        $this->db = \Config\Database::connect();
        $this->session = Services::session();
        

        if ($this->session->has('last_activity')) {
            $lastActivity = $this->session->get('last_activity');
            if (time() - $lastActivity > 10800) { // 10800 seconds = 3 hour
                return redirect()->to('/logout');
            }
        }
        $this->session->set('last_activity', time());
    }
    // Fungsi Kelas
    public function msKelas()
    {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
        $model = new KelasModel();
        $data['kelas'] = $model->getActiveKelas();
        $data['active'] = 'msKelas';
        $data['update']=$this->request->getGet('update');
        $data['del']=$this->request->getGet('del');
        $data['error']=$this->request->getGet('error');

        return view('admin/mskelas', $data);
    }

    public function tambahKelas() {
        $inputdata=$this->request->getPost();
        if ($inputdata) {
            $db = \Config\Database::connect();
            $builder = $db->table('ms_kelas');
    
            $data = [
                'name'         => $this->request->getPost('name'),
                'description'  => $this->request->getPost('description'),
                'created_by'   => 'admin', // or get from session
                'created_date' => date('Y-m-d H:i:s'),
                'is_active'    => 1
            ];
            $builder->insert($data);
            return redirect()->to('/msKelas');
        }
    
        return redirect()->to('/msKelas?error=1');
    }

    public function viewKelas(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost("id");


        $model = new KelasModel();
        $result = $model->getKelasById($id);

        if($result){
            $response = array(
                "status"=>"success",
                "result"=>$result
            );
        }else{
            $response = array(
                "status"=>"error",
                "result"=>"data not found"
            );
        }
        echo json_encode($response);
    }

    public function EditKelas(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');
        $name=$this->request->getPost('name');
        $description=$this->request->getPost('description');

        $builder = $db->table('ms_kelas');
        $updateArray = array(
            "name"=>$name,
            "description"=>$description,
        );
        
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/msKelas?update=1');
    }

    public function hapusKelas(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');

        $builder = $db->table('ms_kelas');
        $updateArray = array(
            "is_active"=>0,
        );
        
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/msKelas?del=1');
    }

    // User -----------------------------------------------------------------
    public function msUser()
    {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
        $model = new UserModel();
        $data['user'] = $model->getActiveUser();
        $data['active'] = 'msUser';
        $data['update']=$this->request->getGet('update');
        $data['del']=$this->request->getGet('del');
        $data['error']=$this->request->getGet('error');

        // echo print_r($data);
        return view('admin/msuser', $data);
    }

    public function tambahUser() {
        $inputdata=$this->request->getPost();
        if ($inputdata) {
            
            $data = [
                'name'         => $this->request->getPost('name'),
                'password'     => md5($this->request->getPost('password')),
                'email'        => $this->request->getPost('email'),
                'phone'        => $this->request->getPost('phone'),
                'date_of_birth'=> $this->request->getPost('date_of_birth'),
                'role'        => $this->request->getPost('role'),
                'created_by'   => $this->session->get('email'), // or get from session
                'created_date' => date('Y-m-d H:i:s'),
                'is_active'    => 1
            ];

            $this->db->table('ms_user')->insert($data);

            return redirect()->to('/msUser');
        }
        return redirect()->to('/msUser?error=1');
    }

    public function viewUser(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost("id");

        $model = new UserModel();
        $result = $model->getUserByIdFront($id);

        if($result){
            $response = array(
                "status"=>"success",
                "result"=>$result
            );
        }else{
            $response = array(
                "status"=>"error",
                "result"=>"data not found"
            );
        }

        echo json_encode($response);
    }

    public function EditUser(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');
        $name=$this->request->getPost('name');
        $email=$this->request->getPost('email');
        $phone=$this->request->getPost('phone');
        $role=$this->request->getPost('role');
        $password=$this->request->getPost('password');
        $date_of_birth=$this->request->getPost('date_of_birth');

        if($password){
            $password=md5($password);

            $updateArray = array(
                "name"=>$name,
                "email"=>$email,
                "phone"=>$phone,
                "role"=>$role,
                "date_of_birth"=>$date_of_birth,
                "password"=>$password,
            );
        }else{
            $updateArray = array(
                "name"=>$name,
                "email"=>$email,
                "phone"=>$phone,
                "role"=>$role,
                "date_of_birth"=>$date_of_birth,
            );
        }

        $this->db->table('ms_user')
        ->where('id',$id)
        ->update($updateArray);


        return redirect()->to('/msUser?update=1');
    }

    public function hapusUser(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');

        $builder = $db->table('ms_user');
        $updateArray = array(
            "is_active"=>0,
        );
        
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/msUser?del=1');
    }

    // Schedule
    public function msSchedule()
    {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $model = new ScheduleModel();
        $data['schedule'] = $model->getActiveSchedule();
        $data['active'] = 'msSchedule';
        $data['update'] = $this->request->getGet('update');
        $data['del'] = $this->request->getGet('del');
        $data['error'] = $this->request->getGet('error');

        $kelas = $this->db->table('ms_kelas')
            ->select('id, name, kuota')
            ->where('is_active', 1)
            ->get()
            ->getResult();

        $coach = $this->db->table('ms_user')
            ->select('id, name')
            ->where('is_active', 1)
            ->where('role', 'coach')
            ->get()
            ->getResult();

        $data['coach'] = $coach;
        $data['kelas'] = $kelas;

        return view('admin/msSchedule', $data);
    }


    public function generate_schedule()
    {
        $key=$this->request->getGet('pass');

        if($key=="xxxxxxxxx"){
            // echo "berhasil";
                $schedules = $this->db->table('tr_schedule')
                                ->where('is_active', 1)
                                ->get()
                                ->getResult();

            // Mapping nama hari (Bahasa) ke format date('w') -> 0=Sunday, ..., 6=Saturday
            $hariMap = [
                'Minggu' => 0,
                'Senin'  => 1,
                'Selasa' => 2,
                'Rabu'   => 3,
                'Kamis'  => 4,
                'Jumat'  => 5,
                'Sabtu'  => 6
            ];

            $start = strtotime(date('Y-m-01')); // 1st day of this month
            $end   = strtotime(date('Y-m-t'));  // last day of this month

            foreach ($schedules as $schedule) {
                $targetDay = $hariMap[$schedule->hari] ?? null;

                if ($targetDay === null) continue;

                for ($date = $start; $date <= $end; $date = strtotime('+1 day', $date)) {
                    if (date('w', $date) == $targetDay) {
                        $tanggal = date('Y-m-d', $date);

                        echo "Schedule ID: {$schedule->id} | Hari: {$schedule->hari} | Tanggal: $tanggal | Jam: {$schedule->jam_mulai} - {$schedule->jam_selesai}<br>";

                        // Example insert
                        $this->db->table('actual_schedule')->insert([
                            'schedule_id' => $schedule->id,
                            'tanggal' => $tanggal,
                            'is_active'=>1
                        ]);
                    }
                }
            }
        }else{
            echo "tidak berhasil";
            exit();
            
        }
        
        
        
    }

    public function tambahSchedule() {
        $inputdata=$this->request->getPost();
        if ($inputdata) {
    
            $data = [
                'class_id'     => $this->request->getPost('kelas'),
                'hari'          => $this->request->getPost('hari'),
                'jam_mulai'     => $this->request->getPost('jam_mulai'),
                'jam_selesai'     => $this->request->getPost('jam_selesai'),
                'is_active'    => 1
            ];

            $this->db->table('tr_schedule')->insert($data);

            return redirect()->to('/msSchedule');
        }
    
        return redirect()->to('/msSchedule?error=1');
    }

    public function viewSchedule(){
        $db = \Config\Database::connect();
        $id = $this->request->getPost("id");

        $model = new ScheduleModel();
        $result = $model->getScheduleById($id);

        if($result){
            $response = array(
                "status" => "success",
                "result" => $result
            );
        }else{
            $response = array(
                "status" => "error",
                "result" => "data not found"
            );
        }
        echo json_encode($response);
    }

    public function EditSchedule(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');
        $class_id = $this->request->getPost('class_id');
        $jam_mulai=$this->request->getPost('jam_mulai');
        $jam_selesai=$this->request->getPost('jam_selesai');
        $kuota=$this->request->getPost('kuota');

        $builder = $db->table('tr_schedule');
        $updateArray = array(
            "class_id"=>$class_id,
            "jam_mulai"=>$jam_mulai,
            "jam_selesai"=>$jam_selesai,
            "kuota"=>$kuota,
        );
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/msSchedule?update=1');
    }

    public function hapusSchedule(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');

        $builder = $db->table('tr_schedule');
        $updateArray = array(
            "is_active"=>0,
        );
        
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/msSchedule?del=1');
    }

    // Actual Schedule
    public function actualSchedule()
    {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $model = new ActualScheduleModel();

        // Get filters and sorting parameters from GET request
        $classFilter = $this->request->getGet('class_filter');
        $timeFilter = $this->request->getGet('time_filter') ?: null;
        $dateFilter = $this->request->getGet('date_filter') ?: null;
        $sortColumn = $this->request->getGet('sort') ?? 'tanggal';
        $sortDirection = $this->request->getGet('direction') ?? 'ASC';

        // Pass parameters to the model
        $data['schedule'] = $model->getActiveSchedule($classFilter, $timeFilter, $sortColumn, $sortDirection, $dateFilter);
        $data['active'] = 'actualSchedule';
        $data['update'] = $this->request->getGet('update');
        $data['del'] = $this->request->getGet('del');
        $data['error'] = $this->request->getGet('error');

        $kelas = $this->db->table('ms_kelas')
            ->select('id, name, kuota')
            ->where('is_active', 1)
            ->get()
            ->getResult();

        $coach = $this->db->table('ms_user')
            ->select('id, name')
            ->where('is_active', 1)
            ->where('role', 'coach')
            ->get()
            ->getResult();

        $distinctTimes = $model->getDistinctTimes();

        $data['coach'] = $coach;
        $data['kelas'] = $kelas;
        $data['distinctTimes'] = $distinctTimes;
        $data['classFilter'] = $classFilter;
        $data['timeFilter'] = $timeFilter;
        $data['dateFilter'] = $dateFilter;
        $data['sortColumn'] = $sortColumn;
        $data['sortDirection'] = $sortDirection;

        return view('admin/actualSchedule', $data);
    }

    public function viewActualSchedule2()
    {
        $db = \Config\Database::connect();
        $id=$this->request->getPost("id");

        $model = new actualScheduleModel();
        $result = $model->getScheduleById($id);
        $users = $this->db->table('ms_user')
            ->select('id, name')
            ->where('role', "customer")
            ->where('is_active', 1)
            ->get()
            ->getResult();

        if ($result) {
            $response = array(
                "status" => "success",
                "result" => $result,
                "users" =>$users
            );
        } else {
            $response = array(
                "status" => "error",
                "result" => "data not found"
            );
        }
        echo json_encode($response);
    }

    public function viewActualSchedule()
    {
        $db = \Config\Database::connect();
        $id=$this->request->getPost("id");

        $model = new actualScheduleModel();
        $result = $model->getScheduleById($id);

        if ($result) {
            $response = array(
                "status" => "success",
                "result" => $result
            );
        } else {
            $response = array(
                "status" => "error",
                "result" => "data not found"
            );
        }
        echo json_encode($response);
    }

    public function CustomerBookActualSchedule()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('id');
        $customer = $this->request->getPost('book_customer');
        $jumlah = $this->request->getPost('book_orang');
        $tanggal = $this->request->getPost('tanggal');

        // echo json_encode($this->request->getPost());

        // exit();

        for ($i=0; $i < $jumlah ; $i++) { 
            $builder = $db->table('tr_user_schedule');
            $insertArray = array(
                "customer_id" => $customer,
                "actual_schedule_id" => $id,
                "tanggal"      =>$tanggal,
                "user_session_category"=>"group",
                'created_by'   => $this->session->get('email'),
                'created_date' => date('Y-m-d H:i:s'),
                "is_active"=>1
            );

            $builder->insert($insertArray);
        }

        

        return redirect()->to('/actualSchedule?update=1');
    }


    public function EditActualSchedule()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('id');
        $coach_id = $this->request->getPost('coach_id');
        $tanggal = $this->request->getPost('tanggal');

        $builder = $db->table('actual_schedule');
        $updateArray = array(
            "coach_id" => $coach_id,
            "tanggal" => $tanggal,
        );
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/actualSchedule?update=1');
    }

    public function hapusActualSchedule(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost('id');

        $builder = $db->table('actual_schedule');
        $updateArray = array(
            "is_active"=>0,
        );
        
        $builder->where('id', $id)->update($updateArray);

        return redirect()->to('/actualSchedule?del=1');
    }

    // msCustomer
    public function msCustomer()
    {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $model = new CustomerModel(); // Or UserModel, if that’s where the method is
        $data['customer'] = $model->getActiveCustomer(); // This now returns customers with group/private sessions

        $data['active'] = 'msCustomer';
        $data['update'] = $this->request->getGet('update');
        $data['del'] = $this->request->getGet('del');
        $data['error'] = $this->request->getGet('error');

        return view('admin/msCustomer', $data);
    }

    public function EditCustomer()
    {
        $db = \Config\Database::connect();
        $userId = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $group = $this->request->getPost('group');
        $private = $this->request->getPost('private');
        $expiration = $this->request->getPost('expiration');

        // 1. Update the user's name in ms_user
        $db->table('ms_user')
            ->where('id', $userId)
            ->update(['name' => $name]);

        // 2. Update 'group' session
        $db->table('tr_user_session')
            ->where('user_id', $userId)
            ->where('category', 'group')
            ->update([
                'session' => $group,
                'expiration' => $expiration
            ]);

        // 3. Update 'private' session
        $db->table('tr_user_session')
            ->where('user_id', $userId)
            ->where('category', 'private')
            ->update([
                'session' => $private,
                'expiration' => $expiration
            ]);

        return redirect()->to('/msCustomer?update=1');
    }

    public function viewCustomer(){
        $db = \Config\Database::connect();
        $id=$this->request->getPost("id");

        $model = new CustomerModel();
        $result = $model->getCustomerByIdFront($id);

        if($result){
            $response = array(
                "status"=>"success",
                "result"=>$result
            );
        }else{
            $response = array(
                "status"=>"error",
                "result"=>"data not found"
            );
        }

        echo json_encode($response);
    }

    // Today Schedule
    public function todaySchedule() {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
        // $TodayScheduleModel = new TodayScheduleModel();
        // $data['sessions'] = $TodayScheduleModel->getTodaySessions();
        $tanggal=date('Y-m-d');
        $query = $this->db->table('actual_schedule a')
            ->select("
                a.tanggal,
                a.id AS actual_schedule_id,
                d.class_name_override,
                b.hari,
                b.jam_mulai,
                b.jam_selesai,
                c.kuota,
                c.description AS nama_kelas,
                e.name AS coach_name,
                d.user_session_category,
                GROUP_CONCAT(DISTINCT d.customer_id ORDER BY d.customer_id SEPARATOR ',') AS customer_ids,
                GROUP_CONCAT(DISTINCT f.name ORDER BY d.customer_id SEPARATOR ', ') AS customer_names,
                COUNT(DISTINCT d.customer_id) AS jumlah_peserta,
                (c.kuota - COUNT(DISTINCT d.customer_id)) AS sisa_kuota
            ")
            ->join('tr_schedule b', 'a.schedule_id = b.id', 'left')
            ->join('ms_kelas c', 'b.class_id = c.id', 'left')
            ->join('tr_user_schedule d', 'd.actual_schedule_id = a.id', 'left')
            ->join('ms_user e', 'e.id = a.coach_id', 'left')
            ->join('ms_user f', 'f.id = d.customer_id', 'left') // Add join to get customer names
            ->where('a.is_active', 1)
            ->where('a.tanggal', $tanggal)
            ->groupBy([
                'a.tanggal',
                'actual_schedule_id',
                'd.class_name_override',
                'b.hari',
                'b.jam_mulai',
                'b.jam_selesai',
                'c.kuota',
                'nama_kelas',
                'd.user_session_category',
                'coach_name'
            ])
            ->orderBy('b.jam_mulai', 'ASC')
            ->get();


        $result = $query->getResult();
        
        // echo json_encode($result);
        // exit();
        $data = [
            'active'=>'todaySchedule',
            'list'=>$result,
        ];
        return view('admin/todaySchedule', $data);
    }

    public function exportTodayScheduleExcel()
{
    $tanggal = date('Y-m-d');
    $query = $this->db->table('actual_schedule a')
        ->select("
            a.tanggal,
            b.jam_mulai,
            b.jam_selesai,
            c.description AS nama_kelas,
            e.name AS coach_name,
            GROUP_CONCAT(DISTINCT f.name ORDER BY d.customer_id SEPARATOR ', ') AS customer_names,
            COUNT(DISTINCT d.customer_id) AS jumlah_peserta,
            (c.kuota - COUNT(DISTINCT d.customer_id)) AS sisa_kuota
        ")
        ->join('tr_schedule b', 'a.schedule_id = b.id', 'left')
        ->join('ms_kelas c', 'b.class_id = c.id', 'left')
        ->join('tr_user_schedule d', 'd.actual_schedule_id = a.id', 'left')
        ->join('ms_user e', 'e.id = a.coach_id', 'left')
        ->join('ms_user f', 'f.id = d.customer_id', 'left')
        ->where('a.is_active', 1)
        ->where('a.tanggal', $tanggal)
        ->groupBy(['a.id'])
        ->orderBy('b.jam_mulai', 'ASC')
        ->get()
        ->getResult();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header row
    $headers = [
        'Tanggal', 'Jam Mulai', 'Jam Selesai', 'Nama Kelas', 'Coach',
        'Jumlah Peserta', 'Sisa Kuota', 'Nama Peserta'
    ];

    $sheet->fromArray($headers, NULL, 'A1');

    // Bold header
    $headerCellRange = 'A1:H1'; // Adjust if more columns are added
    $sheet->getStyle($headerCellRange)->getFont()->setBold(true);

    // Data rows
    $row = 2;
    foreach ($query as $item) {
        $sheet->fromArray([
            $item->tanggal,
            $item->jam_mulai,
            $item->jam_selesai,
            $item->nama_kelas,
            $item->coach_name,
            $item->jumlah_peserta,
            $item->sisa_kuota,
            $item->customer_names
        ], NULL, 'A' . $row++);
    }

    // Auto-size columns
    foreach (range('A', 'H') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Output
    $filename = 'jadwal_Vibrant_' . date('Ymd') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}


}