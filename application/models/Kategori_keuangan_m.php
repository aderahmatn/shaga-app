<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_keuangan_m extends CI_Model
{

    private $_table = 'kategori_keuangan';
    public $id_kategori_keuangan;
    public $kategori_keuangan;
    public $deleted;
    public function rules_kategori_keuangan()
    {
        return [
            [
                'field' => 'fkategori_keuangan',
                'label' => 'kategori keuangan',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_kategori_keuangan()
    {
        return $this->db->get_where($this->_table, ["deleted" => 0])->result();
    }
    public function add_kategori_keuangan()
    {
        $post = $this->input->post();
        $this->kategori_keuangan = $post['fkategori_keuangan'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_kategori_keuangan($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_kategori_keuangan', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Kategori_keuangan_m.php */
?>