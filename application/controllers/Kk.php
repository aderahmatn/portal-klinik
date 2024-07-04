<?php defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Kk_m', 'Karyawan_m']);
    }

    public function index()
    {
        $data['kk'] = $this->Kk_m->get_all_kk();
        $this->template->load('shared/index', 'kk/index', $data);
    }
    public function create()
    {
        // file config
        $filename = date('d_m_Y');
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/kk/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;
        // end config
        $kk = $this->Kk_m;
        $karyawan = $this->Karyawan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kk->rules_kk());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $karyawan->get_all_karyawan();
            $this->template->load('shared/index', 'kk/create', $data);
        } else {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $kk->add_kk($post, $file);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data kecelakaan kerja berhasil disimpan!');
                    redirect('kk', 'refresh');
                }
            }
        }
    }
    public function detail($id)
    {
        $data['kk'] = $this->Kk_m->get_kk_by_id(decrypt_url($id));
        $this->load->view('kk/detail', $data);
    }
    public function edit($id)
    {
        $data['kk'] = $this->Kk_m->get_kk_by_id(decrypt_url($id));
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'kk/edit', $data);
    }
    public function edit_lampiran($id)
    {
        $data['id_kk'] = $id;
        $this->load->view('kk/edit_lampiran', $data);
    }
    public function update()
    {
        $post = $this->input->post(null, TRUE);
        $this->Kk_m->update_kk($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data kecelakaan kerja berhasil!');
            redirect('kk', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data kecelakaan kerja gagal!');
            redirect('kk', 'refresh');
        }
    }
    public function update_lampiran()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/kk/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $id_kk = decrypt_url($this->input->post('fidkk'));
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $file = $this->upload->data("file_name");
            $this->Kk_m->update_lampiran($id_kk, $file);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Lampiran berhasil diganti!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('warning', 'Lampiran gagal diganti!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function delete($id)
    {
        $this->Kk_m->delete_kk(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data kecelakaan kerja berhasil dihapus!');
            redirect('kk', 'refresh');
        }
    }
    public function filter_xls()
    {
        $this->load->model(['Divisi_m', 'Departemen_m']);

        $data['divisi'] = $this->Divisi_m->get_all_divisi();
        $data['dept'] = $this->Departemen_m->get_all_departemen();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->load->view('kk/filter_xls', $data);
    }
    public function spreadsheet()
    {
        $this->load->view('kk/spreadsheet', FALSE);
    }
    public function excel()
    {
        $tgl_awal = $_POST['ftgl_awal'];
        $tgl_akhir = $_POST['ftgl_akhir'];
        $divisi = $_POST['fdivisi'];
        $departemen = $_POST['fdepartemen'];
        $status = $_POST['fstatus'];
        $karyawan = $_POST['karyawan'];
        $pendidikan = $_POST['fpendidikan'];
        $data = $this->Kk_m->get_all_kk_by_filter(
            $tgl_awal,
            $tgl_akhir,
            $divisi,
            $departemen,
            $status,
            $karyawan,
            $pendidikan,
        );
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        foreach (range('A', 'Z') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A1')->getFont()->setSize(20);
        $activeWorksheet->getStyle('A2:AD2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:AD2')->getFont()->setSize(12);
        $activeWorksheet->getStyle('A2:AD2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFCC');
        $activeWorksheet->getRowDimension('1')->setRowHeight(40);
        $activeWorksheet->getRowDimension('2')->setRowHeight(35);
        $activeWorksheet->getColumnDimension('AA')->setWidth(50);
        $activeWorksheet->getStyle('A1')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A2:AD2')->getAlignment()->setVertical('center');
        $activeWorksheet->mergeCells('A1:AD1');
        $activeWorksheet->getStyle('A2:AD2')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A1:AD1')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A:AD')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A:AD')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('AA')->getAlignment()->setWrapText(true);
        $activeWorksheet->setCellValue('A1', 'REKAP DATA KECELAKAAN KERJA');
        $activeWorksheet->setCellValue('A2', 'NO');
        $activeWorksheet->setCellValue('B2', 'NAMA LENGKAP');
        $activeWorksheet->setCellValue('C2', 'NIK');
        $activeWorksheet->setCellValue('D2', 'L/P');
        $activeWorksheet->setCellValue('E2', 'USIA');
        $activeWorksheet->setCellValue('F2', 'PENDIDIKAN');
        $activeWorksheet->setCellValue('G2', 'PERUSAHAAN');
        $activeWorksheet->setCellValue('H2', 'DIVISI');
        $activeWorksheet->setCellValue('I2', 'DEPARTEMEN');
        $activeWorksheet->setCellValue('J2', 'BAGIAN');
        $activeWorksheet->setCellValue('K2', 'STATUS');
        $activeWorksheet->setCellValue('L2', 'AREA KEJADIAN');
        $activeWorksheet->setCellValue('M2', 'MASA KERJA');
        $activeWorksheet->setCellValue('N2', 'NAMA ATASAN');
        $activeWorksheet->setCellValue('O2', 'WEEK');
        $activeWorksheet->setCellValue('P2', 'TANGGAL KEJADIAN');
        $activeWorksheet->setCellValue('Q2', 'WAKTU KEJADIAN');
        $activeWorksheet->setCellValue('R2', 'SHIF');
        $activeWorksheet->setCellValue('S2', 'KATEGORI');
        $activeWorksheet->setCellValue('T2', 'LOST TIME INJURY (LTI)');
        $activeWorksheet->setCellValue('U2', 'MEDICAL TREATMENT (MT)');
        $activeWorksheet->setCellValue('V2', 'BAGIAN YANG CIDERA');
        $activeWorksheet->setCellValue('W2', 'RUJUKAN');
        $activeWorksheet->setCellValue('X2', 'FASKES PENANGANAN');
        $activeWorksheet->setCellValue('Y2', 'TIPE KECELAKAAN');
        $activeWorksheet->setCellValue('Z2', 'PENYEBAB KECELAKAAN');
        $activeWorksheet->setCellValue('AA2', 'KRONOLOGI KEJADIAN');
        $activeWorksheet->setCellValue('AB2', 'TINDAKAN SETELAH DIRUJUK');
        $activeWorksheet->setCellValue('AC2', 'CATATAN');
        $activeWorksheet->setCellValue('AD2', '`UPDATE PEMANTAUAN MEDIS`');
        $column = 3;
        $no = 1;
        foreach ($data as $key => $value) {
            $activeWorksheet->setCellValue('A' . $column, $no++);
            $activeWorksheet->setCellValue('B' . $column, strtoupper($value->nama_lengkap));
            $activeWorksheet->setCellValue('C' . $column, strtoupper($value->nik));
            $activeWorksheet->setCellValue('D' . $column, strtoupper($value->jenkel));
            $activeWorksheet->setCellValue('E' . $column, date('Y', strtotime($value->tgl_kejadian)) - date('Y', strtotime($value->tgl_lahir)));
            $activeWorksheet->setCellValue('F' . $column, strtoupper($value->pendidikan_terakhir));
            $activeWorksheet->setCellValue('G' . $column, strtoupper($value->perusahaan));
            $activeWorksheet->setCellValue('H' . $column, strtoupper($value->nama_divisi));
            $activeWorksheet->setCellValue('I' . $column, strtoupper($value->nama_departemen));
            $activeWorksheet->setCellValue('J' . $column, strtoupper($value->bagian));
            $activeWorksheet->setCellValue('K' . $column, strtoupper($value->status));
            $activeWorksheet->setCellValue('L' . $column, strtoupper($value->area_kejadian));
            $activeWorksheet->setCellValue('M' . $column, date('Y', strtotime($value->tgl_kejadian)) - date('Y', strtotime($value->tgl_join))  . ' Tahun - ' . date('m', strtotime($value->tgl_kejadian)) - date('m', strtotime($value->tgl_join))  . ' Bulan');
            $activeWorksheet->setCellValue('N' . $column, strtoupper($value->nama_atasan));
            $activeWorksheet->setCellValue('O' . $column, strtoupper(NumberWeek($value->tgl_kejadian)));
            $activeWorksheet->setCellValue('P' . $column, TanggalIndo($value->tgl_kejadian));
            $activeWorksheet->setCellValue('Q' . $column, strtoupper($value->jam_kejadian));
            $activeWorksheet->setCellValue('R' . $column, strtoupper($value->shif));
            $activeWorksheet->setCellValue('S' . $column, strtoupper($value->kategori));
            $activeWorksheet->setCellValue('T' . $column, strtoupper($value->lost_time_injury));
            $activeWorksheet->setCellValue('U' . $column, strtoupper($value->medical_treatment));
            $activeWorksheet->setCellValue('V' . $column, strtoupper($value->bagian_cidera));
            $activeWorksheet->setCellValue('W' . $column, strtoupper($value->is_rujuk == 0 ? 'TIDAK' : 'YA'));
            $activeWorksheet->setCellValue('X' . $column, strtoupper($value->faskes_penanganan));
            $activeWorksheet->setCellValue('Y' . $column, strtoupper($value->tipe_kecelakaan));
            $activeWorksheet->setCellValue('Z' . $column, strtoupper($value->penyebab_kecelakaan));
            $activeWorksheet->setCellValue('AA' . $column, strtoupper($value->kronologi_kejadian))->getStyle('AA' . $column)->getAlignment()->setWrapText(true);
            $activeWorksheet->setCellValue('AB' . $column, strtoupper($value->tindakan_rujuk));
            $activeWorksheet->setCellValue('AC' . $column, strtoupper($value->catatan));
            $activeWorksheet->setCellValue('AD' . $column, strtoupper($value->update_pemantauan_medis));
            $column++;
        }
        $activeWorksheet->setCellValue('A' . $column + 2, 'Diunduh pada tanggal ' . date('d/m/Y') . ' Dari PORTAL KLINIK oleh ' .
            ucwords(decrypt_url($this->session->userdata('nama_user'))));
        $activeWorksheet->mergeCells('A' . $column + 2 . ':AC' . $column + 2);
        $activeWorksheet->getStyle('A' . $column + 2)->getFont()->setItalic(true);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ]
            ]
        ];
        $activeWorksheet->getStyle('A2:AD' . ($column - 1))->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Kecelakaan_Kerja.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }
}
/* End of file Kk.php */