<?php

namespace App\Controllers;
use Config\Services;
use CodeIgniter\Session\Session;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use App\Models\UserScheduleModel;

class Home extends BaseController
{
    protected Session $session;
    

    public function __construct()
    {
        // Initialize the session
        $this->session = Services::session();
        $this->db = \Config\Database::connect();

        if ($this->session->has('last_activity')) {
            $lastActivity = $this->session->get('last_activity');
            if (time() - $lastActivity > 10800) { // 10800 seconds = 3 hour
                return redirect()->to('/logout');
            }
        }
        $this->session->set('last_activity', time());
    }

    public function index(): string
    {
        return view('dashboard/home');
    }

    public function landing(): string
    {
        return view('dashboard/landing');
    }

    public function login(){
        return view('dashboard/login');
    }


    public function scheduleMobile() {
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $model = new UserModel();
        $user = $model->check_user(email: $this->session->get('email'));
        $userId = $this->session->get('id');

        $userSessionModel = new UserSessionModel();
        $groupSession = $userSessionModel->selectSum('session')
                                        ->where('user_id', $userId)
                                        ->where('category', 'group')
                                        ->where('is_active', 1)
                                        ->where('expiration >=', date('Y-m-d'))
                                        ->first()['session'] ?? 0;

        $userSessionModel = new UserSessionModel();
        $privateSession = $userSessionModel->selectSum('session')
                                        ->where('user_id', $userId)
                                        ->where('category', 'private')
                                        ->where('is_active', 1)
                                        ->where('expiration >=', date('Y-m-d'))
                                        ->first()['session'] ?? 0;

        $data = [
            "user_id"=>$this->session->get('id'),
            "email" => $this->session->get('email'),
            "name" => $this->session->get('name') ?? 'User',
            "role" => $this->session->get('role'),
            "userData" => $user,
            "groupSession" => $groupSession,
            "privateSession" => $privateSession
        ];
        return view('dashboard/scheduleMobile', $data);
    }

    public function userMobile(){
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $model = new UserModel();
        $user = $model->check_user(email: $this->session->get('email'));
        $userId = $this->session->get('id');
        
        $userSessionModel = new UserSessionModel();
        $groupSession = $userSessionModel->selectSum('session')
                                        ->where('user_id', $userId)
                                        ->where('category', 'group')
                                        ->where('is_active', 1)
                                        ->where('expiration >=', date('Y-m-d'))
                                        ->first()['session'] ?? 0;

        $userSessionModel = new UserSessionModel(); // Reinitialize for private sessions
        $privateSession = $userSessionModel->selectSum('session')
                                        ->where('user_id', $userId)
                                        ->where('category', 'private')
                                        ->where('is_active', 1)
                                        ->where('expiration >=', date('Y-m-d'))
                                        ->first()['session'] ?? 0;

        $scheduleModel = new UserScheduleModel();
        $bookedSession = $scheduleModel->getBookedSession($userId);

        // echo json_encode($bookedSession);
        // exit();
        $data = [
            "email"=>$this->session->get('email'),
            "name" =>$this->session->get('name') ?? 'User',
            "role"=>$this->session->get('role'),
            "userData"=>$user,
            "groupSession" => $groupSession, // Add group session count to data
            "privateSession" => $privateSession, // Add private session count to data
            "bookedSession" => $bookedSession
        ];
        // print_r($data);
        return view('dashboard/userMobile',$data);   
    }

    public function topup(){
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }

        $paketPrivate = $this->db->table('paket_topup')
            ->select('*')
            ->where('group', null)
            ->where('is_active', 1)
            ->get();

        $private = $paketPrivate->getResult();

        $paketGroup = $this->db->table('paket_topup')
            ->select('*')
            ->where('private', null)
            ->where('is_active', 1)
            ->get();

        $group = $paketGroup->getResult();

        $paket = [
            "private" => $private,
            "group" => $group
        ];
        // echo var_dump($paket);
        // exit();
        return view('dashboard/topup', $paket);
    }


    public function login_check(){  
        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));
        
        $model = new UserModel();
        $user = $model->check_user($email);

        if ($user && $password == $user['password']) {
            $this->session->set([
                'email' => $user['email'],
                'id' => $user['id'],
                'role' => $user['role'],
                'name' => $user['name']
            ]);

            // Redirect based on user role
            if ($user['role'] === 'admin' || $user['role'] === 'coach') {
                return redirect()->to('/msKelas');
            } else if ($user['role'] === 'customer') {
                return redirect()->to('userMobile');
            }
        } else {
            session()->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to('login');
        }
    }

    public function register(){
        $data = [
            'name'=> $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'password' =>md5($this->request->getPost('password')),
            'role'=>'customer',
            'is_active'=>1,
            'created_by'=>$this->request->getPost('email'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
        ];

        $model = new UserModel();
        if ($model->save_user($data)) {
            session()->setFlashdata('success', 'Registration successful!');
        } else {
            session()->setFlashdata('error', 'Registration failed.');
        }
    
        return redirect()->to('/login');
    }

    public function booking_kelas(){
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
        $class_name_override = $this->request->getPost('class_name_override');
        // echo var_dump($this->request->getPost());
        // exit();
        if ($class_name_override != 'Half-Tower') {
            $class_name_override = null;
        }

        $data = [
            'customer_id'=> $this->session->get('id'),
            'actual_schedule_id'=> $this->request->getPost('actual_schedule_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'class_name_override' => $class_name_override,
            'user_session_category' => $this->request->getPost('user_session_category'),
            'created_by'=>$this->session->get('email'),
            'created_date' => date('Y-m-d H:i:s'),
            'is_active'=> 1
        ];
        
        $this->db->table(tableName: "tr_user_schedule")->insert($data);

        $query = $this->db->table('tr_user_session')
            ->select('*')
            ->where('user_id', $this->session->get('id'))
            ->where('category', $this->request->getPost('user_session_category'))
            ->where('is_active', 1)
            ->get(1); // Limit to 1 row

        $data = $query->getRow(); // Get as object

        if ($data) {
            $currentsession = $data -> session - 1;
            // Modify fields
            $updatedFields = [
                'session' => $currentsession,
            ];

            // Update using the primary key (assuming 'id' is the primary key)
            $this->db->table('tr_user_session')
                ->where('id', $data->id)
                ->update($updatedFields);
        }

        // echo json_encode($data);
        // exit();
    
        return redirect()->to('/userMobile');
    }

    public function cancel_booking()
    {
        $id = $this->request->getPost("id");

        $query = $this->db->table('tr_user_schedule')
            ->select("id, customer_id, user_session_category")
            ->where("id", $id)
            ->get();

        $header = $query->getRow();

        if (!$header) {
            return redirect()->to('/userMobile')->with('error', 'Booking not found');
        }

        $query2 = $this->db->table('tr_user_session')
            ->select("id, session")
            ->where("user_id", $header->customer_id)
            ->where("category", $header->user_session_category)
            ->where("is_active", 1)
            ->get();

        $session = $query2->getRow();

        if (!$session) {
            return redirect()->to('/userMobile')->with('error', 'Session data not found');
        }

        // Try to update session
        $update_session = [
            'session' => (int)$session->session + 1,
        ];
        $updateResult = $this->db->table('tr_user_session')
            ->where('id', $session->id)
            ->update($update_session);

        // Try to delete booking
        $deleteResult = $this->db->table('tr_user_schedule')
            ->where('id', $header->id)
            ->delete();

        if ($updateResult && $deleteResult) {
            return redirect()->to('/userMobile')->with('success', 'Cancel Booking berhasil');
        } else {
            return redirect()->to('/userMobile')->with('error', 'Cancel Booking gagal. Silakan coba lagi.');
        }
    }


    public function booking_list(){
        if (!$this->session->has('email')) {
            return redirect()->to('/login')->with('error', 'Please log in to access this page.');
        }
        // header('Content-Type: application/json; charset=utf-8');
        $tanggal=$this->request->getGet('tanggal');

        //ini logic jika tanggal tidak diisi maka harus tanggal sekarang
        if(!$tanggal){ 
            $query = $this->db->table('actual_schedule a')
            ->select("
                a.tanggal,
                a.id AS actual_schedule_id,
                d.class_name_override,
                b.hari,
                b.jam_mulai,
                b.jam_selesai,
                c.kuota,
                c.name AS nama_kelas,
                e.name AS coach_name,
                d.user_session_category,
                GROUP_CONCAT(DISTINCT d.customer_id ORDER BY d.customer_id SEPARATOR ',') AS customer_ids,
                COUNT(DISTINCT d.customer_id) AS jumlah_peserta,
                (c.kuota - COUNT(DISTINCT d.customer_id)) AS sisa_kuota
            ")
            ->join('tr_schedule b', 'a.schedule_id = b.id', 'left')
            ->join('ms_kelas c', 'b.class_id = c.id', 'left')
            ->join('tr_user_schedule d', 'd.actual_schedule_id = a.id', 'left')
            ->join('ms_user e', 'e.id = a.coach_id', 'left')
            ->where('a.is_active', 1)
            ->where('a.tanggal', date('Y-m-d')) // make sure $tanggal is passed or declared earlier
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
        }else{ //ini logic jika tanggal diisi maka harus tanggal yang diisi
            $query = $this->db->table('actual_schedule a')
            ->select("
                a.tanggal,
                a.id AS actual_schedule_id,
                d.class_name_override,
                b.hari,
                b.jam_mulai,
                b.jam_selesai,
                c.kuota,
                c.name AS nama_kelas,
                e.name AS coach_name,
                d.user_session_category,
                GROUP_CONCAT(DISTINCT d.customer_id ORDER BY d.customer_id SEPARATOR ',') AS customer_ids,
                COUNT(DISTINCT d.customer_id) AS jumlah_peserta,
                (c.kuota - COUNT(DISTINCT d.customer_id)) AS sisa_kuota
            ")
            ->join('tr_schedule b', 'a.schedule_id = b.id', 'left')
            ->join('ms_kelas c', 'b.class_id = c.id', 'left')
            ->join('tr_user_schedule d', 'd.actual_schedule_id = a.id', 'left')
            ->join('ms_user e', 'e.id = a.coach_id', 'left')
            ->where('a.is_active', 1)
            ->where('a.tanggal', $tanggal) // make sure $tanggal is passed or declared earlier
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

        }
        

        $result = $query->getResult(); // or ->getResultArray() if you prefer array
        
        return $this->response->setJSON($result);
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('/');
    }


    
}