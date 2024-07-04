<?php
defined('BASEPATH') or exit('No direct script access allowed');
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mcu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Mcu_m', 'Karyawan_m']);
    }

    public function index()
    {
        // file config
        $filename = date('d/m/Y');
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/mcu/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $filename;
        $config['max_size'] = 2048;
        // end config
        $mcu = $this->Mcu_m;
        $karyawan = $this->Karyawan_m;
        $validation = $this->form_validation;
        $validation->set_rules($mcu->rules_mcu());
        $this->load->library('upload', $config);
        if ($validation->run() == FALSE) {
            $data['mcu'] = $mcu->get_all_mcu();
            $data['karyawan'] = $karyawan->get_all_karyawan();
            $this->template->load('shared/index', 'mcu/index', $data);
        } else {
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $mcu->add_mcu($post, $file);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data mcu berhasil disimpan!');
                    redirect('mcu', 'refresh');
                }
            }
        }
    }
    public function update_mcu()
    {
        $post = $this->input->post(null, TRUE);
        $this->Mcu_m->update_mcu($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data mcu berhasil!');
            redirect('mcu', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data mcu gagal!');
            redirect('mcu', 'refresh');
        }
    }
    public function delete($id)
    {
        $this->Mcu_m->delete_mcu(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data mcu berhasil dihapus!');
            redirect('mcu', 'refresh');
        }
    }
    public function filter_xls()
    {
        $this->load->model(['Divisi_m', 'Departemen_m']);

        $data['divisi'] = $this->Divisi_m->get_all_divisi();
        $data['dept'] = $this->Departemen_m->get_all_departemen();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->load->view('mcu/filter_xls', $data);
    }
    public function excel()
    {
        $tgl_awal = $_POST['ftgl_awal'];
        $tgl_akhir = $_POST['ftgl_akhir'];
        $divisi = $_POST['fdivisi'];
        $departemen = $_POST['fdepartemen'];
        $status = $_POST['fstatus'];
        $karyawan = $_POST['karyawan'];
        $kategori = $_POST['fkategori_awal'];
        $kategori_folup = $_POST['fkategori_folup'];
        $data = $this->Mcu_m->get_all_mcu_by_filter(
            $tgl_awal,
            $tgl_akhir,
            $divisi,
            $departemen,
            $status,
            $karyawan,
            $kategori,
            $kategori_folup
        );

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        foreach (range('A', 'M') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A1')->getFont()->setSize(20);
        $activeWorksheet->getStyle('A2:Q2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:Q2')->getFont()->setSize(12);
        $activeWorksheet->getStyle('A2:Q2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFCC');
        $activeWorksheet->getRowDimension('1')->setRowHeight(40);
        $activeWorksheet->getRowDimension('2')->setRowHeight(26);
        $activeWorksheet->getStyle('A1')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A2:Q2')->getAlignment()->setVertical('center');
        $activeWorksheet->getColumnDimension('N')->setWidth(50);
        $activeWorksheet->getColumnDimension('O')->setWidth(50);
        $activeWorksheet->getColumnDimension('Q')->setWidth(50);
        $activeWorksheet->getStyle('N')->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('O')->getAlignment()->setWrapText(true);
        $activeWorksheet->getStyle('Q')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);


        $activeWorksheet->mergeCells('A1:Q1');




        $activeWorksheet->getStyle('A:Q')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A:Q')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A1:Q1')->getAlignment()->setHorizontal('center');
        $activeWorksheet->setCellValue('A1', 'REKAP DATA MEDICAL CHECK UP');
        $activeWorksheet->setCellValue('A2', 'NO');
        $activeWorksheet->setCellValue('B2', 'TANGGAL MCU');
        $activeWorksheet->setCellValue('C2', 'NAMA LENGKAP');
        $activeWorksheet->setCellValue('D2', 'NIK');
        $activeWorksheet->setCellValue('E2', 'L/P');
        $activeWorksheet->setCellValue('F2', 'TANGGAL LAHIR');
        $activeWorksheet->setCellValue('G2', 'USIA');
        $activeWorksheet->setCellValue('H2', 'PERUSAHAAN');
        $activeWorksheet->setCellValue('I2', 'DIVISI');
        $activeWorksheet->setCellValue('J2', 'DEPARTEMEN');
        $activeWorksheet->setCellValue('K2', 'BAGIAN');
        $activeWorksheet->setCellValue('L2', 'STATUS');
        $activeWorksheet->setCellValue('M2', 'KATEGORI AWAL MCU');
        $activeWorksheet->setCellValue('N2', 'KESIMPULAN');
        $activeWorksheet->setCellValue('O2', 'SARAN');
        $activeWorksheet->setCellValue('P2', 'KATEGORI FOLLOW UP');
        $activeWorksheet->setCellValue('Q2', 'CATATAN');


        $column = 3;
        $no = 1;
        foreach ($data as $key => $value) {
            $activeWorksheet->setCellValue('A' . $column, $no++);
            $activeWorksheet->setCellValue('B' . $column, TanggalIndo($value->tgl_mcu));
            $activeWorksheet->setCellValue('C' . $column, strtoupper($value->nama_lengkap));
            $activeWorksheet->setCellValue('D' . $column, strtoupper($value->nik));
            $activeWorksheet->setCellValue('E' . $column, strtoupper($value->jenkel));
            $activeWorksheet->setCellValue('F' . $column, TanggalIndo($value->tgl_lahir));
            $activeWorksheet->setCellValue('G' . $column, date('Y', strtotime($value->tgl_mcu)) - date('Y', strtotime($value->tgl_lahir)));
            $activeWorksheet->setCellValue('H' . $column, strtoupper($value->perusahaan));
            $activeWorksheet->setCellValue('I' . $column, strtoupper($value->nama_divisi));
            $activeWorksheet->setCellValue('J' . $column, strtoupper($value->nama_departemen));
            $activeWorksheet->setCellValue('K' . $column, strtoupper($value->bagian));
            $activeWorksheet->setCellValue('L' . $column, strtoupper($value->status));
            $activeWorksheet->setCellValue('M' . $column, strtoupper($value->kategori_mcu));
            $activeWorksheet->setCellValue('N' . $column, strtoupper($value->kesimpulan));
            $activeWorksheet->setCellValue('O' . $column, strtoupper($value->saran));
            $activeWorksheet->setCellValue('P' . $column, strtoupper($value->kategori_followup));
            $activeWorksheet->setCellValue('Q' . $column, strtoupper($value->catatan));
            $column++;
        }
        $activeWorksheet->setCellValue('A' . $column + 2, 'Diunduh pada tanggal ' . date('d/m/Y') . ' Dari PORTAL KLINIK oleh ' .
            ucwords(decrypt_url($this->session->userdata('nama_user'))));
        $activeWorksheet->mergeCells('A' . $column + 2 . ':Q' . $column + 2);
        $activeWorksheet->getStyle('A' . $column + 2)->getFont()->setItalic(true);
        $activeWorksheet->getStyle('A' . $column + 2)->getAlignment()->setHorizontal('left');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ]
            ]
        ];
        $activeWorksheet->getStyle('A2:Q' . ($column - 1))->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Medical_Check_Up.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }
}

/* End of file Diagnosa.php */
