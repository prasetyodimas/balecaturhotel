<?php 
require('fpdf/fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',16); 
$pdf->Cell(40,10,'Convert file to PHP bersama Canisnfelis'); 
$pdf->Output(); 
?>