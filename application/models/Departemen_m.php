<?php defined('BASEPATH') or exit('No direct script access allowed');

class Departemen_m extends CI_Model
{

    private $_table = 'departemen';
    public $id_departemen;
    public $nama_departemen;
    public $deleted;
    public function rules_departemen()
    {
        return [
            [
                'field' => 'fnama_departemen',
                'label' => 'nama departemen',
                'rules' => 'required|is_unique[departemen.nama_departemen]'
            ],
        ];
    }
    public function get_all_departemen()
    {
        return $this->db->get_where($this->_table, ["deleted" => 0])->result();
    }
    public function add_departemen()
    {
        $post = $this->input->post();
        $this->nama_departemen = $post['fnama_departemen'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_departemen($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_departemen', $id);
        $this->db->update($this->_table);
    }
}

/* End of file Jenis_pekerjaan_m.php */
