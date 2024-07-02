<?php
defined('BASEPATH') or exit('No direct script access allowed');
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Skd extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Skd_m', 'Karyawan_m', 'Diagnosa_m', 'Diagnosa_skd_m']);
        $this->load->helper(['Diagnosa_skd']);
    }


    public function index()
    {
        $data['skd'] = $this->Skd_m->get_all_skd();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->template->load('shared/index', 'skd/index', $data);
    }
    public function create()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/skd/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $skd = $this->Skd_m;
        $validation = $this->form_validation;
        $validation->set_rules($skd->rules_skd());
        if ($validation->run() == FALSE) {
            $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
            $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
            $this->template->load('shared/index', 'skd/create', $data);
        } else {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('flampiran')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $post = $this->input->post(null, TRUE);
                $file = $this->upload->data("file_name");
                $skd->add_skd($post, $file);
                $id_skd = $this->db->insert_id();
                $total = count($this->input->post('fdiagnosa'));
                if ($this->db->affected_rows() > 0) {
                    for ($i = 0; $i < $total; $i++) {
                        $this->Diagnosa_skd_m->add_diagnosa_skd($this->input->post('fdiagnosa[' . $i . ']'), $id_skd);
                    }
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data skd berhasil disimpan!');
                        redirect('skd', 'refresh');
                    } else {
                        $this->session->set_flashdata('warning', 'Data diagnosa gagal disimpan');
                        redirect('skd/create', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('warning', 'Data skd tidak berhasil disimpan!');
                    redirect('skd/create', 'refresh');
                }
            }
        }
    }
    public function delete($id)
    {
        $this->Skd_m->delete_skd(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->Diagnosa_skd_m->delete_diagnosa_by_id_skd(decrypt_url($id));
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus!');
                redirect('skd', 'refresh');
            }
        }
    }
    public function delete_diagnosa($id)
    {
        $this->Diagnosa_skd_m->delete_diagnosa_skd(decrypt_url($id));
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa skd berhasil dihapus!');
            redirect('skd', 'refresh');
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
        $data['skd'] = $this->Skd_m->get_skd_by_id(decrypt_url($id));
        $this->load->view('skd/detail', $data);
    }
    public function edit_diagnosa($id)
    {
        $data['id_skd'] = $id;
        $data['alldiagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['diagnosa'] = $this->Diagnosa_skd_m->get_all_diagnosa_skd_by_id_skd(decrypt_url($id));
        $this->load->view('skd/edit_diagnosa', $data);
    }
    public function edit_lampiran($id)
    {
        $data['id_skd'] = $id;
        $this->load->view('skd/edit_lampiran', $data);
    }
    public function update_lampiran()
    {
        // file config
        $config['overwrite'] = false;
        $config['upload_path'] = './uploads/skd/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        // end config
        $id_skd = decrypt_url($this->input->post('fid_skd'));
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('flampiran')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $file = $this->upload->data("file_name");
            $this->Skd_m->update_lampiran($id_skd, $file);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Lampiran berhasil diganti!');
                redirect('skd', 'refresh');
            } else {
                $this->session->set_flashdata('warning', 'Lampiran gagal diganti!');
                redirect('skd', 'refresh');
            }
        }
    }
    public function update_skd()
    {
        $post = $this->input->post(null, TRUE);
        $this->Skd_m->update_skd($post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Edit data skd berhasil!');
            redirect('skd', 'refresh');
        } else {
            $this->session->set_flashdata('warning', 'Edit data skd gagal!');
            redirect('skd', 'refresh');
        }
    }
    public function update_diagnosa()
    {
        $total = count($this->input->post('fdiagnosa'));
        $id_skd = decrypt_url($this->input->post('fid_skd'));
        for ($i = 0; $i < $total; $i++) {
            $this->Diagnosa_skd_m->add_diagnosa_skd($this->input->post('fdiagnosa[' . $i . ']'), $id_skd);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data diagnosa skd berhasil disimpan!');
            redirect('skd', 'refresh');
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
        $this->load->model(['Divisi_m', 'Departemen_m']);

        $data['diagnosa'] = $this->Diagnosa_m->get_all_diagnosa();
        $data['divisi'] = $this->Divisi_m->get_all_divisi();
        $data['dept'] = $this->Departemen_m->get_all_departemen();
        $data['karyawan'] = $this->Karyawan_m->get_all_karyawan();
        $this->load->view('skd/filter_xls', $data);
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
        $status_skd = $_POST['fstatus_skd'];
        $data = $this->Skd_m->get_all_skd_by_filter(
            $tgl_awal,
            $tgl_akhir,
            $divisi,
            $departemen,
            $status,
            $karyawan,
            $diagnosa,
            $status_skd,
        );

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        foreach (range('A', 'T') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $activeWorksheet->getStyle('A1')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A1')->getFont()->setSize(20);
        $activeWorksheet->getStyle('A2:T2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:T2')->getFont()->setSize(12);
        $activeWorksheet->getStyle('A2:T2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFCC');
        $activeWorksheet->getRowDimension('1')->setRowHeight(40);
        $activeWorksheet->getRowDimension('2')->setRowHeight(26);
        $activeWorksheet->getStyle('A1')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A2:T2')->getAlignment()->setVertical('center');
        $activeWorksheet->mergeCells('A1:Q1');



        $activeWorksheet->getStyle('A2:T2')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A1:Q1')->getAlignment()->setHorizontal('center');

        $activeWorksheet->setCellValue('A1', 'REKAP DATA SKD');
        $activeWorksheet->setCellValue('A2', 'NO');
        $activeWorksheet->setCellValue('B2', 'TANGGAL PENYERAHAAN');
        $activeWorksheet->setCellValue('C2', 'NAMA LENGKAP');
        $activeWorksheet->setCellValue('D2', 'L/P');
        $activeWorksheet->setCellValue('E2', 'NIK');
        $activeWorksheet->setCellValue('F2', 'USIA');
        $activeWorksheet->setCellValue('G2', 'PERUSAHAAN');
        $activeWorksheet->setCellValue('H2', 'DIVISI');
        $activeWorksheet->setCellValue('I2', 'DEPARTEMEN');
        $activeWorksheet->setCellValue('J2', 'BAGIAN');
        $activeWorksheet->setCellValue('K2', 'STATUS');
        $activeWorksheet->setCellValue('L2', 'ANAMNESA');
        $activeWorksheet->setCellValue('M2', 'TANGGAL SKD');
        $activeWorksheet->setCellValue('N2', 'LAMA SKD');
        $activeWorksheet->setCellValue('O2', 'KETERANGAN');
        $activeWorksheet->setCellValue('P2', 'FASKES');
        $activeWorksheet->setCellValue('Q2', 'DIAGNOSA');
        $activeWorksheet->setCellValue('R2', 'STATUS');
        $activeWorksheet->setCellValue('S2', 'PERAWAT');
        $activeWorksheet->setCellValue('T2', 'CATATAN');

        $column = 3;
        $no = 1;
        foreach ($data as $key => $value) {
            $activeWorksheet->setCellValue('A' . $column, $no++);
            $activeWorksheet->setCellValue('B' . $column, TanggalIndo($value->tgl_penyerahan));
            $activeWorksheet->setCellValue('C' . $column, strtoupper($value->nama_lengkap));
            $activeWorksheet->setCellValue('D' . $column, strtoupper($value->jenkel));
            $activeWorksheet->setCellValue('E' . $column, $value->nik);
            $activeWorksheet->setCellValue('F' . $column, date('Y', strtotime($value->tgl_mulai_skd)) - date('Y', strtotime($value->tgl_lahir)));
            $activeWorksheet->setCellValue('G' . $column, strtoupper($value->perusahaan));
            $activeWorksheet->setCellValue('H' . $column, strtoupper($value->nama_divisi));
            $activeWorksheet->setCellValue('I' . $column, strtoupper($value->nama_departemen));
            $activeWorksheet->setCellValue('J' . $column, strtoupper($value->bagian));
            $activeWorksheet->setCellValue('K' . $column, strtoupper($value->status));
            $activeWorksheet->setCellValue('L' . $column, strtoupper($value->jenis_penyakit));
            $activeWorksheet->setCellValue('M' . $column, TanggalIndo($value->tgl_mulai_skd) . '-' . TanggalIndo($value->tgl_akhir_skd));
            $activeWorksheet->setCellValue('N' . $column, strtoupper($value->jumlah_hari) . ' HARI');
            $activeWorksheet->setCellValue('O' . $column, strtoupper($value->pembayaran));
            $activeWorksheet->setCellValue('P' . $column, strtoupper($value->faskes));
            $activeWorksheet->setCellValue('Q' . $column, strtoupper(get_diagnosa_kunjungan_by_id_skd_text($value->id_skd)));
            $activeWorksheet->setCellValue('R' . $column, strtoupper($value->status_skd));
            $activeWorksheet->setCellValue('S' . $column, strtoupper($value->nama_user));
            $activeWorksheet->setCellValue('T' . $column, strtoupper($value->catatan_skd));
            $column++;
        }
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ]
            ]
        ];
        $activeWorksheet->getStyle('A2:T' . ($column - 1))->applyFromArray($styleArray);
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_skd.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }
}

/* End of file Kunjungan.php */
