<?php defined('BASEPATH') or exit('No direct script access allowed');

class Obat_kunjungan_m extends CI_Model
{

    private $_table = 'obat_kunjungan';
    public $id_obat;
    public $id_kunjungan;
    public $jumlah_keluar;
    public $deleted;

    public function get_obat_kunjungan_by_id_kunjungan($id_kunjungan)
    {
        $this->db->select('*');
        $this->db->where('obat_kunjungan.deleted', 0);
        $this->db->where('obat_kunjungan.id_kunjungan', $id_kunjungan);
        $this->db->join('obat', 'obat.id_obat = obat_kunjungan.id_obat', 'left');
        $this->db->order_by('obat_kunjungan.id_obat', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_obat_kunjungan($id_obat, $id_kunjungan, $jumlah_keluar)
    {
        $this->id_obat = $id_obat;
        $this->id_kunjungan = $id_kunjungan;
        $this->jumlah_keluar = $jumlah_keluar;
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_obat_kunjungan($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_obat_kunjungan', $id);
        $this->db->update($this->_table);
    }
    // public function update_obat_kunjungan($post)
    // {
    //     $this->db->set('id_obat', $post['fobat']);
    //     $this->db->where('id_obat', decrypt_url($post['fid_obat']));
    //     $this->db->update($this->_table);
    // }
}

/* End of file Jenis_pekerjaan_m.php */
