<?php 
$act = $_GET['act'];
	if ($act=='find_booked') {
		$x= mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking b JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking
				WHERE b.kd_booking='$_POST[kd_booking]'"));
	}else{
		echo "<script>alert('Maaf data yang anda cari tidak ditemukan !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=>";
	}

?>