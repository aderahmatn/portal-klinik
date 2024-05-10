<?php defined('BASEPATH') or exit('No direct script access allowed');

class Obat_m extends CI_Model
{
    // // OBAT
    private $_table = 'obat';
    public $nama_obat;
    public $catatan_obat;
    public $minimum_stok;
    public $deleted;


    public function rules_obat()
    {
        return [
            [
                'field' => 'fnama_obat',
                'label' => 'nama obat',
                'rules' => 'required|is_unique[obat.nama_obat]'
            ],
            [
                'field' => 'fcatatan_obat',
                'label' => 'catatan obat',
                'rules' => 'required'
            ],
            [
                'field' => 'fminimum_stok',
                'label' => 'minimum stok obat',
                'rules' => 'required'
            ],
        ];
    }

    public function get_all_obat()
    {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by('id_obat', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_obat()
    {
        $post = $this->input->post();
        $this->nama_obat = $post['fnama_obat'];
        $this->minimum_stok = $post['fminimum_stok'];
        $this->catatan_obat = $post['fcatatan_obat'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }


    public function delete_obat($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_obat', $id);
        $this->db->update($this->_table);
    }
    public function update_obat($post)
    {
        $this->db->set('nama_obat', $post['fnama_obat']);
        $this->db->set('catatan_obat', $post['fcatatan_obat']);
        $this->db->set('minimum_stok', $post['fminimum_stok']);
        $this->db->where('id_obat', decrypt_url($post['fid_obat']));
        $this->db->update($this->_table);
    }
}

/* End of file Jenis_pekerjaan_m.php */
