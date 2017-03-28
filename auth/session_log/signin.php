<?php session_start();include "../../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hotel Balecatur Inn</title>
	<!-- src css sigup.css -->
	<link rel="shorcut icon" href="<?php echo "$site";?>frontend/icon/favicon.ico.png">
	<link href="../../frontend/css/basehotel.css" type="text/css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keyword" content="hotel murah dijalan wates,hotel murah dan berkualitas">
	<link href="<?php echo $site;?>frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<link href="<?php echo $site;?>frontend/css/basehotel.css" type="text/css" rel="stylesheet">
	<!-- JQUERY VERSION 1.11.1 -->
	<script src="<?php echo $site;?>frontend/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo $site;?>frontend/js/jquery.validate.min.js"></script>

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
</head>
<body>
<form id="login-form" action="<?php echo $site;?>backend/proses_sign.php" method="post" enctype="multipartformdata">
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
					<input class="form-control" type="password" name="password" placeholder="Password" required=""></input>
				</div>
				<div class="form-group">
					<input type="submit" class="btn-signinuser" value="Login"></input>
				</div>
			</div><!-- content-cardsignup -->
			<div class="createaccount">
				<a href="<?php echo "$site"."index.php?modul=signup"?>" class="a-createaccount">Sign up</a> |
				<a href="../forget_pass/forgetpassword.php" class="a-createaccount">Forgot password</a>
			</div>
		</div><!-- box sign-card clearfix -->
	</div><!-- content clearfix -->
</form>
</body>
</html>
