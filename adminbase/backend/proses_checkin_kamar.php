<?php include '../../config/koneksi.php';
date_default_timezone_set('Asia/jakarta');
$act = $_GET['act'];
//variable array string conversion
$array_nokamar 		  = $_POST['id_kamar'];
$array_room_category  = $_POST['cate_room'];
$cate_room = $_POST['cate_room'];
$date_now_checkin = date("Y-m-d H:i:s");
if ($act='choose_room') {

	$ceksudah_checkin = mysqli_query($konek,"SELECT * FROM booking WHERE status_userbook='CI' AND kd_booking='$_POST[kd_booking]'");
	$cek_rows_status = mysqli_num_rows($ceksudah_checkin);
	if ($cek_rows_status > 0) {
		echo "<script>alert('Maaf kamar sudah di acc kepada tamu dan tamu sudah melakukan checkin!!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}else{
		$update_status_room = "UPDATE booking SET status_userbook='CI' WHERE kd_booking='$_POST[kd_booking]'";
		$succes_update_status = mysqli_query($konek,$update_status_room);
		$i=0;
		foreach ($array_nokamar as $no_kamar) {
			//proses update checkin
			$update_noroom = "INSERT INTO detail_booking_kamar (kd_booking,
															    id_kategori_kamar,
															    id_kamar) 
												        VALUES ('$_POST[kd_booking]',
												        	    '$array_room_category[$i]',
												        	    '$no_kamar')";
			$succes_noroom = mysqli_query($konek,$update_noroom);
			$update_room_booked = "UPDATE kamar SET status_kamar='3' WHERE id_kamar='$no_kamar'";
			$succes_update_room_booked = mysqli_query($konek,$update_room_booked); 
		$i++;
		}
		if ($succes_update_status && $succes_noroom) {
			echo "<script>alert('Acc kamar berhasil dismpan !!')</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_listcheckin>";
		}else{
			echo "<script>alert('Acc kamar gagal dismpan !!')</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
		}
	}
}

?>