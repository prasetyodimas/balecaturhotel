<?php include "../../config/koneksi.php";

$act=$_GET['act'];

//booking personal
if ($act=='booking') {

	$acakangkahuruf 			= $_POST['kd_booking'];
	$id_member					= $_POST['id_member'];
	$id_kategori_kamar			= $_POST['id_kategori_kamar'];
	$id_paket    				= $_POST['id_paket'];
	$id_rental					= $_POST['id_rental'];
	$id_laundry  				= $_POST['id_laundry'];
	$nama_perusahaan 			= $_POST['nama_perusahaan'];
	$atas_nama 					= $_POST['atas_nama'];
	$email_atasnama     		= $_POST['email_atasnama'];
	$checkin     				= $_POST['checkin'];
	$checkout     				= $_POST['checkout'];
	$qty_reserve     			= $_POST['qty_reserve'];
	$extrabed     				= $_POST['extrabed'];
	$status 					= $_POST['status'];
	$id_kamar 					= $_POST['id_kamar'];
	$id_extrabed 				= $_POST['id_extrabed'];
	$status_reservation 		= $_POST['status_reservation'];
	$tgl_awal_sewa				= $_POST['tgl_awal_sewa'];
	$tgl_akhir_sewa				= $_POST['tgl_akhir_sewa'];
	$tgl_mulaisewa				= date("Y-m-d H:i:s");
	$biaya_sewa					= $_POST['biaya_sewa'];
	$biaya_perpanjangan	= $_POST['biaya_perpanjangan'];

	//menghitung biaya sewa kamar diihitung dari tanggal checkin s/d checkout
	$getharga_kamar = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$id_kategori_kamar'"));
	$priceroom = $getharga_kamar['tarif'];
	//definisikan hari nya 
	$total_seluruh_hari = 0;
	$hitung_jmlhari = round((strtotime($checkout)-strtotime($checkin))/86400)+1;

	$total_seluruh_hari +=($priceroom*$hitung_jmlhari);


	// validasi booking jika sudah pesan dan transaksi nya belum lunas tidak dapat melanjutkan transaksi lainya !!
	$cekbooking_person = mysqli_query($konek,"SELECT * FROM booking WHERE status='0' AND id_member='$id_member'");
	$cekbooking_rows   = mysqli_num_rows($cekbooking_person);

	if ($cekbooking_rows > 0) {

		echo "<script>alert('Maaf anda masih memiliki pemesanan yang belum dibayarakan !!')</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";

	}else{

	//kondisi normal booking + all transaksi
	$reserveperson ="INSERT INTO booking (kd_booking,
										  id_member,
										  nama_perusahaan,
										  atas_nama,
										  email_atasnama,
										  checkin,
										  checkout,
										  qty_reserve,
										  status,
										  stat_reservation,
										  tgl_mulaisewa,
										  biaya_sewa,
										  biaya_perpanjangan)
								VALUES ('$acakangkahuruf',
								    	'$id_member',
								    	'-',
								    	'-',
								    	'-',
						      			'$checkin',
						      			'$checkout',
						     			'$qty_reserve',
			 			      			'0',
							      		'person',
							      		'$tgl_mulaisewa',
							      		'$total_seluruh_hari',
							      		'$biaya_perpanjangan')";

	/*$sucessuflysaved =mysqli_query($konek,$reserveperson);
	$last_id =mysqli_insert_id($sucessuflysaved);*/

	$reserveperson_detail = "INSERT INTO detail_booking_kamar (id_detail_booking_kamar,
										 kd_booking,
										 id_kategori_kamar,
										 id_kamar)
								 VALUES ('$last_id',
								 	     '$acakangkahuruf',
								 	     '$id_kategori_kamar',
								 	     '$id_kamar')";

	$sucessuflysaved_detail =mysqli_query($konek,$reserveperson_detail);
	$last_id2 =mysqli_insert_id($sucessuflysaved_detail);

	$reserveperson_transaksi = "INSERT INTO transaksi_layanan (id_transaksi_layanan,
										  kd_booking,
										  id_rental,
										  id_paket,
										  id_extrabed,
										  id_laundry)
								  VALUES ('$last_id2',
								  		  '$acakangkahuruf',
								  		  '$id_rental',
								  		  '-',
								  		  '$id_extrabed',
								  		  '-')";

	$sucessuflysaved_transaksi =mysqli_query($konek,$reserveperson_transaksi);
	$last_id3 =mysqli_insert_id($sucessuflysaved_transaksi);

	$reserveperson_transaksi_rental = "INSERT INTO detail_booking_rental (id_detail_booking_rental,
																		kd_booking ,
																		id_rental ,
																		tgl_awal_sewa,
																		tgl_akhir_sewa)
																VALUES ('$last_id3',
																		'$acakangkahuruf',
																		'$id_rental',
																		'$tgl_awal_sewa',
																		'$tgl_akhir_sewa')";

	$sucessuflysaved_transaksi_rental = mysqli_query($konek,$reserveperson_transaksi_rental);

/*
	if($sucessuflysaved || $sucessuflysaved_detail || $sucessuflysaved_transaksi || $sucessuflysaved_transaksi_rental) {

        echo "<script>alert('Reservation Berhasil Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
    } else {
        echo "<script>alert('Reservation Gagal Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=reservation>";
    }*/

	}
}


// booking atas nama / rombongan normal kondisi tanpa pemesanan rental maupun extrabed

if ($act=='booking_instansi') {

	$acakangkahuruf 		= $_POST['kd_booking'];
	$id_member				= $_POST['id_member'];
	$id_kategori_kamar		= $_POST['id_kategori_kamar'];
	$id_paket    			= $_POST['id_paket'];
	$id_kamar    			= $_POST['id_kamar'];
	$id_rental				= $_POST['id_rental'];
	$id_laundry  			= $_POST['id_laundry'];
	$nama_perusahaan 		= $_POST['nama_perusahaan'];
	$atas_nama 				= $_POST['atas_nama'];
	$email_atasnama     	= $_POST['email_atasnama'];
	$checkin     			= $_POST['checkin'];
	$checkout     			= $_POST['checkout'];
	$qty_reserve     		= $_POST['qty_reserve'];
	$extrabed     			= $_POST['extrabed'];
	$status 				= $_POST['status'];
	$id_kamar 				= $_POST['id_kamar'];
	$status_reservation  	= $_POST['status_reservation'];
	$tgl_awal_sewa			= $_POST['tgl_awal_sewa'];
	$tgl_akhir_sewa			= $_POST['tgl_akhir_sewa'];

	// cek validasi booking jika booking nya blm lunas tidak bisa booking lagi
	$cekbooking_atasnama = mysqli_query($konek,"SELECT * FROM booking WHERE status='0' AND id_member='$id_member'");
	$cekbooking_rows=mysqli_num_rows($cekbooking_atasnama);

	if ($cekbooking_rows > 0) {

		echo "<script>alert('Maaf anda masih memiliki pemesanan yang belum dibayarakan !!')</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";

	}else{

//kondisi tidak pesan rental dan extrabed dan kondisi tidak memesan lebih dari satu tipe kamar (normal kondisi)

$jml = count($id_kamar);

for ($i=0; $i<=$jml; $i++) {
/*foreach ($id_kategori_kamar as $key => $value) {*/

		$reserve_instansibooking ="INSERT INTO booking
										(kd_booking,
										id_member,
										id_kategori_kamar,
										id_paket,
										id_rental,
										id_laundry,
										nama_perusahaan,
										atas_nama,
										email_atasnama,
							  			checkin,
							   			checkout,
										qty_reserve,
										extrabed,
							    		status,
							    		id_kamar,
							     		stat_reservation)
								VALUES ('$acakangkahuruf',
									    '$id_member',
									    '$array_idkategori[0]',
									    '-',
									    '-',
									    '-',
							   			'$nama_perusahaan',
							    		'$atas_nama',
							    		'$email_atasnama',
							      		'$checkin',
							      		'$checkout',
							     		'$qty_reserve',
							     		'-',
				 			      		'0',
				 			      		'$id_kamar[0]',
								      	'atasnama')";

			/*echo $reserve_instansibooking;*/
	/*	    print_r($id_kategori_kamar); print_r($array_idkamar);exit();*/

			$sucessuflyinstansi1   =mysqli_query($konek,$reserve_instansibooking);
			$last_id2 =mysqli_insert_id($sucessuflyinstansi1);

			$reserve_instansibookingkamar ="INSERT INTO detail_booking_kamar(id_detail_booking_kamar, kd_booking, id_kategori_kamar, id_kamar)
									 VALUES ('$last_id2','$code_book','{$id_kategori_kamar[$i]}','{$array_idkamar[$i]}')";
			$sucessuflyinstansi2 =mysqli_query($konek,$reserve_instansibookingkamar);


}// end foreach

	if($sucessuflyinstansi1) {
        echo "<script>alert('Booking Berhasil Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
    }else{
        echo "<script>alert('Booking Gagal Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=reservation>";
    }





/*
}*/

	/*$acakangkahuruf 		= $_POST['kd_booking'];
	$id_member				= $_POST['id_member'];
	$id_kategori_kamar		= $_POST['id_kategori_kamar'];
	$id_paket    			= $_POST['id_paket'];
	$id_rental				= $_POST['id_rental'];
	$id_laundry  			= $_POST['id_laundry'];
	$nama_perusahaan 		= $_POST['nama_perusahaan'];
	$atas_nama 				= $_POST['atas_nama'];
	$email_atasnama     	= $_POST['email_atasnama'];
	$checkin     			= $_POST['checkin'];
	$checkout     			= $_POST['checkout'];
	$qty_reserve     		= $_POST['qty_reserve'];
	$extrabed     			= $_POST['extrabed'];
	$status 				= $_POST['status'];
	$id_kamar 				= $_POST['id_kamar'];
	$status_reservation  	= $_POST['status_reservation'];
	$tgl_awal_sewa			= $_POST['tgl_awal_sewa'];
	$tgl_akhir_sewa			= $_POST['tgl_akhir_sewa'];
*/


//kondisi tanpa rental namun memesan lebih dari satu tipe kamar
/*}elseif ($_POST['id_rental'] =="") {*/


/*$a=0;
foreach ($id_kategori_kamar as $key => $value) {

	$code_book = $acakangkahuruf;

		$reserve_instansibooking ="INSERT INTO booking
										(kd_booking,
										id_member,
										id_kategori_kamar,
										id_paket,
										id_rental,
										id_laundry,
										nama_perusahaan,
										atas_nama,
										email_atasnama,
							  			checkin,
							   			checkout,
										qty_reserve,
										extrabed,
							    		status,
							    		id_kamar,
							     		stat_reservation)
								VALUES ('$acakangkahuruf',
									    '$id_member',
									    '$value',
									    '-',
									    '-',
									    '-',
							   			'$nama_perusahaan',
							    		'$atas_nama',
							    		'$email_atasnama',
							      		'$checkin',
							      		'$checkout',
							     		'$qty_reserve',
							     		'$extrabed',
				 			      		'0',
				 			      		'-',
								      	'atasnama')";

				print_r($id_kategori_kamar); exit();*/
				/*$sucessuflyinstansi1   =mysqli_query($konek,$reserve_instansibooking);*/

				/*$reserve_instansibookingkamar ="INSERT INTO detail_booking_kamar (id_detail_booking_kamar, kd_booking, id_kategori_kamar)
									 VALUES ('$last_id2','{$code_book}','$value')";

				$sucessuflyinstansi2 =mysqli_query($konek,$reserve_instansibookingkamar);
				$last_id2 =mysqli_insert_id($sucessuflyinstansi1);
*/

/*		if($sucessuflyinstansi1 && $sucessuflyinstansi2) {
	        echo "<script>alert('Booking Berhasil Di simpan!');</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";
	    } else {
	        echo "<script>alert('Booking Gagal Di simpan!');</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=reservation>";
	    }

$a++;

}
*/
/*}elseif ($_POST['extrabed'] =="") {


		$reserve_instansi ="INSERT INTO booking
										(kd_booking,
										id_member,
										id_kategori_kamar,
										id_paket,
										id_rental,
										id_laundry,
										nama_perusahaan,
										atas_nama,
										email_atasnama,
							  			checkin,
							   			checkout,
										qty_reserve,
										extrabed,
							    		status,
							    		id_kamar,
							     		stat_reservation)
								VALUES ('$acakangkahuruf',
									    '$id_member',
									    '$id_kategori_kamar',
									    '-',
									    '-',
									    '-',
							   			'$nama_perusahaan',
							    		'$atas_nama',
							    		'$email_atasnama',
							      		'$checkin',
							      		'$checkout',
							     		'$qty_reserve',
							     		'-',
				 			      		'0',
				 			      		'-',
								      	'atasnama')";*/
/*
				echo $reserve_instansi;
				$sucessuflyinstansi1 =mysqli_query($konek,$reserve_instansi);
				$last_id =mysqli_insert_id($sucessuflyinstansi1);


				$reserve_instansi2 = "INSERT INTO detail_booking_rental (id_detail_booking_rental, kd_booking, id_rental, tgl_awal_sewa, tgl_akhir_sewa,)
								      VALUES ('$last_id','$acakangkahuruf','$id_rental','$tgl_awal_sewa','$tgl_akhir_sewa')";

				echo $reserve_instansi2;
				$sucessuflyinstansi2 =mysqli_query($konek,$reserve_instansi2);*/
				/*$last_id2 =mysqli_insert_id($sucessuflyinstansi2);*/

/*
				$reserve_instansi3 ="INSERT INTO detail_booking_kamar (id_detail_booking_kamar, kd_booking, id_kategori_kamar)
									 VALUES ('$last_id2','$acakangkahuruf','$id_kategori_kamar')";

				echo $reserve_instansi3;
				$sucessuflyinstansi3 =mysqli_query($konek,$reserve_instansi3);*/

		/*if($sucessuflyinstansi1 && $sucessuflyinstansi2) {

	        echo "<script>alert('Booking Berhasil Di simpan!');</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=myorder>";

	    }else{

	        echo "<script>alert('Booking Gagal Di simpan!');</script>";
	        echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=reservation>";
	    }


		}*/

	}

}

?>
