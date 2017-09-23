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
		$i = 1;
		foreach ($convert_array_noroom as $key => $room_array) {
      $update_noroom = "INSERT INTO detail_booking_kamar (kd_booking, id_kategori_kamar, id_kamar)
										    VALUES  ('$_POST[kd_booking]',
										        	   '$_POST[id_kategori_kamar]',
										        	   '$room_array')";
			$insert_array_room = mysqli_query($konek,$update_noroom);

			//function change status room
			$update_room_booked = "UPDATE kamar SET status_kamar='3' WHERE id_kamar='$room_array'";
			$succes_update_room_booked = mysqli_query($konek,$update_room_booked);

			//function check status
			$checkroom_count = mysqli_fetch_array(mysqli_query($konek,"SELECT count(*) AS status FROM kamar WHERE status_kamar!='3' AND id_kategori_kamar='$_POST[id_kategori_kamar]'"));
			$stockLast = $checkroom_count['status'];

			//function update stock
			$update_stock_room = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$stockLast' WHERE id_kategori_kamar='$_POST[id_kategori_kamar]'";
			$updateStockAkhir  = mysqli_query($konek,$update_stock_room);

			//function update status booked
			$update_status_booked = "UPDATE booking SET status_userbook='CI' WHERE kd_booking='$_POST[kd_booking]'";
			$succes_update_status = mysqli_query($konek,$update_status_booked);
			$i++;
		}

		if ($insert_array_room && $succes_update_status) {
			// echo 1;
		}else{
			// echo 0;
		}
}

?>
