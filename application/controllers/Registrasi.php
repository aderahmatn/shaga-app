<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Registrasi_m');
        $this->load->helper('Whatsapp');
        $this->load->helper('Telegram');
    }


    public function index()
    {
        // file config
        $filename = $this->input->post('fnama_lengkap') . '_' . date('d/m/Y');
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/registrasi/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;

        $registrasi = $this->Registrasi_m;
        $validation = $this->form_validation;
        $validation->set_rules($registrasi->rules());

        $no_urut_registrasi = $this->Registrasi_m->get_no_urut_registrasi();
        $data['no_regis'] = date('dmy') . sprintf("%04d", $no_urut_registrasi);
        if ($validation->run() == FALSE) {
            $this->load->view('registrasi/index', $data);
        } else {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('flampiran')) {
                $file = $this->upload->data("file_name");
                $post = $this->input->post(null, TRUE);
                $registrasi->add_customer($post, $file);
                $text_wa = 'Hallo ' . ucwords($post['fnama_lengkap']) .
                    '
                    
Terima kasih sudah melakukan registrasi
data anda sudah kami terima.

Nomor Registrasi Anda : ' . $data['no_regis'] . '

Admin kami akan segara menghubungi anda untuk melakukan konfirmasi jadwal pemasangan.

Salam,
Gisaka Media';
                if ($this->db->affected_rows() > 0) {
                    telegram_notif_registrasi_pelanggan($post);
                    $notif = send_wa($post['fnowa'], $text_wa);
                    if ($notif == 200) {
                        $this->session->set_flashdata('success', 'Registrasi berhasil ' . $notif);
                        redirect('registrasi/success/' . encrypt_url($data['no_regis']), 'refresh');
                    } else {
                        $this->session->set_flashdata('success', 'Registrasi berhasil ' . $notif);
                        redirect('registrasi/success/' . encrypt_url($data['no_regis']), 'refresh');
                    }
                }
            } else {
                $file = null;
                $this->session->set_flashdata('warning', 'Foto KTP / SIM / Passport harus terisi');
                $this->load->view('registrasi/index');
            }
        }
    }
    // function send_wa()
    // {
    //     $dataSending = array();
    //     $dataSending["api_key"] = "HUVICSYRSVNYX7MW";
    //     $dataSending["number_key"] = "EhlZhkMgwgxbfNOx";
    //     $dataSending["phone_no"] = "6287776451664";
    //     $dataSending["message"] = "ezhilan ganteng";
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => json_encode($dataSending),
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     echo $response;
    // }
    // function cek_wa()
    // {
    //     $dataSending = array();
    //     $dataSending["api_key"] = "HUVICSYRSVNYX7MW";
    //     $dataSending["number_key"] = "EhlZhkMgwgxbfNOx";
    //     $dataSending["phone_no"] = "6287776451664";
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.watzap.id/v1/validate_number',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => json_encode($dataSending),
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $data = json_decode($response);
    //     echo $data->status;
    // }
    function success($noregis = null)
    {
        if (!$noregis) {
            redirect('registrasi', 'refresh');
        } else {
            $nomor_registrasi = decrypt_url($noregis);
            $data['data'] = $this->Registrasi_m->get_by_no_registrasi($nomor_registrasi);
            if ($data['data']) {
                $data['noregis'] = $nomor_registrasi;
                $this->load->view('registrasi/done', $data);
            } else {
                $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
                // redirect('registrasi', 'refresh');
            }
        }
    }
}

/* End of file Registrasi.php */
