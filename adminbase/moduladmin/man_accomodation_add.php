<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		//functio disabled form
		$('#disable-checked').prop("disable",true);

		//show price paket
		$("#select-paket").change(function(){
	        var getValue= $(this).val();
	        if(getValue == 0) {
	            $("#price-paket").html("<input>Pilih paketnya dulu</input>");
	            $("#txt-paket").html("<textarea value=''>Pilih paketnya dulu</textarea>");
	        }else{
	            $.ajax({
	            	url :'json/getdata_paket.php',
	            	type :'GET',
	            	dataType :'json',
	            	data:{'id_paket': getValue},
	            	success:function(data){
	            		if (data!='') {
	            			$.each(data,function(index,value){
	                    		$("#price-paket").val(value.harga_paket);
	                    		$("#txt-paket").val(value.keterangan_menunya);
	            			});
	            		}
	            	}
	            });
	        }
	    });
		//show price rental 
		$("#select-rentals").change(function(){
	        var getValue= $(this).val();
	        if(getValue == 0) {
	            $("#kate-rent").html("<option>Pilih rentalnya dulu</option>");
	            $("#price-rent").html("<textarea value=''>Pilih rentalnya dulu</textarea>");
	        }else{
	            $.ajax({
	            	url :'json/getdata_rental.php',
	            	type :'GET',
	            	dataType :'json',
	            	data:{'id_rental': getValue},
	            	success:function(data){
	            		if (data!='') {
	            			$.each(data,function(index,value){
	                    		$("#kate-rent").html("<option>"+value.kate_kendaraan+"</option>");
	                    		$("#price-rent").html("<option>"+value.harga_kendaraan+"</option>");
	                    		$("#txt-rent").val(value.ket_kendaraan);
	            			});
	            		}
	            	}
	            });
	        }
	    });
	    //show price laundry 
		$("#select-laundry").change(function(){
	        var getValue= $(this).val();
	        if(getValue == 0) {
	            $("#price-laundry").html("<option value=''>Pilih laundrynya dulu</option>");
	        }else{
	            $.ajax({
	            	url :'json/getdata_laundry.php',
	            	type :'GET',
	            	dataType :'json',
	            	data:{'id_laundry': getValue},
	            	success:function(data){
	            		if (data!='') {
	            			$.each(data,function(index,value){
	                    		$("#price-laundry").html("<option>"+value.harga_laundry+"</option>");
	                    		$("#txt-laundry").val(value.ket_laundry);
	            			});
	            		}
	            	}
	            });
	        }
	    });
    });
</script>
<style type="text/css">
	.detail-pemesan-kodebooking{margin-left: 30px; } 
	.detail-pemesan-namapemesan{margin-left: 17px; }
	.detail-pemesan-alamat{margin-left: 76px;} 
	.detail-pemesan-kebangsaan{margin-left: 40px;}
	.detail-pemesan-notelp{margin-left: 76px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Reservasi Offline / Manajemen Transaksi Check-in</h1>
			<p>Anda ingin menambah layanan kami..?</p>
			<form action="backend/proses_transaksi_layanan.php?act=add_transac" method="post" id="validate-form" enctype="multipart/form-data">
			<input type="hidden" name="kd_book" value="<?php echo $_GET['id']?>">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Restorasi</label>
						<select name="id_paket" id="select-paket" class="form-control">
							<option value="">Pilih Paket</option>
							<?php
								$restorasi = mysqli_query($konek,"SELECT * FROM paket ORDER BY id_paket ASC");
								while ($results = mysqli_fetch_array($restorasi)) {
									echo "<option value='".$results['id_paket']."'>".$results['nama_paket']."</option>";
								}

							?>
						</select>		
					</div>
					<div class="form-group">
						<label class="form-inline">Rp.
							<input type="text" class="form-control" id="price-paket" readonly="">
						</label>
					</div>
					<div class="form-group">
						<textarea name="menu" id="txt-paket" rows="6" cols="5" readonly="" class="form-control"></textarea>
					</div>
					<!-- end of restorasi -->
					<?php
						$get_user= mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member m JOIN booking b 
							ON m.id_member=b.id_member WHERE b.kd_booking='$_GET[id]'"));
					 		//echo $get_user['nama_lengkap'];
					 	//membuat kondisi logika
					 	// variable user
					 	$user_id = $_GET['id'];
					 	if ($user_id) {
					 		$var_class = '';
					 	}else{
					 		$var_class = 'disabled';
					 	}
					 ?>
					 <div class="form-group">
						<label>Nama Pemesan
							<input type="text" name="nama_user" id="<?php echo $var_class;?>" value="<?php echo $get_user['nama_lengkap']?>" class="form-control">
						</label>
					 </div>
					<!-- jika id tamu atau pemesan tidak ada -->
					<?php if ($user_id ==''){ ?>
						<div class="form-group">
							<label>Rental</label>
							<select name="id_rental" id="select-rentals" class="form-control" style="cursor:not-allowed;background-color:#eee;">
								<option value="">Pilih Rental</option>
							</select>	
						</div>
					<!-- jika id tamu atau pemesan ada -->
					<?php }else{?>
						<div class="form-group">
							<label>Rental</label>
							<select name="id_rental" id="select-rentals" class="form-control">
								<option value="">Pilih Rental</option>
								<?php
									$rent = mysqli_query($konek,"SELECT * FROM rental ORDER BY id_rental ASC");
									while ($results = mysqli_fetch_array($rent)) {
										echo "<option value='".$results['id_rental']."'>".$results['nama_kendaraan']."</option>";
									}
								?>
							</select>	
						</div>
					<?php } ?>

					<div class="row">
						<div class="form-group">
							<div class="col-md-6 form-group">
								<input type="text" name="dari_tgl" id="datepicker-example7-start" class="form-control" placeholder="dari tanggal">
							</div>
							<div class="col-md-6 form-group">
								<input type="text" name="sampai_tgl" id="datepicker-example7-end" class="form-control" placeholder="sampai tanggal">
							</div>
						</div>
					</div>
					<div class="form-group">
						<select name="kategori_kendaraan" id="kate-rent" class="form-control">
							<option value="">Kate Kendaraan</option>
						</select>
					</div>
					<div class="form-group">
						<select name="harga_rental" id="price-rent" class="form-control">
							<option value="">Harga rental</option>
						</select>
					</div>
					<div class="form-group">
						<textarea name="ket_kendaraan" id="txt-rent"  cols="6" rows="5" class="form-control" readonly=""></textarea>
					</div>
					<div class="form-group">
						<label>Laundry</label>
						<select name="id_laundry" id="select-laundry" class="form-control">
							<option value="">Pilih Laundry</option>
							<?php
								$get_laundry = mysqli_query($konek,"SELECT * FROM laundry");
								while ($res = mysqli_fetch_array($get_laundry)) {
									echo "<option value='".$res['id_laundry']."'>".$res['jenis_laundry']."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<select name="harga_laundry" class="form-control" id="price-laundry">
							<option value="">Harga laundry</option>
						</select>
					</div>
					<div class="form-group">
						<textarea name="ket_laundry" cols="6" rows="5" id="txt-laundry" class="form-control" readonly=""></textarea>
					</div>
					<div class="form-group">
						<label>Extrabed</label>
							<?php
								$get_extrabed = mysqli_query($konek,"SELECT * FROM extrabed");
								while ($res = mysqli_fetch_array($get_extrabed)) {
									echo"<input type='checkbox' name='id_extrabed' value='".$res['id_extrabed']."' style='cursor:pointer;'>";
								}
							?>
					</div>
					<button type="submit">Submit</button>
					<button type="submit" onclick="history.go(-1);">Cancel</button>
				</div><!-- col-md-5-->
				<div class="col-md-6">
					<div class="form-group">
						<?php
							$detail_pemesan = mysqli_fetch_array(mysqli_query($konek,
								"SELECT m.id_member, m.nama_lengkap, b.kd_booking, m.alamat, m.no_telp, m.kebangsaan
								FROM member m JOIN booking b ON m.id_member=b.id_member WHERE b.kd_booking='$_GET[id]'"));
						?>
						<h4>Detail Pemesan</h4>
						<div class="form-group">
							<p>Kode Booking<span class="detail-pemesan-kodebooking">: <?php echo $_GET['id'];?></span></p>
						</div>
						<div class="form-group">
							<p>Nama Pemesan<span class="detail-pemesan-namapemesan">: <?php echo $detail_pemesan['nama_lengkap'];?></span></p>
						</div>
						<div class="form-group">
							<p>Alamat<span class="detail-pemesan-alamat">: <?php echo $detail_pemesan['alamat']?></span></p>
						</div>
						<div class="form-group">
							<p>Kebangsaan<span class="detail-pemesan-kebangsaan">: <?php echo $detail_pemesan['kebangsaan']?></span></p>
						</div>
						<div class="form-group">
							<p>No telp<span class="detail-pemesan-notelp">: <?php echo $detail_pemesan['no_telp']?></span></p>
						</div>
					</div>
					<!-- Detail pemesan -->
				</div>
			</div>
			</form>
			<div style="margin-bottom:100px;"></div>
		</div>
	</div>
</div>
