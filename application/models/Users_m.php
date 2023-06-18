<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_m extends CI_Model
{

    private $_table = 'users';
    public $id_user;
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
                'rules' => 'required|matches[fpassword]
'
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
    public function add_user()
    {
        $post = $this->input->post();
        $this->nama_user = $post['fname_user'];
        $this->email_user = $post['femail_user'];
        $this->phone_user = $post['fphone_user'];
        $this->status_user = 1;
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


}

/* End of file Users_m.php */