<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_tipe_m extends CI_Model
{
    private $_table = 'master_tipe';
    public $kode_tipe;
    public $id_master_merek;
    public $spesifikasi;
    public $deleted;
    public function rules_master_tipe()
    {
        return [
            [
                'field' => 'fkode_tipe',
                'label' => 'kode tipe',
                'rules' => 'required|is_unique[master_tipe.kode_tipe]'
            ],
            [
                'field' => 'fspesifikasi',
                'label' => 'spesifikasi',
                'rules' => 'required'
            ],
            [
                'field' => 'fmerek',
                'label' => 'merek',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_master_tipe()
    {
        $this->db->select('*');
        $this->db->join('master_merek', 'master_merek.id_master_merek= master_tipe.id_master_merek', 'left');
        $this->db->where('master_tipe.deleted', 0);

        $this->db->from($this->_table, $this);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_master_tipe()
    {
        $post = $this->input->post();
        $this->kode_tipe = $post['fkode_tipe'];
        $this->id_master_merek = $post['fmerek'];
        $this->spesifikasi = $post['fspesifikasi'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_master_tipe($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_master_tipe', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Master_barang_m.php */
