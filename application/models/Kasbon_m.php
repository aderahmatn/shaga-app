<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasbon_m extends CI_Model
{
    private $_table = "kasbon";
    public $no_dokumen;
    public $id_user;
    public $keperluan;
    public $nominal;
    public $cara_bayar;
    public $no_urut_kasbon;
    public $note;
    public $status;
    public function rules()
    {
        return [
            [
                'field' => 'fkeperluan',
                'label' => 'keperluan',
                'rules' => 'required'
            ],
            [
                'field' => 'fnominal',
                'label' => 'nominal',
                'rules' => 'required'
            ],
            [
                'field' => 'fcara_pencairan',
                'label' => 'cara pencairan',
                'rules' => 'required'
            ],
        ];
    }
    public function add_kasbon()
    {
        $post = $this->input->post();
        $this->id_user = $this->session->userdata('id_user');
        $this->no_dokumen = $post['fno_dokumen'];
        $this->keperluan = $post['fkeperluan'];
        $this->nominal = str_replace(".", "", $post['fnominal']);
        $this->cara_bayar = $post['fcara_pencairan'];
        $this->note = $post['fnote'];
        $this->status = 'created';
        $this->no_urut_kasbon = $this->get_no_urut_kasbon();
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function get_all_kasbon()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('kasbon.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_no_urut_kasbon()
    {
        $this->db->select('no_urut_kasbon');
        $this->db->from($this->_table);
        $this->db->order_by('no_urut_kasbon', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row()->no_urut_kasbon + 1;

    }


}

/* End of file Kasbon_m.php */