<?php defined('BASEPATH') or exit('No direct script access allowed');

class Skd_m extends CI_Model
{
    private $_table = 'skd';
    public $created_date;
    public $id_user;
    public $id_karyawan;
    public $jenis_penyakit;
    public $tgl_mulai_skd;
    public $tgl_akhir_skd;
    public $jumlah_hari;
    public $pembayaran;
    public $faskes;
    public $tgl_penyerahan;
    public $status_skd;
    public $catatan_skd;
    public $lampiran;
    public $deleted;

    public function rules_skd()
    {
        return [
            [
                'field' => 'fkaryawan',
                'label' => 'Karyawan',
                'rules' => 'required'
            ],
            [
                'field' => 'fjenis_penyakit',
                'label' => 'Jenis Penyakit',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_mulai_skd',
                'label' => 'Tanggal mulai SKD',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_akhir_skd',
                'label' => 'Tanggal akhir SKD',
                'rules' => 'required'
            ],
            [
                'field' => 'fjumlah_hari_skd',
                'label' => 'Jumlah hari SKD',
                'rules' => 'required'
            ],
            [
                'field' => 'fpembayaran',
                'label' => 'Pembayaran',
                'rules' => 'required'
            ],
            [
                'field' => 'ffaskes',
                'label' => 'Faskes',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_penyerahan',
                'label' => 'Tanggal Penyerahan',
                'rules' => 'required'
            ],
            [
                'field' => 'fstatus_skd',
                'label' => 'Status SKD',
                'rules' => 'required'
            ],

        ];
    }

    public function get_all_skd()
    {
        $this->db->select('*');
        $this->db->where('skd.deleted', 0);
        $this->db->join('karyawan', 'karyawan.id_karyawan = skd.id_karyawan', 'left');
        $this->db->join('user', 'user.id_user = skd.id_user', 'left');
        $this->db->join('divisi', 'karyawan.id_divisi = divisi.id_divisi', 'left');
        $this->db->join('departemen', 'karyawan.id_departemen = departemen.id_departemen', 'left');
        $this->db->order_by('skd.id_skd', 'desc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_skd_by_id($id_skd)
    {
        $this->db->select('*');
        $this->db->where('skd.deleted', 0);
        $this->db->where('skd.id_skd', $id_skd);
        $this->db->join('karyawan', 'karyawan.id_karyawan = skd.id_karyawan', 'left');
        $this->db->join('divisi', 'karyawan.id_divisi = divisi.id_divisi', 'left');
        $this->db->join('departemen', 'karyawan.id_departemen = departemen.id_departemen', 'left');
        $this->db->join('user', 'user.id_user = skd.id_user', 'left');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_skd($post, $file)
    {
        $post = $this->input->post();
        $this->created_date = date('Y-m-d');
        $this->id_user = decrypt_url($this->session->userdata('id_user'));
        $this->id_karyawan = decrypt_url($post['fid_karyawan']);
        $this->jenis_penyakit = $post['fjenis_penyakit'];
        $this->tgl_mulai_skd = $post['ftgl_mulai_skd'];
        $this->tgl_akhir_skd = $post['ftgl_akhir_skd'];
        $this->pembayaran = $post['fpembayaran'];
        $this->jumlah_hari = $post['fjumlah_hari_skd'];
        $this->faskes = $post['ffaskes'];
        $this->tgl_penyerahan = $post['ftgl_penyerahan'];
        $this->status_skd = $post['fstatus_skd'];
        $this->lampiran = $file;
        $this->catatan_skd = $post['fcatatan_skd'];
        $this->deleted = 0;
        $this->db->insert($this->_table, $this);
    }

    public function delete_skd($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_skd', $id);
        $this->db->update($this->_table);
    }

    public function update_skd($post)
    {
        $this->db->set('id_karyawan', decrypt_url($post['fid_karyawan']));
        $this->db->set('jenis_penyakit', $post['fjenis_penyakit']);
        $this->db->set('tgl_mulai_skd', $post['ftgl_mulai_skd']);
        $this->db->set('tgl_akhir_skd', $post['ftgl_akhir_skd']);
        $this->db->set('pembayaran', $post['fpembayaran']);
        $this->db->set('jumlah_hari', $post['fjumlah_hari_skd']);
        $this->db->set('faskes', $post['ffaskes']);
        $this->db->set('tgl_penyerahan', $post['ftgl_penyerahan']);
        $this->db->set('status_skd', $post['fstatus_skd']);
        $this->db->set('catatan_skd', $post['fcatatan_skd']);
        $this->db->where('id_skd', decrypt_url($post['fid_skd']));
        $this->db->update($this->_table);
    }
    public function update_lampiran($id_skd, $file)
    {
        $this->db->set('lampiran', $file);
        $this->db->where('id_skd', $id_skd);
        $this->db->update($this->_table);
    }
}

/* End of file Skd_m.php */
