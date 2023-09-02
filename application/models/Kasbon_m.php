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
    public $deleted;
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
                'rules' => 'required|min_length[3]'
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
        $this->no_urut_kasbon = $this->get_no_urut_kasbon();
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    function get_total_pengajuan_keuangan($bln)
    {
        $this->db->select_sum('nominal');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('month(kasbon.created_date)', $bln);
        $this->db->order_by('id_kasbon', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->nominal;
    }
    function get_total_pengajuan_keuangan_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori)
    {
        $this->db->select_sum('nominal');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('kasbon.deleted', 0);
        if ($karyawan != 'all') {
            $this->db->where('kasbon.id_user', $karyawan);
        }
        if ($tgl_awal != null) {
            $this->db->where('kasbon.created_date >=', $tgl_awal);
        }
        if ($tgl_akhir != null) {
            $this->db->where('kasbon.created_date <=', $tgl_akhir);
        }
        if ($kategori != 'all') {
            $this->db->where('kasbon.keperluan', $kategori);
        }

        $this->db->order_by('id_kasbon', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->nominal;
    }
    function get_total_by_status($bln, $status)
    {
        $this->db->select_sum('nominal');
        $this->db->join('status_kasbon', 'status_kasbon.no_dokumen = kasbon.no_dokumen', 'left');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('status_kasbon.status_kasbon', $status);
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('month(kasbon.created_date)', $bln);
        $this->db->order_by('id_kasbon', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->nominal;
    }
    function get_total_by_status_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori, $status)
    {
        $this->db->select_sum('nominal');
        $this->db->join('status_kasbon', 'status_kasbon.no_dokumen = kasbon.no_dokumen', 'left');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('status_kasbon.status_kasbon', $status);
        if ($karyawan != 'all') {
            $this->db->where('kasbon.id_user', $karyawan);
        }
        if ($tgl_awal != null) {
            $this->db->where('kasbon.created_date >=', $tgl_awal);
        }
        if ($tgl_akhir != null) {
            $this->db->where('kasbon.created_date <=', $tgl_akhir);
        }
        if ($kategori != 'all') {
            $this->db->where('kasbon.keperluan', $kategori);
        }

        $this->db->where('kasbon.deleted', 0);
        $this->db->order_by('id_kasbon', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->nominal;
    }
    public function get_all_kasbon($bln)
    {
        $this->db->select('kasbon.*, users.nama_user, users.nik, kategori_keuangan.kategori_keuangan');
        $this->db->from($this->_table);
        $this->db->join('kategori_keuangan', 'kategori_keuangan.id_kategori_keuangan = kasbon.keperluan', 'left');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        if ($this->session->userdata('group') != 1) {
            $this->db->where('kasbon.id_user', $this->session->userdata('id_user'));
        }
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('month(kasbon.created_date)', $bln);
        $this->db->order_by('id_kasbon', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_kasbon_by_filter($karyawan, $tgl_awal, $tgl_akhir, $kategori)
    {
        $this->db->select('kasbon.*, users.nama_user, users.nik, kategori_keuangan.kategori_keuangan');
        $this->db->from($this->_table);
        $this->db->join('kategori_keuangan', 'kategori_keuangan.id_kategori_keuangan = kasbon.keperluan', 'left');
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');

        $this->db->where('kasbon.deleted', 0);
        if ($karyawan != 'all') {
            $this->db->where('kasbon.id_user', $karyawan);
        }
        if ($tgl_awal != null) {
            $this->db->where('kasbon.created_date >=', $tgl_awal);
        }
        if ($tgl_akhir != null) {
            $this->db->where('kasbon.created_date <=', $tgl_akhir);
        }
        if ($kategori != 'all') {
            $this->db->where('kasbon.keperluan', $kategori);
        }

        $this->db->order_by('id_kasbon', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id_kasbon($id)
    {
        $this->db->select('kasbon.*, users.nama_user, users.nik, kategori_keuangan.kategori_keuangan');
        $this->db->from($this->_table);
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        $this->db->join('kategori_keuangan', 'kategori_keuangan.id_kategori_keuangan = kasbon.keperluan', 'left');
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('kasbon.id_kasbon', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_by_no_dokumen($no_dokumen)
    {
        $this->db->select('kasbon.*, users.nama_user, users.nik, kategori_keuangan.kategori_keuangan');
        $this->db->from($this->_table);
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        $this->db->join('kategori_keuangan', 'kategori_keuangan.id_kategori_keuangan = kasbon.keperluan', 'left');
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('kasbon.no_dokumen', $no_dokumen);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_chat_id_by_id_kasbon($id_kasbon)
    {
        $this->db->select('kasbon.*, users.chat_id');
        $this->db->from($this->_table);
        $this->db->join('users', 'users.id_user = kasbon.id_user', 'left');
        $this->db->where('kasbon.deleted', 0);
        $this->db->where('kasbon.id_kasbon', $id_kasbon);
        $query = $this->db->get();
        return $query->row()->chat_id;
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