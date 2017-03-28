<?php include "fungsi/function_transaksi.php";
//get user
$user     = $_SESSION['id_member'];
$gettransaction_other = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE kd_booking='$_GET[id]'"));
$viewuser = mysqli_fetch_array(mysqli_query($konek,"SELECT id_member, 
														   nama_lengkap, 
														   email, 
														   alamat, 
														   no_telp, 
														   kebangsaan 
													FROM member WHERE id_member='$user'"));
$getorder = mysqli_query($konek,"SELECT b.kd_booking, 
										km.id_kategori_kamar, 
										km.type_kamar, 
										b.checkin, 
										b.checkout, 
										b.tgl_booking, 
										km.tarif, 
										b.total_biayasewa, 
										b.layanan_extra, 
										b.nama_atasnama, 
										b.company_or_other
								 FROM booking b JOIN temp_booking tb ON b.id_member=tb.id_member
								 JOIN kategori_kamar km ON tb.id_kategori_kamar=km.id_kategori_kamar
								 WHERE b.kd_booking='$_GET[id]'");
$data 	  = mysqli_fetch_array($getorder); 
//menghitung jumlah harinya dari checkin - checkout
$jumlah_hari = round((strtotime($data['checkout'])-strtotime($data['checkin']))/86400);
?>
<style type="text/css">
	.detailorder-kodepemesan{margin-left: 50px;}
	.detailorder-tglpesan{margin-left: 62px;}
	.detailorder-checkin{margin-left: 93px;}
	.detailorder-checkout{margin-left: 78px;}
	.detailorder-lamamenginap{margin-left: 46px;}
	.detailorder-namapemesan{margin-left: 35px;}
	.detailorder-email{margin-left: 102px;}
	.detailorder-notelp{margin-left: 92px;}
	.detailorder-alamat{margin-left: 93px;}
	.detailorder-kebangsaan{margin-left: 56px;}
	.detailorder-nama_atasnama{margin-left: 40px;}
	.detailorder-companyother{margin-left: 21px;}
	.jenis_kendaraan{margin-left: 50px;}
	.nama_kendaraan{margin-left: 45px;}
	.tanggal_sewa{margin-left: 68px;}
	.harga_kendaraan{margin-left: 80px;}
	.price-bed{margin-left: 93px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">ORDER DETAIL</h1>
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
          		<li class="active">My Order</li>
			</ol>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading"><strong><h6>DASHBOARD USER</h6></strong></div>
						<div class="left-sidebarorder">
							<ul class="list-unstyled">
								<?php 
									$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
									if($url == $site."index.php?modul=myorder") {
										$url_myorder = "active";
									}
								?>
								<li><a class="none-underline <?php echo $url_myorder; ?>" href="<?php echo "$site"."index.php?modul=myorder";?>"><i class="fa fa-shopping-basket fa-fw"></i> My order</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=manageakun";?>"><i class="fa fa-user fa-fw"></i> My profil</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=";?>"><i class="fa fa-search-plus fa-fw"></i> History pemesanan</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<!--====== ORDER DETAIL ====-->
					<div class="form-group">
						<h4 style="font-weight:bold;">ORDER INFORMATION</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<p>Kode Pemesan<span class="detailorder-kodepemesan">: <?php echo $_GET['id'];?> </span></p>
									<p>Tangal Pesan<span class="detailorder-tglpesan">: <?php echo tgl_indo($data['tgl_booking'])." <i class='fa fa-clock-o'></i> ".date("H:i:s");?></span></p>
									<p>Check In<span class="detailorder-checkin">: <?php echo tgl_indo($data['checkin']);?></span></p>
									<p>Check Out <span class="detailorder-checkout">: <?php echo tgl_indo($data['checkout']);?></span></p>
									<p>Lama Menginap<span class="detailorder-lamamenginap">: <?php echo $jumlah_hari;?></span> Hari</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<p>Nama Pemesan<span class="detailorder-namapemesan">: <?php echo $viewuser['nama_lengkap']; ?></span></p>
									<p>Email<span class="detailorder-email">: <?php echo $viewuser['email'];?></span></p>
									<p>No telp<span class="detailorder-notelp">: <?php echo $viewuser['no_telp'];?></span></p>
									<p>Alamat<span class="detailorder-alamat">: <?php echo $viewuser['alamat'];?></span></p>
									<p>Kebangsaan<span class="detailorder-kebangsaan">: <?php echo $viewuser['kebangsaan'];?></span></p>
								</div>
							</div>
							<div class="col-lg-12">
							<?php if($data['nama_atasnama']=='-' || $data['company_or_other']=='-'){ ?>
							<?php }else{ ?>
									<p>Nama Atasnama <span class="detailorder-nama_atasnama">: <?php echo $data['nama_atasnama'];?></span></p>
									<p>Perusahaan / Other <span class="detailorder-companyother">: <?php echo $data['company_or_other'];?></span></p>
							<?php }?>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">Detail Transaksi Kamar</div>
						<div class="table-responsive">
							<table class="table table-hover" style="font-size: 12px;">
								<thead>
									<tr>
										<th>Tipe kamar</th>
										<th>Berapa kamar</th>
										<th>Harga asli</th>
										<th>Pajak</th>
										<th>Diskon</th>
										<th>Total Harga <span style='font-size:10px;'>(pajak / jika ada diskon)</span></th>
										<th>Subtotal <span style='font-size:10px;'>Harga / kamar x hari</span></th>
									</tr>
								</thead>
								<?php 
									//view kode kamar, kategori kamar, harga kamar
									$view_room_detail = mysqli_query($konek,
										"SELECT b.kd_booking, 
												km.id_kategori_kamar, 
												km.type_kamar, 
												b.checkin, 
												b.checkout, 
												b.tgl_booking,
												b.berapa_kamar,
												km.tarif, 
												b.total_biayasewa
										 FROM booking b
										 JOIN temp_booking tb ON b.id_member=tb.id_member
										 JOIN kategori_kamar km ON tb.id_kategori_kamar=km.id_kategori_kamar 
										 WHERE b.kd_booking='$_GET[id]'");
									while ($res = mysqli_fetch_array($view_room_detail)) {
									//var price room
									$price_room = $res['tarif'];
									//cek kamar tersebut ada diskon atau tidak
									$get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$res[id_kategori_kamar]'"));
									//deklarasi variable tarif
									$tarifnya = $get_price['tarif'];
									$x 		  = $get_price['id_kategori_kamar'];
									//buat diskon
									$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$res[id_kategori_kamar]'"));
									//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
									$y  		    = $getdiskon['id_kategori_kamar'];
									$available_disc = $getdiskon['besar_diskon'];
									//variable percent 10%
									$percent = (($price_room*$res['berapa_kamar']*10)/100); 
									//variable discount
									$discount =(($price_room*$available_disc*$res['berapa_kamar'])/100);
								?>
								<tbody>
									<tr>
										<td><?php echo $res['type_kamar'];?></td>
										<td><?php echo "x ".$res['berapa_kamar'];?></td>
										<td>Rp.<?php echo formatuang($res['tarif']).' / malam';?></td>
										<td>10% / <?php echo formatuang($percent);?></td>
										<td><?php if ($x == $y) {echo $getdiskon['besar_diskon']."%";}elseif($y==''){echo "-";}?></td>
										<td>Rp.<?php echo formatuang($price_room+$percent-$discount).' / malam';?></td>
										<td>Rp.<?php echo formatuang(($price_room+$percent-$discount)*$jumlah_hari).' / malam';?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div><!-- TABLE RESPONSIVE -->
					</div><!-- panel heading-->
					<!-- OTHER TRANSACTION -->
					<div class="form-group">
						<?php if ($data['layanan_extra']=='Ya') { ?>
						<h4 style="font-weight:bold;margin-top:35px;">OTHER TRANSACTION INFORMATION</h4>
							<div class="panel panel-default">
								<div class="panel-heading">Layanan Tambahan</div>
								<div class="panel-body">
									<!-- cek transaksi -->
									<?php if ($gettransaction_other['id_rental']!='0') { ?>
									<!-- cek transaksi apa yang dipesan -->
									<?php $getdata_rents = mysqli_fetch_array(mysqli_query($konek,
														   "SELECT r.kate_kendaraan,
														    	   r.nama_kendaraan,
														    	   r.harga_kendaraan,
														    	   dbr.tgl_awal_sewa,
														    	   dbr.tgl_akhir_sewa
															FROM rental r 
															JOIN transaksi_layanan tl ON r.id_rental=tl.id_rental 
													  		JOIN detail_booking_rental dbr ON dbr.id_rental=r.id_rental 
													  		WHERE tl.kd_booking='$_GET[id]'")); ?> 
										<div class="form-group">
											<h4>Sewa Kendaraan</h4>
											<p>Jenis Kendaraan <span class="jenis_kendaraan">: <?php echo $getdata_rents['kate_kendaraan'];?></span></p>
											<p>Nama Kendaraan <span class="nama_kendaraan">: <?php echo $getdata_rents['nama_kendaraan'];?></span></p>
											<p>Tanggal Sewa <span class="tanggal_sewa">: <?php echo tgl_indo($getdata_rents['tgl_awal_sewa']).' S/d '.tgl_indo($getdata_rents['tgl_akhir_sewa']);?></span></p>
											<p>Harga Sewa <span class="harga_kendaraan">: Rp.<?php echo formatuang($getdata_rents['harga_kendaraan']);?></span></p>
										</div>
									<?php }else{ ?>
									<?php } ?>
									<!-- END TRANSACTION RENT -->
									<?php if ($gettransaction_other['id_extrabed']!=0) { ?>
									<?php 
										$getextrabed = mysqli_fetch_array(mysqli_query($konek,
													   "SELECT * FROM extrabed e 
													   JOIN transaksi_layanan tl ON e.id_extrabed=tl.id_extrabed WHERE tl.kd_booking='$_GET[id]'"));
									?>	
										<div class="form-group" style="margin-top:50px;">
											<h4>Tambah Extrabed</h4>
											<p>Harga bed <span class="price-bed">: Rp.<?php echo formatuang($getextrabed['harga_extrabed']);?></span></p>
										</div>
									<?php }else{ ?>

									<?php } ?>
								</div>
							</div>
						<?php }elseif ($data['layanan_extra']=='Tidak') { ?>
								<p style='text-align:center;'>Maaf anda tidak memesan satupun transaksi tambahan !</p>
						<?php } ?>							
					</div>
					<div class="row">
						<div class="col pull-right">
							<p>Total Transaksi <span style="font-weight:bold;">Rp. <?php echo formatuang($data['total_biayasewa']);?></span></p>
						</div>
					</div>
				</div><!-- col-lg-9 -->
			</div><!-- row-->
		</div><!-- post rulefontorder-->
	</div><!-- col-lg-12-->
</div><!-- row-->





