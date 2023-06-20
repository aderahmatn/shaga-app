<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasbon extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Kasbon_m');
        $this->load->helper('rupiah');

    }

    public function index()
    {
        $data['kasbon'] = $this->Kasbon_m->get_all_kasbon();
        $this->template->load('shared/index', 'kasbon/index', $data);

    }
    public function create()
    {

        $kasbon = $this->Kasbon_m;
        $validation = $this->form_validation;
        $validation->set_rules($kasbon->rules());
        if ($validation->run() == FALSE) {
            $data['no_urut'] = $kasbon->get_no_urut_kasbon();
            $this->template->load('shared/index', 'kasbon/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kasbon->add_kasbon($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kasbon berhasil diajukan!');
                redirect('kasbon', 'refresh');
            }
        }
    }

}

/* End of file Kasbon.php */