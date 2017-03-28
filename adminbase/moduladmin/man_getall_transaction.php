<?php include '../fungsi/function_transaksi.php'; error_reporting(0);
	//VAR POST CONVERT TO SESSION 
	$_SESSION['session_checkin'];
	$_SESSION['session_checkout'];
	$_SESSION['session_user'];
  	$_SESSION['sessi_kamar'];
	$userid  = $_SESSION['session_user'];
	//variable get tanggal user
	$getuser = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member WHERE id_member='$userid'"));
	// menghitung jumlah hari usernya atau lama menginap
	$var_days = round((strtotime($_SESSION['session_checkout'])-strtotime($_SESSION['session_checkin']))/86400);
?>
<script type="text/javascript">
	//show hide menu transaksi sewa rental
	$(document).ready(function(){
		$('.click-rental').click(function(){
			$('.btn-click-rental').slideToggle('slow');
		});
		$('.click-restorasi').click(function(){
			$('.btn-click-restorasi').slideToggle('slow');
		});
		$('.click-laundry').click(function(){
			$('.btn-click-laundry').slideToggle('slow');
		});
		$('.click_pembayaran').click(function(){
			$('.btn-click-pembayaran').slideToggle('slow');
		});
		$('.price-total').number(true);
		$('#val-gettransac').validate({
			rules:{
				berapa_orang:{
					required:true
				},
				jumlah_orang:{
					required:true
				},
				other_name:{
					required:true
				},
				nama_penghuni:{
					required:true
				},
			},
			messages:{
				berapa_orang:{
					required:'Jumlah orang menginap tidak boleh kosong !!',
				},
				jumlah_orang:{
					required:'Jumlah orang menginap tidak boleh kosong !!',
				},
				other_name:{
					required:'Nama perusahaan / Rombongan tidak boleh kosong !!',
				},
				nama_penghuni:{
					required:'Nama penghuni tidak boleh kosong !!',
				},
			},
		});
		//onchange function price rent
		$('select.change_values_rent').on('change',function(){
			var rentValue      = $('select.change_values_rent').find(':selected').data('id');
			var totalValue 	   = $('#total_transaksi_kamar').val();
			var subtotal_rents = parseFloat(rentValue)+parseFloat(totalValue); 
			$('.price-total').val(subtotal_rents);
			$('#price-total-nonconvert').val(subtotal_rents);
        	$('#total_all_trans').val(subtotal_rents);
		});
		//onchange function price paket
		$('select.change_values_paket').on('change',function(){
			var paketValue = $('select.change_values_paket').find(':selected').data('id');
			var totalValue = $('#price-total-nonconvert').val();
			var subtotal_paket = parseFloat(paketValue)+parseFloat(totalValue); 
			$('.price-total').val(subtotal_paket);
			$('#price-total-nonconvert').val(subtotal_paket);
        	$('#total_all_trans').val(subtotal_paket);
		});
        //onchange function laundry value
        $('select.change_values_laundry').on('change',function(){
			var laundryValue = $('select.change_values_laundry').find(':selected').data('id');
			var totalValue = $('#price-total-nonconvert').val();
			var subtotal_laundry = parseFloat(laundryValue)+parseFloat(totalValue);
			$('.price-total').val(subtotal_laundry);
			$('#price-total-nonconvert').val(subtotal_laundry); 
        	$('#total_all_trans').val(subtotal_laundry);
        });
		//onchange function get extrabed value
		$('input[type=checkbox]').on('change',function() {
			var extrabedValue  = $(this).attr('data-extrabed');
			var totalValue 	   = $('#price-total-nonconvert').val();
			var subtotal_bed   = parseFloat(extrabedValue)+parseFloat(totalValue);
			alert("Anda memesan extrabed extrabed tambahan");
			$('.price-total').val(subtotal_bed);
			$('#price-total-nonconvert').val(subtotal_bed);
        	$('#total_all_trans').val(subtotal_bed);
        });
        //hitung kembalian 
        $('#jumlah_yg_harus_dibayar').blur(function(){
        	var value_bayar    = $('#jumlah_yg_harus_dibayar').val();
        	var gettotal_trans = $('#total_all_trans').val();
        	var get_returnprice = parseFloat(value_bayar)-parseFloat(gettotal_trans);
        	$('#klik_kembalian').val(get_returnprice);
   		});
		//statement jika member radio clicked	
		$('input[type=radio][name=jenis_member]').click(function(){
			var member_person=$(this).val();
			$('.'+member_person).show();
			$('input[type=radio][name=jenis_member]').not(':checked').each(function(){
				var member_person_atasnama=$(this).val();
				$('.'+member_person_atasnama).hide();
			});
		});
		$('input[type=radio][name=pelunasan]').click(function(){
			var bayarDP=$(this).val();
			$('.'+bayarDP).show();
			$('input[type=radio][name=pelunasan]').not(':checked').each(function(){
				var bayarLunas=$(this).val();
				$('.'+bayarLunas).hide();
			});
		});
		//json change functon harga kendaraan
		$("#id_rental").change(function(){
            var getValue= $(this).val();
            if(getValue == 0) {
                $("#price_rents").html("<option value=''>Pilih rental nya dulu !!</option>");
                $("#kate_rents").html("<option value=''>Pilih rental nya dulu !!</option>");
                $("#desc_rents").html("<textarea>Pilih rental nya dulu !!</textarea>");
            }else{
            	$.ajax({
            		url:'json/getdata_rental.php',
            		type:'GET',
            		dataType:'json',
            		data: {'id_rental' : getValue},
            		success:function (data) {
            			if(data != '') {
	            			$.each(data,function(index,value){
		                        $("#price_rents").html("<option>"+value.harga_kendaraan+"</option>");
		                        $("#kate_rents").html("<option>"+value.kate_kendaraan+"</option>");
		             	        $("#desc_rents").val(value.ket_kendaraan);
	                        });
        				}
            		}
            	});
               
            }
        });
		$("#id_paket").change(function(){
            var getValue= $(this).val();
            if(getValue == 0) {
                $("#price_paket").html("<option value=''>Pilih restorasi nya dulu !!</option>");
                $("#desc_menu").html("<textarea>Pilih restorasi nya dulu !!</textarea>");
            }else{
            	$.ajax({
            		url:'json/getdata_paket.php',
            		type:'GET',
            		dataType:'json',
            		data: {'id_paket' : getValue},
            		success:function (data) {
            			if(data != '') {
	            			$.each(data,function(index,value){
		                        $("#price_paket").html("<option>"+value.harga_paket+"</option>");
		             	        $("#desc_menu").val(value.keterangan_menunya);
	                        });
        				}
            		}
            	});
               
            }
        });
        $("#id_laundry").change(function(){
            var getValue= $(this).val();
            if(getValue == 0) {
                $("#price_laundry").html("<option value=''>Pilih laundry nya dulu !!</option>");
                $("#desc_laundry").html("<textarea>Pilih laundry nya dulu !!</textarea>");
            }else{
            	$.ajax({
            		url:'json/getdata_laundry.php',
            		type:'GET',
            		dataType:'json',
            		data: {'id_laundry' : getValue},
            		success:function (data) {
            			if(data != '') {
	            			$.each(data,function(index,value){
		                        $("#price_laundry").html("<option>"+value.harga_laundry+"</option>");
		             	        $("#desc_laundry").val(value.ket_laundry);
	                        });
        				}
            		}
            	});
               
            }
        });
	});	
</script>
<style type="text/css">
/*======DETAIL TRANSAKSI=======*/
.tglpesan{margin-left: 28px;}
.checkin{margin-left: 58px;}
.checkout{margin-left: 43px;}
.lamamenginap{margin-left: 11px;}
.pajak{margin-left: 80px;}
/*====== CONTENT RENTAL ======*/
.content_nama_kendaraan{margin-left: 100px;}
.content_kate_kendaraan{margin-left: 82px;}
.content_harga_kendaraan{margin-left: 100px;}
.content_dari_tgl{margin-left: 133px;}
.content_keterangan{margin-left: 136px;}
.form-inline{padding: 5px;}
/*======== CONTENT RESTORASI ==========*/
.content-pilih-paket{margin-left: 140px;}
.content-harga-paket{margin-left: 130px;}
.content-menu-paket{margin-left: 173px;}
/*======== CONTENT LAUNDRY ==========*/
.content-pilih-laundry{margin-left: 120px;}
.content-harga-laundry{margin-left: 115px;}
.content-menu-laundry{margin-left: 100px;}
.content-menu-laundry{margin-left: 133px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h3 class="fnt-style">Review Order</h3>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
		  	  <li class="active">Check Avialable</li>
			  <li class="active">Room Available</li>
			  <li class="active">Review Order</li>
			</ol>
			<!-- CEK MEMBER PERSON OR ATASNAMA -->
			<form action="backend/proses_man_reservasi.php?act=bookingnow" method="post" enctype="multipart/form-data" id="val-gettransac">
				<input type="hidden" name="checkin_user" value="<?php echo $_SESSION['session_checkin'];?>">
				<input type="hidden" name="checkout_user" value="<?php echo $_SESSION['session_checkout'];?>">
				<input type="hidden" name="sessi_user" value="<?php echo $userid; ?>">
				<div class="row">
					<div class="col-md-7">
						<h4><strong>Order diterima dari :</strong></h4>
						<div class="form-group">
							<label>Transaksi Tertuju pada</label>
							<label class="radio-inline">
								<input style="cursor:pointer;" type="radio" value="person" id="person" name="jenis_member" checked="">Personal
							</label>
							<label class="radio-inline">
								<input style="cursor:pointer;" type="radio" value="atasnama" id="atasnama" name="jenis_member">Atasnama
							</label>
						</div>
						<div class="form-group">
							<div class="person"><!-- Member Personal -->
								<input type="hidden" name="transaksi_person" value="person">
								<div class="form-group">
									<label>Id member</label>
									<input type="text" name="id_member" value="<?php echo $userid;?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Nama pemesan</label>
									<input type="text" name="nama_pemesan" value="<?php echo $getuser['nama_lengkap'];?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Kebangsaan</label>
									<input type="text" name="kebangsaan" value="<?php echo $getuser['kebangsaan'];?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Untuk Berapa Orang</label>
									<input input type="number" name="jumlah_orang" min="1" max="30" class="form-control">
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="" rows="5" cols="5" readonly class="form-control"><?php echo $getuser['alamat'];?></textarea>
								</div>
							</div>
							<div class="atasnama" style="display:none;"><!-- Member Atasnama -->
								<input type="hidden" name="transaksi_atasnama" value="atasnama">
								<div class="form-group">
									<label>Id member</label>
									<input type="text" name="id_member" value="<?php echo $userid;?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Nama pemesan<span style="font-size:11px;color:#e36c1a;"> (pihak pertama yang memesankan kamar untuk pihak kedua / orang lain)</span></label>
									<input type="text" name="nama_pemesan" value="<?php echo $getuser['nama_lengkap'];?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Kebangsaan</label>
									<input type="text" name="kebangsaan" value="<?php echo $getuser['kebangsaan'];?>" readonly class="form-control">
								</div>
								<div class="form-group">
									<label>Nama Perusahaan / ( Nama Rombongan )<span></span></label>
									<input type="text" name="other_name" class="form-control" autofocus required="">
								</div>
								<div class="form-group">
									<label>Nama penghuni / Nama Atasnama<span style="font-size:11px;color:#e36c1a;"> (pihak kedua atau orang lain yang akan menginap)</span></label>
									<textarea name="nama_penghuni" class="form-control" autofocus required=""></textarea>
								</div>
								<div class="form-group">
									<label>Untuk Berapa Orang</label>
									<input input type="number" name="berapa_orang" min="1" max="30" class="form-control" >
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="" rows="5" cols="5" readonly class="form-control"><?php echo $getuser['alamat'];?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-5">
						<div class="form-group" style="margin-top:15px;">
							<h4><strong>Detail Transaksi :</strong></h4>
						</div>
						<div class="form-group">
							<input type="hidden" name="kd_booking" value="<?php echo acakangkahuruf(5);?>">
							<p>Tangal Pesan<span class="tglpesan">: <?php $datenow=date('Y-m-d'); echo tgl_indo($datenow);?></span></p>
							<p>Check In<span class="checkin">: <?php echo tgl_indo($_SESSION['session_checkin']);?></span></p>
							<p>Check Out <span class="checkout">: <?php echo tgl_indo($_SESSION['session_checkout']);?></span></p>
							<p>Lama Menginap<span class="lamamenginap">: <?php echo $var_days;?></span> Hari</p>
							<p>Pajak<span class="pajak">: 10%</span></p>
							<p>Catatan : Transaksi Personal yaitu transaksi yang dibayarkan tertuju untuk diri sendiri sedangkan transaksi atasnama
							dipergunakan untuk memesankan orang lain sebagai jaminan kepercayaan menggunakan nama atasnama.</p>
						</div>
					</div>
				</div><!--row-->
				<div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Detail Transaksi Kamar</div>
							<div class="table-responsive">
								<table class="table table-hover" style="font-size:13px;">
									<thead>
										<tr>
											<th>Tipe kamar</th>
											<th>Lama menginap</th>
											<th>Harga asli</th>
											<th>Pajak</th>
											<th>Diskon</th>
											<th>Total Harga(pajak / jika ada diskon)</th>
											<th>Subtotal Harga / kamar x hari</th>
										</tr>
									</thead>
									<?php 
										foreach ($_SESSION['sessi_kamar'] as $key => $kategori) :
										//view kode kamar, kategori kamar, harga kamar
										$view_room_detail = mysqli_fetch_array(mysqli_query($konek,
											"SELECT km.id_kategori_kamar, k.id_kamar, km.type_kamar, km.tarif
											 FROM kamar k 
											 JOIN kategori_kamar km ON km.id_kategori_kamar=k.id_kategori_kamar 
											 WHERE km.id_kategori_kamar='$kategori'"));
										$price_room = $view_room_detail['tarif'];
										//cek kamar tersebut ada diskon atau tidak
										$get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$kategori'"));
										//deklarasi variable tarif
										$tarifnya = $get_price['tarif'];
										$x 		  = $get_price['id_kategori_kamar'];
										//buat diskon
										$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$kategori'"));
										//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
										$y  		    = $getdiskon['id_kategori_kamar'];
										$available_disc = $getdiskon['besar_diskon'];
										//variable percent 10%
										$percent = (($price_room*10)/100); 
										//variable discount
										$discount =(($price_room*$available_disc)/100);
										//tentukan perhitungan harga kamar + pajak
										$count_total_price_and_tax +=(($price_room+$percent-$discount)*$var_days);
										/*echo $discount;*/
									?>
									<tbody>
										<tr>
											<td><?php echo $view_room_detail['type_kamar']; ?></td>
											<td><?php echo $var_days.' hari';?></td>
											<td>Rp.<?php echo formatuang($view_room_detail['tarif']).' / malam';?></td>
											<td>10% / <?php echo formatuang($percent);?></td>
											<td><?php if ($x == $y) {echo $getdiskon['besar_diskon']."%";}elseif($y==''){echo "-";}?></td>
											<td>Rp.<?php echo formatuang($price_room+$percent-$discount).' / malam';?></td>
											<td>Rp.<?php echo formatuang(($price_room+$percent-$discount)*$var_days).' / malam';?></td>
										</tr>
										<input type="hidden" name='kategori_kamar[]' value="<?php echo $kategori;?>">
									<?php endforeach;?>
									</tbody>
								</table>
							</div><!-- TABLE RESPONSIVE -->
							<!-- TOTAL TRANSAKSI KAMAR -->
							<input type="hidden" id="total_transaksi_kamar" name="subtotal_kamar" value="<?php echo $count_total_price_and_tax;?>">
						</div>
					</div>
				</div><!--row-->
			<!-- TRANSAKSI LAYANAN -->
			<div class="row">
				<div class="col-lg-12">
					<h3 class="fnt-style">Transaksi Lainya</h3>
					<p>Kami menyediakan Layanan Rental, Restorasi Serta Extrabed untuk kebutuhan yang anda perlukan, Untuk layanan 
					restorasi hanya </br>bisa dilakukan pada saat checkin tidak bisa memesan di jauh hari
					</p>
				</div>
				<div class="col-md-9">
					<div class="click-rental">
						<div class="panel panel-default" style="cursor:pointer;">
							<div class="panel-heading">Layanan Rental klik disini</div>
						</div>
					</div>
					<div class="btn-click-rental" style="display:none;">
						<div class="form-inline">
							<label class="control-label">Nama Kendaraan</label>
							<span class="content_nama_kendaraan">
								<select name="id_rental" class="change_values_rent form-control" id="id_rental">
									<option value="">Pilih kendaraan</option>
									<?php 
										$getrental  = mysqli_query($konek,"SELECT * FROM rental ORDER BY id_rental DESC");
										while ($res = mysqli_fetch_array($getrental)) {
											echo "<option value='".$res['id_rental']."' data-id='".$res['harga_kendaraan']."'>".$res['nama_kendaraan']."</option>";
										}
									?>							
								</select>
							</span>
						</div><!-- form inline-->
						<div class="form-inline">
							<label class="control-label">Kategori kendaraan</label>
							<span class="content_kate_kendaraan">
								<select name="kate_kendaraan" class="form-control" id="kate_rents">
									<option></option>
								</select>
							</span>
						</div><!-- form inline-->
						<div class="form-inline">
							<label class="control-label">Harga kendaraan</label>
							<span class="content_harga_kendaraan">
								<select name="harga_kendaraan" class="form-control" id="price_rents">
									<option></option>
								</select>
							</span>
						</div><!-- form inline-->
						<div class="form-inline">
							<label class="control-label">Dari tanggal</label>
							<span class="content_dari_tgl">
								<input type="text" name="dari_tgl" style="cursor:pointer;" placeholder="Dari Tanggal" id="datepicker-example7-start" class="form-control"> S/d
								<input type="text" name="sampai_tgl" style="cursor:pointer;" placeholder="Sampai Tanggal" id="datepicker-example7-end" class="form-control">
							</span>
						</div><!-- form inline-->
						<div class="form-inline">
							<label class="control-label">Keterangan</label>
							<span class="content_keterangan">
								<textarea name="keterangan_rent" rows="5" cols="54" class="form-control" id="desc_rents"></textarea>
							</span>
						</div><!-- form inline-->
				    </div><!-- BTN CLICK -->
					<div class="click-restorasi">
						<div class="panel panel-default" style="cursor:pointer;">
							<div class="panel-heading">Layanan Restaurant klik disini</div>
						</div>
					</div>
					<div class="btn-click-restorasi" style="display:none;">
						<div class="form-inline">
							<label class="control-label">Pilih Paket</label>
							<span class="content-pilih-paket">
								<div class="form-group">
									<select name="id_paket" class="form-control change_values_paket" id="id_paket">
										<option value="">Pilih Paket</option>
										<?php 
											$get_restorasi = mysqli_query($konek,"SELECT * FROM paket");
											while ($res = mysqli_fetch_array($get_restorasi)) {
												echo "<option value='".$res['id_paket']."' data-id=".$res['harga_paket'].">".$res['nama_paket']."</option>";
											}
										?>
									</select>
								</div>
							</span>
						</div>
						<div class="form-inline">
							<label class="control-label">Harga Paket</label>
							<span class="content-harga-paket">
								<select name="id_paket" class="form-control" id="price_paket">
									<option value="">Pilih Paket</option>
									<option value=""></option>
								</select>
							</span>
						</div>
						<div class="form-inline">
							<label class="control-label">Menu</label>
							<span class="content-menu-paket">
								<textarea name="menu" class="form-control" rows="5" cols="54" id="desc_menu"></textarea>
							</span>
						</div>
					</div>
					<div class="click-laundry">
						<div class="panel panel-default" style="cursor:pointer;">
							<div class="panel-heading">Layanan Laundry klik disini</div>
						</div>
					</div>
					<div class="btn-click-laundry" style="display:none;">
						<div class="form-inline">
							<label class="control-label">Pilih Laundry</label>
							<span class="content-pilih-laundry">
								<div class="form-group">
									<select name="id_laundry" class="form-control change_values_laundry" id="id_laundry">
										<option value="">Pilih Laundry</option>
										<?php 
											$get_laundry = mysqli_query($konek,"SELECT * FROM laundry");
											while ($res = mysqli_fetch_array($get_laundry)) {
											echo "<option value='".$res['id_laundry']."' data-id=".$res['harga_laundry'].">".$res['jenis_laundry']."</option>";
										}
									?>
									</select>
								</div>
							</span>
						</div>
						<div class="form-inline">
							<label class="control-label">Harga laundry</label>
							<span class="content-harga-laundry">
								<select name="harga_paket" class="form-control" id="price_laundry">
									<option value="">Pilih laundry</option>
								</select>
							</span>
						</div>
						<div class="form-inline">
							<label class="control-label">Keterangan</label>
							<span class="content-menu-laundry">
								<textarea name="keterangan_laundry" class="form-control" rows="5" cols="54" id="desc_laundry"></textarea>
							</span>
						</div>
					</div>
					<!-- ======================== EXTRA BED IS HERE =================== -->
					<div>				
						<?php $get_extrabed = "SELECT id_extrabed, harga_extrabed FROM extrabed"; 
							  $save = mysqli_query($konek,$get_extrabed); $show = mysqli_fetch_array($save); 
						?>
						<input type="checkbox" name="id_extrabed" id="change-extrabed" value="<?php echo $show['id_extrabed'];?>" data-extrabed="<?php echo $show['harga_extrabed'];?>" style="cursor:pointer;"> Tambah Extrabed + Rp.<?php echo formatuang($show['harga_extrabed']);?>	
					</div>						
					
				</div><!-- col-md-9 -->
				<!-- EXTRABED-->
				<!-- TOTAL TRANSAKSI USER -->
			</div><!--row-->
			<?php
				$diskon=(($count_total_price_and_tax*30)/100);
			 ?>
			<div class="row">
				<div class="col-lg-12" style="margin-top:50px;">
					<input type="radio" name="" class="click_pembayaran"> Klik Disini Jika Langsung Bayar 
					<div style="display:none;" class="btn-click-pembayaran">
						<h3 class="fnt-style" style="margin-bottom:40px;">Konfirmasi Pembayaran</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Pembayaran</label>	
									<label class="radio-inline">
										<input style="cursor:pointer;" type="radio" value="Lunas" id="Lunas" name="pelunasan">Lunas
									</label>
									<label class="radio-inline">
										<input style="cursor:pointer;" type="radio" value="DP" id="DP" name="pelunasan" checked="">DP 30%
									</label>
								</div>
								<div class="form-group">
									<div class="DP">
										<label>Jumlah Bayar <span style='color:#E36C1A;'>*DP 30%</span></label>
										<input type="text" name="bayar_dp" class="form-control" value="Rp.<?php echo formatuang($diskon);?>" readonly autofocus required="">
									</div>
									<div class="Lunas" style="display:none;"><!-- Lunas_-->
										<label>Jumlah Bayar <span style='color:#E36C1A;'>*Lunas</span></label>
										<input type="text" name="bayar_lunas" class="form-control" value="Rp.<?php echo formatuang($count_total_price_and_tax);?>" readonly autofocus required="">
									</div>
								</div>
								<div class="form-group">
									<label>Pilih Bank </label>
									<select name="jenis_bank" class="form-control">
										<option value=""> Pilih bank </option>	
										<option>BNI</option>	
										<option>BRI</option>	
									</select>
								</div>
								<div class="form-group">
									<label>Bukti pembayaran
										<input type="file" name="bukti_pembayaran">
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Total transaksi</label>
									<input type="text"  name="total_transaksi" class="form-control" value="<?php echo $count_total_price_and_tax;?>" id="total_all_trans">
								</div>
								<div class="form-group">
									<label>Jumlah bayar</label>
									<input type="text" name="jumlah_bayar" class="form-control" id="jumlah_yg_harus_dibayar">
								</div>
								<div class="form-group">
									<label>Kembalian</label>
									<input type="text" name="kembalian" class="form-control" id="klik_kembalian">
								</div>
							</div>
						</div><!-- row -->
					</div>
					<div class="col pull-right">
					  <p>Total Transaksi <span style="font-weight:bold;"> Rp.</span>
					  	<input style="display:inline;border:0;font-weight:bold;width:100px;height:auto;" type="text" name="total_transaksi" class="price-total" value="<?php echo $count_total_price_and_tax;?>" data-total="<?php echo $count_total_price_and_tax;?>">
					  	<!-- COUNT ALL TRANSACTION NO CONVERT JQ PRICE NUMBER FORMAT -->
					  	<input style="border:none;display:none;" type="text" name="total_transaksi_nonconvert" id="price-total-nonconvert" value="<?php echo $count_total_price_and_tax;?>">
				  	  </p>
					</div>
				</div>
			</div>
			<!-- NAVIGATION CHECKOUT -->
			<div class="row" style="margin-top:50px;margin-bottom:100px;">
				<div class="col-md-12 -col-lg-12">
					<button class="btn btn-primary">Checkout</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
