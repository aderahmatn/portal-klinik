<?php defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_kunjungan_m extends CI_Model
{

    private $_table = 'diagnosa_kunjungan';
    public $id_diagnosa;
    public $id_kunjungan;
    public $deleted;

    public function get_diagnosa_kunjungan_by_id_kunjungan($id_kunjungan)
    {
        $this->db->select('diagnosa.diagnosa');
        $this->db->join('diagnosa', 'diagnosa.id_diagnosa = diagnosa_kunjungan.id_diagnosa', 'left');
        $this->db->where('diagnosa_kunjungan.deleted', 0);
        $this->db->where('diagnosa_kunjungan.id_kunjungan', $id_kunjungan);
        $this->db->order_by('id_diagnosa_kunjungan', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_diagnosa_kunjungan_by_id_kunjungan($id_kunjungan)
    {
        $this->db->select('*');
        $this->db->join('diagnosa', 'diagnosa.id_diagnosa = diagnosa_kunjungan.id_diagnosa', 'left');
        $this->db->where('diagnosa_kunjungan.deleted', 0);
        $this->db->where('diagnosa_kunjungan.id_kunjungan', $id_kunjungan);
        $this->db->order_by('id_diagnosa_kunjungan', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_diagnosa_kunjungan($id_diagnosa, $id_kunjungan)
    {
        $this->id_diagnosa = $id_diagnosa;
        $this->id_kunjungan = $id_kunjungan;
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_diagnosa_kunjungan($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_diagnosa_kunjungan', $id);
        $this->db->update($this->_table);
    }
    public function delete_diagnosa_by_id_kunjungan($id_kunjungan)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_kunjungan', $id_kunjungan);
        $this->db->update($this->_table);
    }
    public function get_total_diagnosa_kunjungan($id_diagnosa)
    {
        $this->db->where('deleted', 0);
        $this->db->where('id_diagnosa', $id_diagnosa);
        return $this->db->count_all_results('diagnosa_kunjungan');
    }
}

/* End of file Jenis_pekerjaan_m.php */
