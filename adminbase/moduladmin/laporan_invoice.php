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
		<div class="font-sizerheading"><h1 class="page-header">Laporan Invoice</h1>
			<div class="main-headermember">
				<img src="<?php echo "$site"."frontend/icon/header-invoice.png";?>">
			</div>
			<div id="printReady">
				<table class="table table-bordered">
					<thead class="bg-thead">
						<tr>
							<th>No</th>
							<th>No transaksi </th>
							<th>Nama Pemesan</th>
							<th>Check in</th>
							<th>Check out</th>
							<th>Produk</th>
							<th>Total</th>
							<th class="action-link">Action</th>
						</tr>
					</thead>
				<?php
					$no=1;
					$getdatamember = mysqli_query($konek,"SELECT b.kd_booking, m.id_member, m.nama_lengkap, b.checkin, b.checkout, b.total_biayasewa
														 FROM booking b JOIN member m ON b.id_member=m.id_member
														 WHERE b.status_userbook='CO' || b.status_userbook='CI'");
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
																	   WHERE b.status_userbook='CI' || b.status_userbook='CO'");
								while ($res = mysqli_fetch_array($getarray_kamar)) {
							?>
							<?php echo $res['type_kamar']; } ?></td>
							<td>Rp.<?php echo formatuang($data['total_biayasewa']);?></td>
							<td class="action-link">
								<a href="<?php echo "homeadmin.php?modul=laporan_invoicedetail&id=$data[kd_booking]&member=$data[id_member]"?>">View Invoice</a>
							</td>
						</tr>
					<?php $no++; }  ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
