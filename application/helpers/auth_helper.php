<?php

function check_already_login()
{
    $CI = &get_instance();
    $user_session = $CI->session->userdata('id_user');
    if ($user_session) {
        redirect('dashboard', 'refresh');
    }
}

function check_not_login()
{
    $CI = &get_instance();
    $user_session = $CI->session->userdata('id_user');
    if (!$user_session) {
        $CI->session->set_flashdata('error', 'Silahkan Login terlebih dahulu!');
        redirect('auth/login', 'refresh');
    }
}

function check_role_administrator($level)
{
    $CI = &get_instance();
    $user_session = $level;
    if ($user_session != 'ADMINISTRATOR') {
        $CI->session->set_flashdata('error', 'Halaman tidak ditemukan');
        redirect('dashboard', 'refresh');
    }
}
