<?php
function get_diagnosa_kunjungan_by_id_kunjungan($id_kunjungan)
{
    $CI = &get_instance();
    $CI->load->model('Diagnosa_kunjungan_m');
    $data = $CI->Diagnosa_kunjungan_m->get_diagnosa_kunjungan_by_id_kunjungan($id_kunjungan);
    foreach ($data as $key) {
        echo '<span class="badge badge-warning ml-1">' . $key['diagnosa'] . '</span>';
    }
}
function get_total_diagnosa_kunjungan($id_diagnosa)
{
    $CI = &get_instance();
    $CI->load->model('Diagnosa_kunjungan_m');
    $data = $CI->Diagnosa_kunjungan_m->get_total_diagnosa_kunjungan($id_diagnosa);
    return $data;
}
