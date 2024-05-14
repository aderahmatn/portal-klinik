<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Mcu_m', 'Karyawan_m']);
    }

    public function index()
    {
        // file config
        $filename = date('d/m/Y');
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/mcu/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;
        // end config
        $mcu = $this->Mcu_m;
        $karyawan = $this->Karyawan_m;
        $validation = $this->form_validation;
        $validation->set_rules($mcu->rules_mcu());
        $this->load->library('upload', $config);
        if ($validation->run() == FALSE) {
            $data['mcu'] = $mcu->get_all_mcu();
            $data['karyawan'] = $karyawan->get_all_karyawan();
            $this->template->load('shared/index', 'mcu/index', $data);
        } else {
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $mcu->add_mcu($post, $file);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data mcu berhasil disimpan!');
                    redirect('mcu', 'refresh');
                }
            }
        }
    }
    public function update_mcu()
    {
        $post = $this->input->post(null, TRUE);
        $this->Mcu_m->update_mcu($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data mcu berhasil!');
            redirect('mcu', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data mcu gagal!');
            redirect('mcu', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Mcu_m->delete_mcu(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data mcu berhasil dihapus!');
            redirect('mcu', 'refresh');
        }
    }
}

/* End of file Diagnosa.php */
