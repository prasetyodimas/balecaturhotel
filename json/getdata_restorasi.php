<?php include '../config/koneksi.php';

$id = isset($_GET['id_paket']) ? intval($_GET['id_paket']) : 0;

$query = "SELECT * FROM paket p JOIN detail_paket dp ON p.id_paket=dp.id_paket WHERE dp.id_paket='$id'";
$result = mysqli_query($konek,$query);
$respon = array();
while ($hasil = mysqli_fetch_array($result)) {
    
    $respon[] = $hasil;
}
echo json_encode($respon);