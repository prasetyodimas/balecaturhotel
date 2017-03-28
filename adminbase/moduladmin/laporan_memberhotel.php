<?php  include "../fungsi/function_transaksi.php"; include "../fungsi/function_windowprint.php"; ?>
<style type="text/css">
	@media print {
      body, html, #wrapper {
          width: 100%;
          font-size: 11px !important;
      }
      .cetak-laporanall, .page-header, .action-link{
      	display: none;
      }
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Laporan Member</h1>
			<div id="printReady">
			<div class="main-headermember"><img src="<?php echo "$site"."frontend/icon/header-member.png";?>"></div>
			<div class="table-responsive">
				<table class="table table-bordered">
				<thead class="bg-thead">
					<tr>
						<th>No</th>
						<th>Id Member</th>
						<th>Nama Member</th>
						<th>Alamat</th>
						<th>Jenkel</th>
						<th>Kebangsaan</th>
						<th>Notelp</th>
						<th>Email</th>
						<th class="action-link">Aksi</th>
					</tr>
				</thead>
				<?php
					$no =1;
					$getdatamember = mysqli_query($konek,"SELECT * FROM member");
					while ($data=mysqli_fetch_array($getdatamember)) {
				?>
					<tbody>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $data['id_member'];?></td>
							<td><?php echo $data['nama_lengkap'];?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['jenis_kelamin'];?></td>
							<td><?php echo $data['kebangsaan'];?></td>
							<td><?php echo $data['no_telp']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td class="action-link">
								<a class="" href="<?php echo "homeadmin.php?modul=laporan_memberdetail&id=$data[id_member]"?>">view</a>
							</td>
						</tr>
					<?php $no++; } ?>	
					</tbody>
				</table>
				<div>
					<button class="cetak-laporanall" target="_blank" onclick="windowprint();">Cetak Semua Laporan</button>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
