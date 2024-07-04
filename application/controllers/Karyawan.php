<?php
defined('BASEPATH') or exit('No direct script access allowed');
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Divisi_m', 'Departemen_m', 'Karyawan_m']);
        $this->load->helper(['Diagnosa_kunjungan', 'Obat_kunjungan', 'Diagnosa_skd']);
    }
    public function index()
    {
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'karyawan/index', $data);
    }
    public function detail($id)
    {
        $this->load->model(['Kunjungan_m', 'Skd_m', 'Kk_m', 'Mcu_m']);

        $data['karyawan'] = $this->Karyawan_m->get_by_id_karyawan(decrypt_url($id));
        $data['kunjungan'] = $this->Kunjungan_m->get_kunjungan_by_id_karyawan(decrypt_url($id));
        $data['skd'] = $this->Skd_m->get_skd_by_id_karyawan(decrypt_url($id));
        $data['kk'] = $this->Kk_m->get_kk_by_id_karyawan(decrypt_url($id));
        $data['mcu'] = $this->Mcu_m->get_mcu_by_id_karyawan(decrypt_url($id));
        $this->template->load('shared/index', 'karyawan/detail', $data);
    }
    public function excel($id)
    {
        $this->load->model(['Kunjungan_m', 'Skd_m', 'Kk_m', 'Mcu_m']);
        $karyawan = $this->Karyawan_m->get_by_id_karyawan(decrypt_url($id));
        $kunjungan = $this->Kunjungan_m->get_kunjungan_by_id_karyawan(decrypt_url($id));
        $skd = $this->Skd_m->get_skd_by_id_karyawan(decrypt_url($id));
        $kk = $this->Kk_m->get_kk_by_id_karyawan(decrypt_url($id));
        $mcu = $this->Mcu_m->get_mcu_by_id_karyawan(decrypt_url($id));
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setShowGridlines(false);
        $activeWorksheet->getStyle('A2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2')->getFont()->setSize(35);
        $activeWorksheet->getColumnDimension('A')->setWidth(6);
        $activeWorksheet->getColumnDimension('B')->setWidth(28);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);
        $activeWorksheet->getColumnDimension('D')->setWidth(40);
        $activeWorksheet->getColumnDimension('E')->setWidth(40);
        $activeWorksheet->getColumnDimension('F')->setWidth(35);
        $activeWorksheet->getColumnDimension('G')->setWidth(40);
        $activeWorksheet->getColumnDimension('H')->setWidth(40);
        $activeWorksheet->getColumnDimension('I')->setWidth(15);
        $activeWorksheet->getColumnDimension('J')->setWidth(25);
        $activeWorksheet->getColumnDimension('K')->setWidth(30);
        $activeWorksheet->getColumnDimension('L')->setWidth(25);
        $activeWorksheet->getColumnDimension('M')->setWidth(20);
        $activeWorksheet->getColumnDimension('N')->setWidth(25);
        $activeWorksheet->getColumnDimension('O')->setWidth(25);
        $activeWorksheet->getColumnDimension('P')->setWidth(30);
        $activeWorksheet->getColumnDimension('Q')->setWidth(50);
        $activeWorksheet->getColumnDimension('R')->setWidth(40);
        $activeWorksheet->getColumnDimension('S')->setWidth(40);
        $activeWorksheet->getColumnDimension('T')->setWidth(50);

        $activeWorksheet->setCellValue('A2', 'REKAM MEDIS KARYAWAN');
        $styleArrayBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],

        ];
        $styleArrayHeaderTable = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        // HEADER
        $activeWorksheet->getStyle('A4')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A4')->getFont()->setSize(20);
        $activeWorksheet->getStyle('A5:J7')->getFont()->setSize(12);
        $activeWorksheet->setCellValue('A4', 'DATA KARYAWAN');
        $activeWorksheet->setCellValue('A5', 'NAMA LENGKAP : ' . strtoupper($karyawan->nama_lengkap));
        $activeWorksheet->setCellValue('A6', 'NIK : ' . strtoupper($karyawan->nik));
        $activeWorksheet->setCellValue('A7', 'TANGGAL LAHIR : ' . TanggalIndo($karyawan->tgl_lahir));
        $activeWorksheet->setCellValue('A8', 'JENIS KELAMIN : ' . strtoupper($karyawan->jenkel));
        $activeWorksheet->setCellValue('A9', 'TANGGAL JOIN : ' . TanggalIndo($karyawan->tgl_join));
        $activeWorksheet->setCellValue('E5', 'PERUSAHAAN : ' . strtoupper($karyawan->perusahaan));
        $activeWorksheet->setCellValue('E6', 'DIVISI : ' . strtoupper($karyawan->nama_divisi));
        $activeWorksheet->setCellValue('E7', 'DEPARTEMEN : ' . strtoupper($karyawan->nama_departemen));
        $activeWorksheet->setCellValue('E8', 'BAGIAN : ' . strtoupper($karyawan->bagian));
        $activeWorksheet->setCellValue('E9', 'STATUS KARYAWAN : ' . strtoupper($karyawan->status));
        $activeWorksheet->setCellValue('G5', 'BPJS KESEHATAN : ' . strtoupper($karyawan->bpjs));
        $activeWorksheet->setCellValue('G6', 'BPJS KETENAGAKERJAAN : ' . strtoupper($karyawan->bpjs_ketenagakerjaan));
        $activeWorksheet->setCellValue('G7', 'TANGGAL EXPORT : ' . date('d/m/Y'));
        // HEADER AND
        // KUNJUNGAN
        $activeWorksheet->getRowDimension('14')->setRowHeight(40);
        $activeWorksheet->getStyle('A13')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A13')->getFont()->setSize(20);

        $activeWorksheet->setCellValue('A13', 'DATA KUNJUNGAN KLINIK');
        $activeWorksheet->setCellValue('A14', 'NO');
        $activeWorksheet->setCellValue('B14', 'TANGGAL KUNJUNGAN');
        $activeWorksheet->setCellValue('C14', 'JAM KUNJUNGAN');
        $activeWorksheet->setCellValue('D14', 'ANAMNESA');
        $activeWorksheet->setCellValue('E14', 'DIAGNOSA');
        $activeWorksheet->setCellValue('F14', 'TERAPHY FISIK');
        $activeWorksheet->setCellValue('G14', 'TERAPHY OBAT');
        $activeWorksheet->setCellValue('H14', 'CATATAN');
        $activeWorksheet->setCellValue('I14', 'PERAWAT');
        $column = 15;
        $no_kunjungan = 1;
        foreach ($kunjungan as $key) {
            $activeWorksheet->setCellValue('A' . $column, $no_kunjungan++);
            $activeWorksheet->setCellValue('B' . $column, TanggalIndo($key->tgl_kunjungan));
            $activeWorksheet->setCellValue('C' . $column, $key->jam_kunjungan);
            $activeWorksheet->setCellValue('D' . $column, strtoupper($key->anamnesa));
            $activeWorksheet->setCellValue('E' . $column, strtoupper(get_diagnosa_kunjungan_by_id_kunjungan_text($key->id_kunjungan)));
            $activeWorksheet->setCellValue('F' . $column, strtoupper($key->teraphy));
            $activeWorksheet->setCellValue('G' . $column, strtoupper(get_obat_kunjungan_by_id_kunjungan_text($key->id_kunjungan)));
            $activeWorksheet->setCellValue('H' . $column, strtoupper($key->catatan_kunjungan));
            $activeWorksheet->setCellValue('I' . $column, strtoupper($key->nama_user));
            $column++;
        }
        $activeWorksheet->getStyle('A14:I' . ($column - 1))->applyFromArray($styleArrayBorder);
        $activeWorksheet->getStyle('A14:I14')->applyFromArray($styleArrayHeaderTable);
        $activeWorksheet->getStyle('A14:I14')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('C3E6CB');
        // KUNJUNGAN 
        // SKD
        $activeWorksheet->getRowDimension($column + 4)->setRowHeight(40);
        $activeWorksheet->getStyle('A' . $column + 3)->getFont()->setBold(true);
        $activeWorksheet->getStyle('A' . $column + 3)->getFont()->setSize(20);
        $activeWorksheet->setCellValue('A' . $column + 3, 'DATA SURAT KETERANGAN DOKTER (SKD)');
        $activeWorksheet->setCellValue('A' . $column + 4, 'NO');
        $activeWorksheet->setCellValue('B' . $column + 4, 'TANGGAL PENYERAHAAN');
        $activeWorksheet->setCellValue('C' . $column + 4, 'ANAMNESA');
        $activeWorksheet->setCellValue('D' . $column + 4, 'TANGGAL SKD');
        $activeWorksheet->setCellValue('E' . $column + 4, 'LAMA SKD');
        $activeWorksheet->setCellValue('F' . $column + 4, 'KETERANGAN');
        $activeWorksheet->setCellValue('G' . $column + 4, 'FASKES');
        $activeWorksheet->setCellValue('H' . $column + 4, 'DIAGNOSA');
        $activeWorksheet->setCellValue('I' . $column + 4, 'STATUS');
        $activeWorksheet->setCellValue('J' . $column + 4, 'CATATAN');
        $activeWorksheet->setCellValue('K' . $column + 4, 'PERAWAT');
        $column_skd = $column + 5;
        $no_skd = 1;
        foreach ($skd as $key) {
            $activeWorksheet->setCellValue('A' . $column_skd, $no_skd++);
            $activeWorksheet->setCellValue('B' . $column_skd, TanggalIndo($key->tgl_penyerahan));
            $activeWorksheet->setCellValue('C' . $column_skd, strtoupper($key->jenis_penyakit));
            $activeWorksheet->setCellValue('D' . $column_skd, TanggalIndo($key->tgl_mulai_skd) . '-' . TanggalIndo($key->tgl_akhir_skd));
            $activeWorksheet->setCellValue('E' . $column_skd, strtoupper($key->jumlah_hari) . ' HARI');
            $activeWorksheet->setCellValue('F' . $column_skd, strtoupper($key->pembayaran));
            $activeWorksheet->setCellValue('G' . $column_skd, strtoupper($key->faskes));
            $activeWorksheet->setCellValue('H' . $column_skd, strtoupper(get_diagnosa_kunjungan_by_id_skd_text($key->id_skd)));
            $activeWorksheet->setCellValue('I' . $column_skd, strtoupper($key->status_skd));
            $activeWorksheet->setCellValue('J' . $column_skd, strtoupper($key->catatan_skd));
            $activeWorksheet->setCellValue('K' . $column_skd, strtoupper($key->nama_user));
            $column_skd++;
        }
        $activeWorksheet->getStyle('A' . $column + 4 . ':' . 'K' . ($column_skd - 1))->applyFromArray($styleArrayBorder);
        $activeWorksheet->getStyle('A' . $column + 4 . ':' . 'K' . $column + 4)->applyFromArray($styleArrayHeaderTable);
        $activeWorksheet->getStyle('A' . $column + 4 . ':' . 'K' . $column + 4)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('F5C6CB');
        // SKD
        // KK
        $activeWorksheet->getRowDimension($column_skd + 4)->setRowHeight(40);
        $activeWorksheet->getStyle('A' . $column_skd + 3)->getFont()->setBold(true);
        $activeWorksheet->getStyle('A' . $column_skd + 3)->getFont()->setSize(20);
        $activeWorksheet->setCellValue('A' . $column_skd + 3, 'DATA KECELAKAAN KERJA (KK)');
        $activeWorksheet->setCellValue('A' . $column_skd + 4, 'NO');
        $activeWorksheet->setCellValue('B' . $column_skd + 4, 'AREA KEJADIAN');
        $activeWorksheet->setCellValue('C' . $column_skd + 4, 'MASA KERJA');
        $activeWorksheet->setCellValue('D' . $column_skd + 4, 'NAMA ATASAN');
        $activeWorksheet->setCellValue('E' . $column_skd + 4, 'WEEK');
        $activeWorksheet->setCellValue('F' . $column_skd + 4, 'TANGGAL KEJADIAN');
        $activeWorksheet->setCellValue('G' . $column_skd + 4, 'WAKTU KEJADIAN');
        $activeWorksheet->setCellValue('H' . $column_skd + 4, 'SHIF');
        $activeWorksheet->setCellValue('I' . $column_skd + 4, 'KATEGORI');
        $activeWorksheet->setCellValue('J' . $column_skd + 4, 'LOST TIME INJURY (LTI)');
        $activeWorksheet->setCellValue('K' . $column_skd + 4, 'MEDICAL TREATMENT (MT)');
        $activeWorksheet->setCellValue('L' . $column_skd + 4, 'BAGIAN YANG CIDERA');
        $activeWorksheet->setCellValue('M' . $column_skd + 4, 'RUJUKAN');
        $activeWorksheet->setCellValue('N' . $column_skd + 4, 'FASKES PENANGANAN');
        $activeWorksheet->setCellValue('O' . $column_skd + 4, 'TIPE KECELAKAAN');
        $activeWorksheet->setCellValue('P' . $column_skd + 4, 'PENYEBAB KECELAKAAN');
        $activeWorksheet->setCellValue('Q' . $column_skd + 4, 'KRONOLOGI KEJADIAN');
        $activeWorksheet->setCellValue('R' . $column_skd + 4, 'TINDAKAN SETELAH DIRUJUK');
        $activeWorksheet->setCellValue('S' . $column_skd + 4, 'CATATAN');
        $activeWorksheet->setCellValue('T' . $column_skd + 4, '`UPDATE PEMANTAUAN MEDIS`');
        $column_kk = $column_skd + 5;
        $no_kk = 1;
        foreach ($kk as $key) {
            $activeWorksheet->setCellValue('A' . $column_kk, $no_kk++);
            $activeWorksheet->setCellValue('B' . $column_kk, strtoupper($key->area_kejadian));
            $activeWorksheet->setCellValue('C' . $column_kk, date('Y', strtotime($key->tgl_kejadian)) - date('Y', strtotime($key->tgl_join))  . ' Tahun - ' . date('m', strtotime($key->tgl_kejadian)) - date('m', strtotime($key->tgl_join))  . ' Bulan');
            $activeWorksheet->setCellValue('D' . $column_kk, strtoupper($key->nama_atasan));
            $activeWorksheet->setCellValue('E' . $column_kk, strtoupper(NumberWeek($key->tgl_kejadian)));
            $activeWorksheet->setCellValue('F' . $column_kk, TanggalIndo($key->tgl_kejadian));
            $activeWorksheet->setCellValue('G' . $column_kk, strtoupper($key->jam_kejadian));
            $activeWorksheet->setCellValue('H' . $column_kk, strtoupper($key->shif));
            $activeWorksheet->setCellValue('I' . $column_kk, strtoupper($key->kategori));
            $activeWorksheet->setCellValue('J' . $column_kk, strtoupper($key->lost_time_injury));
            $activeWorksheet->setCellValue('K' . $column_kk, strtoupper($key->medical_treatment));
            $activeWorksheet->setCellValue('L' . $column_kk, strtoupper($key->bagian_cidera));
            $activeWorksheet->setCellValue('M' . $column_kk, strtoupper($key->is_rujuk == 0 ? 'TIDAK' : 'YA'));
            $activeWorksheet->setCellValue('N' . $column_kk, strtoupper($key->faskes_penanganan));
            $activeWorksheet->setCellValue('O' . $column_kk, strtoupper($key->tipe_kecelakaan));
            $activeWorksheet->setCellValue('P' . $column_kk, strtoupper($key->penyebab_kecelakaan));
            $activeWorksheet->setCellValue('Q' . $column_kk, strtoupper($key->kronologi_kejadian))->getStyle('AA' . $column)->getAlignment()->setWrapText(true);
            $activeWorksheet->setCellValue('R' . $column_kk, strtoupper($key->tindakan_rujuk));
            $activeWorksheet->setCellValue('S' . $column_kk, strtoupper($key->catatan));
            $activeWorksheet->setCellValue('T' . $column_kk, strtoupper($key->update_pemantauan_medis));
            $column_kk++;
        }
        $activeWorksheet->getStyle('A' . $column_skd + 4 . ':' . 'T' . ($column_kk - 1))->applyFromArray($styleArrayBorder);
        $activeWorksheet->getStyle('A' . $column_skd + 4 . ':' . 'T' . $column_skd + 4)->applyFromArray($styleArrayHeaderTable);
        $activeWorksheet->getStyle('A' . $column_skd + 4 . ':' . 'T' . $column_skd + 4)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('B8DAFD');
        // KK
        // MCU
        $activeWorksheet->getRowDimension($column_kk + 4)->setRowHeight(40);
        $activeWorksheet->getStyle('A' . $column_kk + 3)->getFont()->setBold(true);
        $activeWorksheet->getStyle('A' . $column_kk + 3)->getFont()->setSize(20);
        $activeWorksheet->setCellValue('A' . $column_kk + 3, 'DATA MEDICAL CHECK UP (MCU)');
        $activeWorksheet->setCellValue('A' . $column_kk + 4, 'NO');
        $activeWorksheet->setCellValue('B' . $column_kk + 4, 'TANGGAL MCU');
        $activeWorksheet->setCellValue('C' . $column_kk + 4, 'KATEGORI AWAL MCU');
        $activeWorksheet->setCellValue('D' . $column_kk + 4, 'KESIMPULAN');
        $activeWorksheet->setCellValue('E' . $column_kk + 4, 'SARAN');
        $activeWorksheet->setCellValue('F' . $column_kk + 4, 'KATEGORI FOLLOW UP');
        $activeWorksheet->setCellValue('G' . $column_kk + 4, 'CATATAN');
        $column_mcu = $column_kk + 5;
        $no_mcu = 1;
        foreach ($mcu as $key) {
            $activeWorksheet->setCellValue('A' . $column_mcu, $no_mcu++);
            $activeWorksheet->setCellValue('B' . $column_mcu, TanggalIndo($key->tgl_mcu));
            $activeWorksheet->setCellValue('C' . $column_mcu, strtoupper($key->kategori_mcu));
            $activeWorksheet->setCellValue('D' . $column_mcu, strtoupper($key->kesimpulan));
            $activeWorksheet->setCellValue('E' . $column_mcu, strtoupper($key->saran));
            $activeWorksheet->setCellValue('F' . $column_mcu, strtoupper($key->kategori_followup));
            $activeWorksheet->setCellValue('G' . $column_mcu, strtoupper($key->catatan));
            $column_mcu++;
        }
        $activeWorksheet->setCellValue('A' . $column_mcu, 'KETERANGAN KATEGORI MCU:');
        $activeWorksheet->setCellValue('A' . $column_mcu + 1, '1 = BAIK (FIT TO WORK)');
        $activeWorksheet->setCellValue('A' . $column_mcu + 2, '2 = CUKUP (FIT WITH NOTE)');
        $activeWorksheet->setCellValue('A' . $column_mcu + 3, '3 = KURANG (TEMPORARY UNFIT)');
        $activeWorksheet->setCellValue('A' . $column_mcu + 6, 'Diunduh pada tanggal ' . date('d/m/Y') . ' Dari PORTAL KLINIK oleh ' .
            ucwords(decrypt_url($this->session->userdata('nama_user'))));
        $activeWorksheet->getStyle('A' . $column_mcu + 6)->getFont()->setItalic(true);
        $activeWorksheet->getStyle('A' . $column_kk + 4 . ':' . 'G' . ($column_mcu - 1))->applyFromArray($styleArrayBorder);
        $activeWorksheet->getStyle('A' . $column_kk + 4 . ':' . 'G' . $column_kk + 4)->applyFromArray($styleArrayHeaderTable);
        $activeWorksheet->getStyle('A' . $column_kk + 4 . ':' . 'G' . $column_kk + 4)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FEEEBA');
        // MCU
        $writer = new Xlsx($spreadsheet);
        $filename = 'REKAM MEDIS ' . strtoupper($karyawan->nama_lengkap) . ' - ' . $karyawan->nik . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }
    public function divisi()
    {
        $divisi = $this->Divisi_m;
        $validation = $this->form_validation;
        $validation->set_rules($divisi->rules_divisi());
        if ($validation->run() == FALSE) {
            $data['divisi'] = $divisi->get_all_divisi();
            $this->template->load('shared/index', 'karyawan/divisi', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $divisi->add_divisi($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data divisi berhasil disimpan!');
                redirect('karyawan/divisi', 'refresh');
            }
        }
    }
    public function create()
    {
        $karyawan = $this->Karyawan_m;
        $divisi = $this->Divisi_m;
        $departemen = $this->Departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($karyawan->rules_karyawan());
        if ($validation->run() == FALSE) {
            $data['divisi'] = $divisi->get_all_divisi();
            $data['departemen'] = $departemen->get_all_departemen();
            $this->template->load('shared/index', 'karyawan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $karyawan->add_karyawan($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data karyawan berhasil disimpan!');
                redirect('karyawan', 'refresh');
            }
        }
    }
    public function update($id = null)
    {
        if (!isset($id))
            redirect('karyawan');
        $divisi = $this->Divisi_m;
        $departemen = $this->Departemen_m;
        $karyawan = $this->Karyawan_m;
        $validation = $this->form_validation;
        $validation->set_rules($karyawan->rules_edit_karyawan());
        if ($this->form_validation->run()) {
            $post = $this->input->post(null, TRUE);
            $this->Karyawan_m->update($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Edit data karyawan berhasil!');
                redirect('karyawan', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Data Tidak Diupdate!');
                redirect('karyawan', 'refresh');
            }
        }
        $data['data'] = $this->Karyawan_m->get_by_id_karyawan(decrypt_url($id));
        if (!$data['data']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            // redirect('karyawan', 'refresh');
        }
        $data['divisi'] = $divisi->get_all_divisi();
        $data['departemen'] = $departemen->get_all_departemen();
        $this->template->load('shared/index', 'karyawan/edit', $data);
    }
    public function update_divisi()
    {
        $post = $this->input->post(null, TRUE);
        $this->Divisi_m->update_divisi($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data divisi berhasil!');
            redirect('karyawan/divisi', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data divisi gagal!');
            redirect('karyawan/divisi', 'refresh');
        }
    }
    public function update_departemen()
    {
        $post = $this->input->post(null, TRUE);
        $this->Departemen_m->update_departemen($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data departemen berhasil!');
            redirect('karyawan/departemen', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data departemen gagal!');
            redirect('karyawan/departemen', 'refresh');
        }
    }
    public function departemen()
    {
        $departemen = $this->Departemen_m;
        $validation = $this->form_validation;
        $validation->set_rules($departemen->rules_departemen());
        if ($validation->run() == FALSE) {
            $data['departemen'] = $departemen->get_all_departemen();
            $this->template->load('shared/index', 'karyawan/departemen', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $departemen->add_departemen($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data departemen berhasil disimpan!');
                redirect('karyawan/departemen', 'refresh');
            }
        }
    }
    public function delete_divisi($id)
    {
        $this->Divisi_m->delete_divisi(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data divisi berhasil dihapus!');
            redirect('karyawan/divisi', 'refresh');
        }
    }
    public function delete_departemen($id)
    {
        $this->Departemen_m->delete_departemen(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data departemen berhasil dihapus!');
            redirect('karyawan/departemen', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Karyawan_m->delete_karyawan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data karyawan berhasil dihapus!');
            redirect('karyawan', 'refresh');
        }
    }
}

/* End of file Karyawan.php */
