<?php include "../../config/koneksi.php";
$act=$_GET['act'];
//MANAGEMENT RESTORASI
//add menu
if ($act=='tambah_menu') {
  //cek validasi 
  $checkval = mysqli_query($konek,"SELECT * FROM detail_paket WHERE id_paket='$_POST[id_paket]'");
  $cek = mysqli_num_rows($checkval);
  if ($cek > 0) {
        echo "<script>alert('Maaf paket sudah disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
  }else{
    $querymenu = "INSERT INTO detail_paket (id_paket, keterangan_menunya) VALUES ('$_POST[id_paket]', '$_POST[keterangan_menunya]')";
    $berhasil =mysqli_query($konek, $querymenu);

      if ($berhasil) {
          echo "<script>alert('Data berhasi disimpan !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
      }else{
          echo "<script>alert('Data Gagal disimpan !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
      }

  }
//update menu
}elseif ($act=='update_datamenu') {

  $updatemenu = "UPDATE detail_paket SET id_paket='$_POST[id_paket]', keterangan_menunya='$_POST[keterangan_menunya]'
                 WHERE id_detail_paket ='$_POST[id_detail_paket]'";
  $berhasilupdate =mysqli_query($konek, $updatemenu);

    if ($berhasilupdate) {
       echo "<script>alert('Data berhasil di update !!')</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
    }else{
       echo "<script>alert('Data gagal di update !!')</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
    }
}
//hapus menu
elseif ($act=='hapus_manmenu') {

  $hapusmenu="DELETE FROM detail_paket WHERE id_detail_paket ='$_GET[id]'";
  $success_delete = mysqli_query($konek,$hapusmenu);

  if ($success_delete) {
      echo "<script>alert('Data berhasil dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
  }else{
      echo "<script>alert('Data gagal dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_menu>";
  }
}
?>