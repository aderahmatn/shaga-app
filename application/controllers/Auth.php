<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_m');
        $this->load->helper('captcha');
        $this->load->helper('telegram');
        $this->load->helper('string');



    }

    public function login()
    {
        check_already_login();

        $this->load->view('auth/login');

    }
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if ($post) {
            $query = $this->Users_m->login($post);
            if ($post['flock'] == "true") {
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    if ($row->chat_id == 0) {
                        $data['code'] = $row->verify_code;
                        $this->load->view('telegram/verify', $data);
                    } else {
                        $params = array(
                            'id_user' => $row->id_user,
                            'email' => $row->email_user,
                            'nik' => $row->nik,
                            'group' => $row->id_group_user,
                            'nama_group' => $row->group_user,
                            'username' => $row->username,
                            'nama_user' => $row->nama_user,
                            'status' => 'login'
                        );
                        $this->session->set_userdata($params);
                        telegram_notif_login($params);
                        redirect('dashboard', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'username / password salah');
                    redirect('auth/login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Captcha tidak cocok');
                redirect('auth/login', 'refresh');

            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function logout()
    {
        check_not_login();
        $params = array('id_user', 'email', 'nik', 'group', 'username', 'nama_user', 'status');
        $this->session->unset_userdata($params);
        redirect('auth/login', 'refresh');
    }

}

/* End of file auth.php */