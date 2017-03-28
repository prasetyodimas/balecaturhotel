<?php include "../fungsi/function_transaksi.php"; include '../fungsi/function_windowprint.php'; error_reporting(0);?>
<script type="text/javascript">
	$(document).ready(function(){
	 $('#dari-tgl1').Zebra_DatePicker();
	 $('#dari-tgl2').Zebra_DatePicker();
	});	
</script>
<style type="text/css">
	@media print {
	      body, html, #wrapper {
	          width: 100%;
	          font-size: 12px;
	      }
	   	  .cetak-laporanall, .searching-laporan, .page-header{
	      	display: none;
	      }
	}
	.searching-laporan{
		margin-bottom: 20px;
	}
	.action-laporan{
		float: right;
	    display: inline-block;
	    margin-top: 30px;
	}
	.main-headermember{
		display: block;
		text-align: center;
	}
	table > tbody > tr > td {
		border-bottom: 1px solid #ddd;
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;

	}
	table>thead>tr>th {
		border: none !important;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading"><h1 class="page-header">Laporan Pemasukan</h1>
			<div class="main-headermember">
				<img src="<?php echo "$site"."frontend/icon/header-pemasukan.png";?>">
			</div>
			<div class="action-laporan">
				<?php
				    $tanggal_1 = $_POST['dari_tanggal'];
					$tanggal_2 = $_POST['sampai_tanggal'];
				 ?>
			<form action="homeadmin.php?modul=laporan_pemasukan" method="post" enctype="multipart/form-data">
				<div class="searching-laporan">
					<label>Lihat Laporan periode</label>
					<label class="form-inline">
						<input type="text" name="dari_tanggal" id="dari-tgl1" class="datepicker" required="">s/d
					</label>
					<label class="form-inline">
						<input type="text" name="sampai_tanggal" id="dari-tgl2" class="datepicker" required="">
					</label>
					<input type="submit" value="cari">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p>Laporan periode : <?php echo tgl_indo($tanggal_1).' S/d '.tgl_indo($tanggal_2);?></p>
				</div>
			</div>
			<table class="table tables-bordered">
				<thead>
					<tr>
						<th width="50">No</th>
						<th>Kode booking</th>
						<th>Nama pemesan</th>
						<th>Tipe Kamar</th>
						<th>Checkin</th>
						<th>Chekcout</th>
						<th>Harga Kamar</th>
						<th>Total Transaksi</th>
					</tr>
				</thead>
				<?php
					$no=1;
					$getlaporan = mysqli_query($konek,"SELECT b.kd_booking, m.id_member, m.nama_lengkap, b.checkin, b.checkout, km.type_kamar, km.tarif, b.status_userbook, b.total_biayasewa 
							      FROM booking b JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking
							      JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar
								  JOIN member m ON b.id_member=m.id_member 
								  WHERE b.checkin BETWEEN '$tanggal_1' AND '$tanggal_2' AND b.status_userbook='CO'");
					while ($result =mysqli_fetch_array($getlaporan)) {
				?>
				<tbody>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $result['kd_booking']; ?></td>
						<td><?php echo $result['nama_lengkap']; ?></td>
						<td><?php echo $result['type_kamar']; ?></td>
						<td><?php echo tgl_indo($result['checkin']); ?></td>
						<td><?php echo tgl_indo($result['checkout']); ?></td>
						<td>Rp.<?php echo formatuang($result['tarif']); ?></td>
						<td>Rp.<?php echo formatuang($result['total_biayasewa']); ?></td>
					</tr>
				</tbody>
				<?php $no++; } ?>
			</table>
			<div style="float:right;margin-top:-20px">
				<table class="table tables-bordered">
					<?php 
						$gettotal = mysqli_query($konek,"SELECT kd_booking, status_userbook, SUM(total_biayasewa) AS total 
									FROM booking WHERE status_userbook='CO' AND checkin BETWEEN '$tanggal_1' AND '$tanggal_2'");
					 	while ($res = mysqli_fetch_array($gettotal)) {
					 ?>
					<thead>
						<tr>
							<th width="152">Subtotal</th>
						</tr>
						<tr>
							<td>Rp.<?php echo formatuang($res['total']);?></td>
						</tr>
					</thead>
					<?php } ?>
				</table>
			</div>
			<div style="margin-top:150px;margin-bottom:50px;">
				<button class="cetak-laporanall" onclick="windowprint();">Cetak Laporan</button>
			</div>
			</form>
		</div>
	</div>
</div>