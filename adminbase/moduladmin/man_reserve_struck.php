<?php include '../fungsi/function_windowprint.php'; include '../fungsi/function_transaksi.php';

$cek_layanan_tambahan = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE kd_booking='$_GET[id]'"));
$get_userhotel = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member m JOIN booking b ON b.id_member=m.id_member WHERE b.kd_booking='$_GET[id]'"));
$get_querytransc  = "SELECT b.kd_booking,  b.checkin, b.checkout, km.id_kategori_kamar, km.type_kamar, km.tarif, km.deskripsi, b.total_biayasewa FROM booking b JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking 
					JOIN kategori_kamar km ON dbk.id_kategori_kamar=km.id_kategori_kamar WHERE b.kd_booking='$_GET[id]'";
$saved = mysqli_query($konek,$get_querytransc);
$gettransaksi = mysqli_fetch_array($saved);
//get waktu menginap
$var_days = round((strtotime($gettransaksi['checkout'])-strtotime($gettransaksi['checkin']))/86400);

$kategori_kamar = $gettransaksi['id_kategori_kamar'];
$price_room = $gettransaksi['tarif'];
//cek kamar tersebut ada diskon atau tidak
$get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori_kamar'"));
//deklarasi variable tarif
$tarifnya = $get_price['tarif'];
$x 		  = $get_price['id_kategori_kamar'];
//buat diskon
$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$kategori_kamar'"));
//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
$y  		    = $getdiskon['id_kategori_kamar'];
$available_disc = $getdiskon['besar_diskon'];
//variable percent 10%
$percent = (($price_room*10)/100); 
//variable discount
$discount =(($price_room*$available_disc)/100);
//tentukan perhitungan harga kamar + pajak
$count_total_price_and_tax =(($price_room+$percent-$discount)*$var_days);

?>
<style type="text/css">
/*using media print to write a code into document !!*/
@media print {
	body, html, #wrapper {
	  width: 100%;
	  display: inline-block;
	  font-size: 10px;
	}
	/* remove all when button print already click*/
	.action-print, .page-header, .navigation-rules {
		display: none;
	}

}	
.main-headerstruck{
	width: 100%;
	height: auto;
	display: inline-block;
	border-top: 1px solid #000;
    border-left: 1px solid #000;
    border-right: 1px solid #000;
}
.header-struck .main-userkd_trans{
	float: right;
	display: block;
    padding: 60px 40px;
    font-size: 20px;
    font-weight: bold;
}
.main-userborder{
    border-top: 1px solid #000000;	
}
.main-userstruck{
	display: inline-block;
	float: left;
	padding: 20px;
}
.main-userstruckright{
	display: inline-block;
	float: right;
	padding: 20px;
}

.tabless-struck{
	width: 100%;
	display: table;
    font-size: 12.5px;

}
.tabless-struck > thead > tr > .th-strucktables{
	padding: 8px;
	width: 29% !important;
	text-align: center;
}
.tabless-struck > tbody > tr > .td-strucktables{
	padding: 2px 15px;

}
.subtotal-tdtransaction{
    text-align: -webkit-right;
    padding-right: 173px;
    font-weight: bold;
}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Cetak Struk Kwitansi Transaksi</h1>
		</div>
		<input type="hidden" value="<?php echo $_GET['id'];?>">
		<div class="main-headerstruck">
			<div class="header-struck">
				<img style="padding: 4px 110px;" src="<?php echo $site;?>frontend/icon/desain-struck.png"></img>
				<div class="main-userkd_trans"><?php echo $_GET['id'];?></div> 
				<p style="text-align:center;font-weight:bold;">Jln. Wates Km 7,8 Telp 086434545 Gamol Rt 07 Rw 17 Balecatur Gamping Sleman, Yogyakarta</p>
			</div>
			<div class="main-userborder">
				<div class="main-userstruck">
					<div>
						<label>Nama</label>
						<span style="margin-left:14px;">: <?php echo $get_userhotel['nama_lengkap']?></span>
					</div>
					<div>
						<label>Alamat</label>
						<span style="margin-left:5px;">: <?php echo $get_userhotel['alamat'];?></span>
					</div>
				</div>
				<div class="main-userstruckright">
					<div>
						<label>Check in</label>
						<span style="margin-left:21px;">: <?php echo tgl_indo($get_userhotel['checkin']);?></span>
					</div>
					<div>
						<label>Check out</label>
						<span style="margin-left:10px;">: <?php echo tgl_indo($get_userhotel['checkout']);?></span>
					</div>
				</div>
			</div>
		</div>
		<table class="tabless-struck" border="1" width="100" cellspacing="2" cellpadding="2">
			<thead>
				<tr>
					<th class="th-strucktables">Room</th>
					<th class="th-strucktables">Kapasitas</th>
					<th class="th-strucktables">Harga Kamar</th>
					<th class="th-strucktables">Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="td-strucktables"><?php echo $gettransaksi['type_kamar'];?></td>
					<td class="td-strucktables"><?php echo $gettransaksi['deskripsi'];?></td>
					<td class="td-strucktables">Rp. <?php echo formatuang($gettransaksi['tarif']);?> / tax 10%(Rp.<?php echo formatuang($percent);?>) </td>
					<td class="td-strucktables">Rp. <?php echo formatuang($gettransaksi['tarif']+$percent);?></td>
				</tr>
				<!-- ==================== TRANSAKSI LAYANAN ================ -->
			<?php if($cek_layanan_tambahan['id_rental']!=0) {?>
			<?php $viewrental = mysqli_fetch_array(mysqli_query($konek,
				"SELECT * FROM rental r JOIN transaksi_layanan tl ON r.id_rental=tl.id_rental 
				 JOIN detail_booking_rental dbr ON dbr.id_rental=tl.id_rental WHERE tl.kd_booking='$_GET[id]'"));?>
				<tr>
					<th class="th-strucktables" style="padding: 11px;">Lain- Lain</td>
					<th colspan="3"></th>
				</tr>
				<tr>
					<td class="td-strucktables">Sewa Rental <?php echo $viewrental['kate_kendaraan']."  ".$viewrental['nama_kendaraan'];?></td>
					<td class="td-strucktables"> Dari tanggal <?php echo tgl_indo($viewrental['tgl_awal_sewa'])." S/d " .tgl_indo($viewrental['tgl_akhir_sewa']);?></td>
					<td></td>
					<td class="td-strucktables">Rp.<?php echo formatuang($viewrental['harga_kendaraan']);?></td>
				</tr>
			<?php }else{ ?>
			<?php } ?>
			<?php if($cek_layanan_tambahan['id_laundry']!=0) { ?>
			<?php $view_laundry = mysqli_fetch_array(mysqli_query($konek,
				"SELECT * FROM laundry l JOIN transaksi_layanan tl ON l.id_laundry=tl.id_laundry WHERE tl.kd_booking='$_GET[id]'"));?>
				<tr>
					<td class="td-strucktables">Laundry</td>
					<td class="td-strucktables">Jenis <?php echo $view_laundry['jenis_laundry'];?></td>
					<td class="td-strucktables"><?php echo $view_laundry['ket_laundry'];?></td>
					<td class="td-strucktables">Rp.<?php echo formatuang($view_laundry['harga_laundry']);?></td>
				</tr>
			<?php }else{ ?>
			<?php } ?>
			<?php if ($cek_layanan_tambahan['id_paket']!=0){?>
				<?php $view_paket = mysqli_fetch_array(mysqli_query($konek,
				"SELECT * FROM paket p JOIN detail_paket dp ON dp.id_paket=p.id_paket JOIN transaksi_layanan tl ON p.id_paket=tl.id_paket WHERE tl.kd_booking='$_GET[id]'"));?>
				<tr>
					<td class="td-strucktables">Restaurant</td>
					<td class="td-strucktables">Jenis <?php echo $view_paket['nama_paket'];?></td>
					<td class="td-strucktables"><?php echo removeStripslases($view_paket['keterangan_menunya']);?></td>
					<td class="td-strucktables">Rp.<?php echo formatuang($view_paket['harga_paket']);?></td>
				</tr>
			<?php }else{?>
			<?php } ?>
			<?php if($cek_layanan_tambahan['id_extrabed']!=0) {?>
			<?php $view_extrabed = mysqli_fetch_array(mysqli_query($konek,
				"SELECT * FROM extrabed e JOIN transaksi_layanan tl ON e.id_extrabed=tl.id_extrabed WHERE tl.kd_booking='$_GET[id]'"));?>
				<tr>
					<td class="td-strucktables">Extrabed</td>
					<td class="td-strucktables"></td>
					<td class="td-strucktables"></td>
					<td class="td-strucktables">Rp.<?php echo formatuang($view_extrabed['harga_extrabed']);?></td>
				</tr>
			<?php }else{ ?>
			<?php } ?>
				<tr>
					<td class="td-strucktables" colspan="3">Subtotal</td>
					<td class="td-strucktables">Rp.<?php echo formatuang($gettransaksi['total_biayasewa']);?></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<th class=""></th>
			</tr>
		</table>
		<div style="margin-top:40px;margin-bottom:50px;">
			<button type="submit" class="action-print" onclick="windowprint();">Cetak Transaksi</button>
		</div>
	</div>
</div>