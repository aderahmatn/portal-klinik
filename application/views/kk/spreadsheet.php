<?php
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
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
$writer = new Xlsx($spreadsheet);
$filename = 'datakktest.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
ob_end_clean();
$writer->save('php://output');
exit();
