<?php include "../../config/koneksi.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- JQUERY VERSION 1.11.1 -->
<script src="<?php echo $site;?>frontend/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $site;?>adminbase/frontend/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$('#login-form').validate({
			rules:{
				email:{
					required:true,
					email:true,
				},
				password:{
					required:true,
				},
			},
			messages:{
				email:{
					required:"email anda tidak boleh kosong !!",
					email:"email anda tidak valid !!",
				},
				password:{
					required:"password tidak boleh kosong !!",
				}
			}
		});
	});
</script>
<style type="text/css">
	.error{
			color: #E60000;
			border-color: #E60000;
			display: block;
			font-size: 12px;
	}
</style>
	<meta charset="utf-8">
	<title>Hotel Balecatur Inn</title>
	<!-- src css sigup.css -->
	<link rel="shorcut icon" href="<?php echo "$site";?>frontend/icon/favicon.ico.png">
	<link href="../../frontend/css/basehotel.css" type="text/css" rel="stylesheet"> 
	<link href="../../frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet"> 
</head>
<body>
<form id="login-form" action="<?php echo $site;?>auth/forget_pass/proses_getpass/cekpassword_member.php" method="post" enctype="multipartformdata">
	<div class="display-outer"></div>
	 	<div class="main-logo header.center">
			<div class="header content.clearfix">
				<img class="logo" src="../../frontend/logo/resize-logo balecatur.png" alt="logo"></img>
			</div><!-- header content.clearfix -->
		</div><!-- main-logo header.center -->		
	<div class="content clearfix">
		<div class="banner">
			<h1>Hotel & Resto</h1>
			<h2 class="text-small">Please sign up to access our website</h2>
		</div><!-- banner -->
		<div class="box sign-card clearfix">
			<div class="content-cardsignup">
				<div class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Email" required=""></input>
				</div>	
				<div class="form-group">
					<input type="submit" class="btn-signinuser" value="Reset Password"></input>
				</div>
			</div><!-- content-cardsignup -->
		</div><!-- box sign-card clearfix -->
	</div><!-- content clearfix -->
</form>
</body>
</html>