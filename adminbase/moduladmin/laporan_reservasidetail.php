<?php include "../fungsi/function_windowprint.php"; include "../fungsi/function_transaksi.php"; ?>
<style type="text/css">
	/*using media print to write a code into document !!*/
	@media print {
		body, html, #wrapper {
		  width: 100%;
		  display: inline-block;
		  font-size: 11px !important;
		}
		/* remove all when button print already click*/
		.btn-warning, .page-header, .navigation-rules {
			display: none;
		}
	}
	.main-headermember{
		text-align: center !important;
	}
	.main-containerdetail{
		width: 70%;
		display: block;
		padding: 0px 66px;
	}
	td{
		padding: 6px;
	}
	.img_member{
		display: block;
		float: right;
		margin-top: 33px !important;
	}
	.right-containhormatkami{
		float: right;
		display: block;
		margin-top: 60px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<input type="hidden" value="<?php echo $_GET['id'];?>">
		<div class="font-sizerheading"><h1 class="page-header">Laporan Reservasi Detail</h1>
			<div style="margin-bottom:5px;">
				<a href="homeadmin.php?modul=laporan_reservasi" class="navigation-rules"><~ Go back</a>
			</div>
			<div class="row">
				<div class="col-md-11 col-md-offset-1 main-headermember">
					<img class="img-responsive" src="<?php echo "$site"."frontend/icon/header-reservasi.png";?>">
				</div>
			</div>
			<?php
				$getdatamember = mysqli_query($konek,"SELECT b.kd_booking, m.nama_lengkap, b.checkin, b.checkout, b.status_userbook, m.jenis_kelamin,
													m.no_telp, m.email, m.alamat, m.jenis_identitas, m.identitas_user, m.foto
												    FROM booking b JOIN member m ON b.id_member=m.id_member
													WHERE b.kd_booking='$_GET[id]' AND b.status_userbook='CO'");
				while ($data=mysqli_fetch_array($getdatamember)) {
				
			?>
			<div class="main-containerdetail">
			<table>
				<tr>
					<td>Kode booking</td>
					<td> :</td>
					<td><?php echo $_GET['id'];?></td>
					<td class="margin-right:100px;"></td>
				</tr>
				<tr>
					<td>Nama Lengkap </td>
					<td> :</td>
					<td><?php echo $data['nama_lengkap'];?></td>
				</tr>
				<tr>
					<td>Checkin</td>
					<td> :</td>
					<td><?php $changedate1 = tgl_indo($data['checkin']); echo $changedate1;?></td>
				<tr>
				<tr>
					<td>Checkout</td>
					<td> :</td>
					<td><?php $changedate2 = tgl_indo($data['checkout']); echo $changedate2;?></td>
				<tr>
			<?php } ?>	
				<tr>
					<?php
						$get_tipekamar = mysqli_query($konek,"SELECT km.id_kategori_kamar, km.type_kamar, km.tarif 
						FROM kategori_kamar km JOIN detail_booking_kamar dbk ON km.id_kategori_kamar=dbk.id_kategori_kamar WHERE dbk.kd_booking='$_GET[id]'");
						while ($res= mysqli_fetch_array($get_tipekamar)) {
					?>
					<td>Tipe Kamar</td>
					<td> :</td>
					<td><?php echo $res['type_kamar'];?></td>
				</tr>
				<tr>
					<td>Tarif Kamar</td>
					<td> :</td>
					<td>Rp.<?php echo formatuang($res['tarif']);?></td>
				</tr>
				<?php } ?>
			</table>
			</div>
			<div class="col-md-3 pull-right">
				<p style="font-weight:bold;">Yogyakarta <?php echo tgl_indo($datenow =date('Y-m-d'));?></p>
				<p style="margin-bottom:50px;">Mengetahui</p>
				<p>Liany Heviana</p>
			</div>
			<div style="margin:160px 0px 6% 70px">
				<a href="" onclick="windowprint();" class="btn btn-warning">Cetak Laporan Member</a>
			</div>
		</div>
	</div>
</div>



