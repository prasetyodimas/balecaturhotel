<?php session_start(); error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include '../config/koneksi.php'; 
$act 		  = $_GET['act'];
$var_date_now =  date('Y-m-d H:i:s');
$s_id         = session_id();
$jumlah_request = $_SESSION['session_jumlah_kamar'];

if ($act=='adding_other_room') {
	$show_data_temp = mysqli_query($konek,"SELECT * FROM temp_booking WHERE id_kategori_kamar='$_POST[kategori_kamar]' AND session='$s_id'");
	$cek_row_temp = mysqli_num_rows($show_data_temp);
	if ($cek_row_temp == 0) {
		//INSERT KAMAR
		//temp insert room
		$insert_to_temp = "INSERT INTO temp_booking (id_kategori_kamar, jumlah, tgl_checkin_now, session) VALUES ('$_POST[kategori_kamar]','$jumlah_request','$var_date_now','$s_id')";
		$saved_temp  = mysqli_query($konek,$insert_to_temp);
		if ($saved_temp) {
			echo "<script>sweetAlert('data berhasil dismpan dan mempersiapkan formulir pemesanan');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}else{
			echo "<script>sweetAlert('data kamar gagal di di simpan !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}
	}else{
		$insert_to_temp = "INSERT INTO temp_booking (id_kategori_kamar, jumlah, tgl_checkin_now, session) VALUES ('$_POST[kategori_kamar]','$jumlah_request','$var_date_now','$s_id')";
		$saved_temp  = mysqli_query($konek,$insert_to_temp);
		if ($saved_temp) {
			echo "<script>sweetAlert('data berhasil dismpan dan mempersiapkan formulir pemesanan');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}else{
			echo "<script>sweetAlert('data kamar gagal di di simpan !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}
		//UPDATE KAMAR
		/*$update_room = mysqli_query($konek,"UPDATE temp_booking SET jumlah = jumlah + 1 WHERE session='$s_id' AND id_kategori_kamar='$_POST[kategori_kamar]'");
		if ($update_room) {
			echo "<script>alert('data kamar berhasil di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}else{
			echo "<script>alert('data kamar gagal di di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
		}*/

	}

}elseif($act=='delete_reservation') {
	$delete_reservation = "DELETE FROM temp_booking WHERE session='$s_id' AND id_tempbooking='$_GET[id]'";
	$succes_delete_reserve = mysqli_query($konek,$delete_reservation);
	if ($succes_delete_reserve) {
		//echo "<script>alert('pemesanan kamar berhasil dibatalkan !');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
	}else{
		//echo "<script>alert('pemesanan kamar gagal di batalkan !');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=getall_transaction>";
	}
}
?>