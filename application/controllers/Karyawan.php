<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Divisi_m', 'Departemen_m', 'Karyawan_m']);
    }
    public function index()
    {
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'karyawan/index', $data);
    }
    public function divisi()
    {
        $divisi = $this->Divisi_m;
        $validation = $this->form_validation;
        $validation->set_rules($divisi->rules_divisi());
        if ($validation->run() == FALSE) {
            $data['divisi'] = $divisi->get_all_divisi();
            $this->template->load('shared/index', 'karyawan/divisi', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $divisi->add_divisi($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data divisi berhasil disimpan!');
                redirect('karyawan/divisi', 'refresh');
            }
        }
    }
    public function create()
    {
        $karyawan = $this->Karyawan_m;
        $divisi = $this->Divisi_m;
        $departemen = $this->Departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($karyawan->rules_karyawan());
        if ($validation->run() == FALSE) {
            $data['divisi'] = $divisi->get_all_divisi();
            $data['departemen'] = $departemen->get_all_departemen();
            $this->template->load('shared/index', 'karyawan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $karyawan->add_karyawan($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data karyawan berhasil disimpan!');
                redirect('karyawan', 'refresh');
            }
        }
    }
    public function departemen()
    {
        $departemen = $this->Departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($departemen->rules_departemen());
        if ($validation->run() == FALSE) {
            $data['departemen'] = $departemen->get_all_departemen();
            $this->template->load('shared/index', 'karyawan/departemen', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $departemen->add_departemen($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data departemen berhasil disimpan!');
                redirect('karyawan/departemen', 'refresh');
            }
        }
    }
    public function delete_divisi($id)
    {
        $this->Divisi_m->delete_divisi(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data divisi berhasil dihapus!');
            redirect('karyawan/divisi', 'refresh');
        }
    }
    public function delete_departemen($id)
    {
        $this->Departemen_m->delete_departemen(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data departemen berhasil dihapus!');
            redirect('karyawan/departemen', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Karyawan_m->delete_karyawan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data karyawan berhasil dihapus!');
            redirect('karyawan', 'refresh');
        }
    }
}

/* End of file Karyawan.php */
