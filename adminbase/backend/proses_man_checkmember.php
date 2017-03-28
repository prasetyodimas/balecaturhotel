<?php session_start();
      include "../../config/koneksi.php";
      include "../../fungsi/function_transaksi.php";
$act = $_GET['act'];

if ($act=='check_member') {
  //cek membernya 
  $userid = $_POST['id_member'];
  //CONVERT VARIABLES TO SESSION VAR
  $_SESSION['sessi_kamar'];
  $_SESSION['session_user'] = $_POST['id_member'];
  $_SESSION['session_checkin'];
  $_SESSION['session_checkout'];
  //print_r($_SESSION['sessi_kamar']);
  $check_member = mysqli_query($konek,"SELECT * FROM member WHERE id_member='$userid'");
  $cek_rows_member = mysqli_num_rows($check_member);
  if ($cek_rows_member > 0) {
      echo "<script>alert('Data yang anda cari telah ditemukan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_getall_transaction>";
  }else{
      echo "<script>alert('Mohon Maaf data member yang anda cari tidak ditemukan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_justreserve>";
  }

}
?>

