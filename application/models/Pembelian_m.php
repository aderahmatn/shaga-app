<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_m extends CI_Model
{
    private $_table = 'pembelian';
    public $id_pembelian;
    public $no_pembelian;
    public $id_user;
    public $project_id;
    public $note_pembelian;
    public $created_date;
    public $deleted;
    public function rules()
    {
        return [
            [
                'field' => 'fproject',
                'label' => 'nama project',
                'rules' => 'required'
            ],
            [
                'field' => 'fno_pembelian',
                'label' => 'nomor pembelian',
                'rules' => 'required'
            ],
            [
                'field' => 'fnama_barang[]',
                'label' => 'item',
                'rules' => 'required'
            ],
            [
                'field' => 'fharga_satuan[]',
                'label' => 'item',
                'rules' => 'required'
            ],
            [
                'field' => 'fqty[]',
                'label' => 'item',
                'rules' => 'required'
            ],
            [
                'field' => 'fspesifikasi[]',
                'label' => 'item',
                'rules' => 'required'
            ],
            [
                'field' => 'fnote[]',
                'label' => 'item',
                'rules' => 'required'
            ],
        ];
    }

    public function get_all_pembelian()
    {
        $this->db->select('*, users.nama_user, project.nama_project, pembelian.created_date');
        $this->db->from($this->_table);
        $this->db->join('users', 'users.id_user = pembelian.id_user', 'left');
        $this->db->join('project', 'project.project_id = pembelian.project_id', 'left');
        $this->db->where('pembelian.deleted', 0);
        $this->db->order_by('pembelian.id_pembelian', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function add_pembelian()
    {
        $post = $this->input->post();
        $this->note_pembelian = $post['fcatatan'];
        $this->no_pembelian = $post['fno_pembelian'];
        $this->id_user = $this->session->userdata('id_user');
        $this->project_id = $post['fid_project'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    function get_no_pembelian()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_pembelian,4)) AS id_max FROM pembelian WHERE DATE(created_date)=CURDATE()");
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

}

/* End of file Pembelian_m.php */