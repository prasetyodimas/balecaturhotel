<?php session_start(); error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php';
$act 		    		= $_GET['act'];
$s_id           = session_id();
$tem_checkin 	  = $_SESSION['session_checkin'];
$tem_checkout 	= $_SESSION['session_checkout'];
$id_usermember  = $_SESSION['id_member'];
$jumlah_request = $_SESSION['session_jumlah_kamar'];
	// FUNCTION CHCEK ROW BOOKING ITEMS
	$show_data_temp = mysqli_query($konek,"SELECT * FROM temp_booking WHERE id_kategori_kamar='$_GET[id]' AND session='$s_id'");
	$cek_row_temp   = mysqli_num_rows($show_data_temp);
	$cek_stock_ketetersediaan_kamar = mysqli_query($konek,
								"SELECT
									  km.id_kategori_kamar,
									  km.type_kamar,
									  km.jumlah_kamar,
									  km.tarif,
									  km.fasilitas,km.foto_kamar,
									  count(k.id_kamar) as stok_kmr
								FROM kamar k
								JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar
								WHERE km.id_kategori_kamar='$_GET[id]'
								AND k.status_kamar !='3'
								GROUP BY k.id_kategori_kamar ASC");
	$show_stok_kamar = mysqli_fetch_array($cek_stock_ketetersediaan_kamar);
	//HITUNG STOK KAMAR
	$stok_kamar 						= $show_stok_kamar['jumlah_kamar'];
	$pengurangan_stok_kamar = ($stok_kamar-$jumlah_request);
	//FUNCTION STOK KAMAR
	$execute = "UPDATE kategori_kamar SET jumlah_kamar_akhir=$pengurangan_stok_kamar WHERE id_kategori_kamar='$_GET[id]'";
	$succesSaved = mysqli_query($konek,$execute);
	//FUNCTION UPDATE STATUS KAMAR
	$updateRoomToBooked = "UPDATE kamar SET status_kamar='4' WHERE id_kategori_kamar='$_GET[id]' LIMIT $jumlah_request";
	$succesSavedStatus	= mysqli_query($konek,$updateRoomToBooked);

	$insert_to_temp = "INSERT INTO temp_booking (id_kategori_kamar,
																							 jumlah,
																							 temp_checkin,
																							 temp_checkout,
																							 session,
																							 id_member)
																			  VALUES ('$_GET[id]',
																								'$jumlah_request',
																								'$tem_checkin',
																								'$tem_checkout',
																								'$s_id',
																								'$id_usermember')";
	$saved_temp  = mysqli_query($konek,$insert_to_temp);
	if ($saved_temp) {
		echo "<script>alert('data berhasil dismpan dan mempersiapkan formulir pemesanan');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
	}else{
		echo "<script>alert('data kamar gagal di di simpan !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
	}
?>
