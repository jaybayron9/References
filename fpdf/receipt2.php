<?php
session_start();

require("receipt/fpdf.php");

$pdf = new FPDF ('P','mm',array(80,145));
$pdf->AddPage();
foreach($_SESSION['data'] as $data){

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(60,8,$data['name'],1,1,'C');
    $pdf->SetFont('Arial','B',8);
}
    
$pdf->Output();

session_destroy();