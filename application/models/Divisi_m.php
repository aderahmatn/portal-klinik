<?php defined('BASEPATH') or exit('No direct script access allowed');

class Divisi_m extends CI_Model
{

    private $_table = 'divisi';
    public $id_divisi;
    public $nama_divisi;
    public $deleted;
    public function rules_divisi()
    {
        return [
            [
                'field' => 'fnama_divisi',
                'label' => 'nama divisi',
                'rules' => 'required|is_unique[divisi.nama_divisi]'
            ],
        ];
    }
    public function get_all_divisi()
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

/* End of file Jenis_pekerjaan_m.php */
