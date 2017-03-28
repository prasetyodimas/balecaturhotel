<?php session_start();
include "../config/koneksi.php";
$username =mysqli_real_escape_string($konek,$_POST['email']);
$password =mysqli_real_escape_string($konek,$_POST['password']);

if ($username=='' OR $password==''){
    echo "<script>alert('Username atau password kosong !!!')</script>";
    echo "<script>history.go(-1)</script>";
}else {
    $password = md5($password);
    $query=mysqli_query($konek,"SELECT * FROM member WHERE email='$username' AND password='$password'");
    $record=mysqli_fetch_array($query);
    if ($record['email']==$username and $record['password']==$password) {
        $_SESSION['id_member']      = $record['id_member'];
        $_SESSION['email']          = $record['email'];
        $_SESSION['nama_lengkap']   = $record['nama_lengkap'];
        echo "<script>alert('Selamat Datang di sistem kami ".$_SESSION['nama_lengkap']."!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site>";
    } else {
        echo "<script>alert('Username atau password salah !!!')</script>";
        echo "<script>history.go(-1)</script>";
    }
}
?>