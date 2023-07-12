<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_m extends CI_Model
{

    private $_table = 'users';
    public $id_user;
    public $nik;
    public $no_rekening;
    public $tgl_join;
    public $bank;
    public $nama_user;
    public $email_user;
    public $phone_user;
    public $status_user;
    public $id_group_user;
    public $username;
    public $password;
    public $deleted;

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

    public function get_all_users()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('group_users', 'group_users.id_group_user = users.id_group_user', 'left');
        $this->db->where('users.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id_user($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('group_users', 'group_users.id_group_user = users.id_group_user', 'left');
        $this->db->where('users.id_user', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add_user()
    {
        $post = $this->input->post();
        $this->nama_user = $post['fname_user'];
        $this->no_rekening = $post['fno_rekening'];
        $this->bank = $post['fbank'];
        $this->tgl_join = $post['ftgl_join'];
        $this->email_user = $post['femail_user'];
        $this->phone_user = $post['fphone_user'];
        $this->status_user = 1;
        $tgl_join = preg_replace("/[^0-9]/", "", $post['ftgl_join']);
        $thn_bln = substr($tgl_join, 2, 4);
        $no_urut = substr($this->get_last_nik(), 4) + 1;
        if (strlen($no_urut) == 1) {
            $no_urut_new = "00" . $no_urut;
        } else if (strlen($no_urut) == 2) {
            $no_urut_new = "0" . $no_urut;
        } else {
            $no_urut_new = $no_urut;
        }
        $this->nik = $thn_bln . $no_urut_new; //2023-06-19
        $this->id_group_user = $post['fid_group_user'];
        $this->username = $post['fusername'];
        $this->password = encrypt_url($post['fpassword']);
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_user($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_user', $id);
        $this->db->update($this->_table);
    }

    function get_last_nik()
    {
        $this->db->select('nik');
        $this->db->limit(1);
        $this->db->order_by('nik', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->nik;

    }
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('username', $post['fusername']);
        $this->db->where('status_user', 1);
        $this->db->where('password', encrypt_url($post['fpassword']));
        $this->db->join('group_users', 'group_users.id_group_user = users.id_group_user', 'left');

        $query = $this->db->get();
        return $query;
    }

    function cek_password_lama($id_user, $pwd)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_user', $id_user);
        $this->db->where('password', encrypt_url($pwd));
        $query = $this->db->get();
        return $query->row();
    }
    function password_is_default($id_user)
    {
        $this->db->select('password');
        $this->db->from($this->_table);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        $pwd = $query->row()->password;
        if (decrypt_url($pwd) == 'admin123') {
            return true;
        } else {
            return false;
        }
    }
    function ganti_password($id_user, $pwd)
    {
        $this->db->set('password', encrypt_url($pwd));
        $this->db->where('id_user', $id_user);
        $this->db->update($this->_table);
    }
    function aktif_nonaktif($id, $value)
    {
        $this->db->set('status_user', $value);
        $this->db->where('id_user', $id);
        $this->db->update($this->_table);
    }


}

/* End of file Users_m.php */