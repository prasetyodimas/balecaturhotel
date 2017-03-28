<?php   session_start();
include "../../config/koneksi.php";
$username =mysqli_real_escape_string($konek,$_POST['username']);
$password =mysqli_real_escape_string($konek,md5($_POST['password']));
//cek querinya
$querinya =mysqli_query($konek,"SELECT * FROM admin WHERE username='$username' AND password='$password' AND status='N' AND level='$_POST[level_akses]'");
$ketemu   =mysqli_fetch_array($querinya);
//note level 1=>admin sistem 2=>receptionist 3=>pimpinan 4=>roomboy
if ($ketemu['username']==$username AND $ketemu['password']==$password) {
    $_SESSION['id_admin']     = $ketemu ['id_admin'];
    $_SESSION['username']     = $ketemu ['username'];
    $_SESSION['password']     = $ketemu ['password'];
    $_SESSION['level_admin']  = $ketemu ['level'];
    $_SESSION['status']       = $ketemu ['status'];

    echo "<script>alert('Selamat datang ".$_SESSION['username']." !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=".$site."adminbase/homeadmin.php?modul=dashboard>";
}else{
    echo "<script>alert('maaf username dan password anda salah cek kolom username password dan level !!')</script>";
    echo "<script>history.go(-1)</script>";
}

?>
