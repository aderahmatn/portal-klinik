<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kunjungan_m extends CI_Model
{

    private $_table = 'kunjungan';
    public $tgl_kunjungan;
    public $jam_kunjungan;
    public $id_karyawan;
    public $anamnesa;
    public $catatan_kunjungan;
    public $created_by;
    public $teraphy;
    public $deleted;


    public function rules_kunjungan()
    {
        return [
            [
                'field' => 'ftgl_kunjungan',
                'label' => 'tanggal kunjungan',
                'rules' => 'required'
            ],
            [
                'field' => 'fjam_kunjungan',
                'label' => 'jam kunjungan',
                'rules' => 'required'
            ],
            [
                'field' => 'fkaryawan',
                'label' => 'nama karyawan',
                'rules' => 'required'
            ],
            [
                'field' => 'fanamnesa',
                'label' => 'anamnesa',
                'rules' => 'required'
            ],
            [
                'field' => 'fcatatan_kunjungan',
                'label' => 'catatan kunjungan',
                'rules' => 'required'
            ],

        ];
    }

    public function get_all_kunjungan()
    {
        $this->db->select('*');
        $this->db->where('kunjungan.deleted', 0);
        $this->db->join('karyawan', 'karyawan.id_karyawan = kunjungan.id_karyawan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->order_by('kunjungan.id_kunjungan', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_kunjungan_by_id($id_kunjungan)
    {
        $this->db->select('*');
        $this->db->where('kunjungan.deleted', 0);
        $this->db->where('kunjungan.id_kunjungan', $id_kunjungan);
        $this->db->join('karyawan', 'karyawan.id_karyawan = kunjungan.id_karyawan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('user', 'user.id_user = kunjungan.created_by', 'left');

        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');

        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_kunjungan()
    {
        $post = $this->input->post();
        $this->tgl_kunjungan = $post['ftgl_kunjungan'];
        $this->jam_kunjungan = $post['fjam_kunjungan'];
        $this->id_karyawan = decrypt_url($post['fid_karyawan']);
        $this->anamnesa = $post['fanamnesa'];
        $this->catatan_kunjungan = $post['fcatatan_kunjungan'];
        $this->created_by = decrypt_url($this->session->userdata('id_user'));
        $this->teraphy = $post['ftheraphy'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }

    public function delete_kunjungan($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_kunjungan', $id);
        $this->db->update($this->_table);
    }
    public function update_kunjungan($post)
    {
        $this->db->set('tgl_kunjungan', $post['ftgl_kunjungan']);
        $this->db->set('jam_kunjungan', $post['fjam_kunjungan']);
        $this->db->set('id_karyawan', decrypt_url($post['fid_karyawan']));
        $this->db->set('anamnesa', $post['fanamnesa']);
        $this->db->set('catatan_kunjungan', $post['fcatatan_kunjungan']);
        $this->db->set('teraphy', $post['ftheraphy']);
        $this->db->where('id_kunjungan', decrypt_url($post['fid_kunjungan']));
        $this->db->update($this->_table);
    }
}

/* End of file Jenis_pekerjaan_m.php */
