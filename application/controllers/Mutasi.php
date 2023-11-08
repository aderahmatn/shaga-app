<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role_administrator_and_admin_officer();
        $this->load->model(['Mutasi_m', 'Inventory_m', 'Log_m']);
    }


    public function index()
    {
        $mutasi = $this->Mutasi_m;
        $validation = $this->form_validation;
        $validation->set_rules($mutasi->rules_mutasi());
        if ($validation->run() == FALSE) {
            $data['mutasi'] = $mutasi->get_all_mutasi();
            $data['inventory'] = $this->Inventory_m->get_all_inventory();
            $this->template->load('shared/index', 'mutasi/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $mutasi->add_mutasi($post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert mutasi barang no regis ' . $post['fno_regis']);
                $this->session->set_flashdata('success', 'Data mutasi barang berhasil disimpan!');
                redirect('mutasi', 'refresh');
            }
        }
    }
}

/* End of file Mutasi.php */
