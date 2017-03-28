<?php include '../../config/koneksi.php';

$id = isset($_GET['id_rental']) ? intval($_GET['id_rental']) : 0;

$query = "SELECT id_rental, kate_kendaraan, harga_kendaraan, ket_kendaraan FROM rental WHERE id_rental='$id'";
$result = mysqli_query($konek,$query);
$respon = array();
while ($hasil = mysqli_fetch_array($result)) {
    
    $respon[] = $hasil;
}
echo json_encode($respon);