<?php include "../../config/koneksi.php";
$act=$_GET['act'];
//MANAGEMENT AKOMODASI
//tambah akomodasi
if ($act=='add_akomodasi'){
  $ket_akomodasi =mysqli_real_escape_string($konek,$_POST['ket_akomodasi']);
  $success = mysqli_query($konek, "INSERT INTO akomodasi(judul_akomodasi, ket_akomodasi) VALUES ('$_POST[judul_akomodasi]','$ket_akomodasi')");
  if($success) {
        echo "<script>alert('Akomodasi berhasil di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
    } else {
        echo "<script>alert('Akomodasi gagal di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
    }
}
//update akomodasi
elseif ($act=='update_akomodasi'){
  $ket_akomodasi =mysqli_real_escape_string($konek,$_POST['ket_akomodasi']);
  $success = mysqli_query($konek,"UPDATE akomodasi SET judul_akomodasi='$_POST[judul_akomodasi]', ket_akomodasi='$ket_akomodasi' WHERE id_akomodasi='$_POST[id]'");
  if($success) {
        echo "<script>alert('Akomodasi berhasil di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
    } else {
        echo "<script>alert('Akomodasi gagal di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
    }
}
//hapus akomodasi
elseif ($act=='hapus_akomodasi') {
  $isi_berita =mysqli_query($konek,"DELETE FROM akomodasi WHERE id_akomodasi='$_GET[id]'");
  if ($isi_berita) {
      echo "<script>alert('Akomodasi berhasil dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
  }else{
      echo "<script>alert('Akomodasi gagal dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_akomodasi>";
  }
}
