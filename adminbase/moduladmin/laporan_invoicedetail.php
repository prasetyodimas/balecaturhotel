<?php
include "../fungsi/function_transaksi.php";
include "../fungsi/function_windowprint.php"; ?>
<style type="text/css">
	@media print {
		.body, html, #wrapper{
			font-size:11px !important;
		}
		.btn.btn-warning, .page-header, .navbar-brand{
			display: none;
		}
	}
	table.table-invoice{
	    width: 100%;
	    max-width: 100%;
	    margin-bottom: 20px;
	}
	th.th-invoice{
		border: 1px solid #000;
		padding: 5px;
	}
	td.td-invoice{
		border: 1px solid #000;
		padding: 5px;
	}
</style>
<?php 
$gettransaksi_layanan = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE kd_booking='$_GET[id]'"));
$get_guest = mysqli_fetch_array(mysqli_query($konek,"SELECT b.kd_booking, m.id_member, m.nama_lengkap, b.checkin, b.checkout, b.total_biayasewa 
				   FROM booking b JOIN member m WHERE b.kd_booking='$_GET[id]' AND m.id_member='$_GET[member]'"));
	//menghitung berapa lama tamu menginap
	$var_days = round((strtotime($get_guest['checkout'])-strtotime($get_guest['checkin']))/86400);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading"><h1 class="page-header">Laporan Invoice</h1>
		<section main-invoice>
			<input type="hidden" value="<?php echo $_GET['id'];?>">
			<div class="row">
				<p style="text-align:center;">INVOICE</p>
				<p style="text-align:center;">No.<?php echo $_GET['id'];?> / BALECATURINN / <?php echo date("Y");?></p>
			</div>
			<div class="header-information">
				<p>Kepada Yth,</p>
				<p><?php echo $get_guest['nama_lengkap'];?></p>
				<p>Di-tempat</p>
			</div>
			<!-- ==================== TOTAL INVOICE KAMAR ==================== -->
			<div class="table-responsive">
				<div class="col pull-right">
					<p>Invoice Tagihan Kamar</p>
				</div>
				<table class="table-invoice">
					<thead>
						<tr class="tr-invoice">
							<th width="50" class="th-invoice">No</th>
							<th class="th-invoice">Uraian</th>
							<th class="th-invoice">Harga</th>
						</tr>
					</thead>
					<?php 
						$no=1;
						$get_transaksi = mysqli_query($konek,"SELECT * FROM kategori_kamar km JOIN detail_booking_kamar dbk ON km.id_kategori_kamar=dbk.id_kategori_kamar 
							WHERE dbk.kd_booking='$_GET[id]'");
						while ($res = mysqli_fetch_array($get_transaksi)) {
					?>
					<tbody>
						<tr>
							<td class="td-invoice"><?php echo $no;?></td>
							<td class="td-invoice">Checkin kamar no <?php echo $res['id_kamar']; ?> 
							<?php echo $res['type_kamar'];?> dari tanggal <?php echo tgl_indo($get_guest['checkin']);?> sampai dengan <?php echo tgl_indo($get_guest['checkout']);?> lama menginap <?php echo $var_days.' hari ';?></td>
							<td class="td-invoice">Rp.<?php echo formatuang($res['tarif']).' / hari x'.$var_days.' hari';?></td>
						</tr>
						<?php if($gettransaksi_layanan['id_extrabed']!=0){?>
						<?php $getdescipt_extrabed = mysqli_fetch_array(mysqli_query($konek,"SELECT tl.kd_booking, e.harga_extrabed 
							  FROM extrabed e JOIN transaksi_layanan tl ON e.id_extrabed=tl.id_extrabed WHERE tl.kd_booking='$_GET[id]'"));?>
						<tr>
							<td class="td-invoice" colspan="3">Transaksi Tambahan :</td>
						</tr>
						<tr>
							<td class="td-invoice" colspan="2"> - Extrabed</td>
							<td class="td-invoice">Rp. <?php echo formatuang($getdescipt_extrabed['harga_extrabed']);?></td>
						</tr>
						<?php }else{ ?>
						<?php } ?>
					<?php $no++; } ?>
						<tr>
							<td colspan="3" class="td-invoice">Total rincian sampai <?php echo tgl_indo($get_guest['checkout']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- end of table responsive -->
			<!-- ==================== END OF TOTAL INVOICE KAMAR ==================== -->

		<?php if($gettransaksi_layanan['id_rental']!=0){ ?>
			<!-- ========== CHECK INVOICE JIKA ADA INVOICE TAMBAHAN ========= -->
			<div class="table-responsive">
				<div class="col pull-right">
					<p>Invoice Tagihan Rental</p>
				</div>
				<table class="table-invoice">
					<thead>
						<tr class="tr-invoice">
							<th width="50" class="th-invoice">No</th>
							<th class="th-invoice">Uraian</th>
							<th class="th-invoice">Harga</th>
						</tr>
					</thead>
					<?php 
						$no=1;
						$get_transaksi_rent = mysqli_query($konek,"SELECT dbr.kd_booking, r.kate_kendaraan, r.nama_kendaraan, r.harga_kendaraan, dbr.tgl_awal_sewa, dbr.tgl_akhir_sewa 
							FROM rental r JOIN detail_booking_rental dbr ON dbr.id_rental=r.id_rental 
							WHERE dbr.kd_booking='$_GET[id]'");
						while ($res = mysqli_fetch_array($get_transaksi_rent)) {
					?>
					<tbody>
					<?php if($res['kate_kendaraan']=='Motor'){ ?>
						<tr>
							<td class="td-invoice"><?php echo $no;?></td>
							<td class="td-invoice">Sewa rental <?php echo $res['kate_kendaraan'].' '.$res['nama_kendaraan'];?> dari tanggal <?php echo tgl_indo($res['tgl_awal_sewa']).' S/d '.tgl_indo($res['tgl_akhir_sewa']);?>  
							<td class="td-invoice">Rp.<?php echo formatuang($res['harga_kendaraan']);?></td>
						</tr>
					<?php }elseif($res['kate_kendaraan']=='Mobil') {?>
						<tr>
							<td class="td-invoice"><?php echo $no;?></td>
							<td class="td-invoice">Sewa rental <?php echo $res['kate_kendaraan'].' '.$res['nama_kendaraan'];?> dari tanggal <?php echo tgl_indo($res['tgl_awal_sewa']).' S/d '.tgl_indo($res['tgl_akhir_sewa']);?>  
							<td class="td-invoice">Rp.<?php echo formatuang($res['harga_kendaraan']);?></td>
						</tr>
					<?php } ?>
					<?php $no++; } ?>
						<tr>
							<td colspan="3" class="td-invoice">Total rincian sampai <?php echo tgl_indo($get_guest['checkout']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- end of table responsive -->
			<!-- ========== END CHECK INVOICE JIKA ADA INVOICE TAMBAHAN ========= -->
		<?php }else{ ?>

		<?php } ?>
			<!-- ========== CHECK INVOICE JIKA ADA INVOICE TAMBAHAN ========= -->
		<?php if($gettransaksi_layanan['id_paket']!=0) {?>
			<div class="table-responsive">
				<div class="col pull-right">
					<p>Invoice Tagihan Restorasi</p>
				</div>
				<table class="table-invoice">
					<thead>
						<tr class="tr-invoice">
							<th width="50" class="th-invoice">No</th>
							<th class="th-invoice">Uraian</th>
							<th class="th-invoice">Harga</th>
						</tr>
					</thead>
					<?php 
						$no=1;
						$get_transaksi = mysqli_query($konek,"SELECT * FROM paket p JOIN detail_paket dp ON p.id_paket=dp.id_paket 
							JOIN transaksi_layanan tl ON tl.id_paket=p.id_paket 
							WHERE tl.kd_booking='$_GET[id]'");
						while ($res = mysqli_fetch_array($get_transaksi)) {
					?>
					<tbody>
						<tr>
							<td class="td-invoice"><?php echo $no;?></td>
							<td class="td-invoice">Nama paket <?php echo $res['nama_paket']." deskripsi menunya ".strip_tags($res['keterangan_menunya']);?></td>
							<td class="td-invoice">Rp. <?php echo formatuang($res['harga_paket']);?></td>
						</tr>
					<?php $no++; } ?>
						<tr>
							<td colspan="3" class="td-invoice">Total rincian sampai <?php echo tgl_indo($get_guest['checkout']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- end of table responsive -->
			<!-- ========== END CHECK INVOICE JIKA ADA INVOICE TAMBAHAN ========= -->
		<?php }else{ ?>

		<?php } ?>
		<?php if($gettransaksi_layanan['id_laundry']!=0) { ?>
			<div class="table-responsive">
				<div class="col pull-right">
					<p>Invoice Tagihan Laundry</p>
				</div>
				<table class="table-invoice">
					<thead>
						<tr class="tr-invoice">
							<th width="50" class="th-invoice">No</th>
							<th class="th-invoice">Uraian</th>
							<th class="th-invoice">Harga</th>
						</tr>
					</thead>
					<?php 
						$no=1;
						$get_transaksi = mysqli_query($konek,"SELECT * FROM laundry la JOIN transaksi_layanan tl ON tl.id_laundry=la.id_laundry 
							WHERE tl.kd_booking='$_GET[id]'");
						while ($res = mysqli_fetch_array($get_transaksi)) {
					?>
					<tbody>
						<tr>
							<td class="td-invoice"><?php echo $no;?></td>
							<td class="td-invoice">Jasa Laundry <?php echo $res['jenis_laundry']." keterangan ".$res['ket_laundry'];?></td>
							<td class="td-invoice">Rp.<?php echo formatuang($res['harga_laundry']);?></td>
						</tr>
					<?php $no++; } ?>
						<tr>
							<td colspan="3" class="td-invoice">Total rincian sampai <?php echo tgl_indo($get_guest['checkout']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- end of table responsive -->
			<!-- ========== END CHECK INVOICE JIKA ADA INVOICE TAMBAHAN ========= -->
		<?php }else{ ?>

		<?php } ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="subtotal-invoice col pull-right">
						<p>Total tagihan anda : <strong> Rp. <?php echo formatuang($get_guest['total_biayasewa']);?></strong></p>
					</div>
				</div>
			</div>
			<div>
				<a href="" onclick="windowprint();" class="btn btn-warning">Cetak Invoice</a>
			</div>
			<div class="col pull-right" style="margin-top:50px;">
				<p>Yogyakarta, <?php echo tgl_indo($tgl_now = date('Y-m-d'));?></p>
				<p class="laporan-heading">Mengetahui</p>

				<p>Liani Heviani</p>
			</div>
		</section>
	</div>
</div>