<?php session_start();
include  "config/koneksi.php";
include 'fungsi/function_transaksi.php';
if (empty($_SESSION['id_member'])) {
    echo "<script>alert('Maaf anda harus login terlebih dahulu !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=auth/session_log/signin.php>";
}else {
	
?>
<script type="text/javascript">
	$(document).ready(function() {
	  // jquery tabs
	  $(".tabs-menu a").click(function(event) {
	    event.preventDefault();
	    $(this).parent().addClass("current");
	    $(this).parent().siblings().removeClass("current");

	    var tab = $(this).attr("href");
	    $(".tab-content").not(tab).css("display", "none");
	    $(tab).fadeIn();
  	});
		//jquery validation resrve person
		$('#reserve-person').validate({
			rules:{
				checkin:{
					required:true,
				},
				checkout:{
					required:true,
				},
				id_kategori_kamar:{
					required:true,
				},
				qty_reserve:{
					required:true,
				},
				
			},
			messages:{
				checkin:{
					required:"Tanggal Check In tidak boleh kosong !!",
				},
				checkout:{
					required:"Tanggal Check Out tidak boleh kosong !!",
				},
				id_kategori_kamar:{
					required:"Kategori kamar tidak boleh kosong !!",
				},
				qty_reserve:{
					required:"jumlah pemesan tidak boleh kosong !!",
				},
			}
		});
		$('#reserve-atasnama').validate({
			rules:{
				nama_perusahaan:{
					required:true,
				},
				atas_nama:{
					required:true,
				},
				email_atasnama:{
					required:true,
					email:true,
				},
				checkin:{
					required:true,
				},
				checkout:{
					required:true,
				},
				id_kategori_kamar:{
					required:true,
				},
				qty_reserve:{
					required:true,
				}
			},
			messages:{
				nama_perusahaan:{
					required:"Nama perusahaan / Rombongan tidak boleh kosong !!",
				},
				atas_nama :{
					required:"Kolom atasnama tidak boleh kosong !!",
				},
				email_atasnama:{
					required:"Email anda tidak boleh kosong !!",
					email:"Email anda tidak valid !!",
				},
				checkin:{
					required:"Tanggal Check In tidak boleh kosong !!",
				},
				checkout:{
					required:"Tanggal Check Out tidak boleh kosong !!",
				},
				id_kategori_kamar:{
					required:"Kategori kamar tidak boleh kosong !!",
				},
				qty_reserve:{
					required:"jumlah pemesan tidak boleh kosong !!",
				},
			}
		});

		//layanan tambahan
		$('.contain-menulayanan').click(function(){
			/*e.preventDefault();*/
			$(".inner-mainlayanan").show('slow');
			
		});
			$(".cancel").click(function(e){
			e.preventDefault();
				$(this).parent().remove();
			});

		//datepicker reserve personal 
		$('#datepicker-reservepersonal').Zebra_DatePicker({
        	direction: true,
        	pair: $('#datepicker-example7-end')
    	});
    	$('#datepicker-reservepersonal-end').Zebra_DatePicker({
        	direction: 1
    	});

    	//datepicker reserve instansi
    	$('#datepicker-reserveintansi').Zebra_DatePicker({
    		direction:true,
    		pair:$('#datepicker-example7-end')
    	});
    	$('#datepicker-reserveintansi-end').Zebra_DatePicker({
    		direction:1
    	});


    	//datepicker reserve rental person
		$('#datepicker-reserverentalperson').Zebra_DatePicker({
        	direction: true,
        	pair: $('#datepicker-example7-end')
    	});
    	$('#datepicker-reserverentalperson-end').Zebra_DatePicker({
        	direction: 1
    	});

    	//datepicker reserve rental instansi
		$('#datepicker-rentalinstansi').Zebra_DatePicker({
        	direction: true,
        	pair: $('#datepicker-example7-end')
    	});
    	$('#datepicker-rentalinstansi-end').Zebra_DatePicker({
        	direction: 1
    	});



		//jquery clone select append reserve atasnama
		$('.tambah-kategori-kamar').click(function(e) {
			e.preventDefault();
			//alert function kamar
			alert('anda ingin tambah kamar lagi..?');

			var new_cat = $('.kategori-kamar div.a').clone();
			var new_nokamar = $('.no_kamar div.c').clone();

			$('#select0').append(new_cat);
			$('#select0').append(new_nokamar);

			$('.removed').click(function(e){ //user click on remove text
	        	e.preventDefault(); 
	        	$(this).parent().remove();
	    	});
		});

		//reservasi personal
		//get json encode kategori kamar = no kamarnya otomatis sesuai kategori kamarnya
		$("#change-room").change(function(){
			var getValues = $(this).val();

			if (getValues == 0) {
				$("#choose-noroom").html("<option>Pilih kamarnya dulu !!</option>");

			}else{

				$.getJSON('getdata_nokamar.php',{'id_kategori_kamar' : getValues},
					function(data){
						var tampildatanya1;
						var tampildatanya2;

						$.each(data, function(index,value){
							tampildatanya1 +="<option>"+value.id_kamar+"</option>";
							tampildatanya2 +="<option>"+value.tarif+"</option>";
						})
						$("#choose-noroom").html(tampildatanya1);	
						$("#choose-noroomprice").html(tampildatanya2);	
				})
			}
		});

		//reservasi atasnama 
		//get json encode kategori kamar = no kamarnya otomatis sesuai kategori kamarnya
		$('#change-roomatasnama').click(function(){
			var getValues = $(this).val();

			if (getValues == 0) {
				$('#choose-noroomatasnama').html("<option>Pilih kamarnya dulu !!</option>");

			}else{

				$.getJSON('getdata_nokamar.php',{'id_kategori_kamar' : getValues},
					function(data){
						var tampildatareservasi_atasnama;
						$.each(data, function(index,value){
							tampildatareservasi_atasnama +="<option>"+value.id_kamar+"</option>";

						})
						$('#choose-noroomatasnama').html(tampildatareservasi_atasnama);
				
				})

			}

		});

		//reservasi atasnama jquery append this parent !!
		//get json encode kategori kamar = no kamarnya otomatis sesuai kategori kamarnya
		$('#change-roomatasnama_append').click(function(){
			var getValues = $(this).val();

			if (getValues == 0) {
				$('#choose-noroomatasnama_append').html("<option>Pilih kamarnya dulu !!</option>");

			}else{

				$.getJSON('getdata_nokamar_append.php',{'id_kategori_kamar' : getValues},
					function(data){
						var tampildatareservasi_atasnama_append;
						$.each(data, function(index,value){
							tampildatareservasi_atasnama_append +="<option>"+value.id_kamar+"</option>";

						})
						$('#choose-noroomatasnama_append').html(tampildatareservasi_atasnama_append);
				
				})

			}

		});



		//get json encode rental  = id rental  otomatis sesuai kategori rental person / personal
		$("#change-rentperson").change(function(){
			var getValues = $(this).val();

			if (getValues == 0 || "") {
				$("#choose_rentpriceperson").html("<option>Pilih rental dulu !!</option>");

			}else{

				$.getJSON('getdata_rental.php',{'id_rental' : getValues},
					function(data){
						var showdata;
						$.each(data, function(index,value){
							showdata +="<option>"+value.harga_kendaraan+"</option>";
						})
						$("#choose_rentpriceperson").html(showdata);	
					})
			}
		});


		//get json encode rental  = id rental  otomatis sesuai kategori rental atasnama / rombongan
		$("#change-rentalatasnama").change(function(){
			var getValues = $(this).val();

			if (getValues == 0 || "") {
				$("#choose_rentpriceatasnama").html("<option>Pilih rental dulu !!</option>");

			}else{

				$.getJSON('getdata_rental.php',{'id_rental' : getValues},
					function(data){
						var showdata;
						$.each(data, function(index,value){
							showdata +="<option>"+value.harga_kendaraan+"</option>";
						})
						$("#choose_rentpriceatasnama").html(showdata);	
					})
			}
		});


	}); 
</script>
</head>
<style type="text/css">

	.heading-reserve{
		font-size: 16px;
    	margin: 10px 0px;
    	color: #E36C1A;
	}
	.removed{
		cursor: pointer;
	}
	.dateinput{
		cursor: pointer;
	}
/*=== JQUERY ERROR CONFIG ====*/
	.error{
		color: #E60000;
		border-color: #E60000;
		display: block;
	}
	.navigation-add{
		display: inline-block;
		margin-top: 5px;
		margin-bottom: 5px;
		margin-left: 5px;
	}
	.navigation-add .tambah-kategori-kamar{
		text-decoration: none;
		color: #E36C1A;

	}
	.bingkai-reserve{
	    font-size: 12px;
	    padding: 20px;
	    border: 1px solid #DCDCDC;
	    margin-bottom: 20px;
	}

	/* JQUERY TABS */
	.tabs-menu {
		height: 30px;
		float: left;
		clear: both;
		font-size: 12px;
	}

	.tabs-menu li {
		height: 30px;
		line-height: 30px;
		float: left;
		margin-right: 5px;
		background-color: #ccc;
		border-top: 1px solid #d4d4d1;
		border-right: 1px solid #d4d4d1;
		border-left: 1px solid #d4d4d1;
	}

	.tabs-menu li.current {
		position: relative;
		background-color: #fff;
		border-bottom: 1px solid #fff;
		z-index: 5;
	}

	.tabs-menu li a {
		padding: 10px;
		text-transform: uppercase;
		color: #fff;
		text-decoration: none;
	}

	.tabs-menu .current a {
	  	color: #E36C1A;
	}		

	.tab {
		border: 1px solid #d4d4d1;
		background-color: #fff;
		float: left;
		margin-bottom: 20px;
		width: auto;
	}

	.tab-content {
		width: 660px;
		display: none;
	}

	#tab-1 {
		display: inline-block;
		width: 70%;
		height: auto;
	}

	#tab-2 {
		display: inline-block;
		width: 70%;
		height: auto;
	}

</style>
<div class="cnt-reserve">
	<div class="post-rulefontreserve">
		<h1 class="fnt-style">FORM RESERVATION'S HOTEL BALECATUR INN</h1>
		<div class="heading-breadcumb">
			<ul>
				<li>Home >> moreinformation >> Reservation</li>
			</ul>
		</div>
		
<div id="tabs-container">
	<ul class="tabs-menu">
		<li class="current"><a href="#tab-1">Reservation Personal</a></li>
		<li><a href="#tab-2">Reservation Atasnama PT / CV (Instansi) / Rombongan</a></li>
	</ul>

	<!--============= RESERVATION PERSONAL=============== -->

  	<div id="tab-1" class="tab-content">
		<form id="reserve-person" action="<?php echo $site;?>modulpage/proses/reservationproses.php?act=booking" method="post" enctype="multipartformdata">
		<section class="bingkai-reserve">
		<h3 class="heading-reserve">RESERVATION PERSONAL</h3>
		<div class="form-grupingbox">
			<input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>" class="form-box box-input cursorkodebook">	
		</div>
		<div class="form-grupingbox">
			<label>Kode booking</label>
			<input type="text" name="kd_booking" value="<?php echo acakangkahuruf(6); ?>" class="form-box box-input cursorkodebook" readonly required="">
		</div>
		<div class="form-grupingbox">
			<label>Nama Pemesan</label>
			<input type="text" name="nama_lengkap" value="<?php echo $_SESSION['nama_lengkap'];?>" class="form-box box-input cursorkodebook" readonly required="">
		</div>
		<div>
			<label>Check In</label>
			<input type="text" name="checkin" class="form-box box-input cursorbox" id="datepicker-reservepersonal" autofocus required></td>
		</div>
		<div>
			<label>Check Out</label>
			<input type="text" name="checkout" value=""  class="form-box box-input cursorbox" id="datepicker-reservepersonal-end" autofocus required></td>
		</div>
		<div class="form-grupingbox">
			<label>Tipe kamar</label>
			<!-- jika kondisi get ID kategori kamarnya -->
			<?php if ($_GET['id']) { ?>
				<select name='id_kategori_kamar' id="change-room" class='form-select box-input kategori-kamar' style='cursor:pointer;' autofocus required>
				<?php
						$ambildata=mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$_GET[id]'");
						while ($data=mysqli_fetch_array($ambildata)) {
							echo "<option value='".$data['id_kategori_kamar']."'>".$data['type_kamar']."</option>";
						}
				?>
				</select>
		<div>
			<label>No Kamar</label>
				<select name="id_kamar" id="choose-noroom" class="form-select box-input kategori-kamar">
				<?php 
						$ambildata_kamar =mysqli_query($konek,"SELECT * FROM kategori_kamar km JOIN Kamar k ON k.id_kategori_kamar=km.id_kategori_kamar 
							WHERE k.id_kategori_kamar='$_GET[id]'");
						while ($data =mysqli_fetch_array($ambildata_kamar)) {
							echo "<option value='".$data['id_kamar']."'>".$data['no_kamar']."</option>";
						}
				?>	
			</select>
		</div>
		<div><!--form-grupingbox -->
			<label>Harga Kamar</label>
				<select name="harga_kamar" id="choose-noroom" class="form-select box-input kategori-kamar">
				<?php 
						$ambildata_kamar =mysqli_query($konek,"SELECT * FROM kategori_kamar km JOIN Kamar k ON k.id_kategori_kamar=km.id_kategori_kamar 
							WHERE k.id_kategori_kamar='$_GET[id]'");
						while ($data =mysqli_fetch_array($ambildata_kamar)) {
							echo "<option value='".$data['id_kategori_kamar']."'>".$data['tarif']."</option>";
						}
				?>	
			</select>
		</div>
		</div>
		<!-- jika kondisi not get ID kategori kamarnya -->
			<?php }else{ ?>

				<select name='id_kategori_kamar' id="change-room" class='form-select box-input kategori-kamar' style="cursor:pointer;" autofocus required>";
					<option value="">Choose room</option>
				<?php
						$ambildata=mysqli_query($konek,"SELECT * FROM kategori_kamar");
						while ($data=mysqli_fetch_array($ambildata)) {
							echo "<option value='".$data['id_kategori_kamar']."'>".$data['type_kamar']."</option>";
						}
				?>
				</select>
		</div>
		<div style="display:;">
			<label>No Kamar</label>
			<select name="id_kamar" id="choose-noroom" class="form-select box-input kategori-kamar add-false" readonly>
				<option value=""></option>		
			</select>
		</div>
		<!-- <div>
			<label>Harga Kamar</label>
			<select name="harga_kamar" id="choose-noroomprice" class="form-select box-input kategori-kamar">
				<option value=""></option>		
			</select>
		</div> -->
		<?php } ?>

		<div class="form-grupingbox">
			<label>Untuk berapa orang</label>
			<input type="number" name="qty_reserve" class="form-box box-input" autofocus required>
		</div>
		<div>
			<h3 class="style-menutmbhn">Layanan Tambahan</h3><span class="icon-imgmenu"></span>
		</div>
		<div class="container-menutmbhn">
			<div class="contain-menulayanan"><a class="notifclick" class="icon-pluslayanan">Klik disini</a>
				<div class="inner-mainlayanan">
					<h3 style="margin-bottom:10px;">SEWA RENTAL</h3>
					<label>Pilih Kendaraan</label>
						<select name="id_rental" id="change-rentperson" class="form-select box-input" style="cursor:pointer;">
							<option value="">- pilih kendaraan -</option>
							<?php

								$getrental = mysqli_query($konek,"SELECT * FROM rental ORDER BY id_rental ASC");
								while ($data = mysqli_fetch_array($getrental)) {
									echo "<option value='".$data['id_rental']."'>".$data['nama_kendaraan']."</option>";
								}
							?>
						</select>
						<label>Harga Kendaraan</label>
						<select name="harga_rental" id="choose_rentpriceperson" class="form-select box-input" style="cursor:pointer;">
							<option value=""></option>
						</select>
						<div>
							<label>Dari Tanggal</label>
							<input type="text" name="tgl_awal_sewa" class="form-box box-input dateinput" id="datepicker-reserverentalperson">
						</div>
						<div>
							<label>Sampai tanggal</label>
							<input type="text" name="tgl_akhir_sewa" class="form-box box-input dateinput" id="datepicker-reserverentalperson-end">
						</div>

						<h3 style="margin-top:10px;"> EXTRA BED </h3>
						<div style='margin-top:10px;'>
							<label>Extra Bed </label>
							<?php 
								$get_etrabed = mysqli_query($konek,"SELECT * FROM extrabed");
								while ($data =mysqli_fetch_array($get_etrabed)) {
							?>
							<input type="checkbox" style="cursor:pointer;" name="id_extrabed" value="<?php echo $data['id_extrabed'];?>">
							<?php } ?>
							<p style="font-family:arial,sans-serif;">*Jika anda ingin extra bed tambahan centang pada bagian kolom extrabed</p>
						</div>
						<div class="cancel removed">batal</div>
				</div><!-- inner-mainlayanan -->	
			</div><!-- contain-menulayanan -->
			</div><!-- container-menutmbhn -->
			<div style="margin-bottom:20px;">
				<input type="submit" class="btn btn-reserve" value="Pesan Sekarang">
			</div>
		</form>
		</div>
		</section>
	</div><!-- tab-1 tab-content-->


	<!-- ============= RESERVATION ATASNAMA ================ -->

    <div id="tab-2" class="tab-content" style="display:none;">
		<form id="reserve-atasnama" action="<?php echo $site;?>modulpage/proses/reservationproses.php?act=booking_instansi" method="post" enctype="multipartformdata">
		<section class="bingkai-reserve">
		<h3 class="heading-reserve">RESERVATION ATASNAMA</h3>
		<div class="form-grupingbox">
			<input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>" class="form-box box-input cursorkodebook">	
		</div>
		<div class="form-grupingbox">
			<label>Kode booking</label>
			<input type="text" name="kd_booking" value="<?php echo acakangkahuruf(6); ?>" class="form-box box-input cursorkodebook" readonly required="">
		</div>
		<div class="form-grupingbox">
			<label>Nama Pemesan</label>
			<input type="text" name="nama_lengkap" value="<?php echo $_SESSION['nama_lengkap'];?>" class="form-box box-input cursorkodebook" readonly required="">
		</div>
		<div class="form-grupingbox">
			<label>Nama Perusahaan / Rombongan </label>
			<input type="text" name="nama_perusahaan" value="" class="form-box box-input" required="">
		</div>
		<div class="form-grupingbox">
			<label>Atas Nama / Kpd Yth</label>
			<input type="text" name="atas_nama" value="" class="form-box box-input" required="">
		</div>
		<div class="form-grupingbox">
			<label>Email Atas Nama yang dituju</label>
			<input type="text" name="email_atasnama" value="" class="form-box box-input" required="">
		</div>

		<!-- CLONE FORM  SELECT -->
		
		<div>
			<label>Check In</label>
			<input type="text" name="checkin" id="datepicker-reserveintansi" class="form-box box-input cursorbox"  required=""></td>
		</div>
		<div>
			<label>Check Out</label>
			<input type="text" name="checkout" id="datepicker-reserveintansi-end" class="form-box box-input cursorbox"  required=""></td>
		</div>
		<div class="form-grupingbox">
			<label>Tipe kamar</label>
			<?php if ($_GET['id']) { ?>
				<select name='id_kategori_kamar[]' id="change-roomatasnama" class='form-select box-input'autofocus required>
				<?php
						$ambildata=mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$_GET[id]'");
						while ($data=mysqli_fetch_array($ambildata)) {
							echo "<option value='".$data['id_kategori_kamar']."' name='reques'>".$data['type_kamar']."</option>";
						}
				?>
				</select>

			<?php }else{ ?>
				<select name='id_kategori_kamar[]' id="change-roomatasnama" class='form-select box-input' autofocus required>";
					<option value="">Choose room</option>
				<?php
						$ambildata=mysqli_query($konek,"SELECT * FROM kategori_kamar");
						while ($data=mysqli_fetch_array($ambildata)) {
							echo "<option value='".$data['id_kategori_kamar']."' name='reques'>".$data['type_kamar']."</option>";
						}
				?>
				</select>
			<?php } ?> 
		</div>
		<div id="select0">
			<a href="javascript:;" style="font-size:12px;text-decoration:none;color:#DD4814;" class="tambah-kategori-kamar">+ add room ( jika anda memesan lebih dari satu tipe kamar )</a>
		</div>
		<div>
			<label>No Kamar</label>
			<select name="id_kamar[]" id="choose-noroomatasnama" class="form-select box-input kategori-kamar">
				<option value=""></option>		
			</select>
		</div>
		<div class="form-grupingbox">
			<label>Untuk berapa orang</label>
			<input type="number" name="qty_reserve" class="form-box box-input" autofocus required>
		</div>

		<div>
			<h3 class="style-menutmbhn">Layanan Tambahan</h3><span class="icon-imgmenu"></span>
		</div>
		<div class="container-menutmbhn">
			<div class="contain-menulayanan"><a class="notifclick" class="icon-pluslayanan">Klik disini</a>
				<div class="inner-mainlayanan">
				<h3 style="margin-bottom:10px;"> SEWA RENTAL </h3>
					<label>Pilih Kendaraan</label>
					<select name="id_rental" id="change-rentalatasnama" class="form-select box-input" style="cursor:pointer;">
						<option value="">- pilih kendaraan -</option>
						<?php

							$getrental = mysqli_query($konek,"SELECT * FROM rental ORDER BY id_rental ASC");
							while ($data = mysqli_fetch_array($getrental)) {
								echo "<option value='".$data['id_rental']."'>".$data['nama_kendaraan']."</option>";
							}
						?>
					</select>
				<label>Harga Kendaraan</label>
					<select name="harga_rental" id="choose_rentpriceatasnama" class="form-select box-input" style="cursor:pointer;">
						<option value=""></option>
					</select>
				<div>
					<label>Dari Tanggal</label>
					<input type="text" name="tgl_awal_sewa" class="form-box box-input dateinput" id="datepicker-rentalinstansi">
				</div>
				<div>
					<label>Sampai tanggal</label>
					<input type="text" name="tgl_akhir_sewa" class="form-box box-input dateinput" id="datepicker-rentalinstansi-end">
				</div>
				<h3 style="margin-top:10px;"> EXTRA BED </h3>
				<div style='margin-top:10px;'>
					<label>Extra Bed </label>
					<input type="checkbox"  style="cursor:pointer;" name="extrabed" value="Ya">
				</div>
				</div><!-- inner-mainlayanan -->	
			</div><!-- contain-menulayanan -->
		</div><!-- container-menutmbhn -->
		<div style="margin-bottom:20px;">
			<input type="submit" class="btn btn-reserve" value="Pesan Sekarang">
		</div>
		</section>
		</form>
		<!-- CLone form kategori kamar--> 
		<div style="display:none;" class="kategori-kamar">
			<div class="a">
				<select name="id_kategori_kamar[]" class="form-select box-input" id="change-roomatasnama_append" autofocus required>
					<option value=""> Choose room </option>
					<?php 
						$ambildata=mysqli_query($konek,"SELECT * FROM kategori_kamar");
						while ($data=mysqli_fetch_array($ambildata)) {
							echo "<option value='".$data['id_kategori_kamar']."'>".$data['type_kamar']."</option>";
						}
					?>
				</select>
				<div class="removed">batal</div>
			</div>
		</div>

		<!-- clone form no kamar -->
		<div style="display:none;" class="no_kamar">
			<div class="c">
				<label>No Kamar</label>
				<select name="id_kamar[]" id="choose-noroomatasnama_append" class="form-select box-input kategori-kamar">
					<?php
						$getnokamar =mysqli_query($konek,"SELECT * FROM kamar");
						while ($y =mysqli_fetch_array($getnokamar)) {
							echo "<option value='".$y['id_kamar']."'>".$y['id_kamar']."</option>";
						}
					?>
					<!-- <option value=""></option> -->		
				</select>
				<div class="removed">batal</div>
			</div>
		</div>


		</div>
	</div><!-- post-rulefont -->
</div><!-- cnt-reserve -->

<?php } ?>



