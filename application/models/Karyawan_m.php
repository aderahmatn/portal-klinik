<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_m extends CI_Model
{
    private $_table = 'karyawan';
    public $id_karyawan;
    public $nama_lengkap;
    public $nik;
    public $jenkel;
    public $id_divisi;
    public $id_departemen;
    public $bpjs;
    public $perusahaan;
    public $bagian;
    public $status;
    public $deleted;
    public function rules_karyawan()
    {
        return [
            [
                'field' => 'fnik',
                'label' => 'NIK',
                'rules' => 'required|is_unique[karyawan.nik]'
            ],
            [
                'field' => 'fnama_lengkap',
                'label' => 'nama lengkap',
                'rules' => 'required'
            ],
            [
                'field' => 'fjenkel',
                'label' => 'jenis kelamin',
                'rules' => 'required'
            ],
            [
                'field' => 'fdivisi',
                'label' => 'divisi',
                'rules' => 'required'
            ],
            [
                'field' => 'fdepartemen',
                'label' => 'departemen',
                'rules' => 'required'
            ],
            [
                'field' => 'fbagian',
                'label' => 'bagian',
                'rules' => 'required'
            ],
            [
                'field' => 'fperusahaan',
                'label' => 'perusahaan',
                'rules' => 'required'
            ],
            [
                'field' => 'fstatus',
                'label' => 'status',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_karyawan()
    {
        return $this->db->get_where($this->_table, ["deleted" => 0])->result();
    }
    public function add_divisi()
    {
        $post = $this->input->post();
        $this->nama_divisi = $post['fnama_divisi'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_divisi($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_divisi', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Karyawan_m.php */
