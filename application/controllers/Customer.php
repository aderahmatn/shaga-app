<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_m');

    }

    public function browse()
    {
        $data['customers'] = $this->Customers_m->get_all_customer();
        $this->template->load('shared/index', 'customer/index', $data);

    }
    public function create()
    {
        $customers = $this->Customers_m;
        $validation = $this->form_validation;
        $validation->set_rules($customers->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'customer/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $customers->add_customer($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data customer berhasil disimpan!');
                redirect('customer/create', 'refresh');
            }
        }

    }

}

/* End of file Customer.php */