<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_merek_m extends CI_Model
{
    private $_table = 'master_merek';
    public $nama_merek;
    public $kode_merek;
    public $deleted;
    public function rules_master_merek()
    {
        return [
            [
                'field' => 'fkode_merek',
                'label' => 'kode merek',
                'rules' => 'required|is_unique[master_merek.kode_merek]'
            ],
            [
                'field' => 'fnama_merek',
                'label' => 'merek',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_master_merek()
    {
        return $this->db->get_where($this->_table, ["deleted" => 0])->result();
    }
    public function add_master_merek()
    {
        $post = $this->input->post();
        $this->kode_merek = $post['fkode_merek'];
        $this->nama_merek = $post['fnama_merek'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_master_merek($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_master_merek', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Master_barang_m.php */
