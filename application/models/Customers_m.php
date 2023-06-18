<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers_m extends CI_Model
{
    private $_table = "customers";
    public $uid_customer;
    public $id_customer;
    public $fullname;
    public $phone_customer;
    public $no_id;
    public $jenis_id;
    public $alamat_id;
    public $no_npwp;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fid_customer',
                'label' => 'ID pelanggan',
                'rules' => 'required|is_unique[customers.id_customer]'
            ],
            [
                'field' => 'ffullname',
                'label' => 'nama lengkap',
                'rules' => 'required'
            ],
            [
                'field' => 'fphone_customer',
                'label' => 'nomor handphone',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'fno_id',
                'label' => 'nomor identitas',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'fjenis_id',
                'label' => 'jenis identitas',
                'rules' => 'required'
            ],
            [
                'field' => 'falamat_id',
                'label' => 'alamat lengkap',
                'rules' => 'required'
            ],
            [
                'field' => 'fno_npwp',
                'label' => 'nomor NPWP',
                'rules' => 'required|numeric'
            ],
        ];
    }
    public function get_all_customer()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('customers.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_customer()
    {
        $post = $this->input->post();
        $this->fullname = $post['ffullname'];
        $this->id_customer = $post['fid_customer'];
        $this->phone_customer = $post['fphone_customer'];
        $this->no_id = $post['fno_id'];
        $this->jenis_id = $post['fjenis_id'];
        $this->alamat_id = $post['falamat_id'];
        $this->no_npwp = $post['fno_npwp'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_customer($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('uid_customer', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Customers_m.php */