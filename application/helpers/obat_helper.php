<?php
function get_stok_obat($id_obat)
{
    $CI = &get_instance();
    $CI->load->model('Stok_obat_m');
    $data = $CI->Stok_obat_m->get_stok_by_id_obat($id_obat);
    if ($data != null) {
        return $data;
    } else {
        return 0;
    }
}
