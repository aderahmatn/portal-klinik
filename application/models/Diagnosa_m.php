<?php defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa_m extends CI_Model
{

    private $_table = 'diagnosa';
    public $id_diagnosa;
    public $diagnosa;
    public $deleted;
    public function rules_diagnosa()
    {
        return [
            [
                'field' => 'fdiagnosa',
                'label' => 'nama diganosa',
                'rules' => 'required|is_unique[diagnosa.diagnosa]'
            ],
        ];
    }
    public function get_all_diagnosa()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by('id_diagnosa', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_diagnosa()
    {
        $post = $this->input->post();
        $this->diagnosa = $post['fdiagnosa'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_diagnosa($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_diagnosa', $id);
        $this->db->update($this->_table);
    }
    public function update_diagnosa($post)
    {
        $this->db->set('diagnosa', $post['fdiagnosa']);
        $this->db->where('id_diagnosa', decrypt_url($post['fid_diagnosa']));
        $this->db->update($this->_table);
    }
}

/* End of file Jenis_pekerjaan_m.php */
