<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunjungan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Kunjungan_m', 'Karyawan_m', 'Diagnosa_m', 'Diagnosa_kunjungan_m', 'Obat_m', 'Obat_kunjungan_m']);
        $this->load->helper(['diagnosa_kunjungan', 'obat_kunjungan']);
    }

    // function test($id)
    // {
    //     // get_diagnosa_kunjungan_by_id_kunjungan($id);
    //     $data = $this->Obat_kunjungan_m->get_obat_kunjungan_by_id_kunjungan($id);
    //     foreach ($data as $key) {
    //         echo '<p>' . $key->nama_obat . ' (' . $key->jumlah_keluar . ')' . '</p>';
    //     }
    //     // echo implode(" ", $data['1']);
    //     var_dump($data);
    //     // echo $data;
    // }
    public function index()
    {
        $data['kunjungan'] = $this->Kunjungan_m->get_all_kunjungan();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'kunjungan/index', $data);
    }
    public function create()
    {

        $kunjungan = $this->Kunjungan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kunjungan->rules_kunjungan());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
            $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
            $data['obat'] = $this->Obat_m->get_all_obat();
            $this->template->load('shared/index', 'kunjungan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kunjungan->add_kunjungan($post);
            $id_kunjungan = $this->db->insert_id();
            $total = count($this->input->post('fdiagnosa'));
            $total_obat = count($this->input->post('fid_obat'));
            if ($this->db->affected_rows() > 0) {
                for ($i = 0; $i < $total; $i++) {
                    $this->Diagnosa_kunjungan_m->add_diagnosa_kunjungan($this->input->post('fdiagnosa[' . $i . ']'), $id_kunjungan);
                }
                if ($this->db->affected_rows() > 0) {
                    for ($i = 0; $i < $total_obat; $i++) {
                        $this->Obat_kunjungan_m->add_obat_kunjungan($this->input->post('fid_obat[' . $i . ']'), $id_kunjungan, $this->input->post('fjumlah_obat[' . $i . ']'));
                    }
                    $this->session->set_flashdata('success', 'Data kunjungan berhasil disimpan!');
                    redirect('kunjungan', 'refresh');
                } else {
                    $this->session->set_flashdata('warning', 'Data diagnosa gagal disimpan');
                    redirect('kunjungan/create', 'refresh');
                }
            } else {
                $this->session->set_flashdata('warning', 'Data kunjungan tidak berhasil disimpan!');
                redirect('kunjungan/create', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->Kunjungan_m->delete_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function delete_diagnosa($id)
    {
        $this->Diagnosa_kunjungan_m->delete_diagnosa_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa kunjungan berhasil dihapus!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function detail($id)
    {
        $data['kunjungan'] = $this->Kunjungan_m->get_kunjungan_by_id(decrypt_url($id));
        $this->load->view('kunjungan/detail', $data);
    }
    public function edit_diagnosa($id)
    {
        $data['id_kunjungan'] = $id;
        $data['alldiagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['diagnosa'] = $this->Diagnosa_kunjungan_m->get_all_diagnosa_kunjungan_by_id_kunjungan(decrypt_url($id));
        $this->load->view('kunjungan/edit_diagnosa', $data);
    }
    public function update_kunjungan()
    {
        $post = $this->input->post(null, TRUE);
        $this->Kunjungan_m->update_kunjungan($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data kunjungan berhasil!');
            redirect('kunjungan', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data kunjungan gagal!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function update_diagnosa()
    {
        $total = count($this->input->post('fdiagnosa'));
        $id_kunjungan = decrypt_url($this->input->post('fid_kunjungan'));
        for ($i = 0; $i < $total; $i++) {
            $this->Diagnosa_kunjungan_m->add_diagnosa_kunjungan($this->input->post('fdiagnosa[' . $i . ']'), $id_kunjungan);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa kunjungan berhasil disimpan!');
            redirect('kunjungan', 'refresh');
        }
    }
}

/* End of file Kunjungan.php */
