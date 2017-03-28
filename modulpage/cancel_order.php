<script type="text/javascript">
	$('#cancel-order-to-refund').prop('disabled');
</script>
<?php include "fungsi/function_transaksi.php";
	//get user
	$user     = $_SESSION['id_member'];
	$viewuser = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member WHERE id_member='$user'"));
	$view_confirmation = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM knfrimasi_pmbyaran WHERE kd_booking='$_GET[kode_book]'"));
	$view_othertransac = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE  kd_booking='$_GET[kode_book]'"));
	$getorder = mysqli_query($konek,"SELECT b.kd_booking, km.id_kategori_kamar, km.type_kamar, b.checkin, b.checkout, b.tgl_booking, km.tarif, b.total_biayasewa
									 FROM booking b JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking
									 JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar
									 WHERE b.kd_booking='$_GET[kode_book]'");
	$data 	  = mysqli_fetch_array($getorder); 
	//menghitung jumlah harinya dari checkin - checkout
	$jumlah_hari = round((strtotime($data['checkout'])-strtotime($data['checkin']))/86400);
?>
<style type="text/css">
	.detailorder-idmember{margin-left: 100px;}
	.detailorder-kodepemesan{margin-left:67px;}
	.detailorder-namapemesan{margin-left:63px;}
	.detailorder-tglpesan{margin-left:72px;}
	.form-padding{padding: 20px;border: 1px solid #dedede;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">CANCEL ORDER</h1>
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
								<li><a class="none-underline <?php echo $url_myorder; ?>" href="<?php echo "$site"."index.php?modul=myorder";?>"><i class="fa fa-shopping-basket fa-fw"></i> My Order</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=manageakun";?>"><i class="fa fa-user fa-fw"></i> My Profil</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=history_pemesanan";?>"><i class="fa fa-search-plus fa-fw"></i> History pemesanan</a></li>
							</ul>
						</div><!--left-sidebarorder-->
					</div><!-- panel panel-default-->
				</div><!-- col-md-3-->
				<div class="col-lg-9">
					<div class="form-group">
						<h4>Detail Order</h4>
					</div>
					<form action="backend/proses_refund.php?act=refund" method="post" enctype="multipart/form-data">
						<!-- defined status refund from user -->
						<input type="hidden" name="status" value="RF">
						<input type="hidden" name="kd_booking" value="<?php echo $_GET['kode_book']?>">
						<label>Pemesan :</label>
						<div class="form-padding">
							<div class="form-group">
								<p>Kode Pemesan <span class="detailorder-kodepemesan">: <?php echo $data['kd_booking'];?></span></p>
							</div>
							<div class="form-group">
								<p>Nama Pemesan <span class="detailorder-namapemesan">: <?php echo $viewuser['nama_lengkap'];?></span></p>
							</div>
							<div class="form-group">
								<p>Tanggal pesan <span class="detailorder-tglpesan">: <?php echo $data['tgl_booking'];?></span></p>
							</div>
						</div>
						<label>Pembayaran :</label>
						<div class="form-padding form-group">
							<?php
								$status_confirm_yes =$view_confirmation['jumlah_bayar']!=''; 
								$status_confirm_no =$view_confirmation['jumlah_bayar']==''; 
								if ($status_confirm_yes) {
									echo "
									<div class='form-group'>
										<p>Jenis pembayaran<span class='detailorder-kodepemesan'>: $vie_confirmation[kd_booking]</span></p>
									</div>
									<div class='form-group'>
										<p>Transfer pembayaran<span class='detailorder-kodepemesan'>: </span></p>
									</div>
									<div class='form-group'>
										<p>Status pembayaran<span class='detailorder-kodepemesan'>: </span></p>
									</div>";
								}elseif ($status_confirm_no) {
									echo "<h5 style='text-align:center;color:#ff0000;'>Maaf anda belum melakukan pembayaran !</h5>";
								}
							 ?>
						</div>
						<div class="form-group">
							<p>Bagaimana cara mengajukan refund?
							   Pengajuan refund dapat dilakukan melalui akun Balecatur Hotel inn Anda dengan mengikuti empat langkah mudah ini:
							</p>
							<label>1.Log in ke akun Balecatur Hotel inn Anda. Jika belum memiliki akun, daftar sekarang dengan alamat email yang sama dengan yang Anda gunakan untuk memesan.</label>
							<label>2.Pada halaman dashboard user di akun Anda, pilih submenu my order / pemesanan saya.</label>
							<label>3.Pada halaman dashboard user di akun Anda, pilih submenu Pesanan Saya.</label>
							<label>3.Jika sudah berada di menu cancel order anda harus membaca syarat dan ketentuan yang berlaku dalam proses refund.</label>
						</div>
						<div class="form-group">
							<p>Apa yang dimaksud dengan refund?
							  Refund adalah sejumlah uang yang akan Anda terima atas pembatalan pemesanan transaksi kamar beserta akomodasi lainya yang bersifat refundable,
							  serta tergantung pada kebijakan yang berlaku. Permohonan refund yang telah diajukan tidak dapat dibatalkan
							</p>
						</div>
						<div class="form-group">
							<?php
								if ($view_confirmation['jumlah_bayar']!=''){
									
								}else{

								}
								
							?>
							<button class="btn btn-danger" id="cancel-order-to-refund" name="status_refund" value="RF">Refund Order</button>
							<button class="btn btn-warning">Hapus Pemesanan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>





