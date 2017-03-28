<?php include "../../../config/koneksi.php";
//var user dari form to get user baru
$email_user = $_POST['email'];

// cek user email tsb ada atau tidak !!
$cek_user = mysqli_query($konek,"SELECT * FROM member WHERE email='$email_user'");
$cek_barismember = mysqli_num_rows($cek_user);

// jika ada email user di database !!
if ($cek_barismember > 0) {

	$show  = mysqli_fetch_array($cek_user);
	$email = $show['email'];

	$panjangkar       = strlen($email);
	$karkter_depan    = substr($email,0,2);
	$karkter_belakang = substr($email,-12);
	$hiden_karakter   = $panjangkar-2;

	if ($show < 0) {
		echo "<script>alert('Maaf kami tidak dapat menemukan email anda !! silahkan hubungi admin kami ');</script>";
	    echo "<http-equiv=refresh content=0;url=auth/forget_pass/cekpassword_member.php>";
	}else{

		echo "<script>alert('Anda yakin email anda adalah $_POST[email]');</script>";
		$tekshow_bintang = str_repeat("*",$hiden_karakter);
		$newkarakter     = "$karkter_depan $tekshow_bintang $karkter_belakang";
		$ket="<form method=post action='$site"."auth/forget_pass/proses_getpass/getpassword_proses.php'>
		<input type=hidden name=email value='$email'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-5'>
					<div class='alert alert-danger'>
						email anda adalah : <b>$newkarakter</b>
					</div>
					<div class='form-group'>
						<p>Ketik selengkapnya</p>
						<input type='text' name='email' autofocus required='' autocomplete='off' class='form-control'>
					</div>
					<div class='form-group'>
						<p>Password Baru</p>
						<input type='text' autofocus required='' class='form-control' autocomplete='off' name='password'>
					</div>
				</div>
			</div>
				<input type='submit' class='btn btn-danger' value='Ubah Password'></form>
		</div>";
		echo $ket;

	}

//jika email user tidak ada di database !!
}else{

	echo "<script>alert('Maaf kami tidak dapat menemukan email anda $_POST[email] !! silahkan hubungi admin kami ');</script>";
/*	echo "<script>javascript:history.go(-2);</script>";*/
	echo "<http-equiv=refresh content=0;url=auth/session_log/signin.php>";


}

?>
<!-- CSS -->
<link href="<?php echo $site;?>frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
	$(document).ready(function(){
		$('.').validate({
			rules:{

			},messages:{


				
			}
		});
	}
</script>