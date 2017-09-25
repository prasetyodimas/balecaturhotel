<?php include '../../config/koneksi.php';
date_default_timezone_set('Asia/jakarta');
$act = $_GET['act'];
if ($act='checkout_room') {
	$array_room = $_POST['no_room_category'];
	$array_cateroom = $_POST['category_room'];
	//change booking status CO ( checkout status )
	$update_status_room = "UPDATE booking SET status_userbook='CO' WHERE kd_booking='$_POST[kd_booking]'";
	$succes_update_status = mysqli_query($konek,$update_status_room);

	$i =0;
	foreach ($array_cateroom as $caterooms) {
		$view_permintaan_kamar = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking b
																																		JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking
																																		JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar
																																		WHERE b.kd_booking='$_POST[kd_booking]'"));
		$qtyRoomRequest  = $view_permintaan_kamar['berapa_kamar'];
		$checkroom_count = mysqli_fetch_array(mysqli_query($konek,"SELECT count(*) AS status FROM kamar WHERE status_kamar!='3' AND id_kategori_kamar='$caterooms'"));
		$statusAllRoom   = $checkroom_count['status'];
		$stockLast 	     = $view_permintaan_kamar['jumlah_kamar_akhir'];
		$countAllStock   = ($stockLast + $qtyRoomRequest);
		// function update status room
		$updateRoomStat = "UPDATE kamar SET status_kamar='2' WHERE id_kategori_kamar='$caterooms' AND id_kamar='$array_room[$i]'";
		$savedSucces =mysqli_query($konek,$updateRoomStat);
		$i++;
	}//endforeach
	
	// function update stock
	$updateStocklist = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$countAllStock' WHERE id_kategori_kamar='$caterooms'";
	$sucessfulled_saved = mysqli_query($konek,$updateStocklist);
	if ($succes_update_status && $sucessfulled_saved && $savedSucces) {
			echo "<script>alert('checkout kamar berhasil dilakukan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}else{
			echo "<script>alert('checkout kamar gagal dilakukan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}
}

?>
