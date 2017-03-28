<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox-effects-a').fancybox();
	});
</script>
<?php $user =  $_SESSION['id_member'];  
$q = mysqli_query($konek, "select * from member where id_member='$user'");
	while ($data=mysqli_fetch_array($q)) {
	$photo = $site."uploads/user/".$data['foto'];	
	$photo_bukti_identitas = $site."uploads/identitas/".$data['foto_identitas'];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">MANAGE AKUN HOTEL BALECATUR INN</h1>
		   	<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
	      		<li class="active">My Profile</li>
			</ol>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading"><strong><h6>DASHBOARD USER</h6></strong></div>
						<div class="left-sidebarorder">
							<ul class="list-unstyled">
							<?php 
								$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
								if($url == $site."index.php?modul=myorder") {
									$url_myprofile = "active";
								}
							?>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=myorder";?>"><i class="fa fa-shopping-basket fa-fw"></i> My order</a></li>
								<li><a class="none-underline <?php echo $url_myprofile; ?>" href="<?php echo "$site"."index.php?modul=manageakun";?>"><i class="fa fa-user fa-fw"></i> My profil</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=history_pemesanan";?>"><i class="fa fa-search-plus fa-fw"></i> History pemesanan</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-lg-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5>Account Information</h5>
						</div>
					</div>
					<form action="<?php echo $site;?>backend/proses_manage_akun.php?act=update_member&id=<?php echo $_SESSION['id_member']?>" method="post" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-8">
									<!-- <div class="action-userback"><a class="overaction-back" href="javascript:history.back();"><- Go Back</a></div> -->
									<input type="hidden" name="id_member" value="<?php echo $_SESSION['id_member'];?>">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap'];?>">
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" value="<?php echo $data['email'];?>">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="text" name="password" readonly class="form-control" value="<?php echo $data['password']?>">
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<textarea cols="5" rows="5" name="alamat" class="form-control"><?php echo $data['alamat'];?></textarea>
									</div>
									<div class="form-group radio-pointer">
										<label>Jenis Kelamin</label>
										<?php
											if ($data['jenis_kelamin']=='Pria') {
												echo "<label class='radio-inline'></label>";	
													echo "<input type='radio' class='radio-clickpointer' name='jenis_kelamin' value='Pria' checked=''> Pria";
												echo "<label class='radio-inline'></label>";	
													echo "<input type='radio' class='radio-clickpointer' name='jenis_kelamin' value='Wanita'> Wanita";
											}elseif ($data['jenis_kelamin']=='Wanita') {
												echo "<label class='radio-inline'></label>";	
													echo "<input type='radio' class='radio-clickpointer' name='jenis_kelamin' value='Pria'> Pria";
												echo "<label class='radio-inline'></label>";	
													echo "<input type='radio' class='radio-clickpointer' name='jenis_kelamin' value='Wanita' checked=''> Wanita";
											}
										?>
									</div>
									<div class="form-group">	
										<label>No telp</label>
										<input type="text" name="no_telp" class="form-control" value="<?php echo $data['no_telp'];?>">
									</div>
									<div class="form-group">
										<label>Jenis identitas</label>
										<select name="jenis_identitas" class="form-control" style="cursor:pointer;">
											<option value="<?php echo $data['jenis_identitas'];?>"><?php echo $data['jenis_identitas'];?></option>
											<option value="KTP">KTP</option>
											<option value="SIM">SIM</option>
											<option value="Passport">Passport</option>
										</select>
									</div>
									<div class="form-group">
										<label>Nomor identitas</label>
										<input type="text" name="identitas_user" class="form-control" value="<?php echo $data['identitas_user'];?>">
									</div>
									<div class="form-group">
										<label>Bukti identitas</label>
										<div class="form-group">
											<a class="fancybox-effects-a" href="<?php echo $photo_bukti_identitas;?>">
											<img class="img-responsive" width="100" height="auto" src="<?php echo $photo_bukti_identitas;?>"></a>
										</div>
										<!-- <input type="file" name="foto_identitas"> -->
									</div>
									<div class="form-group">
										<label>Foto profil | *disi jika ingin merubah</label>
										<input type="file" name="foto_member">
									</div>
									<div class="form-group">
										<button class="btn btn-danger" value="Edit Profil">Edit Profil</input>
									</div>
								</div><!-- col-md-8-->
								<div class="col-md-3">
									<?php if ($data['foto']=='-') { ?>
										<a href="<?php echo $site;?>uploads/blank_user/User.jpg" class="fancybox-effects-a">
										<img class='img-responsive' src="<?php echo $site;?>uploads/blank_user/User.jpg"></img></a>
									<?php }else{ ?>
										<a href="<?php echo $site;?>uploads/user/<?php echo $data['foto'];?>" class="fancybox-effects-a">
										<img class='img-responsive' src="<?php echo $site;?>uploads/user/<?php echo $data['foto'];?>"></img></a>
									<?php } ?>
								</div>
							<?php } ?>	
							</div>
						</div><!--panel-body-->
					</div><!-- panel panel default -->
					<div style="margin-top:10px;"></div> 
					</form>
				</div><!--col-md-9 col-lg-9-->
			</div><!--row-->
		</div><!--post rulefontorder-->
	</div><!-- col-lg-12-->
</div><!-- row-->
