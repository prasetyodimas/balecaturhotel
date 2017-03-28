<?php include "fungsi/function_transaksi.php";
if (empty($_SESSION['id_member'])) {
    echo "<script>alert('Maaf anda harus login terlebih dahulu !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=signin.php>";
}else {
?>
<script type="text/javascript">
	$(document).ready(function(){	
		//statement jika radio clicked	
		$('input[type=radio][name=pelunasan]').click(function(){
			var bayarDP=$(this).val();
			$('.'+bayarDP).show();
			$('input[type=radio][name=pelunasan]').not(':checked').each(function(){
				var bayarLunas=$(this).val();
				$('.'+bayarLunas).hide();
			});
		});
		$('#confrimation').validate({	
			rules:{
				jenis_bank:{
					required:true,
				},
				bukti_pembayaran:{
					required:true,
				},
				jumlah_bayar:{
					required:true,
					number:true,
				},
				cara_pembayaran:{
					required:true,
				},
				jenis_pembayaran:{
					required:true,
					number:false,
				},
			}
			,messages:{
				jenis_bank:{
					required:"kolom jenis bank tidak boleh kosong !!",
				},
				bukti_pembayaran:{
					required:"kolom bukti pembayaran tidak boleh kosong !!",
					number:"tidak valid harus angka !!",
				},
				jumlah_bayar:{
					required:"kolom jumlah bayar tidak boleh kosong !! ",
				},
				cara_pembayaran:{
					required:"Kolom cara pembayaran tidak boleh kosong !!",
				},	
				jenis_pembayaran:{
					required: "kolom jenis pembayaran tidak boleh kosong !!",
				},
				checked:{
					required:"kolom terms and condition tidak boleh kosong !!",
				}
			}
		});
	});
</script>
<style type="text/css">
	.man-konfrimasi-nopemesanan{margin-left: 50px;}
	.man-konfrimasi-namapemesan{margin-left: 48px;}
	.man-detail-checkin{margin-left: 96px;}
	.man-detail-checkout{margin-left: 86px;}
	.man-tanggal-pesan{margin-left: 52px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">KONFIRMASI PEMBAYARAN</h1>
			<ol class="breadcrumb">
				<li><a>Home</a></li>
          		<li class="active">My Order</li>
          		<li class="active"><strong>Konfrimasi Pembayaran</strong></li>
			</ol>
		<div class="col-lg-8 col-md-4">
			<?php $link_act = "$site/backend/proses_konfrimasi_pembayaran.php?act=add_konfrimasi"?>
			<form action="<?php echo $link_act;?>" id="confrimation" method="post" enctype="multipart/form-data">
			<input type="hidden" name="kd_booking" value="<?php echo $_GET['kode_book'];?>">
			<input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>">
			<?php
				//get transaksi tambahan
				$gettransac = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi_layanan WHERE kd_booking='$_GET[kode_book]'"));
					//jika tidak memesan transaksi layanan
				$viewkonfrimasi = mysqli_fetch_array(
								  mysqli_query($konek,"SELECT b.kd_booking, 
								  							  m.nama_lengkap, 
								  							  b.checkin, 
								  							  b.checkout, 
								  							  b.total_biayasewa,
								  							  b.tgl_booking 
							  							FROM booking b JOIN member m ON b.id_member=m.id_member 
								  						WHERE b.kd_booking='$_GET[kode_book]'")); 
				$var_total_sewa = $viewkonfrimasi['total_biayasewa'];
				//mengitung diskon 
				$diskon=(($var_total_sewa*30)/100);
			?>
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="form-group">
						<label>No Pemesanan <span class="man-konfrimasi-nopemesanan">: <?php echo $_GET['kode_book'];?></span></label>
					</div>
					<div class="form-group">
						<label>Nama Pemesan <span class="man-konfrimasi-namapemesan">: <?php echo $viewkonfrimasi['nama_lengkap']; ?></span></label>
					</div>
					<div class="form-group">
						<label>Checkin <span class="man-detail-checkin">: <?php echo tgl_indo($viewkonfrimasi['checkin']);?></span></label>
					</div>
					<div class="form-group">
						<label>Checkout <span class="man-detail-checkout">: <?php echo tgl_indo($viewkonfrimasi['checkout']);?></span></label>
					</div>
					<div class="form-group">
						<label>Tanggal pesan <span class="man-tanggal-pesan">: <?php $potong_tgl = substr($viewkonfrimasi['tgl_booking'],10); echo tgl_indo($viewkonfrimasi['tgl_booking']).' / '.$potong_tgl; ?></span></label>
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-12">
							<div class="form-group">
								<label>Pilih Bank </label>
								<select name="jenis_bank" class="form-control" autofocus required>
									<option value=""> Pilih bank </option>	
									<option>BNI</option>	
									<option>BRI</option>	
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Pembayaran</label>	
						<label class="radio-inline">
							<input style="cursor:pointer;" type="radio" value="Lunas" id="Lunas" name="pelunasan">Lunas
						</label>
						<label class="radio-inline">
							<input style="cursor:pointer;" type="radio" value="DP" id="DP" name="pelunasan" checked="">DP 30%
						</label>
					</div>
					<div class="row">
						<div class="col-lg-8 col-md-12 form-group">
							<div class="DP">
								<label>Jumlah Bayar <span style='color:#E36C1A;'>*DP 30%</span></label>
								<input type="text" name="bayar_dp" class="form-control" value="Rp.<?php echo formatuang($diskon);?>" readonly autofocus required>
							</div>
							<div class="Lunas" style="display:none;"><!-- Lunas_-->
								<label>Jumlah Bayar <span style='color:#E36C1A;'>*Lunas</span></label>
								<input type="text" name="bayar_lunas" class="form-control" value="Rp.<?php echo formatuang($var_total_sewa);?>" readonly autofocus required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label style="font-size:13px; margin-bottom:10px;color:#000;">Bukti Pembayaran</label>
				<input type="file" name="bukti_pembayaran" autofocus required>
			</div>
			<!-- HOW TO PAY WITH BANK TRANSFER -->
			<div class="purchasing-block" style="margin-top:50px">
				<h4 class="heading-purchaseitems">How to pay with bank transfer</h4>
			</div>
			<div>
				<article style="font-size: 12px;margin-top: 10px;margin-bottom: 10px;">
				<!-- mendefiniskian pembayaran 30% untuk transaksi online-->
					Anda dapat melakukan transfer 30% ( Rp.<span style="font-weight:bold"><?php echo formatuang($diskon);?> </span>) 
					dari transaksi yang sudah anda pesan, jika anda tidak mengkonfrimasi transaksi dalam waktu 4 jam setelah anda melakukan pemesanan, maka transaksi anda otomatis 
					kami blokir dan uang anda tidak kembali.
				</article>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th style="text-align:center;"><span>Bank</span></th>
						<th style="text-align:center;"><span>No Rekening</span></td>
						<th style="text-align:center;"><span>Atas Nama</span></th>
						<th style="text-align:center;"><span>Cabang</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span style="margin-left:2px;"><img src="<?php echo "frontend/icon/BNI_logo.png";?>"></span></td>
						<td><span>3545 0909 23</span></td>
						<td><span>Liany heviana</span></td>
						<td><span>KCP Yogyakarta</span></td>
					</tr>
					<tr>
						<td><span style="margin-left:-1px;"><img src="<?php echo "frontend/icon/bank-bri-logo.png";?>"></span></td>
						<td><span>83723 0909</span></td>
						<td><span>Liany Heviana</span></td>
						<td><span>KCP Yogyakarta</span></td>
					</tr>				
				</tbody>
			</table>
			<p style="font-size: 12px;margin-top: 10px;margin-bottom: 10px;">
				Anda dapat melakukan transfer sejumlah bank di atas, silahkan anda pilih metode yang anda gunakan, mengenai kebijakan untuk
				pembayaran transaksi anda pihak manajemen hotel balecatur inn tidak bertanggung jawab apabila ada kesalahan pengisian data
				pastikan anda teliti dalam mengisi data yang akan anda masukkan terimakasih.
			</p>
			<input type="checkbox" style="cursor:pointer;" name="checked" autofocus required>
			<label style="font-size:13px;margin-bottom:10px;color:#000">Saya setuju dengan kebijakan tersebut Terms and condition</label>
		</div><!-- col md 5 -->
		<!-- INFORMATION PAYMENT -->
		<?php
			//get value tgl bayar 
			$getdate_reserve = mysqli_fetch_array(mysqli_query($konek,"SELECT tgl_booking, checkout FROM booking WHERE kd_booking='$_GET[kode_book]'"));
		 	//variable tgl boking
		 	$potong_char = $getdate_reserve['tgl_booking'];
		 	$tanggal_now = $getdate_reserve['tgl_booking'];	
		 	//variable hari + 1 hari dari tanggal pesan
			$adding_days = str_replace('-', '/', $tanggal_now);
			//function adding +1 days count from now
			$tomorrow    = date('Y-m-d',strtotime($adding_days."+0 days"));
			//function counting hours + 1 hours from now
			$remove_date = gettimer($getdate_reserve['tgl_booking']); 
			//function adding hour 
			$timestamp   = strtotime($remove_date) + 120*120;
			$time        = date('H:i:s', $timestamp);
		?>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><label>Batas Konfirmasi Pembayaran</label></div>
				<div class="panel-body">
					<div class="form-group">
						<p>Tanggal pesan <?php echo tgl_indo($getdate_reserve['tgl_booking']);?> jam 
						<?php echo gettimer($getdate_reserve['tgl_booking']);?></p> 
						<p>Tanggal Jatuh tempo <spam style="color: #E36C1A;"><?php echo tgl_indo($tomorrow);?> jam <?php echo $time;?></spam></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12" style="margin-bottom:50px">
			<div style="float:right;margin-top:20px;">
				<input type="submit" class="btn-confirmation" value="Konfrimasi Pembayaran"></a>
			</div>
			</form>
		</div>
	</div>
	</div>
</div>
<?php } ?>
