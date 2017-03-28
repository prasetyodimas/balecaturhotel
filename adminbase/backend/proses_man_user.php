<?php include "../../config/koneksi.php";

$act=$_GET['act'];

//MANAGEMENT MEMBER & USER ADMIN

// Add User admin
if ($act=='adduser') {

  $pass = md5($_POST['password']);
  $q = "INSERT INTO admin (username, password, level, status)
        VALUES('$_POST[username]','$pass','$_POST[user]','$_POST[blokir]')";
  $success = mysqli_query($konek,$q);

    if($success) {
        echo "<script>alert('User berhasil di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User Gagal Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}

// Update User admin
elseif ($act=='updateUser'){

  $success = mysqli_query($konek,"UPDATE admin SET username='$_POST[username]', status ='$_POST[blokir]' WHERE id_admin = '$_POST[id]'");
    if($success) {
        echo "<script>alert('User berhasil di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User gagal di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}

// Hapus User admin
elseif ($act=='hapusUser'){

  $success = mysqli_query($konek,"DELETE FROM admin WHERE id_admin='$_GET[id]'");
  if($success) {

        echo "<script>alert('User berhasil di hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User gagal di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}

