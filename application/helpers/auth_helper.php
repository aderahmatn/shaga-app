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

function check_role_administrator()
{
    $CI = &get_instance();
    $user_session = $CI->session->userdata('group');
    if ($user_session != '1') {
        $CI->session->set_flashdata('error', 'Halaman tidak ditemukan');
        redirect('dashboard', 'refresh');
    }
}

// function check_role_admin()
// {
//     $CI = &get_instance();
//     $user_session = $CI->session->userdata('role');
//     if ($user_session != '1') {
//         $CI->session->set_flashdata('error', 'Hak akses terbatas!');
//         redirect('dashboard', 'refresh');
//     }
// }