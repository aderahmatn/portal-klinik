<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mcu_m extends CI_Model
{
    private $_table = 'mcu';
    public $id_mcu;
    public $tgl_mcu;
    public $id_karyawan;
    public $kesimpulan;
    public $saran;
    public $kategori_mcu;
    public $kategori_followup;
    public $file_mcu;
    public $created_by;
    public $catatan;
    public $deleted;
    public function rules_mcu()
    {
        return [
            [
                'field' => 'ftgl_mcu',
                'label' => 'tanggal MCU',
                'rules' => 'required'
            ],
            [
                'field' => 'fkaryawan',
                'label' => 'nama karyawan',
                'rules' => 'required'
            ],
            [
                'field' => 'fkesimpulan',
                'label' => 'kesimpulan',
                'rules' => 'required'
            ],
            [
                'field' => 'fsaran',
                'label' => 'saran',
                'rules' => 'required'
            ],
            [
                'field' => 'fkategori',
                'label' => 'kategori MCU awal',
                'rules' => 'required'
            ],
            [
                'field' => 'fkategori_followup',
                'label' => 'kategori MCU follow up',
                'rules' => 'required'
            ],
        ];
    }
    public function get_all_mcu()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('karyawan', 'karyawan.id_karyawan = mcu.id_karyawan', 'left');
        $this->db->order_by('id_mcu', 'desc');
        $this->db->where('mcu.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_all_mcu_by_filter(
        $tgl_awal,
        $tgl_akhir,
        $divisi,
        $departemen,
        $status,
        $karyawan,
        $kategori,
        $kategori_folup
    ) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('karyawan', 'karyawan.id_karyawan = mcu.id_karyawan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->where('tgl_mcu >=', $tgl_awal);
        $this->db->where('tgl_mcu <=', $tgl_akhir);
        if (in_array("all", $divisi) == false) {
            $this->db->where_in('karyawan.id_divisi', $divisi);
        }
        if (in_array("all", $departemen) == false) {
            $this->db->where_in('karyawan.id_departemen', $departemen);
        }
        if (in_array("all", $status) == false) {
            $this->db->where_in('karyawan.status', $status);
        }
        if (in_array("all", $karyawan) == false) {
            $this->db->where_in('kunjungan.id_karyawan', $karyawan);
        }
        if (in_array("all", $kategori) == false) {
            $this->db->where_in('mcu.kategori_mcu', $kategori);
        }
        if (in_array("all", $kategori_folup) == false) {
            $this->db->where_in('mcu.kategori_followup', $kategori_folup);
        }
        $this->db->order_by('id_mcu', 'desc');
        $this->db->where('mcu.deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_mcu_by_id_karyawan($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('karyawan', 'karyawan.id_karyawan = mcu.id_karyawan', 'left');
        $this->db->join('user', 'user.id_user = mcu.created_by', 'left');
        $this->db->order_by('id_mcu', 'desc');
        $this->db->where('mcu.deleted', 0);
        $this->db->where('mcu.id_karyawan', $id_karyawan);
        $query = $this->db->get();
        return $query->result();
    }
    public function add_mcu($post, $file)
    {
        $post = $this->input->post();
        $this->tgl_mcu = $post['ftgl_mcu'];
        $this->id_karyawan = decrypt_url($post['fid_karyawan']);
        $this->kesimpulan = $post['fkesimpulan'];
        $this->saran = $post['fsaran'];
        $this->kategori_mcu = $post['fkategori'];
        $this->kategori_followup = $post['fkategori_followup'];
        $this->catatan = $post['fcatatan'];
        $this->file_mcu = $file;
        $this->created_by = decrypt_url($this->session->userdata('id_user'));
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }
    public function delete_mcu($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_mcu', $id);
        $this->db->update($this->_table);
    }
    public function update_mcu($post)
    {
        $this->db->set('tgl_mcu',  $post['ftgl_mcu']);
        $this->db->set('id_karyawan', decrypt_url($post['fid_karyawan_edit']));
        $this->db->set('kesimpulan',  $post['fkesimpulan']);
        $this->db->set('saran',  $post['fsaran']);
        $this->db->set('kategori_mcu',  $post['fkategori']);
        $this->db->set('kategori_followup',  $post['fkategori_followup']);
        $this->db->set('catatan',  $post['fcatatan']);
        $this->db->where('id_mcu', decrypt_url($post['fid_mcu']));
        $this->db->update($this->_table);
    }
}

/* End of file Jenis_pekerjaan_m.php */
