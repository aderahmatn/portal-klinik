<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_obat_m extends CI_Model
{

    // // STOK OBAT
    private $_table = 'stok_obat';
    public $id_obat;
    public $tgl_masuk;
    public $expired_date;
    public $jumlah;
    public $created_by;
    public $deleted_stok;

    public function rules_tambah_stok_obat()
    {
        return [
            [
                'field' => 'fnama_obat',
                'label' => 'nama obat',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_masuk',
                'label' => 'tanggal masuk',
                'rules' => 'required'
            ],
            [
                'field' => 'fexpired_date',
                'label' => 'expired date',
                'rules' => 'required'
            ],
            [
                'field' => 'fjumlah',
                'label' => 'jumlah',
                'rules' => 'required'
            ],
        ];
    }
    public function add_stok()
    {
        $post = $this->input->post();
        $this->id_obat = decrypt_url($post['fid_obat']);
        $this->tgl_masuk = $post['ftgl_masuk'];
        $this->expired_date = $post['fexpired_date'];
        $this->jumlah = $post['fjumlah'];
        $this->created_by = decrypt_url($this->session->userdata('id_user'));
        $this->deleted_stok = 0;
        $this->db->insert($this->_table, $this);
    }
    public function get_stok_by_id_obat($id_obat)
    {
        $this->db->select_sum('jumlah');
        $this->db->where('deleted_stok', 0);
        $this->db->where('id_obat', decrypt_url($id_obat));
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row()->jumlah;
    }
    public function get_all_obat_masuk()
    {
        $this->db->select('*');
        $this->db->join('obat', 'obat.id_obat = stok_obat.id_obat', 'left');
        $this->db->where('deleted_stok', 0);
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }
    public function update_stok_obat($post)
    {
        $this->db->set('id_obat', decrypt_url($post['fid_obat_edit']));
        $this->db->set('tgl_masuk', $post['ftgl_masuk']);
        $this->db->set('expired_date', $post['fexpired_date']);
        $this->db->set('jumlah', $post['fjumlah']);
        $this->db->where('id_stok_obat', decrypt_url($post['fid_stok']));
        $this->db->update($this->_table);
    }
    public function delete_stok($id)
    {
        $this->db->set('deleted_stok', 1);
        $this->db->where('id_stok_obat', $id);
        $this->db->update($this->_table);
    }
}

/* End of file ModelName.php */
