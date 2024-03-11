<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role_administrator_and_admin_officer();
        $this->load->model('Customers_m');
        $this->load->model('Registrasi_m');
    }

    public function browse()
    {

        $data['customers'] = $this->Customers_m->get_all_customer();
        $this->template->load('shared/index', 'customer/index', $data);
    }
    public function browse_registrasi()
    {

        $data['customers'] = $this->Registrasi_m->get_all_data_registrasi();
        $this->template->load('shared/index', 'customer/registration', $data);
    }
    public function onbill()
    {

        $data['customers'] = $this->Customers_m->get_all_customer();
        $this->template->load('shared/index', 'customer/onbill', $data);
    }
    public function create()
    {
        $customers = $this->Customers_m;
        $validation = $this->form_validation;
        $validation->set_rules($customers->rules());
        if ($validation->run() == FALSE) {
            $data['id_cust'] = $this->Customers_m->get_id_customer();
            $this->template->load('shared/index', 'customer/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $customers->add_customer($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data customer berhasil disimpan!');
                redirect('customer/create', 'refresh');
            }
        }
    }
    public function edit($id = null)
    {
        $customers = $this->Customers_m;
        $validation = $this->form_validation;
        $validation->set_rules($customers->rules());
        if ($validation->run() == FALSE) {
            $data['cust'] = $this->Customers_m->get_cust_by_id(decrypt_url($id));
            $this->template->load('shared/index', 'customer/edit', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $customers->edit_customer($post, decrypt_url($id));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data customer berhasil disimpan!');
                redirect('customer/browse', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Batal edit data pelanggan');
                redirect('customer/browse', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->Customers_m->delete_customer(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pelanggan berhasil dihapus!');
            redirect('customer/browse', 'refresh');
        }
    }
}

/* End of file Customer.php */