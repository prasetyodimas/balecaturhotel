<?php include "../../../config/koneksi.php";

// debug 
/*echo $_POST['email'];
echo $_POST['password'];*/

$var_newemail = $_POST['email'];
$var_newpass  = $_POST['password'];


$getpass  = mysqli_query($konek,"SELECT * FROM member WHERE email ='$_POST[email]'");
/*echo $getpass; exit();*/
$cekbaris = mysqli_num_rows($getpass);

if ($cekbaris > 0) {

	//membuat password random
	/*$karakter = array("A","B","C","D","F","J",0,1,2,3,4,5,6,7,8,9,10);
	$get_aray = array();
	while (count($get_aray)<5) {
		
		//acak karakter untuk password
		$acakkarakter = rand(0,(count($karakter)-1));
		$reskarkter   = $karakter[$acakkarakter];
		$ambil[]      = $karakter[$acakkarakter];

		$gabungkar =implode("", $ambil);
		$newpass   =md5($gabungkar);*/

		$newpass   =md5($var_newpass);
		$update_newpass =mysqli_query($konek,"UPDATE member SET password='$newpass' WHERE email='$var_newemail'");
		//cek baris 
		if($update_newpass){
			echo "
				<div class='container'>
					<div class='row'>
						<div class='col-lg-12'>
							<div class='alert alert-success'>
								Password baru anda adalah : $var_newpass  silahkan anda login dengan password anda yang baru, klik link berikut 
							</div>
						</div>
					</div>
				</div>
			<br><a href='$site"."auth/session_log/signin.php'>Klik di sini untuk login ke sistem</a> </br>";
		}else{
			echo "<script>alert('password gagal di ubah !! ulangi lagi !!');</script>";
		}
// jika gagal eksekusi !!
}else{
	echo "<script>alert(' password gagal diubah , email anda mungkin tidak valid !!');</script>";
	echo "<meta http-equiv=refresh content=0;url=../../../auth/session_log/signin.php>";
}
?>
<link href="<?php echo $site;?>frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet">
