<?php include '../fungsi/function_transaksi.php';
// variable post checkin and checkout
$tgl_checkin  = $_POST['checkin'];
$tgl_checkout = $_POST['checkout'];
$_SESSION['session_jumlah_kamar'] = $_POST['berapa_kamar'];
$jumlah_permintaan_tamu_untuk_kamarnya = $_SESSION['session_jumlah_kamar'];

//cek jika tgl_checkin nya kosong atau tgl_checkout nya kosong !!
if (empty($tgl_checkin) || empty($tgl_checkout)) {
	echo "<script>alert('Maaf tanggal checkin atau checkout anda tidak boleh kosong !!');</script>";
	echo "<script>history.go(-1);</script>";
}else{
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#submit-checkbox').submit(function(){
			// if checkbox is checked
	        if ($('input.checkbox_check').is(':checked')) { 
	            alert("Anda belum memilih kamar !!");
        		return false; 
	        }
		});
	});
</script>
<style type="text/css">
	.price{margin-left: 80px;}
	.number-room{margin-left: 20px;}
</style>
<div class="row">
	<div class="col-lg-12">
	<div id="tab-1" class="tab-content">
		<div class="font-sizerheading">
			<h1 class="page-header">Room Available</h1>
		</div>
		<form id="submit-checkbox" action="homeadmin.php?modul=man_checkmember" method="post" enctype="multipart/form-data">
		<input type="hidden" name="checkin_tgl" value="<?php echo $tgl_checkin;?>">
		<input type="hidden" name="checkout_tgl" value="<?php echo $tgl_checkout?>">
				<!-- <h4>Ketersediaan kamar tanggal <?php echo tgl_indo($tgl_checkin); ?> s/d <?php echo tgl_indo($tgl_checkout);?></h4> -->
					<?php
						//var post tanggal yg direquest
						$tgl_checkin  = $_POST['checkin'];
						$tgl_checkout = $_POST['checkout'];

						$no =1 ;
						$findandget = mysqli_query($konek,
									"SELECT km.id_kategori_kamar, km.type_kamar, km.tarif, km.fasilitas,km.foto_kamar, count(k.id_kamar) as stok_kmr
									FROM kamar k JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar
									WHERE k.status_kamar !='3'AND k.status_kamar='2' GROUP BY k.id_kategori_kamar ASC");
						//cek jika kamarnya masih ada yang kosong..?
						if (mysqli_num_rows($findandget) > 0 ) {
						while ($data=mysqli_fetch_array($findandget)) {
							if($data['stok_kmr'] >= $jumlah_permintaan_tamu_untuk_kamarnya) {
								$get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$data[id_kategori_kamar]'"));
				                //deklarasi variable tarif
				                $tarifnya = $get_price['tarif'];
				                $x        = $get_price['id_kategori_kamar'];
				                //buat diskon
				                $getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$data[id_kategori_kamar]'"));
				                //mendefinisikan get diskonya berdasarkan kamar yang ada diskon
				                $diskon_kamar = $getdiskon['besar_diskon'];
				                $y            = $getdiskon['id_kategori_kamar'];
				                //variable percent 10%
								$percent = (($data['tarif']*10)/100); 
					?>
						<div class="col-md-4">
							<img class="img-responsive" src='<?php echo $site;?>uploads/kamar/<?php echo $data['foto_kamar'];?>'>
							<div class="panel panel-default container-description">
								<div class="panel-heading">
									<p class="judul-roomfeatures"><?php echo $data['type_kamar'];?></p>
								</div>
								<div class="panel-body">
									<div class="container-description">
										<dt><dl>Description Room</dl></dt>
										<p>Price <span class="price">: <?php echo formatuang($data['tarif']+$percent);?> / Night</span></p>
										<?php if ($x == $y) { ?>
										<p>Diskon <span class="diskon">: <?php echo $diskon_kamar."%";?></span></p>
										<?php }elseif ($y=="") {?>
										<p>Diskon <span class="diskon">: -</span></p>
										<?php } ?>
										<p>Harga Sudah Termasuk Pajak 10%</p>
										<p><i class="fa fa-cutlery fa-fw"></i> Termasuk Breakfast Morning</p>
										<input type="checkbox" name="kategori_kamar[]" value="<?php echo $data['id_kategori_kamar']; ?>" style="cursor:pointer;">
										<strong style="color:#e36c1a;">BOOKING NOW</strong> 
									</div>
								</div>
							</div>
						</div>
					<?php  } } ?>
						<div class="col-lg-12">
							<div class="pull-right" style="margin-bottom:10px;">
								<button class="btn btn-primary">LANJUT</button>
							</div>
						</div>
				</form>
				<?php }else{echo "Maaf kamar tidak ada yang tersedia, silahkan anda check di tanggal lain terimakasih!";}?>
		<?php } ?>
		</div>
	</div>
</div>
