<?php include 'fungsi/function_transaksi.php';?>
<style type="text/css">
	.price-paket{margin-left: 25px; } 
	.descript-menu{margin-left: 29px; } 
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">ACCOMODATION HOTEL BALECATUR INN</h1>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Room Features</li>
			</ol>
    		<div class="col-md-3 col-sm-3 col-xs-12">
				<img src="frontend/icon/reception.png" class="img-responsive">
    		</div>
    		<div class="col-md-9 col-sm-9 col-xs-12">
				<?php
					$getdata =mysqli_query($konek,"SELECT * FROM akomodasi");
					while ($r=mysqli_fetch_array($getdata)) {
				?>
				<h2 class=""><?php echo $r['judul_akomodasi']; ?></h2>
				<div>
					<p><?php echo $r['ket_akomodasi']; ?></p>
				</div>
				<?php } ?>
   			</div>
   			<!-- layanan rental -->
   			<div class="layanan-rental">
	   			<div class="row">
	   				<div class="col-lg-12 col-margin100" style="margin-top:100px;">
	   					<div class="fnt-akomodasi">
							<h2>Layanan Rental Balecatur Hotel</h2>   					
	   					</div>
	   				</div>
	   			</div>
				<?php 
					$getrental = mysqli_query($konek,"SELECT * FROM rental ORDER BY id_rental DESC");
					while ($v  = mysqli_fetch_array($getrental)) {
				?>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<img src="uploads/rental/<?php echo $v['foto_kendaraan'];?>" class="img-responsive">	   					
					<div class="panel panel-default container-description">
						<div class="panel-heading" style="text-align:center">
							<p><strong><?php echo $v['nama_kendaraan'];?></strong></p>
						</div>
						<div class="panel-body">
							<p>Harga <span><strong>Rp.<?php echo formatuang($v['harga_kendaraan']);?></strong></span></p>
							Deskripsi : <?php echo $v['ket_kendaraan']; ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="layanan-restorasi">
				<div class="row">
	   				<div class="col-lg-12 col-margin100" style="margin-top:100px;">
						<div class="fnt-akomodasi">
							<h2>Layanan Restaurant Balecatur Hotel</h2>   					
						</div>
						<?php
							$getrestorasi = mysqli_query($konek,"SELECT p.nama_paket, p.harga_paket, dp.keterangan_menunya FROM paket p join detail_paket dp ON p.id_paket=dp.id_paket");
							while ($res = mysqli_fetch_array($getrestorasi)) {
						?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="panel panel-default">
								<div class="panel-heading" style="text-align:center"><p><strong>Nama Paket : <?php echo $res['nama_paket']; ?></strong></p></div> 
								<div class="panel-body">
									<img src="">
									<div class="section-paket">
										<p>Harga<span class="price-paket">: Rp.<?php echo formatuang($res['harga_paket']);?></span></p>
									</div>
									<div class="section-keteranganmenu">
										<p>Menu<span class="descript-menu">: <?php echo removetags($res['keterangan_menunya']);?></span></p>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<!-- Keterangan layanan restaurant -->
				</div>
				<div class="col-lg-12">
					<strong style="font-size:16px;">Catatan :</strong>
					<p>Restaurant : Jenis Menu dan Harga di setiap paket menu <strong>RESTAURANT</strong> sewaktu- waktu dapat berubah sesuai dengan kebijakan manajemen hotel, untuk pemesanan layanan restaurant hanya dapat dilakukan ditempat saja / reservasi langsung.</p>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
