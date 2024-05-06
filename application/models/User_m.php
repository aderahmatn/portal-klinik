<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

    private $_table = 'user';
    public $id_user;
    public $nama_user;
    public $email_user;
    public $username;
    public $password;
    public $level;
    public $whatsapp_user;
    public $deleted;

    public function rules()
    {
        return [
            [
                'field' => 'fnama_user',
                'label' => 'nama user',
                'rules' => 'required'
            ],
            [
                'field' => 'femail_user',
                'label' => 'email user',
                'rules' => 'required|is_unique[user.email_user]|valid_email'
            ],
            [
                'field' => 'fwhatsapp_user',
                'label' => 'whatsapp user',
                'rules' => 'required'
            ],
            [
                'field' => 'fusername',
                'label' => 'username',
                'rules' => 'required|is_unique[user.username]'
            ],
            [
                'field' => 'flevel',
                'label' => 'level',
                'rules' => 'required'
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
        ];
    }
    public function rules_edit()
    {
        return [
            [
                'field' => 'fnama_user',
                'label' => 'nama user',
                'rules' => 'required'
            ],
            [
                'field' => 'femail_user',
                'label' => 'email user',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'fwhatsapp_user',
                'label' => 'whatsapp user',
                'rules' => 'required'
            ],
            [
                'field' => 'fusername',
                'label' => 'username',
                'rules' => 'required'
            ],
            [
                'field' => 'flevel',
                'label' => 'level',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id_user($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add_user()
    {
        $post = $this->input->post();
        $this->nama_user = $post['fnama_user'];
        $this->email_user = $post['femail_user'];
        $this->whatsapp_user = $post['fwhatsapp_user'];
        $this->username = $post['fusername'];
        $this->level = $post['flevel'];
        $this->password = encrypt_url($post['fpassword']);
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function update($post)
    {
        $post = $this->input->post();
        $this->db->set('nama_user', $post['fnama_user']);
        $this->db->set('email_user', $post['femail_user']);
        $this->db->set('whatsapp_user', $post['fwhatsapp_user']);
        $this->db->set('username', $post['fusername']);
        $this->db->set('level', $post['flevel']);
        $this->db->where('id_user', decrypt_url($post['fid_user']));
        $this->db->update($this->_table);
    }
    public function delete_user($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_user', $id);
        $this->db->update($this->_table);
    }
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('username', $post['fusername']);
        $this->db->where('password', encrypt_url($post['fpassword']));
        $query = $this->db->get();
        return $query;
    }
}

/* End of file User_m.php */
