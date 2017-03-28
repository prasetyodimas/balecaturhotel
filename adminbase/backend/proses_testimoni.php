<?php include "../../config/koneksi.php";

$act=$_GET['act'];
//MANAGEMENT TESTIMONI
//update testimoni
if ($act=='update_testi'){
  $keterangan_testi =mysqli_real_escape_string($konek,$_POST['keterangan_testi']);
  $success = mysqli_query($konek,"UPDATE testimonial SET id_member='$_POST[id_member]', keterangan_testi='$keterangan_testi', blokir_testi='$_POST[blokir_testi]' WHERE id_testimonial='$_POST[id_testimonial]'");
  if($success) {
        echo "<script>alert('Testimoni berhasil di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_testimoni>";
    } else {
        echo "<script>alert('Testimoni gagal di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_testimoni>";
    }
}
//hapus akomodasi
elseif ($act=='delete_testi') {
  $isi_testi =mysqli_query($konek,"DELETE FROM testimonial WHERE id_testimonial='$_GET[id]'");
  if ($isi_testi) {
      echo "<script>alert('Testimoni berhasil dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_testimoni>";
  }else{
      echo "<script>alert('Testimoni gagal dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_testimoni>";
  }
}
