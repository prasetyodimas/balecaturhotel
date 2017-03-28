<?php session_start();

	include "config/koneksi.php";
	include "fungsi/tgl_indo.php";
	
	$user=$_SESSION['id_member'];

?>
<style type="text/css">

.content-statususer{
		width: 100%;
	    height: auto;
	    display: inline-block;
	    margin-top: 20px;
}
.alink-confirm{
		color: #E36C1A;
}
.notifier-user{
	    color: #000;
	    font-family: arial,sans-serif;
	    font-size: 12px;
	    line-height: 20px;
        margin-top: 10px;
}
.confirmation-user{
		font-size: 14px;
		font-family: arial,sans-serif;
		margin-top: 10px;
		line-height: 22px;
}
.statTransaksi{
		margin-left: 108px;
}
.kdbooking{
		margin-left: 200px;
}
.idmember{
		margin-left: 219px;
}
.NamaPemesan{
		margin-left: 186px;
}
.TipeKamar{
		margin-left: 215px;
}
.HargaKamar{
		margin-left: 203px;
}
.Checkin{
		margin-left: 237px;
}
.Checkout{
		margin-left: 228px;
}
.accKamar{
		margin-left: 225px;
}
.berapaOrang{
		margin-left: 162px;
}
.JenisPembayaran{
		margin-left: 171px;
}
.JumlahBayar{
		margin-left: 202px;
}
.JenisBank{
		margin-left: 220px;
}
.SewaRental{
		margin-left: 213px;
}
.ExtraBed{
		margin-left: 235px;
}
.SisaPembayaran{
		margin-left: 32px;
}
</style>
<div class="cnt-reserve">
	<div class="post-rulefontorder">
		<h1 class="fnt-style">FORM MY ORDER HOTEL BALECATUR INN</h1>
		<div class="heading-breadcumb">
			<ul>
				<li>Home >> My order</li>
			</ul>
		</div>
	<div class="main-ordercontainerprimary">
	<div class="left-sidebarorder">
		<div class="panel-dashboarduser">DASHBOARD USER</div>
		<div class="inner-sidebarleft">
			<ul>
				<?php 
					$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					if($url == $site."index.php?modul=myorder") {
						$urla = "active";
					}
				?>
				<li><a class="none-underline <?php echo $urla; ?>" href="<?php echo "$site"."index.php?modul=myorder";?>">My order</a></li>
				<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=manageakun";?>">My Profil</a></li>
			</ul>
		</div>
	</div>
	<div class="mid-containerordered">
		<div>
			<h5>Konfirmasi Order & Detail Transaksi</h5>
		</div>
		<div><a style="font-size:12px;color:#E36C1A;" href="javascript:history.back();"><~ Go Back</a></div>
			
		<?php 
			//get status reservasi
			$getstat_reserve = "SELECT * FROM booking WHERE kd_booking='$_GET[id]'";
			$savedquery =mysqli_query($konek,$getstat_reserve);
			$res = mysqli_fetch_array($savedquery);

					if ($res['stat_reservation']=='person') {
						$status_booking="Reservasi Personal";
					}elseif($res['stat_reservation']=='atasnama') {
						$status_booking ="Reservation Atasnama PT / CV (Instansi)";
					}	
		
		?>
		
		<div class="confirmation-user">
		<p> Status Transaksi / Reservasi <span class="statTransaksi">: <?php echo $status_booking; ?></span></p>

		<?php
			//view pemesan
			$getbooking = mysqli_query($konek,"SELECT * FROM booking b JOIN member m ON b.id_member=m.id_member
																	   JOIN kategori_kamar km ON b.id_kategori_kamar=km.id_kategori_kamar
																	   JOIN kamar k  ON  b.id_kamar=k.id_kamar
																	   WHERE kd_booking='$_GET[id]'");

				while ($data=mysqli_fetch_array($getbooking)) {

				$bayarnya   =$data['jumlah_bayar'];
				$tarifkamar =$data['tarif'];	
		?>

		<div>
			<p>Kode Booking <span class="kdbooking">: <?php echo $data['kd_booking']?></span></p>
		</div>
		<div>
			<p>Id Member <span class="idmember">: <?php echo $data['id_member']?></span></p>
		</div>
		<div>
			<p>Nama Pemesan <span class="NamaPemesan">: <?php echo $data['nama_lengkap']?></span></p>
		</div>
		<div>
			<?php if ($data['stat_reservation']=='atasnama') {

				echo "<div>
						<p>Nama Perusahaan <span class='companyname'>: $data[nama_perusahaan]</span></p>
					  </div>";
				} 

			?>
		</div>
		<div>
			<p>Tipe Kamar <span class="TipeKamar">: <?php echo $data['type_kamar']?></span></p>
		</div>
		<div>
			<p>Harga Kamar <span class="HargaKamar">: Rp.<?php echo number_format("$tarifkamar",0,",",".").',-'; ?></span></p>
		</div>
		<div>
			<p>Checkin <span class="Checkin">: <?php echo tgl_indo($data['checkin']);?></span></p>
		</div>
		<div>
			<p>Checkout <span class="Checkout">: <?php echo tgl_indo($data['checkin']);?></span></p>
		<div>
		<?php
			//acc booking dan update status
			$getbooking = mysqli_query($konek,"SELECT * FROM booking WHERE kd_booking='$_GET[id]'");
											   while ($data2=mysqli_fetch_array($getbooking)){
		?>
	<form action="<?php echo "$site"."modulpage/proses/konfirmasi_userproses.php?act=konfrimasi_transaksi";?>" method="post" id="confrimation_form" enctype="multipart/form-data">
		<section style="width:30%;">
			<div style="display:none;">
				<input type="text" name="kd_booking"  class="form-control" value="<?php echo $data['kd_booking']?>">
				<input type="text" name="id_member"  class="form-control" value="<?php echo $data['id_member']?>">
				<input type="text" name="id_kategori_kamar"  class="form-control" value="<?php echo $data['id_kategori_kamar']?>">
				<input type="text" name="id_paket"  class="form-control" value="<?php echo $data['id_paket']?>">
				<input type="text" name="id_rental"  class="form-control" value="<?php echo $data['id_rental']?>">
				<input type="text" name="id_laundry"  class="form-control" value="<?php echo $data['id_laundry']?>">
				<input type="text" name="nama_perusahaan"  class="form-control" value="<?php echo $data['nama_perusahaan']?>">
				<input type="text" name="atas_nama"  class="form-control" value="<?php echo $data['atas_nama']?>">
				<input type="text" name="email_atasnama"  class="form-control" value="<?php echo $data['email_atasnama']?>">
				<input type="text" name="checkin"  class="form-control" value="<?php echo $data['checkin']?>">
				<input type="text" name="checkout"  class="form-control" value="<?php echo $data['checkout']?>">
				<input type="text" name="qty_reserve"  class="form-control" value="<?php echo $data['qty_reserve']?>">
				<input type="text" name="extrabed"  class="form-control" value="<?php echo $data['extrabed']?>">
				<input type="text" name="status"  class="form-control" value="2">
				<input type="text" name="id_kamar"  class="form-control" value="1">
				<input type="text" name="stat_reservation"  class="form-control" value="<?php echo $data['stat_reservation']?>">
			</div>
		</section>
		<div>
			<p>Kamar No <span class="accKamar"> : Kamar no <?php echo $data['no_kamar'];?>
		</div>
			
		<div style="margin-bottom:20px;">
			<p>Untuk berapa orang <span class="berapaOrang">: <?php echo $data['qty_reserve']?> Orang</span></p>
		</div>
		<div>
	   		<label style="font-weight:bold;">Konfrimasi Pembayaran</label>
		</div>

	<?php }  ?>

	<?php  

		//view status konfrimasi pembayaran
		$getkonfrimasi = "SELECT * FROM booking bk jOIN knfrimasi_pmbyaran kp  
								   ON kp.kd_booking=bk.kd_booking WHERE kp.kd_booking='$_GET[id]'";

		$savekonfrim =mysqli_query($konek,$getkonfrimasi);
		$hasilnya    =mysqli_fetch_array($savekonfrim);

		$status_booking =$hasilnya['status'];
		$bayar =$hasilnya['jumlah_bayar'];

		$SisaPembayaran = ($tarifkamar-$bayar);

		if ($hasilnya =='' OR $hasilnya == null) {
			$statuskonfrim ="disabled";
		}else{
			$statuskonfrim ="none";
		}

		if ($bayar=="") {

	   echo"<div>
				<p>Jenis Pembayaran <span class='JenisPembayaran'>: -</span></p>
			</div>
			<div>
				<p>Jumlah Bayar <span class='JumlahbelumBayar'>: Belum melakukan pembayaran !!</span></p>
			</div>
			<div>
				<p>Jenis Bank <span class='JenisBank'> : -</span></p>
			</div>";

		}else{

	   echo"<div>
				<p>Jenis Pembayaran <span class='JenisPembayaran'>: $hasilnya[jenis_pembayaran]</span></p>
			</div>
	  		<div>
				<p>Jumlah Bayar <span class='JumlahBayar'>"?> : Rp.<?php echo number_format("$bayar",0,",",".").',-';?></p>
			</div>	
		<?php if ($bayar='Lunas') { ?>

		
			<div>	
				<p>Jenis Bank <span class="JenisBank">: <?php echo $hasilnya['jenis_bank']?></span></p>
			</div>
		
		<?php }else{ ?>


			<div>
				<p>Sisa Pembayaran yang harus dibayarkan<span class="SisaPembayaran">: Rp.<?php echo number_format("$SisaPembayaran",0,",",".").',-'; ?> </span></p>
			</div>


		<?php } ?>




			<div style="margin-bottom:20px;"></div>
			<div>
				<label style="font-weight:bold;">Layanan Tambahan</label>
				<p>Sewa Rental<span class="SewaRental">: <?php echo $hasilnya['id_rental'];?></span></p>
			</div>
			<div>
				<p>ExtraBed<span class="ExtraBed">: <?php echo $hasilnya['extrabed'];?></span></p>
			</div>
	
		<article class="ketentuan-termsandcondition">
		<label>Keterangan :</label>
			* Jika dalam waktu 3 hari x 24 jam pelanggan tidak mengkonfrimasi pembayaran maka transaksi akan kami batalkan
			sesuai dengan peraturan kebijakan manajemen balecatur hotel.
		</article>		
	<?php } ?>
		<div style="margin-top:50px">
			<button type="submit" class="btn btn-small btn-success <?php echo $statuskonfrim; ?>" value="konfrimasi transaksi" onclick="return confirm('Konfrimasi transaksi sekarang..?')">Konfrimasi Pemesanan</button>
		</div>

	</form>
	<?php } ?>

		</div>
		</div><!-- confirmation-user -->
	</div>
</div>
</div>
</div>
</div>
</div>