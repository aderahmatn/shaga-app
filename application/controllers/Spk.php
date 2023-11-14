<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Spk_m', 'Project_m', 'Users_m', 'Jenis_pekerjaan_m', 'Log_m']);
    }


    public function index()
    {
        $spk = $this->Spk_m;
        $project = $this->Project_m;
        $user = $this->Users_m;
        $jenis_pekerjaan = $this->Jenis_pekerjaan_m;
        $validation = $this->form_validation;
        $validation->set_rules($spk->rules_spk());
        if ($validation->run() == FALSE) {
            $data['user'] = $user->get_all_users();
            $data['project'] = $project->get_all_project();
            $data['jenis_pekerjaan'] = $jenis_pekerjaan->get_all_jenis_pekerjaan();
            $data['spk'] = $spk->get_all_spk();
            $this->template->load('shared/index', 'spk/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $spk->add_spk($post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert SPK NO ' . 'GSK/' . date('dmy') . '/SPK/' . sprintf("%04d", $spk->get_no_urut_spk()));
                $this->session->set_flashdata('success', 'Data SPK berhasil disimpan!');
                redirect('spk', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        $spk = $this->Spk_m;
        $project = $this->Project_m;
        $user = $this->Users_m;
        $jenis_pekerjaan = $this->Jenis_pekerjaan_m;
        $validation = $this->form_validation;
        $validation->set_rules($spk->rules_spk());
        if ($validation->run() == FALSE) {
            $data['user'] = $user->get_all_users();
            $data['project'] = $project->get_all_project();
            $data['jenis_pekerjaan'] = $jenis_pekerjaan->get_all_jenis_pekerjaan();
            $data['spk'] = $spk->get_all_spk();
            $data['data'] = $spk->get_spk_by_id(decrypt_url($id));
            if ($data['data']) {
                $this->template->load('shared/index', 'spk/edit', $data);
            } else {
                $this->session->set_flashdata('warning', 'Data spk tidak ditemukan!');
                redirect('spk', 'refresh');
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $spk->update_spk($id, $post);
            if ($this->db->affected_rows() > 0) {
                $data['data'] = $spk->get_spk_by_id(decrypt_url($id));
                $this->Log_m->create_log('update data spk nomor ' . $data['data']->no_spk);
                $this->session->set_flashdata('success', 'Update data spk berhasil!');
                redirect('spk', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Update data barang dibatalkan!');
                redirect('spk', 'refresh');
            }
        }
    }
    public function delete_spk($id)
    {
        $this->Spk_m->delete_spk(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Log_m->create_log('delete spk ID ' . decrypt_url($id));
            $this->session->set_flashdata('success', 'Data spk berhasil dihapus!');
            redirect('spk', 'refresh');
        }
    }
}

/* End of file Spk.php */
