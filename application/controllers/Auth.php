<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m');
        $this->load->helper('string');
    }

    public function login()
    {
        check_already_login();
        $this->load->view('auth/login');
    }
    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if ($post) {
            $query = $this->User_m->login($post);
            if ($post['flock'] == "true") {
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $params = array(
                        'id_user' => encrypt_url($row->id_user),
                        'nama_user' => encrypt_url($row->nama_user),
                        'username' => encrypt_url($row->username),
                        'email' => encrypt_url($row->email_user),
                        'whatsapp' => encrypt_url($row->whatsapp_user),
                        'level' => encrypt_url($row->level),
                        'status' => 'login'
                    );
                    $this->session->set_userdata($params);
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'username / password salah');
                    redirect('auth/login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Captcha tidak cocok');
                redirect('auth/login', 'refresh');
            }
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function logout()
    {
        check_not_login();
        $params = array('id_user', 'email', 'whatsapp', 'username', 'nama_user', 'level');
        $this->session->unset_userdata($params);
        redirect('auth/login', 'refresh');
    }
}

/* End of file auth.php */