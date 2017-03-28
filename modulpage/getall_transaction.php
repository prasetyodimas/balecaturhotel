<?php include 'fungsi/function_transaksi.php'; error_reporting(0);
	//variable get tanggal user
	$tgl_checkin  = $_SESSION['session_checkin'];
	$tgl_checkout = $_SESSION['session_checkout'];
	$jumlah_orang = $_SESSION['session_jumlah_orang'];
	$jumlah_kamar = $_SESSION['session_jumlah_kamar'];
	//check session user ada atau tidak !!
	if (empty($_SESSION['id_member'])) {
	    echo "<script>alert('Maaf anda harus login terlebih dahulu !!')</script>";
    	echo "<meta http-equiv=refresh content=0;url=auth/session_log/signin_non_userid.php>";
	}else{
	//get session data member
	$userid 	   = $_SESSION['id_member'];
	$getuser 	   = mysqli_fetch_array(mysqli_query($konek,"SELECT id_member, 
																    nama_lengkap, 
																	alamat, 
																    kebangsaan 
														     FROM member 
														     WHERE id_member='$userid'"));
	// menghitung jumlah hari usernya atau lama menginap
	$var_days = round((strtotime($tgl_checkout)-strtotime($tgl_checkin))/86400);
	$total_seluruh_transaksi = 0;
	//hitung jumlah hari menginap nya
	$s_id        = session_id();

?>
<script type="text/javascript">
	//show hide menu transaksi sewa rental
	$(document).ready(function(){
		$('.click-disini').click(function(){
			$('.btn-click').slideToggle('slow');
		});
		$('#adding_room').on('shown.bs.modal', function () {
		  	$('#myInput').focus();
		});
        $('.price-total').number(true);
		$('#val-gettransac').validate({
			rules:{
				berapa_orang:{
					required:true
				},
				berapa_kamar:{
					required:true
				},
				jumlah_kamar:{
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
				berapa_kamar:{
					required:'Jumlah kamar tidak boleh kosong !!',
				},
				jumlah_kamar:{
					required:'Jumlah kamar tidak boleh kosong !!',
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
		//apend function 
		$('.click_adding_room_again').click(function(){
			var adding_new_room = $('.add_body_room div.a').clone();
			$('#apend-td').append(adding_new_room);
		});
		//onchange function price rent
		$('select.change_values_rent').on('change',function(){
			var rentValue      = $('select.change_values_rent').find(':selected').data('id');
			var totalValue 	   = $('#total_transaksi_kamar').val();
			var subtotal_rents = parseFloat(rentValue)+parseFloat(totalValue); 
			$('.price-total').val(subtotal_rents);
			$('#price-total-nonconvert').val(subtotal_rents);
		});
		//onchange function price extrabed
		$('input[type=checkbox]').on('change',function() {
			var extrabedValue  = $(this).attr('data-extrabed');
			var totalValue 	   = $('#price-total-nonconvert').val();
			var subtotal_bed   = parseFloat(extrabedValue)+parseFloat(totalValue);
			alert("Anda memesan extrabed extrabed tambahan");
			$('.price-total').val(subtotal_bed);
			$('#price-total-nonconvert').val(subtotal_bed);
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
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">Review Order</h1>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
		  	  <li class="active">Check Avialable</li>
			  <li class="active">Room Available</li>
			  <li class="active">Review Order</li>
			</ol>
			<!-- CEK MEMBER PERSON OR ATASNAMA -->
			<form action="backend/proses_reservation.php?act=bookingnow" method="post" enctype="multipart/form-data" id="val-gettransac">
				<input type="hidden" name="checkiun_user" value="<?php echo $tgl_checkin;?>">
				<input type="hidden" name="checkout_user" value="<?php echo $tgl_checkout;?>">
				<input type="hidden" name="userid" value="<?php echo $userid;?>">
				<div class="row">
					<div class="col-md-6">
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
									<input type="number" name="jumlah_orang" min="1" max="100" class="form-control" value="<?php echo $jumlah_orang;?>" readonly>
								</div>
								<div class="form-group">
									<label>Berapa Kamar</label>
									<input type="number" name="berapa_kamar" min="1" class="form-control" value="<?php echo $jumlah_kamar;?>"readonly>
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
									<input input type="number" name="berapa_orang" min="1" max="30" class="form-control" value="<?php echo $jumlah_orang;?>">
								</div>
								<div class="form-group">
									<label>Berapa Kamar</label>
									<input type="number" name="jumlah_kamar" min="1" class="form-control" value="<?php echo $jumlah_kamar;?>">
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
							<p>Tangal Pesan<span class="tglpesan">: <?php echo date("Y-m-d")." <i class='fa fa-clock-o'></i> ".date("H:i:s");?></span></p>
							<p>Check In<span class="checkin">: <?php echo tgl_indo($tgl_checkin);?></span></p>
							<p>Check Out <span class="checkout">: <?php echo tgl_indo($tgl_checkout);?></span></p>
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
								<div class="add_other_room" style="display:none;">
									<div class="form-group" style="padding: 12px 10px;border-bottom: 1px solid #e4e4e4;">
										<a class="btn btn-danger" data-toggle="modal" data-target="#adding_room">Tambah kamar</a>
									</div>
								</div><!-- adding new other room -->
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Tipe kamar</th>
											<th>Berapa kamar</th>
											<th>Lama Inap</th>
											<th>Harga</th>
											<th>Pajak</th>
											<th>Diskon</th>
											<th>Total Harga<span style="font-size:11px;"> (pajak + jika ada diskon)</span></th>
											<th>Subtotal Harga <span style="font-size:11px;">(kamar x hari)</span></th>
											<!--<th>Action</th>-->
										</tr>
									</thead>
									<tbody>
									<?php 
										$view_room_detail = mysqli_query($konek,"SELECT * FROM temp_booking tb 
																							   JOIN kategori_kamar km ON km.id_kategori_kamar=tb.id_kategori_kamar 
																				 WHERE tb.id_member='$userid'");
										 while ($res_view = mysqli_fetch_array($view_room_detail)):
											$price_room = $res_view['tarif']; 
											$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$res_view[id_kategori_kamar]'"));
											//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
											$y  		    = $getdiskon['id_kategori_kamar'];
											$available_disc = $getdiskon['besar_diskon']; 
											//deklarasi variable tarif
											$tarifnya = $res_view['tarif'];
											$x 		  = $res_view['id_kategori_kamar'];
											//buat diskon
											//variable percent 10%
											$percent = (($price_room*$res_view['jumlah']*10)/100); 
											//variable discount
											$discount =(($price_room*$available_disc*$res_view['jumlah'])/100);
											$count_total_price_and_tax +=(($price_room+$percent-$discount)*$var_days*$res_view['jumlah']);?>
										<tr>
											<td><?php echo $res_view['id_kategori_kamar'];?></td>
											<td><?php echo $jumlah_kamar;?></td>
											<td><?php echo $var_days.' hari';?></td>
											<td>Rp.<?php echo formatuang($res_view['tarif']).' / malam';?></td>
											<td>10% / <?php echo formatuang($percent);?></td>
											<td><?php if ($x == $y) {echo $getdiskon['besar_diskon']."%";}elseif($y==''){echo "-";}?></td>
											<td>Rp.<?php echo formatuang($price_room+$percent-$discount).' / malam';?></td>
											<td>Rp.<?php echo formatuang(($price_room+$percent-$discount)*$var_days).' / malam';?></td>
											<!-- <td><i class="fa fa-times" aria-hidden="true"></i>
												<a href="backend/proses_tambah_kamar_keranjang.php?act=delete_reservation&id=<?php echo $res_view['id_tempbooking']?>">delete
											</td> -->
										</tr>
										<input type="hidden" name='kategori_kamar[]' value="<?php echo $res_view['id_kategori_kamar'];?>">
									<?php endwhile; ?>
									</tbody>
								</table>
							</div><!-- TABLE RESPONSIVE -->
							<!-- TOTAL TRANSAKSI KAMAR -->
							<input type="hidden" id="total_transaksi_kamar" name="subtotal_kamar" value="<?php echo $count_total_price_and_tax;?>">
						</div>
					</div>
				</div><!--row-->
			<div id="apend-td"></div>
			<!-- TRANSAKSI LAYANAN -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="fnt-style">Transaksi Lainya</h1>
					<p>Kami menyediakan Layanan Rental, Restorasi Serta Extrabed untuk kebutuhan yang anda perlukan, Untuk layanan 
					restorasi hanya </br>bisa dilakukan pada saat checkin tidak bisa memesan di jauh hari
					</p>
				</div>
				<div class="col-md-8">
					<div class="click-disini">
						<div class="panel panel-default" style="cursor:pointer;">
							<div class="panel-heading">Layanan Rental klik disini</div>
						</div>
					</div>
					<div class="btn-click" style="display:none;">
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
					<!-- EXTRABED-->
					<div>				
						<?php $get_extrabed = "SELECT id_extrabed, harga_extrabed FROM extrabed"; 
							  $save = mysqli_query($konek,$get_extrabed); $show = mysqli_fetch_array($save); 
						?>
						<input type="checkbox" name="id_extrabed" id="change-extrabed" value="<?php echo $show['id_extrabed'];?>" data-extrabed="<?php echo $show['harga_extrabed'];?>" style="cursor:pointer;"> Tambah Extrabed + Rp.<?php echo formatuang($show['harga_extrabed']);?>	
					</div>						
				</div>
				<!-- TOTAL TRANSAKSI USER -->
			</div><!--row-->
			<div class="col-lg-12">
				<div class="col pull-right">
				  <p>Total Transaksi <span style="font-weight:bold;"> Rp.</span>
				  	<input style="display:inline;border:0;font-weight:bold;width:100px;" type="text" name="total_transaksi" class="price-total" value="<?php echo $count_total_price_and_tax;?>" data-total="<?php echo $count_total_price_and_tax;?>">
				  	<!-- COUNT ALL TRANSACTION NO CONVERT JQ PRICE NUMBER FORMAT -->
				  	<input type="hidden" name="total_transaksi_nonconvert" id="price-total-nonconvert" name="total_transaksi" value="<?php echo $count_total_price_and_tax;?>">
			  	  </p>
				</div>
				<!-- NAVIGATION CHECKOUT -->
			</div><!--col-lg-12-->
			<div class="row">
				<div class="col-lg-12"> 
					<div class="col pull-right">
						<button class="btn btn-primary">Checkout</button>
					</div>
				</div>
			</div>
		</form>
		<!-- Modal Boostrap -->
		<div class="modal fade" id="adding_room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Anda ingin tambah kamar lagi..?</h4>
		      </div>
		      <!-- DATA ROOM TYPE -->
			  <form action="backend/proses_tambah_kamar_keranjang.php?act=adding_other_room" method="post" enctype="multipart-form-data">
		      <div class="modal-body" style="height:70px;">
		      	<div class="col-md-12">
		      		<div class="row">
			      		<div class="col-md-3" style="margin-top:10px;">
							<label>Tipe Kamar</label>
			      		</div>
			      		<div class="col-md-6 form-inline">
							: <select name="kategori_kamar" class="form-control" required>
								<option value="">Pilih kamar</option>
								<?php 
									$get_other_room = mysqli_query($konek,"SELECT 
																		  km.id_kategori_kamar, 
																		  km.type_kamar,
																		  km.jumlah_kamar_akhir, 
																		  km.tarif, 
																		  km.fasilitas,km.foto_kamar, 
																		  count(k.id_kamar) as stok_kmr
																	FROM kamar k 
																	JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar
										WHERE k.status_kamar !='3'AND k.status_kamar='2' GROUP BY k.id_kategori_kamar ASC");
										while ($result_room_type = mysqli_fetch_array($get_other_room)) {
										//cek ketersediaan kamar !
										if($result_room_type['stok_kmr'] > $jumlah_kamar){
											echo "<option value='".$result_room_type['id_kategori_kamar']."'>".$result_room_type['type_kamar']."</option>";
										}
									}
								?>
							</select>
			      		</div>
		      		</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
			</form>
		    </div>
		  </div>
		</div>
	</div>
	</div>
</div>
<?php } ?>
