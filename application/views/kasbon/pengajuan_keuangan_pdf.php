<?php
$pdf = new FPDF('p', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->SetTitle("REKAP PENGAJUAN KEUANGAN", 1);

// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 10);
// mencetak string 
$pdf->Cell(45, 2, '', 0, 1, 'C');
$pdf->Cell(45, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, 'REKAP PENGAJUAN KEUANGAN', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(97, 5, '', 0, 1, 'R');
$pdf->Image(base_url() . "assets/images/logogisaka.png", 10, 10, 43, 0, 'PNG');
$pdf->Cell(45, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 5, 'PT. GIANDRA SAKA MEDIA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(45, 5, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(29, 5, 'GISAKA MEDIA | ', 0, 0, 'L');
$pdf->SetFont('Arial', 'i', 10);
$pdf->Cell(50, 5, 'Connecting NICE Peoples! ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(68, 5, 'TGL CETAK ' . date('d/m/Y'), 0, 1, 'R');
$pdf->SetLineWidth(0.4);
$pdf->Line(10, 28, 202, 28);

// WIDTH TABLE SETTING
$no = 7;
$no_dokumen = 25;
$nama = 50;
$kategori = 30;
$nominal = 25;
$tgl = 30;
$status = 25;

// TABLE HEAD
$pdf->Cell(45, 5, '', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell($no, 7, 'NO.', 1, 0, 'C');
$pdf->Cell($no_dokumen, 7, 'NO DOKUMEN', 1, 0, 'C');
$pdf->Cell($nama, 7, 'NAMA LENGKAP', 1, 0, 'C');
$pdf->Cell($kategori, 7, 'KATEGORI', 1, 0, 'C');
$pdf->Cell($nominal, 7, 'NOMINAL', 1, 0, 'C');
$pdf->Cell($tgl, 7, 'TGL PENGAJUAN', 1, 0, 'C');
$pdf->Cell($status, 7, 'STATUS', 1, 1, 'C');

//TABLE BODY
$pdf->SetFont('Arial', '', 8);
$nomor = 1;
foreach ($data as $key) {
    $pdf->Cell($no, 7, $nomor++, 1, 0, 'C');
    $pdf->Cell($no_dokumen, 7, strtoupper($key->no_dokumen), 1, 0, 'C');
    $pdf->Cell($nama, 7, strtoupper($key->nama_user), 1, 0, 'L');
    $pdf->Cell($kategori, 7, strtoupper($key->kategori_keuangan), 1, 0, 'L');
    $pdf->Cell($nominal, 7, rupiah($key->nominal), 1, 0, 'L');
    $pdf->Cell($tgl, 7, TanggalIndo($key->created_date), 1, 0, 'L');
    $pdf->Cell($status, 7, strtoupper($key->status_terakhir), 1, 1, 'C');
}



$pdf->Output('', "SPK.pdf", 'SPK.pdf');
