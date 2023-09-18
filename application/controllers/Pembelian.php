<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_role_administrator();
        $this->load->model(['Pembelian_m', 'Project_m', 'Item_pembelian_m']);
        $this->load->helper(['Rupiah', 'formatdate', 'pembelian']);


    }


    public function index()
    {
        $data['pembelian'] = $this->Pembelian_m->get_all_pembelian();
        $this->template->load('shared/index', 'pembelian/index', $data);

    }
    public function create()
    {

        $pembelian = $this->Pembelian_m;
        $validation = $this->form_validation;
        $validation->set_rules($pembelian->rules());
        if ($validation->run() == FALSE) {
            $data['no_pembelian'] = $this->Pembelian_m->get_no_pembelian();
            $data['project'] = $this->Project_m->get_all_project_for_pembelian();
            $this->template->load('shared/index', 'pembelian/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $pembelian->add_pembelian($post);
            if ($this->db->affected_rows() > 0) {
                $nama_barang = $_POST['fnama_barang'];
                $harga_satuan = $_POST['fharga_satuan'];
                $qty = $_POST['fqty'];
                $spesifikasi = $_POST['fspesifikasi'];
                $note = $_POST['fnote'];
                $data = array();
                $index = 0;
                foreach ($nama_barang as $key) {
                    array_push(
                        $data,
                        array(
                            'nama_barang' => $key,
                            'harga_satuan' => $harga_satuan[$index],
                            'no_pembelian' => $post['fno_pembelian'],
                            'qty' => $qty[$index],
                            'total_harga' => $harga_satuan[$index] * $qty[$index],
                            'spesifikasi' => $spesifikasi[$index],
                            'note' => $note[$index],
                        )
                    );
                    $index++;
                }
                $sql = $this->Item_pembelian_m->add_item_pembelian($data);
                if ($sql) {
                    $this->session->set_flashdata('success', 'Data pembelian berhasil disimpan!');
                    redirect('pembelian', 'refresh');
                } else {
                    $this->session->set_flashdata('danger', 'Data pembelian gagal disimpan!');
                    redirect('pembelian/create', 'refresh');
                }

            }
        }
    }
    // public function test($no)
    // {
    //     $data = $this->Item_pembelian_m->total_pembelian_by_no_pembelian($no);
    //     echo $data;
    // }
}

/* End of file Pembelian.php */