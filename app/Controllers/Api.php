<?php

namespace App\Controllers;
use Config\Services;
use CodeIgniter\Session\Session;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use App\Models\UserScheduleModel;

class Api extends BaseController
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

    public function create_invoice() {
        $secretKey = 'xnd_development_mqH3gmuvOlfwbqYdY0MbrGMmM1Gqn3D7TMp9wMWTtzTYgcF6KVFPeEWoaqPfwgI';
        $data = $this->request->getJSON();
        $sales_id = $data->sales_id ?? null;
        $harga = $data->harga ?? null;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.xendit.co/v2/invoices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "external_id" => "invoice-". time(),
                "amount" => $harga,
                "payer_email" => $this->session->get("email"),
                "description" => "Top Up Session ".$sales_id
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($secretKey . ':')
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }

        curl_close($curl);
        // echo $response;
        $response_decode = json_decode($response);

        $insertData = array(
            "log_id"=>$response_decode->id,
            "external_id"=>$response_decode->external_id,
            "user_id"=>$this->session->get('email'),
            "status"=>$response_decode->status,
            "merchant_name"=>$response_decode->merchant_name,
            "amount"=>$response_decode->amount,
            "payer_email"=>$response_decode->payer_email,
            "description"=>$response_decode->description,
            "expiry_date"=>$response_decode->expiry_date,
            "invoice_url"=>$response_decode->invoice_url,
            "is_active"=>1,
        );

        $this->db->table('log_request_payment')->insert($insertData);

        return $this->response->setJSON([
            'success' => true,
            'url' =>$response_decode->invoice_url
        ]);
    }

}