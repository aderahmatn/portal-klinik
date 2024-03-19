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
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->where('karyawan.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_karyawan()
    {
        $post = $this->input->post();
        $this->nama_lengkap = $post['fnama_lengkap'];
        $this->nik = $post['fnik'];
        $this->jenkel = $post['fjenkel'];
        $this->id_divisi = $post['fdivisi'];
        $this->id_departemen = $post['fdepartemen'];
        $this->bpjs = $post['fbpjs'];
        $this->perusahaan = $post['fperusahaan'];
        $this->bagian = $post['fbagian'];
        $this->status = $post['fstatus'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_karyawan($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_karyawan', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Karyawan_m.php */
