<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role_administrator(decrypt_url($this->session->userdata('level')));
        $this->load->model(['User_m']);
    }


    public function index()
    {
        $data['user'] = $this->User_m->get_all_user();
        $this->template->load('shared/index', 'user/index', $data);
    }
    public function create()
    {
        // check_role_administrator();
        $user = $this->User_m;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());
        if ($validation->run() == FALSE) {
            $this->template->load('shared/index', 'user/create');
        } else {
            $post = $this->input->post(null, TRUE);
            $user->add_user($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data user berhasil disimpan!');
                redirect('user', 'refresh');
            }
        }
    }
    function edit($id = null)
    {
        if (!isset($id))
            redirect('user');
        $user = $this->User_m;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules_edit());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->User_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'User Berhasil Diupdate!');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data User Tidak Diupdate!');
                redirect('user', 'refresh');
            }
        }
        $data['data'] = $this->User_m->get_by_id_user(decrypt_url($id));
        if (!$data['data']) {
            $this->session->set_flashdata('error', 'Data User Tidak ditemukan!');
            redirect('user', 'refresh');
        }
        $this->template->load('shared/index', 'user/update', $data);
    }
    public function delete($id)
    {
        // check_role_administrator();
        $this->User_m->delete_user(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data user berhasil dihapus!');
            redirect('user', 'refresh');
        }
    }
}

/* End of file User.php */
