<?php include "../config/koneksi.php";

  	session_start();
  	// session_destroy();
	unset($_SESSION['username']);
	unset($_SESSION['nama_lengkap']);
	unset($_SESSION['password']);
	unset($_SESSION['level_admin']);
	
  	echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b><br/>";
  	echo "<meta http-equiv='refresh' content='2; url=".$site."adminbase'>";

?>
