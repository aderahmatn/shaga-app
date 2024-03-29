<?php
$pdf = new FPDF('l', 'mm', array(30, 20));
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle("BARCODE ", 1);

// setting jenis font yang akan digunakan
// mencetak string 
$pdf->SetFont('Arial', 'B', 7);
$pdf->Text(5, 3.5, $data->nama_tipe);
$pdf->Image(base_url() . "assets/images/logogisaka-90.png", 1,  5, 4, 0, 'PNG');
require 'vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$pdf->Image("data:image/png;base64," . base64_encode($generator->getBarcode($id, $generator::TYPE_EAN_13)), 5, 5, 23, 10, 'PNG');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Text(11, 18, $id);
$pdf->Output('', "BARCODE");
