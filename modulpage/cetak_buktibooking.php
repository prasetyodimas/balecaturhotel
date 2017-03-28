<?php include "fungsi/function_windowprint.php"; error_reporting(0);
      include "fungsi/function_transaksi.php";
/*$user=$_SESSION['id_member'];*/
$get_transaksi_layanan = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE kd_booking='$GET[kode_book]'"));
$getorder = mysqli_query($konek,"SELECT b.kd_booking, m.nama_lengkap, m.alamat, b.checkin, b.checkout, b.total_biayasewa, b.layanan_extra
							 	 FROM booking b JOIN member m on b.id_member=m.id_member
							     WHERE b.kd_booking='$_GET[kode_book]'");
$data=mysqli_fetch_array($getorder); 
//menghitung jumlah harinya dari checkin - checkout
$jumlah_hari = round((strtotime($data['checkout'])-strtotime($data['checkin']))/86400);
?>
<style type="text/css">
	.thin-style{font-weight: normal; } 
	.margin-20{margin-bottom: 70px; } 
	.margin10-top{margin-top: 10px; } 
	.bordered-header{border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; } 
	table.tb-bukticustom{
		width: 100%;
    	vertical-align: top;
	}
	table.tb-bukticustom>thead>tr.tr-custombukti{
		line-height: 20px;
	}
	th.th-custombukti, td.td-custombukti{
		padding: 10px;
	}
	.kode-bookright{display:inline-block;position: relative; top:35px; left: 0; right: 0; bottom: 0; }
	.heading-padd{display:inline-block;position:relative;left:200px;padding: 10px; }
	@media print{
		.navbar,.footer-area,.copyright-site,.asidelogo-right,.action-userback,.breadcrumb,.fnt-style{
			display: none;
		}
		.margin-20{
			margin-bottom: 70px;
		}
		body {
			line-height: 1.3;
		}
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">BUKTI RESERVASI ONINE</h1>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">My order</li>
			  <li class="active">Bukti reservasi online</li>
			</ol>
			<!-- header logo start here -->
			<div class="row action-userback">
				<div class="col-md-6">
					<a class="overaction-back" href="javascript:history.back();"><~ Go back</a>
				</div>
				<div class="col-md-6">
					<a class="btn-navigationact" target="_blank" onclick="windowprint();">Cetak Bukti Reservasi</a>
				</div>
			</div>
			<!-- header logos -->
			<div class="col-lg-12 bordered-header margin10-top">
				<img class="img-responsive heading-padd" src="<?php echo $site;?>frontend/icon/desain-struck.png">
				<div class="kode-bookright col-md-2 pull-right">
					<h2 style="font-weight:bold;"><?php echo $_GET['kode_book'];?></h2>
				</div>
			</div>
			<input type="hidden" name="kode_book" value="<?php echo $_GET['kode_book'];?>">
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table border="1" class="tb-bukticustom table-responsive">
							<thead>
								<tr class="tr-custombukti">
									<th class="th-custombukti" colspan="5">Nama pemesan : <span><?php echo $data['nama_lengkap'];?></span></th>
									<th class="th-custombukti" colspan="5">Checkin: <span><?php echo tgl_indo($data['checkin']);?></span></th>
								</tr>
								<tr class="tr-custombukti">
									<th class="th-custombukti" colspan="5">Alamat : <span><?php echo $data['alamat'];?><span></th>
									<th class="th-custombukti" colspan="5">Checkout: <span><?php echo tgl_indo($data['checkout']);?></span></th>
								</tr>
								<tr class="tr-custombukti">
									<th class="th-custombukti">No</th>
									<th class="th-custombukti">Tipe kamar</th>
									<th class="th-custombukti">Harga asli</th>
									<th class="th-custombukti">Pajak</th>
									<th class="th-custombukti">Diskon</th>
									<th class="th-custombukti">Total Harga (pajak / jika ada diskon)</th>
									<th class="th-custombukti">Subtotal Harga / kamar x hari</th>
								</tr>
							</thead>
							<?php 
								$no=1;
								$get_transc =mysqli_query($konek,"SELECT b.kd_booking, km.id_kategori_kamar, b.checkin, b.checkout, b.tgl_booking, 
								    km.type_kamar, km.tarif, b.total_biayasewa
									FROM booking b 
									JOIN temp_booking tb ON tb.id_member=b.id_member
									JOIN kategori_kamar km ON tb.id_kategori_kamar=km.id_kategori_kamar
									WHERE b.kd_booking='$_GET[kode_book]'");
								while ($res = mysqli_fetch_array($get_transc)) {
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
									$percent = (($price_room*10)/100); 
									//variable discount
									$discount =(($price_room*$available_disc)/100);
							?>
							<tbody>
								<td class="td-custombukti"><?php echo $no;?></td>
								<td class="td-custombukti"><?php echo $res['type_kamar']; ?></td>
								<td class="td-custombukti">Rp.<?php echo formatuang($res['tarif']);?></td>
								<td class="td-custombukti">10% / <?php echo formatuang($percent);?></td>
								<td class="td-custombukti"><?php if ($x == $y) {echo $getdiskon['besar_diskon']."%";}elseif($y==''){echo "-";}?></td>
								<td class="td-custombukti">Rp.<?php echo formatuang($price_room+$percent-$discount).' / malam';?></td>
								<td class="td-custombukti">Rp.<?php echo formatuang(($price_room+$percent-$discount)*$jumlah_hari).' / malam';?></td>
							</tbody>
							<tfoot>
								<?php if ($data['layanan_extra']=='Ya'){ ?>
									<?php $show_transaksi_tamu = mysqli_fetch_array(mysqli_query($konek,"SELECT tl.kd_booking, r.kate_kendaraan, r.nama_kendaraan, r.harga_kendaraan 
									FROM transaksi_layanan tl JOIN rental r ON r.id_rental=tl.id_rental 
									WHERE tl.kd_booking='$_GET[kode_book]'"));?>
									<?php if($show_transaksi_tamu['id_rental']!=0) { ?>
										<tr>
											<td class="td-custombukti" colspan="2"><label>Layanan Tambahan</label></td>
											<td class="td-custombukti" colspan="5"><?php echo $get_transaksi_layanan['harga_extrabed'];?></td>
										</tr>
										<tr>
											<td class="td-custombukti" colspan="2">dsd<?php echo $show_transaksi_tamu['harga_extrabed']; ?></td>
											<td class="td-custombukti"></td>
										</tr>
									<?php }elseif($show_transaksi_tamu['id_rental']==0) { ?>
									<?php } ?>
									<?php $show_transaksi_tamu = mysqli_fetch_array(mysqli_query($konek,"SELECT tl.id_extrabed, e.harga_extrabed FROM transaksi_layanan tl 
										JOIN extrabed e ON tl.id_extrabed=e.id_extrabed WHERE tl.kd_booking='$_GET[kode_book]'"));?>
									<?php if ($show_transaksi_tamu['id_extrabed']!=0) { ?>
										<tr>
											<td class="td-custombukti" colspan="2"><label>Layanan Tambahan</label></td>
											<td class="td-custombukti" colspan="5"></td>
										</tr>
										<tr>
											<td class="td-custombukti" colspan="7">Extrabed Rp.<?php echo formatuang($show_transaksi_tamu['harga_extrabed']);?></td>
										</tr>
									<?php }elseif ($show_transaksi_tamu['id_extrabed']==0) { ?>
									<?php } ?>
								<?php }elseif($data['layanan_extra']=='Tidak') { ?>
									<tr>
										<td class="td-custombukti" colspan="2"><label>Layanan Tambahan</label></td>
										<td class="td-custombukti" colspan="5"> - </td>
									</tr>
								<?php } ?>
								<tr>
									<td class="td-custombukti" colspan="6"><label>Fasilitas : Meeting room, Restoran, Hot water, Ac, Rental, Catering, Laundry </label></br>Bukti transaksi ini harus dibawa ketika akan melakukan konfirmasi checkin, dan nikmati 
									kemudahan transaksi yang kami sediakan</td>
									<td class="td-custombukti">
										<div> <h4 style="text-align:center;">Subtotal Transaksi </h4> </div> 
										<div>
											<p style="text-align: center;">Rp <?php echo formatuang($data['total_biayasewa']);?></p>
										</div>
									</td>
								</tr>
							</tfoot>
							<?php $no++; } ?>
						</table>
					</div>
				</div>
			</div><!--end of row-->
		</div>
	</div>
	</div>
</div>
