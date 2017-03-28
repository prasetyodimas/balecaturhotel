<?php include "../fungsi/function_windowprint.php"; 
	  include "../fungsi/function_transaksi.php"; 
?>
<style type="text/css">
	@media print {
	      body, html, #wrapper {
	          width: 100%;
	          font-size: 11px !important;
	      }
	      .bg-thead{
	      	display: visible;
	      }
	      .page-header, .action-link, .btn-cetakreserved, .mainsearch-member{
	      	display: none  !important;
	      }
		}
	}
	.main-headermember{text-align: center; display: block; margin-bottom: 50px; } 
	.mainsearch-member{display:inline-block; float:right; margin-top: 20px; margin-bottom: 20px; } 
	.from-stats{padding: 3px; display: inline-block; cursor: pointer; }
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading"><h1 class="page-header">Laporan Reservasi</h1>
			<div class="main-headermember">
				<img src="<?php echo "$site"."frontend/icon/header-reservasi.png";?>">
			</div>
				<div id="printReady">
					<table class="table table-bordered">
						<thead class="bg-thead">
							<tr>
								<th>No</th>
								<th>Kode booking</th>
								<th>Nama Pemesan</th>
								<th>Check in</th>
								<th>Check out</th>
								<th>Produk</th>
								<th>Total</th>
								<th class="action-link">Aksi</th>
							</tr>
						</thead>
						<?php
							$no=1;
							$getdatamember = mysqli_query($konek,"SELECT b.kd_booking, m.nama_lengkap, b.checkin, b.checkout, b.total_biayasewa
																 FROM booking b JOIN member m ON b.id_member=m.id_member
																 WHERE b.status_userbook='CO'");
							while ($data=mysqli_fetch_array($getdatamember)) {
						?>
						<tbody>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $data['kd_booking'];?></td>
								<td><?php echo $data['nama_lengkap'];?></td>
								<td><?php echo tgl_indo($data['checkin']); ?></td>
								<td><?php echo tgl_indo($data['checkout']); ?></td>
								<td>
								<?php 
									$getarray_kamar = mysqli_query($konek,"SELECT b.kd_booking, b.status_userbook, dbk.id_kategori_kamar, km.type_kamar 
																		   FROM detail_booking_kamar dbk JOIN booking b ON dbk.kd_booking=b.kd_booking
																		   JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar
																		   WHERE b.status_userbook='CO'");
									while ($res = mysqli_fetch_array($getarray_kamar)) {
								?>
								<?php echo $res['type_kamar']; } ?>
								</td>

								<td>Rp.<?php echo formatuang($data['total_biayasewa']);?></td>
								<td class="action-link">
									<a href="<?php echo "homeadmin.php?modul=laporan_reservasidetail&id=$data[kd_booking]"?>">view</a>
								</td>
							</tr>
						<?php $no++; } ?>	
						<?php $grandtotal = mysqli_fetch_array(mysqli_query($konek,"SELECT kd_booking, id_member, status_userbook, SUM(total_biayasewa) AS total_transaksi 
							FROM booking WHERE status_userbook='CO'"));?>
							<tr>
								<td colspan="6"></td>
								<td>Grand Total : Rp.<?php echo formatuang($grandtotal['total_transaksi']);?></td>
								<td class="action-link"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col pull-right">
					<p>Yogyakarta, <?php echo tgl_indo($tgl_now = date('Y-m-d'));?></p>
					<p class="laporan-heading">Mengetahui</p>
					<p>Liani Heviani</p>
				</div>
			<div style="margin-top:100px;">
				<button class="btn-cetakreserved" onclick="windowprint();">Cetak Semua Laporan</button>
			</div>
		</div>
	</div>
</div>
