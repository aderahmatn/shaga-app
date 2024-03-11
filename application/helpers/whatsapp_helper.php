<?php
date_default_timezone_set('Asia/Jakarta');
function send_wa($no_wa, $pesan)
{
    $dataSending = array();
    $dataSending["api_key"] = "HUVICSYRSVNYX7MW";
    $dataSending["number_key"] = "EhlZhkMgwgxbfNOx";
    $dataSending["phone_no"] = $no_wa;
    $dataSending["message"] = $pesan;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dataSending),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response);
    return $data->status;
}
