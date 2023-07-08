<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role_administrator();
        $this->load->model('Users_m');
        $this->load->model('Group_user_m');


    }

    public function index()
    {
        $data['users'] = $this->Users_m->get_all_users();
        $this->template->load('shared/index', 'user/index', $data);

    }
    function create()
    {
        $users = $this->Users_m;
        $validation = $this->form_validation;
        $validation->set_rules($users->rules());
        if ($validation->run() == FALSE) {
            $data['last_nik'] = $users->get_last_nik();
            $data['group_user'] = $this->Group_user_m->get_all_group_user();
            $this->template->load('shared/index', 'user/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $users->add_user($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data user berhasil disimpan!');
                redirect('users', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->Users_m->delete_user(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data user berhasil dihapus!');
            redirect('users', 'refresh');
        }
    }

}

/* End of file User.php */