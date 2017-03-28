<?php include '../../config/koneksi.php';

$id = isset($_GET['id_laundry']) ? intval($_GET['id_laundry']) : 0;

$query = "SELECT * FROM laundry WHERE id_laundry='$id'";
$result = mysqli_query($konek,$query);
$respon = array();
while ($hasil = mysqli_fetch_array($result)) {

    $respon[] = $hasil;
}
echo json_encode($respon);
