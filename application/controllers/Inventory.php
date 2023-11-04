<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role_administrator_and_admin_officer();
        $this->load->model(['Master_barang_m', 'Master_merek_m', 'Log_m', 'Master_tipe_m', 'Inventory_m']);
        $this->load->helper('Rupiah');
    }


    public function index()
    {
        $inventory = $this->Inventory_m;
        $validation = $this->form_validation;
        $validation->set_rules($inventory->rules_inventory());
        if ($validation->run() == FALSE) {
            $data['master_barang'] = $this->Master_barang_m->get_all_master_barang();
            $data['master_tipe'] = $this->Master_tipe_m->get_all_master_tipe();
            $data['inventory'] = $inventory->get_all_inventory();
            $this->template->load('shared/index', 'inventory/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $inventory->add_inventory($post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert inventory barang ' . $post['fbarang']);
                $this->session->set_flashdata('success', 'Data barang berhasil disimpan!');
                redirect('inventory', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        $inventory = $this->Inventory_m;
        $validation = $this->form_validation;
        $validation->set_rules($inventory->rules_update_inventory());
        if ($validation->run() == FALSE) {
            $data['master_barang'] = $this->Master_barang_m->get_all_master_barang();
            $data['master_tipe'] = $this->Master_tipe_m->get_all_master_tipe();
            $data['inventory'] = $inventory->get_all_inventory();
            $data['data'] = $inventory->get_by_id_inventory(decrypt_url($id));
            if ($data['data']) {
                $this->template->load('shared/index', 'inventory/edit', $data);
            } else {
                $this->session->set_flashdata('warning', 'Data inventory tidak ditemukan!');
                redirect('inventory', 'refresh');
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $inventory->update_inventory($id, $post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('update data inventory barang ' . $post['fno_registrasi']);
                $this->session->set_flashdata('success', 'Update data barang berhasil!');
                redirect('inventory', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Update data barang dibatalkan!');
                redirect('inventory', 'refresh');
            }
        }
    }
    public function delete_inventory($id)
    {
        $this->Inventory_m->delete_inventory(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Log_m->create_log('delete inventory ' . decrypt_url($id));
            $this->session->set_flashdata('success', 'Data inventory berhasil dihapus!');
            redirect('inventory', 'refresh');
        }
    }
    function barcode($id = null)
    {

        include_once APPPATH . '/third_party/fpdf/fpdf.php';
        if ($id == null) {
            $this->session->set_flashdata('warning', 'ID tidak ditemukan');
            redirect('inventory', 'refresh');
        } else {
            $data['id'] = $id;
            $this->load->view('inventory/barcode_pdf', $data);
        }
    }

    public function master_barang()
    {
        $master_barang = $this->Master_barang_m;
        $validation = $this->form_validation;
        $validation->set_rules($master_barang->rules_master_barang());
        if ($validation->run() == FALSE) {
            $data['master_barang'] = $this->Master_barang_m->get_all_master_barang();
            $data['no_urut'] = $this->Master_barang_m->get_no_urut_barang();
            $this->template->load('shared/index', 'inventory/master_barang', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $master_barang->add_master_barang($post);
            $item = $post['fkode_barang'];
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert master barang ' . $item);
                $this->session->set_flashdata('success', 'Data master barang berhasil disimpan!');
                redirect('inventory/master_barang', 'refresh');
            }
        }
    }
    public function delete_master_barang($id)
    {
        $id_brg = decrypt_url($id);
        $this->Master_barang_m->delete_master_barang($id_brg);
        if ($this->db->affected_rows() > 0) {
            $this->Log_m->create_log('delete master barang id ' . $id_brg);
            $this->session->set_flashdata('success', 'Data master barang berhasil dihapus!');
            redirect('inventory/master_barang', 'refresh');
        }
    }
    public function master_merek()
    {
        $master_merek = $this->Master_merek_m;
        $validation = $this->form_validation;
        $validation->set_rules($master_merek->rules_master_merek());
        if ($validation->run() == FALSE) {
            $data['master_merek'] = $this->Master_merek_m->get_all_master_merek();
            $data['no_urut'] = $this->Master_merek_m->get_no_urut_merek();
            $this->template->load('shared/index', 'inventory/master_merek', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $master_merek->add_master_merek($post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert master merek ' . $post['fkode_merek']);
                $this->session->set_flashdata('success', 'Data master merek berhasil disimpan!');
                redirect('inventory/master_merek', 'refresh');
            }
        }
    }
    public function delete_master_merek($id)
    {
        $this->Master_merek_m->delete_master_merek(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Log_m->create_log('delete master merek id ' . decrypt_url($id));
            $this->session->set_flashdata('success', 'Data master merek berhasil dihapus!');
            redirect('inventory/master_merek', 'refresh');
        }
    }
    public function master_tipe()
    {
        $master_tipe = $this->Master_tipe_m;
        $validation = $this->form_validation;
        $validation->set_rules($master_tipe->rules_master_tipe());
        if ($validation->run() == FALSE) {
            $data['master_tipe'] = $this->Master_tipe_m->get_all_master_tipe();
            $data['master_merek'] = $this->Master_merek_m->get_all_master_merek();
            $data['no_urut'] = $this->Master_tipe_m->get_no_urut_tipe();
            $this->template->load('shared/index', 'inventory/master_tipe', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $master_tipe->add_master_tipe($post);
            if ($this->db->affected_rows() > 0) {
                $this->Log_m->create_log('insert master tipe barang kode ' . $post['fkode_tipe']);
                $this->session->set_flashdata('success', 'Data master tipe barang berhasil disimpan!');
                redirect('inventory/master_tipe', 'refresh');
            }
        }
    }
    public function delete_master_tipe($id)
    {
        $this->Master_tipe_m->delete_master_tipe(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Log_m->create_log('delete master tipe id ' . decrypt_url($id));
            $this->session->set_flashdata('success', 'Data master tipe barang berhasil dihapus!');
            redirect('inventory/master_tipe', 'refresh');
        }
    }
}

/* End of file Inventory.php */
