<?php include 'fungsi/function_transaksi.php'; 
	//get url id
	$getid     = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$_GET[id]'"));
	//get price , tarif , fasilitas, id
	$get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$_GET[id]'"));
	//deklarasi variable tarif
	$tarifnya = $get_price['tarif'];
	$x 		  = $get_price['id_kategori_kamar'];
	//buat diskon
	$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$_GET[id]'"));
	//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
	$diskon_kamar = $getdiskon['besar_diskon'];
	$y  		  = $getdiskon['id_kategori_kamar'];
	//catatan mengitung percent ((harga/100)*berapa persent));
 	$tentukan_percent = (($get_price['tarif']/100)*10);
	$total_price = ($get_price['tarif']+$tentukan_percent);
	
	$potongan_price = (($total_price*$diskon_kamar)/100);
	$harga_merge_diskon = $total_price-$potongan_price;

	/*$available_discount = ($diskon_tersedia-$available_discount);
	$yang_harusdibayar  = ($tarifnya-$available_discount)*/
	
?>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Features package</li>
          <li class="active">More information</li>
        </ol>
		<input type="hidden" value="<?php echo $_GET['id']?>">
		<div class="row">
			<div class="col-md-5">
				<img class='img-responsive' src='<?php echo $site; ?>uploads/kamar/<?php echo $getid["foto_kamar"];?>'>				
			</div>
				<div class="col-md-6">
					<strong><p style="font-size:29px;"><?php echo $getid['type_kamar'] ?></p></strong>
					<?php if ($x == $y)  { ?>
						<span class="prizer-colored line-through"> Rp.<?php echo formatuang($total_price)." / malam"?></span> discount jadi
						<span class="prizer-colored"> Rp.<?php echo formatuang($harga_merge_diskon);?></span>
						<div>
							discount <?php echo $getdiskon['besar_diskon'];?> &#37; |
							keterangan diskon : <?php echo $getdiskon['keterangan_diskon']; ?>
						</div>
					<?php }elseif ($y =='') { ?>
							<div>discount (tidak tersedia)</div>	
							<span class="prizer-colored">Rp.<?php echo formatuang($total_price)." / malam";?></span> 
					<?php } ?>
					<strong><h4>Description Room</h4></strong>
					<p class="inner-deskripsitext">Fasilitas Hotel : <?php echo $get_price['fasilitas'];?></p>
					<p class="inner-"><?php echo $get_price['deskripsi'];?></p>
					<p>Kapasitas ruangan 2 orang namun jika anda butuh extrabed tambahan kami akan sigap mempersiapkan nya segera.</p>
					<p>Ukuran ruangan 3,25 x 4m</p>
				</div>
			</div>
		</div>
	</div>
</div>
					
