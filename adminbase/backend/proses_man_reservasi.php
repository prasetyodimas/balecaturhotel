<?php session_start();error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include '../../config/koneksi.php';
include '../../fungsi/function_transaksi.php';
$userid = $_SESSION['session_user'];
$act = $_GET['act'];
//get var act form method post
$rental   	= $_POST['id_rental'];
$extrabed 	= $_POST['id_extrabed'];
$laundry    = $_POST['id_laundry'];
if(isset($rental) || isset($extrabed)){

//deklarasi variable action member 
$act_member = $_POST['jenis_member'];
if ($_GET['act']=='bookingnow') {
	// validasi booking jika sudah pesan dan transaksi nya belum lunas tidak dapat melanjutkan transaksi lainya !!
	$cekbooking_person = mysqli_query($konek,"SELECT status_userbook, id_member FROM booking WHERE id_member='$userid' AND status_userbook!='CO'");
	$cekbooking_rows   = mysqli_num_rows($cekbooking_person);
	if ($cekbooking_rows > 0) {
		echo "<script>alert('Maaf anda masih memiliki pemesanan yang belum dibayarakan !!')</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
	}else{
		//cek jenis transaksi member
		switch ($act_member) {		
		//MEMBER PERSONAL 
		case 'person':
				//VARIABLE ARRAY KAMAR
				$array_kategori_kamar=$_POST['kategori_kamar'];
				//var logic transaction process jika tidak memesan layanan tambahan
				if($extrabed=="" && $rental=="") {
					$var_transaction = 'Tidak';
					//default transaksi personal tidak memesan layanan rental
					if($extrabed=="" && $rental=="") {
						echo "transaksi personal tidak memesan layanan rental & extrabed";
						//definisi tanggal booking
						$tgl_booking_skrng = date("Y-m-d H:i:s");
						$reserve = "INSERT INTO booking (kd_booking,
													id_member,
													checkin,
													checkout,
													tgl_booking,
													layanan_extra,
													status_userbook,
													company_or_other,
													nama_atasnama,
													berapa_orang,
													total_biayasewa,
													biaya_perpanjangan) 
											VALUES ('$_POST[kd_booking]',
													'$userid',
													'$_POST[checkin_user]',
													'$_POST[checkout_user]',
													'$tgl_booking_skrng',
													'$var_transaction',
													'BK',
													'-',
													'-',
													'$_POST[jumlah_orang]',
													'$_POST[total_transaksi_nonconvert]',
													'')";

						$success_saved = mysqli_query($konek,$reserve);
						$last_id 	   = mysqli_insert_id($success_saved);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_book = mysqli_query($konek,$reserve_detail_book);
							//hitung tamu memesan berapa tipe perkamarnya
							$reserve_koutaroom = "SELECT COUNT(dbk.id_kategori_kamar) AS order_kamar FROM detail_booking_kamar dbk JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE dbk.id_kategori_kamar='$kategori_kamar'";
							$saved_countroom = mysqli_query($konek,$reserve_koutaroom);
							$show_count_allroom = mysqli_fetch_array($saved_countroom);
							//tampilkan stock awal perkamar yang diminta
							$stock_awalroom = mysqli_fetch_array(mysqli_query($konek,"SELECT jumlah_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
							//variable stock awal - permintaan
							$number_room = $stock_awalroom['jumlah_kamar'];
							$room_type = $show_count_allroom['order_kamar']; 
							//proses perhitungan kamar
							$count_type_all_room = ($number_room-$room_type);
							//update stock kamar (logic stock awal - permintaan = stock akhir)
							$update_stock_akhir = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$count_type_all_room' WHERE id_kategori_kamar='$kategori_kamar'";
							$list_update_stock = mysqli_query($konek,$update_stock_akhir);
						}//endforeach
						if ($success_saved && $success_saved_book) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}	
					}	
					
				}elseif($rental!='' && $rental!='') {
					$var_transaction = 'Ya';
					// jika transaksi personal memesan layanan rental & extrabed 
					if($extrabed!='' && $rental!=''){
						echo "transaksi person memesan extrabed dan rental";
						//validasi
						$tgl_awal_sewa_rent  = $_POST['dari_tgl'];
						$tgl_akhir_sewa_rent = $_POST['sampai_tgl'];
						if ($tgl_awal_sewa_rent=='' || $tgl_akhir_sewa_rent=='') {
							echo "<script>alert('Maaf tanggal sewa rental belum dipilih !!');</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."homeadmin.php?modul=man_reserveonline>";
						}else{

						//definisi tanggal booking
						$tgl_booking_skrng = date("Y-m-d H:i:s");
						$reserve = "INSERT INTO booking (kd_booking,
													id_member,
													checkin,
													checkout,
													tgl_booking,
													layanan_extra,
													status_userbook,
													company_or_other,
													nama_atasnama,
													berapa_orang,
													total_biayasewa,
													biaya_perpanjangan) 
											VALUES ('$_POST[kd_booking]',
													'$userid',
													'$_POST[checkin_user]',
													'$_POST[checkout_user]',
													'$tgl_booking_skrng',
													'$var_transaction',
													'BK',
													'-',
													'-',
													'$_POST[jumlah_orang]',
													'$_POST[total_transaksi_nonconvert]',
													'')";
						$success_saved = mysqli_query($konek,$reserve);
						$last_id 	   = mysqli_insert_id($success_saved);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_book = mysqli_query($konek,$reserve_detail_book);
							$last_id_detail_room = mysqli_insert_id($success_saved_book);

						//transaksi rental
						$reserve_rent = "INSERT INTO detail_booking_rental (id_detail_booking_rental, kd_booking, id_rental, tgl_awal_sewa, tgl_akhir_sewa) 
								     VALUES('$last_id_detail_room','$_POST[kd_booking]','$_POST[id_rental]','$_POST[dari_tgl]','$_POST[sampai_tgl]')";
						$success_saved_rent = mysqli_query($konek,$reserve_rent);
						$last_id_detail_rent = mysqli_insert_id($success_saved_rent);
						
						$tgl_transaksi_now = date('Y-m-d');
						$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																					 kd_booking, 
																					 id_rental, 
																					 id_laundry, 
																					 id_extrabed, 
																					 id_paket, 
																					 tgl_transaksi) 
																			 VALUES ('$last_id_detail_rent',
																			 		 '$_POST[kd_booking]',
																			 		 '$_POST[id_rental]',
																			 		 '-',
																			 		 '$_POST[id_extrabed]',
																			 		 '-',
																			 		 '$tgl_transaksi_now')";
						$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

						if ($success_saved && $success_saved_book && $success_saved_rent && $success_saved_transac_layanan) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}
						
						}
					}
				
				//jika transaksi personal memesan layanan rental
				}elseif($rental!=""){
					$var_transaction = 'Ya';
					echo "transaksi person memesan rental"; 
					//definisi tanggal booking
					$tgl_booking_skrng = date("Y-m-d H:i:s");
					$reserve = "INSERT INTO booking (kd_booking,
												id_member,
												checkin,
												checkout,
												tgl_booking,
												layanan_extra,
												status_userbook,
												company_or_other,
												nama_atasnama,
												berapa_orang,
												total_biayasewa,
												biaya_perpanjangan) 
										VALUES ('$_POST[kd_booking]',
												'$userid',
												'$_POST[checkin_user]',
												'$_POST[checkout_user]',
												'$tgl_booking_skrng',
												'$var_transaction',
												'BK',
												'-',
												'-',
												'$_POST[jumlah_orang]',
												'$_POST[total_transaksi_nonconvert]',
												'')";
					$success_saved = mysqli_query($konek,$reserve);
					$last_id 	   = mysqli_insert_id($success_saved);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_book = mysqli_query($konek,$reserve_detail_book);
							$last_id_detail_room = mysqli_insert_id($success_saved_book);
							//hitung tamu memesan berapa tipe perkamarnya
							$reserve_koutaroom = "SELECT COUNT(dbk.id_kategori_kamar) AS order_kamar FROM detail_booking_kamar dbk JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE dbk.id_kategori_kamar='$kategori_kamar'";
							$saved_countroom = mysqli_query($konek,$reserve_koutaroom);
							$show_count_allroom = mysqli_fetch_array($saved_countroom);
							//tampilkan stock awal perkamar yang diminta
							$stock_awalroom = mysqli_fetch_array(mysqli_query($konek,"SELECT jumlah_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
							//variable stock awal - permintaan
							$number_room = $stock_awalroom['jumlah_kamar'];
							$room_type = $show_count_allroom['order_kamar']; 
							//proses perhitungan kamar
							$count_type_all_room = ($number_room-$room_type);
							//update stock kamar (logic stock awal - permintaan = stock akhir)
							$update_stock_akhir = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$count_type_all_room' WHERE id_kategori_kamar='$kategori_kamar'";
							$list_update_stock = mysqli_query($konek,$update_stock_akhir);
						}///endforeach
						//transaksi rental
						$reserve_rent = "INSERT INTO detail_booking_rental (id_detail_booking_rental, kd_booking, id_rental, tgl_awal_sewa, tgl_akhir_sewa) 
								     VALUES('$last_id_detail_room','$_POST[kd_booking]','$_POST[id_rental]','$_POST[dari_tgl]','$_POST[sampai_tgl]')";
						$success_saved_rent = mysqli_query($konek,$reserve_rent);
						$last_id_detail_rent = mysqli_insert_id($success_saved_rent);
						
						$tgl_transaksi_now = date('Y-m-d');
						$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																					 kd_booking, 
																					 id_rental, 
																					 id_laundry, 
																					 id_extrabed, 
																					 id_paket, 
																					 tgl_transaksi) 
																			 VALUES ('$last_id_detail_rent',
																			 		 '$_POST[kd_booking]',
																			 		 '$_POST[id_rental]',
																			 		 '-',
																			 		 '-',
																			 		 '-',
																			 		 '$tgl_transaksi_now')";
						$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

						if ($success_saved && $success_saved_book && $success_saved_rent && $success_saved_transac_layanan) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}
					}
					//jika transaksi personal memesan layanan extrabed
				}elseif($extrabed!=''){
					$var_transaction = 'Ya';
					//echo "transaksi person memesan extrabed";
					//definisi tanggal booking
					$tgl_booking_skrng = date("Y-m-d H:i:s");
					$reserve = "INSERT INTO booking (kd_booking,
												id_member,
												checkin,
												checkout,
												tgl_booking,
												layanan_extra,
												status_userbook,
												company_or_other,
												nama_atasnama,
												berapa_orang,
												total_biayasewa,
												biaya_perpanjangan) 
										VALUES ('$_POST[kd_booking]',
												'$userid',
												'$_POST[checkin_user]',
												'$_POST[checkout_user]',
												'$tgl_booking_skrng',
												'$var_transaction',
												'BK',
												'-',
												'-',
												'$_POST[jumlah_orang]',
												'$_POST[total_transaksi_nonconvert]',
												'')";
					$success_saved = mysqli_query($konek,$reserve);
					$last_id 	   = mysqli_insert_id($success_saved);

					foreach ($array_kategori_kamar as $key => $kategori_kamar) {
						$reserve_detail_book = "INSERT INTO detail_booking_kamar
													(id_detail_booking_kamar,
												    kd_booking,
												    id_kategori_kamar, 
												    id_kamar) 
											VALUES ('$last_id',
													'$_POST[kd_booking]',
													'$kategori_kamar',
													'')";
						$success_saved_book = mysqli_query($konek,$reserve_detail_book);
						$last_id_detail_room = mysqli_insert_id($success_saved_book);
						//hitung tamu memesan berapa tipe perkamarnya
						$reserve_koutaroom = "SELECT COUNT(dbk.id_kategori_kamar) AS order_kamar FROM detail_booking_kamar dbk JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE dbk.id_kategori_kamar='$kategori_kamar'";
						$saved_countroom = mysqli_query($konek,$reserve_koutaroom);
						$show_count_allroom = mysqli_fetch_array($saved_countroom);
						//tampilkan stock awal perkamar yang diminta
						$stock_awalroom = mysqli_fetch_array(mysqli_query($konek,"SELECT jumlah_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
						//variable stock awal - permintaan
						$number_room = $stock_awalroom['jumlah_kamar'];
						$room_type = $show_count_allroom['order_kamar']; 
						//proses perhitungan kamar
						$count_type_all_room = ($number_room-$room_type);
						//update stock kamar (logic stock awal - permintaan = stock akhir)
						$update_stock_akhir = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$count_type_all_room' WHERE id_kategori_kamar='$kategori_kamar'";
						$list_update_stock = mysqli_query($konek,$update_stock_akhir);
					}///endforeach
					//transaksi extrabed
					$tgl_transaksi_now = date('Y-m-d');
					$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																				 kd_booking, 
																				 id_rental, 
																				 id_laundry, 
																				 id_extrabed, 
																				 id_paket, 
																				 tgl_transaksi) 
																		 VALUES ('$last_id_detail_rent',
																		 		 '$_POST[kd_booking]',
																		 		 '-',
																		 		 '-',
																		 		 '$_POST[id_extrabed]',
																		 		 '-',
																		 		 '$tgl_transaksi_now')";
					$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

					if ($success_saved && $success_saved_book && $success_saved_transac_layanan) {
						echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
						echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
					}else{
						echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
						echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
					}
				}

			break;
		// TRANSACTION ATASNAMA
		case 'atasnama':
				$array_kategori_kamar=$_POST['kategori_kamar'];
				// TRANSAKSI MEMBER ATASNAMA
				//echo "transaksi atasnama tidak memesan layanan rental"; 
				//var logic transaction process jika tidak memesan layanan tambahan
				if($_POST['id_extrabed']=='' && $_POST['id_rental']=='') {
					$var_transaction = 'Tidak';
					//default transaksi personal tidak memesan layanan rental
					if($_POST['id_rental']=='' && $_POST['id_extrabed']=='') {
						echo "transaksi personal tidak memesan layanan rental & extrabed";
						//definisi tanggal booking
						$tgl_booking_skrng = date("Y-m-d H:i:s");
						$reserve_atasnama = "INSERT INTO booking (kd_booking,
													id_member,
													checkin,
													checkout,
													tgl_booking,
													layanan_extra,
													status_userbook,
													company_or_other,
													nama_atasnama,
													berapa_orang,
													total_biayasewa,
													biaya_perpanjangan) 
											VALUES ('$_POST[kd_booking]',
													'$userid',
													'$_POST[checkin_user]',
													'$_POST[checkout_user]',
													'$tgl_booking_skrng',
													'$var_transaction',
													'BK',
													'$_POST[other_name]',
													'$_POST[nama_penghuni]',
													'$_POST[berapa_orang]',
													'$_POST[total_transaksi_nonconvert]',
													'')";
						$success_saved_atasnama = mysqli_query($konek,$reserve_atasnama);
						$last_id 	   = mysqli_insert_id($success_saved_atasnama);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book_room = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_detail_book = mysqli_query($konek,$reserve_detail_book_room);
							
						}//endforeach
						if ($success_saved_atasnama && $success_saved_detail_book) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}		
					}//end of default transaksi personal tidak memesan layanan rental
				//var logic memesan layanan tambahan
				}elseif($_POST['id_extrabed']!='' && $_POST['id_rental']!='') {
					$var_transaction = 'Ya';
					// jika transaksi atasnama memesan layanan rental & extrabed 
					if($_POST['id_extrabed']!='' && $_POST['id_rental']!=''){
						//echo "transaksi atasnama memesan extrabed dan rental"; 
						//definisi tanggal booking
						$tgl_booking_skrng = date("Y-m-d H:i:s");
						$reserve_atasnama = "INSERT INTO booking (kd_booking,
													id_member,
													checkin,
													checkout,
													tgl_booking,
													layanan_extra,
													status_userbook,
													company_or_other,
													nama_atasnama,
													berapa_orang,
													total_biayasewa,
													biaya_perpanjangan) 
											VALUES ('$_POST[kd_booking]',
													'$userid',
													'$_POST[checkin_user]',
													'$_POST[checkout_user]',
													'$tgl_booking_skrng',
													'$var_transaction',
													'BK',
													'$_POST[other_name]',
													'$_POST[nama_penghuni]',
													'$_POST[berapa_orang]',
													'$_POST[total_transaksi_nonconvert]',
													'')";
						$success_saved_atasnama = mysqli_query($konek,$reserve_atasnama);
						$last_id 	   = mysqli_insert_id($success_saved_atasnama);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_book = mysqli_query($konek,$reserve_detail_book);
							$last_id_detail_room = mysqli_insert_id($success_saved_book);

						//transaksi rental
						$reserve_rent = "INSERT INTO detail_booking_rental (id_detail_booking_rental, kd_booking, id_rental, tgl_awal_sewa, tgl_akhir_sewa) 
								     VALUES('$last_id_detail_room','$_POST[kd_booking]','$_POST[id_rental]','$_POST[dari_tgl]','$_POST[sampai_tgl]')";
						$success_saved_rent = mysqli_query($konek,$reserve_rent);
						$last_id_detail_rent = mysqli_insert_id($success_saved_rent);
						
						$tgl_transaksi_now = date('Y-m-d');
						$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																					 kd_booking, 
																					 id_rental, 
																					 id_laundry, 
																					 id_extrabed, 
																					 id_paket, 
																					 tgl_transaksi) 
																			 VALUES ('$last_id_detail_rent',
																			 		 '$_POST[kd_booking]',
																			 		 '$_POST[id_rental]',
																			 		 '-',
																			 		 '$_POST[id_extrabed]',
																			 		 '-',
																			 		 '$tgl_transaksi_now')";
						$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

						if ($success_saved_atasnama && $success_saved_book && $success_saved_rent && $success_saved_transac_layanan) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}
					}
				//jika transaksi atasnama memesan layanan rental
				}elseif($_POST['id_rental']!=''){
					$var_transaction = 'Ya';
					//echo "transaksi atasnama memesan rental";
					//definisi tanggal booking
					$tgl_booking_skrng = date("Y-m-d H:i:s");
					$reserve_atasnama = "INSERT INTO booking (kd_booking,
												id_member,
												checkin,
												checkout,
												tgl_booking,
												layanan_extra,
												status_userbook,
												company_or_other,
												nama_atasnama,
												berapa_orang,
												total_biayasewa,
												biaya_perpanjangan) 
										VALUES ('$_POST[kd_booking]',
												'$userid',
												'$_POST[checkin_user]',
												'$_POST[checkout_user]',
												'$tgl_booking_skrng',
												'$var_transaction',
												'BK',
												'$_POST[other_name]',
												'$_POST[nama_penghuni]',
												'$_POST[berapa_orang]',
												'$_POST[total_transaksi_nonconvert]',
												'')";
					$success_saved_atasnama = mysqli_query($konek,$reserve_atasnama);
					$last_id 	   = mysqli_insert_id($success_saved_atasnama);

						foreach ($array_kategori_kamar as $key => $kategori_kamar) {
							$reserve_detail_book = "INSERT INTO detail_booking_kamar
														(id_detail_booking_kamar,
													    kd_booking,
													    id_kategori_kamar, 
													    id_kamar) 
												VALUES ('$last_id',
														'$_POST[kd_booking]',
														'$kategori_kamar',
														'')";
							$success_saved_book = mysqli_query($konek,$reserve_detail_book);
							$last_id_detail_room = mysqli_insert_id($success_saved_book);
							// ============= PERHITUNGAN PERMINTAAN KAMAR YANG DIMINTA =================
							//hitung tamu memesan berapa tipe perkamarnya
							$reserve_koutaroom = "SELECT COUNT(dbk.id_kategori_kamar) AS order_kamar FROM detail_booking_kamar dbk JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE dbk.id_kategori_kamar='$kategori_kamar'";
							$saved_countroom = mysqli_query($konek,$reserve_koutaroom);
							$show_count_allroom = mysqli_fetch_array($saved_countroom);
							//tampilkan stock awal perkamar yang diminta
							$stock_awalroom = mysqli_fetch_array(mysqli_query($konek,"SELECT jumlah_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
							//variable stock awal - permintaan
							$number_room = $stock_awalroom['jumlah_kamar'];
							$room_type = $show_count_allroom['order_kamar']; 
							//proses perhitungan kamar
							$count_type_all_room = ($number_room-$room_type);
							//update stock kamar (logic stock awal - permintaan = stock akhir)
							$update_stock_akhir = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$count_type_all_room' WHERE id_kategori_kamar='$kategori_kamar'";
							$list_update_stock = mysqli_query($konek,$update_stock_akhir);

						}///endforeach
						//transaksi rental
						$reserve_rent = "INSERT INTO detail_booking_rental (id_detail_booking_rental, kd_booking, id_rental, tgl_awal_sewa, tgl_akhir_sewa) 
								     VALUES('$last_id_detail_room','$_POST[kd_booking]','$_POST[id_rental]','$_POST[dari_tgl]','$_POST[sampai_tgl]')";
						$success_saved_rent = mysqli_query($konek,$reserve_rent);
						$last_id_detail_rent = mysqli_insert_id($success_saved_rent);
						
						$tgl_transaksi_now = date('Y-m-d');
						$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																					 kd_booking, 
																					 id_rental, 
																					 id_laundry, 
																					 id_extrabed, 
																					 id_paket, 
																					 tgl_transaksi) 
																			 VALUES ('$last_id_detail_rent',
																			 		 '$_POST[kd_booking]',
																			 		 '$_POST[id_rental]',
																			 		 '-',
																			 		 '-',
																			 		 '-',
																			 		 '$tgl_transaksi_now')";
						$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

						if ($success_saved_atasnama && $success_saved_book && $success_saved_rent && $success_saved_transac_layanan) {
							echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}else{
							echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
							echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
						}
					}	
				//jika transaksi atasnama memesan layanan extrabed
				}elseif($_POST['id_extrabed']!=''){
					//echo "transaksi atasnama memesan extrabed";
					//definisi tanggal booking
					$tgl_booking_skrng = date("Y-m-d H:i:s");
					$reserve_atasnama = "INSERT INTO booking (kd_booking,
												id_member,
												checkin,
												checkout,
												tgl_booking,
												layanan_extra,
												status_userbook,
												company_or_other,
												nama_atasnama,
												berapa_orang,
												total_biayasewa,
												biaya_perpanjangan) 
										VALUES ('$_POST[kd_booking]',
												'$userid',
												'$_POST[checkin_user]',
												'$_POST[checkout_user]',
												'$tgl_booking_skrng',
												'$var_transaction',
												'BK',
												'$_POST[other_name]',
												'$_POST[nama_penghuni]',
												'$_POST[berapa_orang]',
												'$_POST[total_transaksi_nonconvert]',
												'')";
					$success_saved_atasnama = mysqli_query($konek,$reserve_atasnama);
					$last_id 	   = mysqli_insert_id($success_saved_atasnama);

					foreach ($array_kategori_kamar as $key => $kategori_kamar) {
						$reserve_detail_book = "INSERT INTO detail_booking_kamar
													(id_detail_booking_kamar,
												    kd_booking,
												    id_kategori_kamar, 
												    id_kamar) 
											VALUES ('$last_id',
													'$_POST[kd_booking]',
													'$kategori_kamar',
													'')";
						$success_saved_book = mysqli_query($konek,$reserve_detail_book);
						$last_id_detail_room = mysqli_insert_id($success_saved_book);
						//hitung tamu memesan berapa tipe perkamarnya
						$reserve_koutaroom = "SELECT COUNT(dbk.id_kategori_kamar) AS order_kamar FROM detail_booking_kamar dbk JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE dbk.id_kategori_kamar='$kategori_kamar'";
						$saved_countroom = mysqli_query($konek,$reserve_koutaroom);
						$show_count_allroom = mysqli_fetch_array($saved_countroom);
						//tampilkan stock awal perkamar yang diminta
						$stock_awalroom = mysqli_fetch_array(mysqli_query($konek,"SELECT jumlah_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
						//variable stock awal - permintaan
						$number_room = $stock_awalroom['jumlah_kamar'];
						$room_type = $show_count_allroom['order_kamar']; 
						//proses perhitungan kamar
						$count_type_all_room = ($number_room-$room_type);
						//update stock kamar (logic stock awal - permintaan = stock akhir)
						$update_stock_akhir = "UPDATE kategori_kamar SET jumlah_kamar_akhir='$count_type_all_room' WHERE id_kategori_kamar='$kategori_kamar'";
						$list_update_stock = mysqli_query($konek,$update_stock_akhir);
					}///endforeach
					//transaksi extrabed
					$tgl_transaksi_now = date('Y-m-d');
					$reserve_transaksi_layanan = "INSERT INTO transaksi_layanan (id_transaksi_layanan, 
																				 kd_booking, 
																				 id_rental, 
																				 id_laundry, 
																				 id_extrabed, 
																				 id_paket, 
																				 tgl_transaksi) 
																		 VALUES ('$last_id_detail_rent',
																		 		 '$_POST[kd_booking]',
																		 		 '-',
																		 		 '-',
																		 		 '$_POST[id_extrabed]',
																		 		 '-',
																		 		 '$tgl_transaksi_now')";
					$success_saved_transac_layanan = mysqli_query($konek,$reserve_transaksi_layanan);

					if ($success_saved_atasnama && $success_saved_book && $success_saved_transac_layanan) {
						echo "<script>alert('Booking telah berhasil disimpan !!')</script>";
						echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
					}else{
						echo "<script>alert('Maaf booking gagal disimpan !!')</script>";
						echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=man_reserveonline>";
					}	
				}	
			break;

		}//end switch case
	}//end of logic validation booking procces
}//end of GET ACT booking
}//end of isset
?>