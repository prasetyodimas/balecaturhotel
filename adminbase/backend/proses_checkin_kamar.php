<?php include '../../config/koneksi.php'; error_reporting(0);
$act  									= $_GET['act'];
$date_now_checkin			  = date("Y-m-d H:i:s");
$convert_array_noroom   = $_POST['id_kamar'];
$convert_array_category = $_POST['id_kategori_kamar'];
// print_r($convert_array_noroom);
// echo count($convert_array_category);
// exit();
if ($act='choose_room') {
	 	$ceksudah_checkin = mysqli_query($konek,"SELECT * FROM booking WHERE status_userbook='CI' AND kd_booking='$_POST[kd_booking]'");
		$cek_rows_status = mysqli_num_rows($ceksudah_checkin);
	/*if ($cek_rows_status > 0) {
		echo "<script>alert('Maaf kamar sudah di acc kepada tamu dan tamu sudah melakukan checkin!!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}else{*/
		/*$update_status_room = "UPDATE booking SET status_userbook='CI' WHERE kd_booking='$_POST[kd_booking]'";
		$succes_update_status = mysqli_query($konek,$update_status_room);*/
		$no = 1;
		foreach ($convert_array_noroom as $key => $value) {
		// for($i=0;$i<count($convert_array_noroom);$i++){
      $update_noroom = "INSERT INTO detail_booking_kamar (kd_booking, id_kategori_kamar, id_kamar)
										    VALUES  ('$_POST[kd_booking]',
										        	   '$_POST[id_kategori_kamar]',
										        	   '$value')";
			$insert_array_room = mysqli_query($konek,$update_noroom);
			/*$update_room_booked = "UPDATE kamar SET status_kamar='3' WHERE id_kamar='$array_nokamar[$i]'";
			$succes_update_room_booked = mysqli_query($konek,$update_room_booked); */
			$no++;
		}
		if ($insert_array_room) {
			echo "<script>alert('Acc kamar berhasil dismpan !!')</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_listcheckin>";
		}else{
			echo "<script>alert('Acc kamar gagal dismpan !!')</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
		}
	/*}*/
}

?>
