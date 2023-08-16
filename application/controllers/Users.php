<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Users_m');
        $this->load->model('Group_user_m');


    }

    public function list()
    {
        check_role_administrator();
        $data['users'] = $this->Users_m->get_all_users();
        $this->template->load('shared/index', 'user/index', $data);

    }
    function create()
    {
        check_role_administrator();
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
                redirect('users/list', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        check_role_administrator();
        $this->Users_m->delete_user(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data user berhasil dihapus!');
            redirect('users', 'refresh');
        }
    }
    public function aktif_nonaktif($id, $value)
    {
        check_role_administrator();
        $this->Users_m->aktif_nonaktif(decrypt_url($id), $value);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data user berhasil diupdate!');
            redirect('users', 'refresh');
        }
    }
    function detail($id)
    {
        check_role_administrator();
        $data['user'] = $this->Users_m->get_by_id_user(decrypt_url($id));
        $this->template->load('shared/index', 'user/detail', $data);

    }
    function profile()
    {
        $data['user'] = $this->Users_m->get_by_id_user($this->session->userdata('id_user'));
        $this->template->load('shared/index', 'user/profile', $data);
    }

}

/* End of file User.php */