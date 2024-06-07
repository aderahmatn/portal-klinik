<?php defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_skd_m extends CI_Model
{

    private $_table = 'diagnosa_skd';
    public $id_diagnosa;
    public $id_skd;
    public $deleted;

    public function get_diagnosa_skd_by_id_skd($id_skd)
    {
        $this->db->select('diagnosa.diagnosa');
        $this->db->join('diagnosa', 'diagnosa.id_diagnosa = diagnosa_skd.id_diagnosa', 'left');
        $this->db->where('diagnosa_skd.deleted', 0);
        $this->db->where('diagnosa_skd.id_skd', $id_skd);
        $this->db->order_by('id_diagnosa_skd', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_diagnosa_skd_by_id_skd($id_skd)
    {
        $this->db->select('*');
        $this->db->join('diagnosa', 'diagnosa.id_diagnosa = diagnosa_skd.id_diagnosa', 'left');
        $this->db->where('diagnosa_skd.deleted', 0);
        $this->db->where('diagnosa_skd.id_skd', $id_skd);
        $this->db->order_by('id_diagnosa_skd', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_diagnosa_skd($id_diagnosa, $id_skd)
    {
        $this->id_diagnosa = $id_diagnosa;
        $this->id_skd = $id_skd;
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_diagnosa_skd($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_diagnosa_skd', $id);
        $this->db->update($this->_table);
    }
    public function delete_diagnosa_by_id_skd($id_skd)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_skd', $id_skd);
        $this->db->update($this->_table);
    }
    public function get_total_diagnosa_skd($id_diagnosa)
    {
        $this->db->where('deleted', 0);
        $this->db->where('id_diagnosa', $id_diagnosa);
        return $this->db->count_all_results('diagnosa_skd');
    }
}

/* End of file Jenis_pekerjaan_m.php */
