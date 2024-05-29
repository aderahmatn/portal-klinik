<?php
function get_obat_kunjungan_by_id_kunjungan($id_kunjungan)
{
    $CI = &get_instance();
    $CI->load->model('Obat_kunjungan_m');
    $data = $CI->Obat_kunjungan_m->get_obat_kunjungan_by_id_kunjungan($id_kunjungan);
    foreach ($data as $key) {
        echo '<span class="badge badge-pill badge-success ml-1">' . $key->nama_obat . ' (' . $key->jumlah_keluar . ')' . '</span>';
    }
}
function get_total_obat_keluar_kunjungan($id_obat)
{
    $CI = &get_instance();
    $CI->load->model('Obat_kunjungan_m');
    $data = $CI->Obat_kunjungan_m->get_total_obat_keluar($id_obat);
    return $data;
}
