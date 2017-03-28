<?php include 'fungsi/function_transaksi.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add-testi').validate({
			rules:{
				emailtesti:{
					required:true,
					email:true
				},
				namatesti:{
					required:true,
				},	
			},	
			messages:{
				emailtesti:{
					required:"Email anda tidak boleh kosong !!",
					email:"Email anda tidak valid !!",
				},
				namatesti:{
					required:"Nama anda tidak boleh kosong !!",
				},
				keterangan_testi:{
					required:"Keterangan testimonial tidak boleh kosong !!",
				},
			}
		});
	});
</script>
<?php 
	$cekuser_log = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member")); 
	$cek_total_testimoni = mysqli_query($konek,"SELECT * FROM testimonial");
	$cek_rows = mysqli_num_rows($cek_total_testimoni); 
?>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">TESTIMONIALS</h1>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Testimonials</li>
			</ol>
			<div class="row">
				<div class="col-md-8" style="margin-bottom:50px;">
					<div class="media-body">
			    	<?php 
			    		$x = mysqli_query($konek,"SELECT  m.nama_lengkap, t.keterangan_testi, t.tgl_testi, t.blokir_testi FROM testimonial t JOIN member m ON t.id_member=m.id_member WHERE blokir_testi='N' ORDER BY id_testimonial DESC");
			    		while ($res = mysqli_fetch_array($x)) {
			    	?>
						<div class="media">
						  	<div class="media-left">
							    <a href="#">
							      <img class="media-object" src="<?php echo "frontend/icon/box-testi.png"; ?>" alt="...">
							    </a>
			  				</div>
						  	<div class="media-body">
						    	<h4 class="media-heading"><?php echo $res['nama_lengkap']; ?><span style='font-size:14px;'> / <?php echo tgl_indo($res['tgl_testi']);?></span></h4>
						    	<p><?php echo $res['keterangan_testi']; ?></p>
						  	</div>
						</div><!--media-->
		    		<?php } ?>
					</div><!--media-body-->
					<div class="show-entries-count" style="margin-top:20px;">
						<p><span style="font-weight:bold;font-size:15px;"><?php echo $cek_rows;?> <i class="fa fa-comments"></i></span> orang pelanggan Hotel Balecatur Inn telah menginap di hotel ini dan memberikan reviewnya</i></p>
					</div>
				</div><!--col-md-9-->
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong style="color:#e36b17;">More Information</strong>
						</div>
						<div class="panel-body">
								
						</div>
					</div>
				</div>
			</div>
			<!-- cek session -->
			<?php if (empty($_SESSION['id_member'])) {?>
			<div class="row">
				<div class="col-lg-12">
				<p>Untuk memberikan feedback kepada kami anda harus login terlebih dahulu klik di pada link => <a href="<?php echo $site;?>/auth/session_log/signin.php">Login</p>
				</div>
			</div>
			<?php }else{?>		
  		    <div class="row">
  		    	<div class="col-md-8">
  		    		<div class="panel panel-default">
  		    			<div class="panel-body" id="custom-panel-padd">
								<form id="add-testi" action="<?php echo $site;?>backend/proses_testimonial.php?act=addtesti" method="post" enctype="multipart/form-data">
									<div class="box-qoutedtesti">
										<input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>" class="form-control" autofocus required="" readonly></td>
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="emailtesti" value="<?php echo $cekuser_log['email'];?>" class="form-control" autofocus required="" readonly></td>
										</div>
										<div class="form-group">
											<label>Nama</label>
											<input type="text" name="namatesti" value="<?php echo $cekuser_log['nama_lengkap'];?>" class="form-control" autofocus required readonly></td>
										</div>
										<div class="form-group">
											<label>Tanggal</label>
											<input type="text" value="<?php echo datenow(); ?>" class="form-control" autofocus required readonly></td>
										</div>
										<div class="form-group">
											<label>Komentar</label>
											<textarea name="keterangan_testi" class="form-control" cols="8" rows="6" autofocus required></textarea></td>
										</div>
										<div>
											<input type="submit" class="btn btn-custom-balecatur-hotel" value="Kirim Testimonial">
										</div>
									</div>			
								</form>
  		    				</div>
  		    			</div>
					</div><!--col-md-8-->	
				<?php } ?>		
			</div><!--row-->			
		</div><!--post-rulefontorder-->		
	</div><!-- col-lg-12-->	
	<div style="margin-bottom:100px;"></div>
</div><!-- row-->			
