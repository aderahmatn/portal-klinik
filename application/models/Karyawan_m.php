<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_m extends CI_Model
{
    private $_table = 'karyawan';
    public $id_karyawan;
    public $nama_lengkap;
    public $tgl_lahir;
    public $nik;
    public $jenkel;
    public $id_divisi;
    public $id_departemen;
    public $bpjs;
    public $bpjs_tk;
    public $perusahaan;
    public $tgl_join;
    public $bagian;
    public $status;
    public $deleted;
    public function rules_karyawan()
    {
        return [
            [
                'field' => 'fnik',
                'label' => 'NIK',
                'rules' => 'required|is_unique[karyawan.nik]|min_length[8]|max_length[8]'
            ],
            [
                'field' => 'ftgl_lahir',
                'label' => 'tanggal lahir',
                'rules' => 'required'
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
                'field' => 'ftgl_join',
                'label' => 'tanggal join',
                'rules' => 'required'
            ],
            [
                'field' => 'fstatus',
                'label' => 'status',
                'rules' => 'required'
            ],
        ];
    }
    public function rules_edit_karyawan()
    {
        return [
            [
                'field' => 'fnik',
                'label' => 'NIK',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_join',
                'label' => 'tanggal join',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_lahir',
                'label' => 'tanggal lahir',
                'rules' => 'required'
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
        $this->db->order_by('id_karyawan', 'desc');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id_karyawan($id)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->where('karyawan.deleted', 0);
        $this->db->where('karyawan.id_karyawan', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function add_karyawan()
    {
        $post = $this->input->post();
        $this->nama_lengkap = $post['fnama_lengkap'];
        $this->nik = $post['fnik'];
        $this->jenkel = $post['fjenkel'];
        $this->id_divisi = $post['fdivisi'];
        $this->tgl_lahir = $post['ftgl_lahir'];
        $this->id_departemen = $post['fdepartemen'];
        $this->bpjs = $post['fbpjs'];
        $this->bpjs_tk = $post['fbpjs_tk'];
        $this->tgl_join = $post['ftgl_join'];
        $this->perusahaan = $post['fperusahaan'];
        $this->bagian = $post['fbagian'];
        $this->status = $post['fstatus'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function update($post)
    {
        $this->db->set('nama_lengkap', $post['fnama_lengkap']);
        $this->db->set('nik', $post['fnik']);
        $this->db->set('jenkel', $post['fjenkel']);
        $this->db->set('id_divisi', $post['fdivisi']);
        $this->db->set('tgl_lahir', $post['ftgl_lahir']);
        $this->db->set('id_departemen', $post['fdepartemen']);
        $this->db->set('tgl_join', $post['ftgl_join']);
        $this->db->set('bpjs', $post['fbpjs']);
        $this->db->set('bpjs_tk', $post['fbpjs_tk']);
        $this->db->set('perusahaan', $post['fperusahaan']);
        $this->db->set('bagian', $post['fbagian']);
        $this->db->set('status', $post['fstatus']);
        $this->db->where('id_karyawan', $post['fid_karyawan']);
        $this->db->update($this->_table);
    }
    public function delete_karyawan($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
}

/* End of file Karyawan_m.php */
