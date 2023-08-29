<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Telegram extends CI_Controller
{

    public function index()
    {
        $content = file_get_contents("php://input");
        if ($content) {
            $TOKEN = "5876987158:AAEMq3QfjstyZK1a38T5h0TgTHNeDBTV1fE";
            $apiURL = "https://api.telegram.org/bot$TOKEN";
            $update = json_decode($content, TRUE);
            $chatID = $update["message"]["chat"]["id"];
            $message = $update["message"]["text"];

            if (strpos($message, "/start") === 0) {
                $user = $this->User_m->get_by_chat_id($chatID);
                if (!$user) {
                    $txtok = urlencode("SELAMAT DATANG\nNampaknya anda belum terdaftar pada SipeangBot,\nUntuk mendaftar silahkan masukan :\n<b>/register [spasi] username [spasi] nip</b>");
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtok.&parse_mode=HTML");
                } else {
                    $txt = urlencode("<b>SELAMAT DATANG</b>\nNama : " . strtoupper($user->nama_lengkap) . "\nNIP : " . strtoupper($user->nip));
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txt&parse_mode=HTML");
                }
            }

            if (strpos($message, "/register") === 0) {
                $usercek = $this->User_m->get_by_chat_id($chatID);
                if ($usercek) {
                    $txt = urlencode("<b>Anda sudah terdaftar sebagai :</b>\nNama : " . strtoupper($usercek->nama_lengkap) . "\nNIP : " . strtoupper($usercek->nip));
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txt&parse_mode=HTML");
                } else {
                    $jml = str_word_count(strval($message), 0, '1234567890');
                    $arr = explode(' ', trim($message));
                    if ($jml === 3) {
                        $user_registred = $this->User_m->cek_registered_user($arr[1], $arr[2]);
                        if ($user_registred) {
                            if ($user_registred->chat_id != 0) {
                                $text = urlencode("Username dan NIP sudah melakukan aktivasi pada SipeangBot,\nSilahkan masukan username dan NIP lain.");
                                file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$text&parse_mode=HTML");
                            } else {
                                $this->User_m->insert_chat_id($chatID, $arr[1]);
                                $textberhasil = urlencode("Terimakasih..\nAnda berhasil terdaftar pada SipeangBot");
                                file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$textberhasil");
                            }
                        } else {
                            $txtblm = urlencode("Username dan NIP anda belum terdaftar\nSilahkan menghubungi administrator untuk mendaftar.");
                            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtblm");
                        }
                    } else {
                        $txtsalah = urlencode("Format salah!\nSilahkan masukan :\n /register [spasi] username [spasi] nip");
                        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtsalah&parse_mode=HTML");
                    }
                }
            }

            if (strpos($message, "/anggaran") === 0) {
                $usercek = $this->User_m->get_by_chat_id($chatID);
                if ($usercek) {
                    $jml = str_word_count(strval($message), 0, '1234567890');
                    $txtsalah = urlencode("Format salah!\nSilahkan masukan :\n /anggaran [spasi] tahun anggaran");
                    if ($jml != 2) {
                        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtsalah");
                    } else {
                        $tahun = explode(' ', trim($message));
                        $text = "hallo gaes $tahun[1] $chatID";
                        $total_anggaran = $this->Dashboard_m->get_total_anggaran($chatID, $tahun[1]);
                        $total_penyerapan = $this->Dashboard_m->get_total_penyerapan($chatID, $tahun[1]);
                        $total_anggaran_rp = rupiah($total_anggaran);
                        $total_penyerapan_rp = rupiah($total_penyerapan);
                        $sisa_anggaran_rp = rupiah($total_anggaran - $total_penyerapan);
                        $presentase = $total_penyerapan == 0 ? '0' : ceil($total_penyerapan / $total_anggaran * 100);
                        if ($total_anggaran) {
                            $text = urlencode("<b>Tahun Anggaran $tahun[1]</b> \n------------------------------\nTotal Anggaran : $total_anggaran_rp  \nTotal Penyerapan : $total_penyerapan_rp \nSisa Anggaran : $sisa_anggaran_rp \nPresentase Penyerapan : $presentase%");
                        } else {
                            $text = 'Belum ada anggaran tahun ' . $tahun[1];
                        }

                        file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$text&parse_mode=HTML");
                    }
                } else {
                    $txtok = urlencode("SELAMAT DATANG\nNampaknya anda belum terdaftar pada SipeangBot,\nUntuk mendaftar silahkan masukan :\n<b>/register [spasi] username [spasi] nip</b>");
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=$txtok.&parse_mode=HTML");
                }
            }
        } else {
            echo 'Not authorized!';
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