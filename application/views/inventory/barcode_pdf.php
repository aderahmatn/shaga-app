<?php
$pdf = new FPDF('l', 'mm', array(50, 20));
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle("BARCODE ", 1);

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 10);
// mencetak string 
$pdf->Image(base_url() . "assets/images/logogisaka-90.png", 2, 1.5, 7, 0, 'PNG');
require 'vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$pdf->Image("data:image/png;base64," . base64_encode($generator->getBarcode($id, $generator::TYPE_EAN_13)), 10, 2, 37, 10, 'PNG');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Text(10, 16, $id);
$pdf->Output('', "BARCODE");
