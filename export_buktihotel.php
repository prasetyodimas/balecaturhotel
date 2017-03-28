<?php session_start();
include "config/koneksi.php";
require('library/fpdf/fpdf.php');

//query databases
$kd_booking = $_GET['id'];

$gettransaction = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking WHERE kd_booking='$kd_booking'"));
echo $kd_booking;

$hasilnya = mysqli_query($konek,
	 "SELECT * FROM booking b JOIN member m ON m.id_member=b.id_member WHERE b.kd_booking='$kd_booking'");
$result = mysqli_fetch_array($hasilnya);

// list ($nama_siswa, $nis, $ta, $semester,$kd_mapel, $mapel, $kelas, $nilai) 

//medifinisikan variable class fpdf dan page pdf
$pdf = new FPDF('P','mm','A4'); 
$pdf->AddPage();

//medifinisikan set margin
$pdf->SetMargins(40,10,6);


$pdf->Image('frontend/icon/desain-struck.png' ,12,3,0,28);
$pdf->SetFont('Arial','B',10); 
												
//fungsi mengatur text area font
$pdf->SetFont('Arial', 'B', 8);

$pdf->Text(140, 50, "Kode Booking");
$pdf->Text(165, 50," : " .$result['kd_booking']);

$pdf->Text(15, 50, "Nama Pemesan");
$pdf->Text(40, 50," : " .$result['nama_lengkap']);

$pdf->Text(15, 55, "Nama Siswa");
$pdf->Text(40, 55," : " .$tampilHasil['nama_siswa']);

$pdf->Text(140, 55, "Semester");
$pdf->Text(165, 55," : ".$tampilHasil['semester']);


//fungsi mengatur dan posisi table x dan y
$pdf->SetXY(15, 60);
$pdf->AliasNbPages();
// function untuk menampilkan tabel


//membuat header tabel set color
$pdf->SetFillColor(50, 50, 50);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(10, 5, "No.", 1, 0, 'C', true);
$pdf->Cell(40, 5, "Kode Mapel", 1, 0, 'C', true);
$pdf->Cell(40, 5, "Mata Pelajaran", 1, 0, 'C', true);
$pdf->Cell(20, 5, "Kelas", 1, 0, 'C', true);
$pdf->Cell(30, 5, "Nilai Akhir", 1, 0, 'C', true);
$pdf->Cell(30, 5, "Predikat (NA)", 1, 0, 'C', true);




$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);
//membuat halaman
$no=1; 

//fungsi mengatur dan posisi table x dan y	
$pdf->SetXY(15, 65);

//membuat baris tabel
while (list($kd_mapel, $mapel, $kelas, $nilai) = mysql_fetch_row($hasilnya2)) {
$pdf->Cell(10, 5, $no, 1, 0, 'C');
$pdf->Cell(40, 5, $kd_mapel, 1, 0, 'C');
$pdf->Cell(40, 5, $mapel, 1, 0, 'C');
$pdf->Cell(20, 5, $kelas, 1, 0, 'C');
$pdf->Cell(30, 5, $nilai, 1, 0, 'C');
$pdf->Cell(30, 5, $nilai, 1, 0, 'C');

$y = 65+(5*$no);
$no++;
$pdf->SetXY(15, $y);

}



//fungsi show halaman
$pdf->SetY(-15);
//buat garis horizontal
$pdf->Line(7, $pdf->GetY(),200,$pdf->GetY());
//Arial italic 9
$pdf->SetFont('Arial','I',7);
//nomor halaman
$pdf->Cell(0,-10,'Halaman '.$pdf->PageNo().' dari {nb}',0,0,'R');

$pdf->Output(); 






?>