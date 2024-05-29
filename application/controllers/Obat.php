<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Obat_m', 'Stok_obat_m']);
        $this->load->helper(['obat', 'obat_kunjungan']);
    }
    public function index()
    {

        $obat = $this->Obat_m;
        $validation = $this->form_validation;
        $validation->set_rules($obat->rules_obat());
        if ($validation->run() == FALSE) {
            $data['obat'] = $obat->get_all_obat();
            $this->template->load('shared/index', 'obat/index', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $obat->add_obat($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data obat berhasil disimpan!');
                redirect('obat', 'refresh');
            }
        }
    }
    function test()
    {
        $id = encrypt_url(2);
        echo get_stok_obat($id);
    }
    public function get_stok_obat($id_obat)
    {
        $id = encrypt_url($id_obat);
        $data = get_stok_obat($id) - get_total_obat_keluar_kunjungan($id_obat);
        echo $data;
    }
    public function create()
    {
        $obat = $this->Stok_obat_m;
        $validation = $this->form_validation;
        $validation->set_rules($obat->rules_tambah_stok_obat());
        if ($validation->run() == FALSE) {
            $data['obat'] = $this->Obat_m->get_all_obat();
            $data['stok'] = $this->Stok_obat_m->get_all_obat_masuk();
            $this->template->load('shared/index', 'obat/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $obat->add_stok($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Stok obat berhasil ditambah!');
                redirect('obat/create', 'refresh');
            }
        }
    }
    function update_master_obat()
    {
        $post = $this->input->post(null, TRUE);
        $this->Obat_m->update_obat($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data obat berhasil!');
            redirect('obat', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data obat gagal!');
            redirect('obat', 'refresh');
        }
    }
    function update_stok_obat()
    {
        $post = $this->input->post(null, TRUE);
        $this->Stok_obat_m->update_stok_obat($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data obat masuk berhasil!');
            redirect('obat/create', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data obat masuk gagal!');
            redirect('obat/create', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Obat_m->delete_obat(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data obat berhasil dihapus!');
            redirect('obat', 'refresh');
        }
    }
    public function delete_stok($id)
    {
        $this->Stok_obat_m->delete_stok(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data obat masuk berhasil dihapus!');
            redirect('obat/create', 'refresh');
        }
    }
}

/* End of file Karyawan.php */
