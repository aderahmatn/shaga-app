<?php
function cek_status_pembelian($no_pembelian, $status)
{
    $CI = get_instance();
    $CI->load->model('Status_pembelian_m');
    $data = $CI->Status_pembelian_m->cek_status($no_pembelian, $status);
    if (!$data) {
        return 0;
    } else {
        return 1;
    }
}