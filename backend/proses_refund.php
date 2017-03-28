<?php include '../config/koneksi.php';
$act = $_GET['act'];
// REFUND PROSES
if ($act=='refund') {
	$cekupdate_refund_order = mysqli_query($konek,"SELECT * FROM booking WHERE status_userbook='RF' OR status_userbook='CI'  AND kd_booking='$_POST[kd_booking]'");
	$cekrows_updaterefund = mysqli_num_rows($cekupdate_refund_order);
	if ($cekrows_updaterefund > 0) {
		echo "<script>alert('Maaf anda telah mengajukan proses refund !!')</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
	}else{
		$update_refund = "UPDATE booking SET status_userbook='$_POST[status]' WHERE kd_booking='$_POST[kd_booking]'";
		/*echo $update_refund; exit(); */
		$succes = mysqli_query($konek,$update_refund);
		if ($succes) {
			echo "<script>alert('Refund berhasil harap tunggu konfirmasi dari admin hotel terimakasiih !')</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
		}else{
			echo "<script>alert('Refund gagal!')</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
		}			
	}
}

?>