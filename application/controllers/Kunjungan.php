<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kunjungan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Kunjungan_m', 'Karyawan_m', 'Diagnosa_m', 'Diagnosa_kunjungan_m', 'Obat_m', 'Obat_kunjungan_m', 'Kk_m']);
        $this->load->helper(['diagnosa_kunjungan', 'obat_kunjungan']);
    }

    public function index()
    {
        $data['kunjungan'] = $this->Kunjungan_m->get_all_kunjungan();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'kunjungan/index', $data);
    }
    public function create()
    {
        $kunjungan = $this->Kunjungan_m;
        $validation = $this->form_validation;
        $validation->set_rules($kunjungan->rules_kunjungan());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
            $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
            $data['obat'] = $this->Obat_m->get_all_obat();
            $this->template->load('shared/index', 'kunjungan/create', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $kunjungan->add_kunjungan($post);
            $id_kunjungan = $this->db->insert_id();
            $total = count($this->input->post('fdiagnosa'));
            $total_obat = count($this->input->post('fid_obat'));
            if ($this->db->affected_rows() > 0) {
                for ($i = 0; $i < $total; $i++) {
                    $this->Diagnosa_kunjungan_m->add_diagnosa_kunjungan($this->input->post('fdiagnosa[' . $i . ']'), $id_kunjungan);
                }
                if ($this->db->affected_rows() > 0) {
                    if ($total_obat == 1 && $this->input->post('fid_obat[0]') == null) {
                        $this->session->set_flashdata('success', 'Data kunjungan berhasil disimpan!');
                        redirect('kunjungan', 'refresh');
                    } else {
                        for ($i = 0; $i < $total_obat; $i++) {
                            $this->Obat_kunjungan_m->add_obat_kunjungan($this->input->post('fid_obat[' . $i . ']'), $id_kunjungan, $this->input->post('fjumlah_obat[' . $i . ']'));
                        }
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data kunjungan berhasil disimpan!');
                            redirect('kunjungan', 'refresh');
                        }
                    }
                } else {
                    $this->session->set_flashdata('warning', 'Data diagnosa gagal disimpan');
                    redirect('kunjungan/create', 'refresh');
                }
            } else {
                $this->session->set_flashdata('warning', 'Data kunjungan tidak berhasil disimpan!');
                redirect('kunjungan/create', 'refresh');
            }
        }
    }
    public function delete($id)
    {
        $this->Kunjungan_m->delete_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Obat_kunjungan_m->delete_obat_by_id_kunjungan(decrypt_url($id));
            if ($this->db->affected_rows() > 0) {
                $this->Diagnosa_kunjungan_m->delete_diagnosa_by_id_kunjungan(decrypt_url($id));
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus!');
                    redirect('kunjungan', 'refresh');
                }
            }
        }
    }
    public function delete_diagnosa($id)
    {
        $this->Diagnosa_kunjungan_m->delete_diagnosa_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa kunjungan berhasil dihapus!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function delete_obat($id)
    {
        $this->Obat_kunjungan_m->delete_obat_kunjungan(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data teraphy obat berhasil dihapus!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function detail($id)
    {
        $data['kunjungan'] = $this->Kunjungan_m->get_kunjungan_by_id(decrypt_url($id));
        $this->load->view('kunjungan/detail', $data);
    }
    public function edit_diagnosa($id)
    {
        $data['id_kunjungan'] = $id;
        $data['alldiagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['diagnosa'] = $this->Diagnosa_kunjungan_m->get_all_diagnosa_kunjungan_by_id_kunjungan(decrypt_url($id));
        $this->load->view('kunjungan/edit_diagnosa', $data);
    }
    public function edit_obat($id)
    {
        $data['id_kunjungan'] = $id;
        $data['allobat'] = $this->Obat_m->get_all_obat();
        $data['obat'] = $this->Obat_kunjungan_m->get_obat_kunjungan_by_id_kunjungan(decrypt_url($id));
        $this->load->view('kunjungan/edit_obat', $data);
    }
    public function update_kunjungan()
    {
        $post = $this->input->post(null, TRUE);
        $this->Kunjungan_m->update_kunjungan($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data kunjungan berhasil!');
            redirect('kunjungan', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data kunjungan gagal!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function update_diagnosa()
    {
        $total = count($this->input->post('fdiagnosa'));
        $id_kunjungan = decrypt_url($this->input->post('fid_kunjungan'));
        for ($i = 0; $i < $total; $i++) {
            $this->Diagnosa_kunjungan_m->add_diagnosa_kunjungan($this->input->post('fdiagnosa[' . $i . ']'), $id_kunjungan);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa kunjungan berhasil disimpan!');
            redirect('kunjungan', 'refresh');
        }
    }
    public function update_obat()
    {
        $total_obat = count($this->input->post('fid_obat'));
        $id_kunjungan = decrypt_url($this->input->post('fid_kunjungan'));
        for ($i = 0; $i < $total_obat; $i++) {
            if ($this->input->post('fjumlah_obat[' . $i . ']') == null) {
                $this->session->set_flashdata('error', 'Obat tidak tersedia');
                redirect('kunjungan', 'refresh');
            } else {
                $this->Obat_kunjungan_m->add_obat_kunjungan($this->input->post('fid_obat[' . $i . ']'), $id_kunjungan, $this->input->post('fjumlah_obat[' . $i . ']'));
            }
        }
        $this->session->set_flashdata('success', 'Data kunjungan berhasil disimpan!');
        redirect('kunjungan', 'refresh');
    }
    public function filter_xls()
    {
        $this->load->model(['Divisi_m', 'Departemen_m', 'Diagnosa_m']);

        $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['divisi'] = $this->Divisi_m->get_all_divisi();
        $data['dept'] = $this->Departemen_m->get_all_departemen();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->load->view('kunjungan/filter_xls', $data);
    }
    public function excel()
    {
        $tgl_awal = $_POST['ftgl_awal'];
        $tgl_akhir = $_POST['ftgl_akhir'];
        $divisi = $_POST['fdivisi'];
        $departemen = $_POST['fdepartemen'];
        $status = $_POST['fstatus'];
        $karyawan = $_POST['karyawan'];
        $diagnosa = $_POST['fdiagnosa'];
        $data = $this->Kunjungan_m->get_all_kunjungan_by_filter(
            $tgl_awal,
            $tgl_akhir,
            $divisi,
            $departemen,
            $status,
            $karyawan,
            $diagnosa,
        );


        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        foreach (range('A', 'Q') as $columnID) {
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
        $activeWorksheet->mergeCells('A1:Q1');



        $activeWorksheet->getStyle('A2:Q2')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A1:Q1')->getAlignment()->setHorizontal('center');
        $activeWorksheet->setCellValue('A1', 'REKAP DATA KUNJUNGAN');
        $activeWorksheet->setCellValue('A2', 'TANGGAL KUNJUNGAN');
        $activeWorksheet->setCellValue('B2', 'JAM KUNJUNGAN');
        $activeWorksheet->setCellValue('C2', 'NAMA LENGKAP');
        $activeWorksheet->setCellValue('D2', 'L/P');
        $activeWorksheet->setCellValue('E2', 'TANGGAL LAHIR');
        $activeWorksheet->setCellValue('F2', 'USIA');
        $activeWorksheet->setCellValue('G2', 'PERUSAHAAN');
        $activeWorksheet->setCellValue('H2', 'DIVISI');
        $activeWorksheet->setCellValue('I2', 'DEPARTEMEN');
        $activeWorksheet->setCellValue('J2', 'BAGIAN');
        $activeWorksheet->setCellValue('K2', 'STATUS');
        $activeWorksheet->setCellValue('L2', 'ANAMNESA');
        $activeWorksheet->setCellValue('M2', 'DIAGNOSA');
        $activeWorksheet->setCellValue('N2', 'CATATAN');
        $activeWorksheet->setCellValue('O2', 'TERAPHY FISIK');
        $activeWorksheet->setCellValue('P2', 'TERAPHY OBAT');
        $activeWorksheet->setCellValue('Q2', 'PERAWAT');

        $column = 3;
        foreach ($data as $key => $value) {
            $activeWorksheet->setCellValue('A' . $column, TanggalIndo($value->tgl_kunjungan));
            $activeWorksheet->setCellValue('B' . $column, $value->jam_kunjungan);
            $activeWorksheet->setCellValue('C' . $column, strtoupper($value->nama_lengkap));
            $activeWorksheet->setCellValue('D' . $column, strtoupper($value->jenkel));
            $activeWorksheet->setCellValue('E' . $column, $value->tgl_lahir);
            $activeWorksheet->setCellValue('F' . $column, date('Y', strtotime($value->tgl_kunjungan)) - date('Y', strtotime($value->tgl_lahir)));
            $activeWorksheet->setCellValue('G' . $column, strtoupper($value->perusahaan));
            $activeWorksheet->setCellValue('H' . $column, strtoupper($value->nama_divisi));
            $activeWorksheet->setCellValue('I' . $column, strtoupper($value->nama_departemen));
            $activeWorksheet->setCellValue('J' . $column, strtoupper($value->bagian));
            $activeWorksheet->setCellValue('K' . $column, strtoupper($value->status));
            $activeWorksheet->setCellValue('L' . $column, strtoupper($value->anamnesa));
            $activeWorksheet->setCellValue('M' . $column, strtoupper(get_diagnosa_kunjungan_by_id_kunjungan_text($value->id_kunjungan)));
            $activeWorksheet->setCellValue('N' . $column, strtoupper($value->catatan_kunjungan));
            $activeWorksheet->setCellValue('O' . $column, strtoupper($value->teraphy));
            $activeWorksheet->setCellValue('P' . $column, strtoupper(get_obat_kunjungan_by_id_kunjungan_text($value->id_kunjungan)));
            $activeWorksheet->setCellValue('Q' . $column, strtoupper($value->nama_user));
            $column++;
        }
        $activeWorksheet->setCellValue('A' . $column + 2, 'Diunduh pada tanggal ' . date('d/m/Y') . ' Dari PORTAL KLINIK oleh ' .
            ucwords(decrypt_url($this->session->userdata('nama_user'))));
        $activeWorksheet->mergeCells('A' . $column + 2 . ':Q' . $column + 2);
        $activeWorksheet->getStyle('A' . $column + 2)->getFont()->setItalic(true);
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
        $filename = 'Data_Kunjungan.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }
}

/* End of file Kunjungan.php */
