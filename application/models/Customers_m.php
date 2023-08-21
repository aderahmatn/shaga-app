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
                'rules' => 'required'
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
                'rules' => 'numeric|min_length[16]'
            ],
        ];
    }
    function get_id_customer()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_customer,4)) AS id_max FROM customers WHERE DATE(created_date)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->id_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy') . $kd;
    }
    public function get_all_customer()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('customers.deleted', 0);
        $this->db->order_by('uid_customer', 'desc');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_cust_by_id($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('customers.deleted', 0);
        $this->db->where('customers.uid_customer', $id);
        $query = $this->db->get();
        return $query->row();
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
    public function edit_customer($post, $id)
    {
        $post = $this->input->post();
        $this->db->set('fullname', $post['ffullname']);
        $this->db->set('phone_customer', $post['fphone_customer']);
        $this->db->set('no_id', $post['fno_id']);
        $this->db->set('jenis_id', $post['fjenis_id']);
        $this->db->set('alamat_id', $post['falamat_id']);
        $this->db->set('no_npwp', $post['fno_npwp']);
        $this->db->where('uid_customer', $id);
        $this->db->update($this->_table);
    }
    public function delete_customer($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('uid_customer', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Customers_m.php */