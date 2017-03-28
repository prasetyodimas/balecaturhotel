<?php session_start();
include "../config/koneksi.php";
include "../fungsi/function_transaksi.php";
$act=$_GET['act'];
if ($act=='add_konfrimasi') {
	$validasi_cekpayment  = mysqli_query($konek,"SELECT * FROM knfrimasi_pmbyaran WHERE kd_booking='$_POST[kd_booking]'");
	$cek_now = mysqli_num_rows($validasi_cekpayment);
	if ($cek_now > 0 ) {
		echo "<script>alert('Maaf Anda sudah melakukan pembayaran, Tunggu konfrimasi dari kami terimakasih !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
	}else{
		// validasi pembayaran jatuh tempo
		$get_time_booking = "SELECT tgl_booking FROM booking WHERE kd_booking='$_POST[kd_booking]'";
		$saved_temp = mysqli_query($konek,$get_time_booking);
		$show_time = mysqli_fetch_array($saved_temp);
		//var tgl_pesan 
		$adding_days = str_replace('-', '/',$show_time['tgl_booking']);
		$tomorrow = date('Y-m-d',strtotime($adding_days . "+1 days"));
		$tomorrow.gettimer($show_time['tgl_booking']);
		//var tanggal sekarang 
		$date_now = date("Y-m-d H:i:s");
		if ($tomorrow.gettimer($show_time['tgl_booking']) < $date_now) {
			echo "<script>alert('Maaf anda terlambat melakukan pembayaran !! maximal pembayaran anda 1x 24 jam terhitung dari tangggal pesan')</script>";
			echo "<script>history.go(-2);</script>";
		}else{
			//upload foto script
			$lokasi_file    = $_FILES['bukti_pembayaran']['tmp_name'];
			$nama_file      = $_FILES['bukti_pembayaran']['name'];
			$acak           = rand(000000,999999);
			$nama_file_unik = $acak.$nama_file; 
			$vdir_upload    = "../uploads/bukti/";
			move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"],$vdir_upload . $nama_file_unik);

			$bayar_dp		    		= $_POST['bayar_dp'];
			$cut_character_dp  			= substr($bayar_dp, 3, 9);
			$replace_character_dp   	= str_replace(".","", $cut_character_dp);

			$bayar_lunas		  		= $_POST['bayar_lunas'];
			$cut_character_lunas   		= substr($bayar_lunas, 3, 9);
			$replace_character_lunas    = str_replace(".","", $cut_character_lunas);

			$jenis_pelunasan = $_POST['pelunasan'];
			$tgl_bayar		  = date('Y-m-d H:i:s');

			//jika pembayaran dp
		    if ($_POST['pelunasan']=="DP") {

		   		$knfrimasi_DP = "INSERT INTO knfrimasi_pmbyaran (id_knfrimasi_pmbyaran, kd_booking, id_member, cara_bayar, jenis_bank, jumlah_bayar, pelunasan, bukti_pembayaran, tgl_bayar) VALUES ('',
								  					  		   '$_POST[kd_booking]',
								  					  	       '$_POST[id_member]',
								  					  	       'Transfer',
								  					  	       '$_POST[jenis_bank]',
								  					  	       '$replace_character_dp',
								  					  	       '$_POST[pelunasan]',
								  					  	       '$nama_file_unik',
								  					  	       '$tgl_bayar')";
		  		$sucess= mysqli_query($konek,$knfrimasi_DP);
		  		//jika sudah bayar update status booking 
			  	$update_status_book = "UPDATE booking SET status_userbook='KF' WHERE kd_booking='$_POST[kd_booking]'";
			  	$succesfully = mysqli_query($konek,$update_status_book);

				if ($sucess && $succesfully) {
					 echo "<script>alert('konfrimasi anda berhasil, tunggu hingga konfrimasi selanjutnya dari kami terimakasih !!')</script>";
					 echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
				}else{
					 echo "<script>alert('konfrimasi gagal disimpan !! ')</script>";
					 echo "<script>history.go(-1);</script>";

				}

		    }elseif($_POST['pelunasan']=="Lunas"){
	   
			$knfrimasi_LUNAS = "INSERT INTO knfrimasi_pmbyaran (id_knfrimasi_pmbyaran, kd_booking, id_member, cara_bayar, jenis_bank, jumlah_bayar, pelunasan, bukti_pembayaran, tgl_bayar) VALUES ('',
								  					  		   '$_POST[kd_booking]',
								  					  	       '$_POST[id_member]',
								  					  	       'Transfer',
								  					  	       '$_POST[jenis_bank]',
								  					  	       '$replace_character_lunas',
								  					  	       '$_POST[pelunasan]',
								  					  	       '$nama_file_unik',
								  					  	       '$tgl_bayar')";
				$sucess= mysqli_query($konek,$knfrimasi_LUNAS);
				//jika sudah bayar update status booking 
			  	$update_status_book = "UPDATE booking SET status_userbook='KF' WHERE kd_booking='$_POST[kd_booking]'";
			  	$succesfully = mysqli_query($konek,$update_status_book);

				if ($sucess) {
					 echo "<script>alert('konfrimasi anda berhasil, tunggu hingga konfrimasi selanjutnya dari kami terimakasih !!')</script>";
					 echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
				}else{
					 echo "<script>alert('konfrimasi gagal disimpan !! ')</script>";
					 echo "<script>history.go(-1);</script>";

				}
			}
		}
   }
}
?>