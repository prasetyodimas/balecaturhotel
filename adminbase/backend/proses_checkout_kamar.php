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
		//update stock kamar (logic stock awal - permintaan = stock akhir)
		$update_status_room = "UPDATE kamar SET status_kamar='0' WHERE id_kamar='$no_kamar'";
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