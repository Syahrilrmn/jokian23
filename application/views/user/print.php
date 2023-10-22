<?php
$pdf = new FPDF("P", "cm", "A4");
$pdf->AddPage();
$pdf->SetTitle("Laporan Data User Admin");
$pdf->SetFont("Arial", "B", "12");
$pdf->Cell("19", 1, "PLN PERSERO", 0, 1, "C");
$pdf->SetFont("Arial", "", "12");
$pdf->Cell("19", 1, "Alamat: JL.Mistar Cokrokusumo KM 39, Cempaka, Banjarbaru, Kalimantan Selatan 70733", 0, 1, "C");
$pdf->Line(1, 3, 20, 3);
$pdf->ln (1);
$pdf->SetFont("Arial", "B", "12");
$pdf->Cell(19, 1, "Laporan Data User Admin", 0, 1, "C");
$pdf->ln(1);
$pdf->SetFont("Arial", "B", "11");
$pdf->SetFillColor(125, 229, 237);
$pdf->Cell(1, 1, "No", 1, 0, "C", true);
// $pdf->Cell(6, 1, "Foto", 1, 0, "C", true);
$pdf->Cell(3, 1, "user", 1, 0, "C", true);
$pdf->Cell(2, 1, "Level", 1, 0, "C", true);
$pdf->Cell(3.5, 1, "jenis kelamin", 1, 0, "C", true);
$pdf->Cell(3, 1, "Telepon", 1, 0, "C", true);
$pdf->Cell(3, 1, "Tempat_lahir", 1, 0, "C", true);
$pdf->Cell(3, 1, "Tanggal_lahir", 1, 1, "C", true);
// $pdf->Cell(4, 1, "Tanggal Selesai", 1, 0, "C", true);
// $pdf->Cell(4, 1, "Jenis Beasiswa", 1, 1, "C", true);
$pdf->SetFont("Arial", "", 11);
$no = 1;
foreach ($user as $a) {
    $pdf->Cell(1, 1, $no++, 1, 0, "C",);
    // $pdf->Cell(6, 1, $a->foto, 1, 0, "C");
    $pdf->Cell(3, 1, $a->user, 1, 0, "C");
    $pdf->Cell(2, 1, $a->level, 1, 0, "C");
    $pdf->Cell(3.5, 1, $a->jenkel, 1, 0, "C");
    $pdf->Cell(3, 1, $a->telepon, 1, 0, "C");
    $pdf->Cell(3, 1, $a->tempat_lahir, 1, 0, "C");
    $pdf->Cell(3, 1, $a->tgl_lahir, 1, 1, "C");
    
    // $pdf->Cell(4, 1, $a->tanggal_selesai, 1, 0, "C");
    // $pdf->Cell(4, 1, $a->nama_jenis, 1, 1, "C");
}
$pdf->Output();