
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kk_m extends CI_Model
{
    private $_table = 'kk';

    public $id_karyawan;
    public $pendidikan_terakhir;
    public $area_kejadian;
    public $nama_atasan;
    public $tgl_kejadian;
    public $jam_kejadian;
    public $shif;
    public $kategori;
    public $lost_time_injury;
    public $medical_treatment;
    public $bagian_cidera;
    public $faskes_penanganan;
    public $tipe_kecelakaan;
    public $penyebab_kecelakaan;
    public $kronologi_kejadian;
    public $is_rujuk;
    public $tindakan_rujuk;
    public $catatan;
    public $update_pemantauan_medis;
    public $file;
    public $deleted;
    public $id_user;

    public function rules_kk()
    {

        return [

            [
                'field' => 'fkaryawan',
                'label' => 'Pendidikan Terakhir',
                'rules' => 'required'
            ],
            [
                'field' => 'fpendidikan_terakhir',
                'label' => 'Pendidikan Terakhir',
                'rules' => 'required'
            ],
            [
                'field' => 'farea_kejadian',
                'label' => 'Area Kejadian',
                'rules' => 'required'
            ],
            [
                'field' => 'fnama_atasan',
                'label' => 'Nama Atasan',
                'rules' => 'required'
            ],
            [
                'field' => 'ftgl_kejadian',
                'label' => 'Tanggal Kejadian',
                'rules' => 'required'
            ],
            [
                'field' => 'fjam_kejadian',
                'label' => 'Jam Kejadian',
                'rules' => 'required'
            ],
            [
                'field' => 'fshif',
                'label' => 'Shift',
                'rules' => 'required'
            ],
            [
                'field' => 'fkategori',
                'label' => 'Kategori',
                'rules' => 'required'
            ],
            [
                'field' => 'flost_time_injury',
                'label' => 'Lost Time Injury',
                'rules' => 'required'
            ],
            [
                'field' => 'fmedical_treatment',
                'label' => 'Medical Treatment',
                'rules' => 'required'
            ],
            [
                'field' => 'fbagian_cidera',
                'label' => 'Bagian Cidera',
                'rules' => 'required'
            ],
            [
                'field' => 'ffaskes_penanganan',
                'label' => 'Faskes Penanganan',
                'rules' => 'required'
            ],
            [
                'field' => 'ftipe_kecelakaan',
                'label' => 'Tipe Kecelakaan',
                'rules' => 'required'
            ],
            [
                'field' => 'fpenyebab_kecelakaan',
                'label' => 'Penyebab Kecelakaan',
                'rules' => 'required'
            ],
            [
                'field' => 'fkronologi_kejadian',
                'label' => 'Kronologi Kejadian',
                'rules' => 'required'
            ],
            [
                'field' => 'fis_rujuk',
                'label' => 'Is Rujuk',
                'rules' => 'required'
            ],
        ];
    }

    public function get_all_kk()
    {
        $this->db->select('*');
        $this->db->where('kk.deleted', 0);
        $this->db->join('karyawan', 'karyawan.id_karyawan = kk.id_karyawan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->order_by('kk.id_karyawan', 'asc');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kk_by_id($id_kk)
    {
        $this->db->select('*');
        $this->db->where('kk.deleted', 0);
        $this->db->where('kk.id_kk', $id_kk);
        $this->db->join('karyawan', 'karyawan.id_karyawan = kk.id_karyawan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi = karyawan.id_divisi', 'left');
        $this->db->join('departemen', 'departemen.id_departemen = karyawan.id_departemen', 'left');
        $this->db->join('user', 'user.id_user = kk.id_user', 'left');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->row();
    }

    public function add_kk($post, $file)
    {
        $post = $this->input->post();
        $this->id_karyawan = decrypt_url($post['fid_karyawan']);
        $this->pendidikan_terakhir = $post['fpendidikan_terakhir'];
        $this->area_kejadian = $post['farea_kejadian'];
        $this->nama_atasan = $post['fnama_atasan'];
        $this->tgl_kejadian = $post['ftgl_kejadian'];
        $this->jam_kejadian = $post['fjam_kejadian'];
        $this->shif = $post['fshif'];
        $this->kategori = $post['fkategori'];
        $this->lost_time_injury = $post['flost_time_injury'];
        $this->medical_treatment = $post['fmedical_treatment'];
        $this->bagian_cidera = $post['fbagian_cidera'];
        $this->faskes_penanganan = $post['ffaskes_penanganan'];
        $this->tipe_kecelakaan = $post['ftipe_kecelakaan'];
        $this->penyebab_kecelakaan = $post['fpenyebab_kecelakaan'];
        $this->kronologi_kejadian = $post['fkronologi_kejadian'];
        $this->is_rujuk = $post['fis_rujuk'];
        $this->tindakan_rujuk = $post['ftindakan_rujuk'];
        $this->catatan = $post['fcatatan'];
        $this->update_pemantauan_medis = $post['fupdate_pemantauan_medis'];
        $this->file = $file;
        $this->deleted = 0;
        $this->id_user = decrypt_url($this->session->userdata('id_user'));
        $this->db->insert($this->_table, $this);
    }

    public function delete_kk($id)
    {
        $this->db->set('deleted', 1);
        $this->db->where('id_kk', $id);
        $this->db->update($this->_table);
    }

    public function update_kk($post)
    {
        $this->db->set('id_karyawan', decrypt_url($post['fid_karyawan']));
        $this->db->set('pendidikan_terakhir', $post['fpendidikan_terakhir']);
        $this->db->set('area_kejadian', $post['farea_kejadian']);
        $this->db->set('nama_atasan', $post['fnama_atasan']);
        $this->db->set('tgl_kejadian', $post['ftgl_kejadian']);
        $this->db->set('jam_kejadian', $post['fjam_kejadian']);
        $this->db->set('shif', $post['fshif']);
        $this->db->set('kategori', $post['fkategori']);
        $this->db->set('lost_time_injury', $post['flost_time_injury']);
        $this->db->set('medical_treatment', $post['fmedical_treatment']);
        $this->db->set('bagian_cidera', $post['fbagian_cidera']);
        $this->db->set('faskes_penanganan', $post['ffaskes_penanganan']);
        $this->db->set('tipe_kecelakaan', $post['ftipe_kecelakaan']);
        $this->db->set('penyebab_kecelakaan', $post['fpenyebab_kecelakaan']);
        $this->db->set('kronologi_kejadian', $post['fkronologi_kejadian']);
        $this->db->set('is_rujuk', $post['fis_rujuk']);
        $this->db->set('tindakan_rujuk', $post['ftindakan_rujuk']);
        $this->db->set('catatan', $post['fcatatan']);
        $this->db->set('update_pemantauan_medis', $post['fupdate_pemantauan_medis']);
        $this->db->where('id_kk', decrypt_url($post['fidkk']));
        $this->db->update($this->_table);
    }
    public function update_lampiran($idkk, $file)
    {
        $this->db->set('file', $file);
        $this->db->where('id_kk', $idkk);
        $this->db->update($this->_table);
    }
}

/* End of file Kk_m.php */