<?php
function get_diagnosa_skd_by_id_skd($id_skd)
{
    $CI = &get_instance();
    $CI->load->model('Diagnosa_skd_m');
    $data = $CI->Diagnosa_skd_m->get_diagnosa_skd_by_id_skd($id_skd);
    foreach ($data as $key) {
        echo '<span class="badge badge-warning ml-1">' . $key['diagnosa'] . '</span>';
    }
}
function get_total_diagnosa_skd($id_diagnosa)
{
    $CI = &get_instance();
    $CI->load->model('Diagnosa_skd_m');
    $data = $CI->Diagnosa_skd_m->get_total_diagnosa_skd($id_diagnosa);
    return $data;
}
