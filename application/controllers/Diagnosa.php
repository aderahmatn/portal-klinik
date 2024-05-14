<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Diagnosa_m');
    }

    public function index()
    {
        $diagnosa = $this->Diagnosa_m;
        $validation = $this->form_validation;
        $validation->set_rules($diagnosa->rules_diagnosa());
        if ($validation->run() == FALSE) {
            $data['diagnosa'] = $diagnosa->get_all_diagnosa();
            $this->template->load('shared/index', 'diagnosa/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $diagnosa->add_diagnosa($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data diagnosa berhasil disimpan!');
                redirect('diagnosa', 'refresh');
            }
        }
    }
    public function update_diagnosa()
    {
        $post = $this->input->post(null, TRUE);
        $this->Diagnosa_m->update_diagnosa($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data diagnosa berhasil!');
            redirect('diagnosa', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data diagnosa gagal!');
            redirect('diagnosa', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Diagnosa_m->delete_diagnosa(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa berhasil dihapus!');
            redirect('diagnosa', 'refresh');
        }
    }
}

/* End of file Diagnosa.php */
