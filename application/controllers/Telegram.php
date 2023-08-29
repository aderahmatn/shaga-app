<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');

    }

    function verify()
    {
        $this->load->view('telegram/verify');

    }

    public function index()
    {
        $content = file_get_contents("php://input");
        $TOKEN = "6259502863:AAEsTD1linSz1FbX4Hs7SH5U238u_ftIRZU";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode($content, TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        $txtok = urlencode("SELAMAT DATANG DI GISAKA AUTOMATION SYSTEM");
        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtok.&parse_mode=HTML");
        if ($message) {
            $txtok = urlencode("SELAMAT DATANG DI GISAKA AUTOMATION SYSTEM");
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtok.&parse_mode=HTML");
        }

    }
    public function send()
    {
        // create curl resource 
        $ch = curl_init();
        $txt = urlencode("Pesan otomatis (setiap 1 menit) dari GAS Notification");
        $TOKEN = "6259502863:AAEsTD1linSz1FbX4Hs7SH5U238u_ftIRZU";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        // set url 
        curl_setopt($ch, CURLOPT_URL, $apiURL . "/sendmessage?chat_id=959036270/&text=$txt");
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string 
        $output = curl_exec($ch);
        // close curl resource to free up system resources 
        curl_close($ch);
    }

}

/* End of file Telegram.php */