<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Skd_m', 'Karyawan_m', 'Diagnosa_m', 'Diagnosa_skd_m']);
        $this->load->helper(['Diagnosa_skd']);
    }


    public function index()
    {
        $data['skd'] = $this->Skd_m->get_all_skd();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'skd/index', $data);
    }
    public function create()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/skd/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $skd = $this->Skd_m;
        $validation = $this->form_validation;
        $validation->set_rules($skd->rules_skd());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
            $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
            $this->template->load('shared/index', 'skd/create', $data);
        } else {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $skd->add_skd($post, $file);
                $id_skd = $this->db->insert_id();
                $total = count($this->input->post('fdiagnosa'));
                if ($this->db->affected_rows() > 0) {
                    for ($i = 0; $i < $total; $i++) {
                        $this->Diagnosa_skd_m->add_diagnosa_skd($this->input->post('fdiagnosa[' . $i . ']'), $id_skd);
                    }
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data skd berhasil disimpan!');
                        redirect('skd', 'refresh');
                    } else {
                        $this->session->set_flashdata('warning', 'Data diagnosa gagal disimpan');
                        redirect('skd/create', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('warning', 'Data skd tidak berhasil disimpan!');
                    redirect('skd/create', 'refresh');
                }
            }
        }
    }
    public function delete($id)
    {
        $this->Skd_m->delete_skd(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Diagnosa_skd_m->delete_diagnosa_by_id_skd(decrypt_url($id));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus!');
                redirect('skd', 'refresh');
            }
        }
    }
    public function delete_diagnosa($id)
    {
        $this->Diagnosa_skd_m->delete_diagnosa_skd(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa skd berhasil dihapus!');
            redirect('skd', 'refresh');
        }
    }
    public function delete_obat($id)
    {
        $this->Obat_kunjungan_m->delete_obat_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data teraphy obat berhasil dihapus!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function detail($id)
    {
        $data['skd'] = $this->Skd_m->get_skd_by_id(decrypt_url($id));
        $this->load->view('skd/detail', $data);
    }
    public function edit_diagnosa($id)
    {
        $data['id_skd'] = $id;
        $data['alldiagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['diagnosa'] = $this->Diagnosa_skd_m->get_all_diagnosa_skd_by_id_skd(decrypt_url($id));
        $this->load->view('skd/edit_diagnosa', $data);
    }
    public function edit_lampiran($id)
    {
        $data['id_skd'] = $id;
        $this->load->view('skd/edit_lampiran', $data);
    }
    public function update_lampiran()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/skd/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $id_skd = decrypt_url($this->input->post('fid_skd'));
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $file = $this->upload->data("file_name");
            $this->Skd_m->update_lampiran($id_skd, $file);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Lampiran berhasil diganti!');
                redirect('skd', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Lampiran gagal diganti!');
                redirect('skd', 'refresh');
            }
        }
    }
    public function update_skd()
    {
        $post = $this->input->post(null, TRUE);
        $this->Skd_m->update_skd($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data skd berhasil!');
            redirect('skd', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data skd gagal!');
            redirect('skd', 'refresh');
        }
    }
    public function update_diagnosa()
    {
        $total = count($this->input->post('fdiagnosa'));
        $id_skd = decrypt_url($this->input->post('fid_skd'));
        for ($i = 0; $i < $total; $i++) {
            $this->Diagnosa_skd_m->add_diagnosa_skd($this->input->post('fdiagnosa[' . $i . ']'), $id_skd);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa skd berhasil disimpan!');
            redirect('skd', 'refresh');
        }
    }
    public function update_obat()
    {
        $total_obat = count($this->input->post('fid_obat'));
        $id_kunjungan = decrypt_url($this->input->post('fid_kunjungan'));
        for ($i = 0; $i < $total_obat; $i++) {
            if ($this->input->post('fjumlah_obat[' . $i . ']') == null) {
                $this->session->set_flashdata('error', 'Obat tidak tersedia');
                redirect('kunjungan', 'refresh');
            } else {
                $this->Obat_kunjungan_m->add_obat_kunjungan($this->input->post('fid_obat[' . $i . ']'), $id_kunjungan, $this->input->post('fjumlah_obat[' . $i . ']'));
            }
        }
        $this->session->set_flashdata('success', 'Data kunjungan berhasil disimpan!');
        redirect('kunjungan', 'refresh');
    }
}

/* End of file Kunjungan.php */
