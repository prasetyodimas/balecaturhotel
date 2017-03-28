<?php include "../config/koneksi.php";

$act = $_GET['act'];

if ($act=='addtesti') {
	
	$keterangan_testi = mysqli_real_escape_string($konek, $_POST['keterangan_testi']);
	$tgltesti = date('Y-m-d');

	$testiadd = "INSERT INTO testimonial (id_member, keterangan_testi, tgl_testi, blokir_testi) 
				 VALUES ('$_POST[id_member]','$keterangan_testi' ,'$tgltesti','N')";
	$sucessed = mysqli_query($konek,$testiadd);

	if ($sucessed) {
		echo "<script>alert('testimoni berhasil disimpan !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=testimonial>";

		echo "";
	}else{
		echo "<script>alert('testimoni gagal disimpan !!');</script>";
		echo "<script>history.go(-1);</script>";
	}

}

?>