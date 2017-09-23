<?php include 'fungsi/function_transaksi.php';
if (empty($_POST['checkin']) AND empty($_POST['checkout']) AND empty($_POST['berapa_orang']) AND empty($_POST['berapa_kamar'])) {
	echo "<script>alert('Maaf tanggal checkin anda tidak boleh kosong !!')</script>";
	echo "<script>history.go(-1);</script>";
	exit();
}
// variable post checkin and checkout
  $_SESSION['session_checkin']  		 = $_POST['checkin'];
  $_SESSION['session_checkout']  		 = $_POST['checkout'];
  $_SESSION['session_jumlah_orang'] 	 = $_POST['berapa_orang'];
  $_SESSION['session_jumlah_kamar'] 	 = $_POST['berapa_kamar'];
  $jumlah_permintaan_tamu_untuk_kamarnya = $_SESSION['session_jumlah_kamar'];
?>
<style type="text/css">
	.price{margin-left: 80px;}
	.diskon{margin-left: 69px}
	.number-room{margin-left: 20px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">ROOM AVAILABLE</h1>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Check Avialable</li>
			  <li class="active">Room Avialable</li>
			</ol>
				<form action="backend/proses_tambah_kamar.php?act=adding_other_room&id=<?php echo $data['id_kategori_kamar']; ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Pencarian Kamar Telah ditemukan untuk <?php echo $_SESSION['session_jumlah_orang'];?> Orang dan <?php echo $_SESSION['session_jumlah_kamar']." Kamar";?>
							</div>
							<div class="panel-body">
								<h5 style="text-align:center;">Ketersediaan kamar tanggal
								<span style="color:#e36c1a;font-size:15px;"><?php echo tgl_indo($_SESSION['session_checkin']); ?> s/d <?php echo tgl_indo($_SESSION['session_checkout']);?></span></h5>
							</div>
						</div>
					</div>
				</div>
					<?php
						// cek jika tanggal sama atau tidak dengan user lain
						$cek_tgl_book_user = mysqli_query($konek,"SELECT b.checkin, b.checkout,

													FROM temp_booking tb
													JOIN booking b ON b.id_member=tb.id_member");

						$no =1;
						$findandget = mysqli_query($konek,
									"SELECT km.id_kategori_kamar,
									 		km.type_kamar,
									 		km.tarif,
									 		km.fasilitas,
									 		km.foto_kamar,
									 		km.jumlah_kamar_akhir,
									 		count(k.id_kamar) as stok_kmr
									FROM kamar k JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar
									WHERE km.jumlah_kamar_akhir!='0' GROUP BY km.id_kategori_kamar");
						//cek jika kamarnya masih ada yang kosong..?
						if (mysqli_num_rows($findandget) > 0 ) {
						while ($data=mysqli_fetch_array($findandget)) {
							if($data['jumlah_kamar_akhir'] >= $jumlah_permintaan_tamu_untuk_kamarnya) {
			                //deklarasi variable tarif
			                $tarifnya = $data['tarif'];
			                $x        = $data['id_kategori_kamar'];
			                //buat diskon
			                $getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$data[id_kategori_kamar]'"));
			                //mendefinisikan get diskonya berdasarkan kamar yang ada diskon
			                $diskon_kamar = $getdiskon['besar_diskon'];
			                $y            = $getdiskon['id_kategori_kamar'];
			                //variable percent 10%
							$percent = (($data['tarif']*10)/100);
							//cek jika kamar nya == 0 tidak akan tampil kamar tersebut !!
							//$stok_kamar_akhir = $data['jumlah_kamar_akhir'];
					?>
						<div class="col-md-4">
							<img class="img-responsive" src='<?php echo $site;?>uploads/kamar/<?php echo $data['foto_kamar'];?>'>
							<div class="panel panel-default container-description">
								<div class="panel-heading">
									<p class="judul-roomfeatures"><?php echo $data['type_kamar'];?></p>
								</div>
								<div class="panel-body">
									<div class="container-description">
										<input type="hidden" name="room" value="<?php echo $data['id_kategori_kamar'];?>">
										<dt><dl>Description Room</dl></dt>
										<p>Price <span class="price">: <?php echo formatuang($data['tarif']+$percent);?> / Night</span></p>
										<?php if ($x == $y) { ?>
										<p>Diskon <span class="diskon">: <?php echo $diskon_kamar."%";?></span></p>
										<?php }elseif ($y=="") {?>
										<p>Diskon <span class="diskon">: -</span></p>
										<?php } ?>
										<p><i class="fa fa-percent" aria-hidden="true"></i> Harga Sudah Termasuk Pajak 10%</p>
										<p><i class="fa fa-cutlery fa-fw"></i> Termasuk Breakfast Morning</p>
										<div class="row">
											<div class="col-lg-12">
												<a class="btn btn-block btn-custom-balecatur-hotel" href="backend/proses_tambah_kamar.php?act=adding_other_room&id=<?php echo $data['id_kategori_kamar'];?>">BOOKING NOW</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } } ?>
				<?php }else{echo "Maaf kamar tidak ada yang tersedia, silahkan anda check di tanggal lain terimakasih!";}?>
			</form>
		</div>
	</div>
</div>
