<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox-effects-a').fancybox();
	});
</script>
<?php $user =  $_SESSION['id_member'];  
$data = mysqli_fetch_array(mysqli_query($konek, "select * from member where id_member='$user'"));
//var dirr foto	user member	
$photo = $site."uploads/user/".$data['foto'];	
//var dirr bukti identitas
$photo_bukti_identitas = $site."uploads/identitas/".$data['foto_identitas'];	

?>
<!-- style akun information -->
<style type="text/css">
	.form-group .id-member{margin-left:87px;}
	.form-group .nama-lengkap{margin-left:65px;}
	.form-group .jenis-kelamin{margin-left:75px;}
	.form-group .email-user{margin-left:128px;}
	.form-group .alamat-user{margin-left:120px;}
	.form-group .notelp-user{margin-left:120px;}
	.form-group .kebangsaan-user{margin-left:86px;}
	.form-group .jenisidentitas-user{margin-left:76px;}
	.form-group .identitas-user{margin-left:93px;}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">MANAGE AKUN</h1>
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
				<form action="<?php echo $site;?>index.php?modul=manageakunedit&id=<?php echo $_SESSION['id_member'];?>" method="post" enctype="multipart/form-data" role="form">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<p>ID Member <span class="id-member">: <strong><?php echo $data['id_member'];?></strong></span></p>
										</div>
										<div class="form-group">
											<p>Nama Lengkap<span class="nama-lengkap">: <?php echo $data['nama_lengkap'];?></span></p>
										</div>
										<div class="form-group">
											<p>Jenis Kelamin<span class="jenis-kelamin">: <?php echo $data['jenis_kelamin'];?></span></p>
										</div>
										<div class="form-group">
											<p>Email<span class="email-user">: <?php echo $data['email'];?></span></p>
										</div>
										<div class="form-group">
											<p>Alamat<span class="alamat-user">: <?php echo $data['alamat'];?></span></p>
										</div>
										<div class="form-group">
											<p>No telp<span class="notelp-user">: <?php echo $data['no_telp'];?></span></p>
										</div>
										<div class="form-group">
											<p>Kebangsaan<span class="kebangsaan-user">: <?php echo $data['kebangsaan'];?></span></p>
										</div>
										<div class="form-group">
											<p>Jenis Identitas<span class="jenisidentitas-user">: <?php echo $data['jenis_identitas'];?></span></p>
										</div>
										<div class="form-group">
											<p>No identitas<span class="identitas-user">: <?php echo $data['identitas_user'];?></span></p>
										</div>
										<!-- Foto Identitas -->
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Foto identitas</label>
													<a class="fancybox-effects-a" href="<?php echo $photo_bukti_identitas;?>">
													<img class="img-responsive" src="<?php echo $photo_bukti_identitas;?>"></a>
												</div><!-- col md 3-->
											</div>
										</div>
										<div class="form-group">
											<button class="btn btn-danger" value="Edit Profil">Edit Profil</input>
										</div>
									</div>
									<div class="col-md-4">
										<?php if ($data['foto']=='-'){ ?>
											<a class="fancybox-effects-a" href="<?php echo $site;?>uploads/blank_user/User.jpg">
											<img class='sizing-border' width="200" height="auto" src="<?php echo $site;?>uploads/blank_user/User.jpg"></img></a>
										<?php }else{ ?>
											<a class="fancybox-effects-a" href="<?php echo $photo;?>">
											<img class='img-responsive sizing-border' src="<?php echo $photo;?>"></img></a>
										<?php } ?>
									</div>
								</div><!-- row-->
							</div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>
