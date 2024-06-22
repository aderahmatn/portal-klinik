<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Kk_m', 'Karyawan_m']);
    }
    public function index()
    {
        $data['kk'] = $this->Kk_m->get_all_kk();
        $this->template->load('shared/index', 'kk/index', $data);
    }
    public function create()
    {
        // file config
        $filename = date('d_m_Y');
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/kk/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;
        // end config
        $kk = $this->Kk_m;
        $karyawan = $this->Karyawan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kk->rules_kk());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $karyawan->get_all_karyawan();
            $this->template->load('shared/index', 'kk/create', $data);
        } else {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $kk->add_kk($post, $file);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data kecelakaan kerja berhasil disimpan!');
                    redirect('kk', 'refresh');
                }
            }
        }
    }
    public function detail($id)
    {
        $data['kk'] = $this->Kk_m->get_kk_by_id(decrypt_url($id));
        $this->load->view('kk/detail', $data);
    }
    public function edit($id)
    {
        $data['kk'] = $this->Kk_m->get_kk_by_id(decrypt_url($id));
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'kk/edit', $data);
    }
    public function edit_lampiran($id)
    {
        $data['id_kk'] = $id;
        $this->load->view('kk/edit_lampiran', $data);
    }
    public function update()
    {
        $post = $this->input->post(null, TRUE);
        $this->Kk_m->update_kk($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data kecelakaan kerja berhasil!');
            redirect('kk', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data kecelakaan kerja gagal!');
            redirect('kk', 'refresh');
        }
    }
    public function update_lampiran()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/kk/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $id_kk = decrypt_url($this->input->post('fidkk'));
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $file = $this->upload->data("file_name");
            $this->Kk_m->update_lampiran($id_kk, $file);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Lampiran berhasil diganti!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('warning', 'Lampiran gagal diganti!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function delete($id)
    {
        $this->Kk_m->delete_kk(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kecelakaan kerja berhasil dihapus!');
            redirect('kk', 'refresh');
        }
    }
}

/* End of file Kk.php */
