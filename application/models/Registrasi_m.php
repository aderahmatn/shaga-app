<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi_m extends CI_Model
{

    private $_table = 'registrasi_customer';
    public $id_registrasi_customer;
    public $nama_lengkap;
    public $jenkel;
    public $tgl_lahir;
    public $nomor_identitas;
    public $jenis_identitas;
    public $alamat_identitas;
    public $foto_identitas;
    public $kota;
    public $kode_pos;
    public $faksimili;
    public $telepon;
    public $seluler;
    public $email;
    public $jenis_layanan;
    public $bandwidth;
    public $bandwidth_lainnya;
    public $alamat_pemasangan;
    public $rt;
    public $rw;
    public $desa;
    public $kecamatan;
    public $kota_pemasangan;
    public $kode_pos_pemasangan;
    public $jangka_waktu_berlangganan;
    public $jangka_waktu_berlangganan_lainnya;
    public $tgl_pemasangan;
    public function rules()
    {
        return [
            [
                'field' => 'fname_user',
                'label' => 'name user',
                'rules' => 'required'
            ],
            [
                'field' => 'femail_user',
                'label' => 'email user',
                'rules' => 'required|is_unique[users.email_user]|valid_email'
            ],
            [
                'field' => 'fphone_user',
                'label' => 'phone user',
                'rules' => 'required|is_unique[users.phone_user]'
            ],
            [
                'field' => 'fid_group_user',
                'label' => 'group user',
                'rules' => 'required'
            ],
            [
                'field' => 'fusername',
                'label' => 'username',
                'rules' => 'required|is_unique[users.username]'
            ],
            [
                'field' => 'fpassword',
                'label' => 'password',
                'rules' => 'required|min_length[8]'
            ],
            [
                'field' => 'fconfpassword',
                'label' => 'konfirmasi password',
                'rules' => 'required|matches[fpassword]'
            ],
            [
                'field' => 'fno_rekening',
                'label' => 'nomor rekening',
                'rules' => 'numeric'
            ],
            [
                'field' => 'ftgl_join',
                'label' => 'tanggal join',
                'rules' => 'required'

            ],
        ];
    }
}

/* End of file Registrasi_m.php */
