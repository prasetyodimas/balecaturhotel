<?php include '../../config/koneksi.php';
date_default_timezone_set('Asia/jakarta');
$act = $_GET['act'];
if ($act='checkout_room') {
	//variable array tipe kamar
	$array_room 		 = $_POST['no_room_category'];
	//change booking status CO ( checkout status )
	$update_status_room = "UPDATE booking SET status_userbook='CO' WHERE kd_booking='$_POST[kd_booking]'";
	$succes_update_status = mysqli_query($konek,$update_status_room);
	foreach ($array_room as $no_kamar) {
	$view_permintaan_kamar = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking b 
																      JOIN detail_booking_kamar dbk
																	  ON b.kd_booking=dbk.kd_booking
																      JOIN kategori_kamar km 
																      ON dbk.id_kategori_kamar=km.id_kategori_kamar
																	  WHERE b.kd_booking='$_POST[kd_booking]'"));
		$jumlah_kamar_diminta = $view_permintaan_kamar['berapa_kamar'];
		//$jumlah_kamar_akhir   = $view_permintaan_kamar['jumlah_kamar_akhir'];
		//$counting_stock =$jumlah_kamar_akhir+$jumlah_kamar_diminta;

		//update stock kamar (logic stock awal - permintaan = stock akhir)
		$update_status_room = "UPDATE kamar k 
		                       JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar 
		                       SET k.status_kamar='0',km.jumlah_kamar_akhir= jumlah_kamar_akhir + '$jumlah_kamar_diminta'
							   WHERE k.id_kamar='$no_kamar'";

							  //echo $counting_stock;
		//echo $update_status_room; die(); 
		$sucess_update_stats = mysqli_query($konek,$update_status_room);
	}//endforeach
	if ($succes_update_status && $sucess_update_stats) {
		echo "<script>alert('checkout kamar berhasil dilakukan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}else{
		echo "<script>alert('checkout kamar gagal dilakukan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}
}

?>