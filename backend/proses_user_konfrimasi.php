<?php include "../../config/koneksi.php";

$act = $_GET['act'];

if ($act=='konfrimasi_transaksi') {

	$update_konfrimasi = "UPDATE booking SET id_member     ='$_POST[id_member]', 
										 id_kategori_kamar ='$_POST[id_kategori_kamar]', 
					  					 id_paket          ='$_POST[id_paket]',
					  					 id_rental 		   ='$_POST[id_rental]', 
					  					 id_laundry 	   ='$_POST[id_laundry]', 
					  					 nama_perusahaan   ='$_POST[nama_perusahaan]',
					  					 atas_nama 		   ='$_POST[atas_nama]', 
					  					 email_atasnama    ='$_POST[email_atasnama]',
					  					 checkin 		   ='$_POST[checkin]',
					  					 checkout 		   ='$_POST[checkout]', 
					  					 qty_reserve	   ='$_POST[qty_reserve]',
					  					 extrabed		   ='$_POST[extrabed]',
					  					 status		   	   ='$_POST[status]',
					  					 id_kamar 		   ='$_POST[id_kamar]',
					  					 stat_reservation  ='$_POST[stat_reservation]'
 					  			   WHERE kd_booking        ='$_POST[kd_booking]'";
/* 	echo $update_konfrimasi;*/			  			  
$succesfull = mysqli_query($konek,$update_konfrimasi);

	if ($succesfull) {
		echo "<script>alert('konfirmasi berhasil transaksi sudah selesai !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
	}else{
		echo "<script>alert('konfirmasi berhasil transaksi sudah selesai !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
	}


}

?>