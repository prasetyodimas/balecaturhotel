<?php include "../../config/koneksi.php";
$act= $_GET['act'];
// MANAGEMENT EXTRABED
if ($act=='add_extrabed') {
  $insert ="INSERT INTO extrabed (harga_extrabed) VALUES ('$_POST[harga_extrabed]')";
  $saved =mysqli_query($konek,$insert);

  if ($saved) {
     echo "<script>alert('Extrabed berhasil di simpan !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }else{
     echo "<script>alert('Extrabed gagal di simpan !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }

}elseif ($act=='edit_extrabed') {
  $edit_query = "UPDATE extrabed SET harga_extrabed='$_POST[harga_extrabed]'";
  $saved =mysqli_query($konek,$edit_query);
  if ($saved) {
     echo "<script>alert('Extrabed berhasil di diubah !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }else{
     echo "<script>alert('Extrabed gagal di diubah !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }

}elseif ($act=='delete_extrabed') {
  $edit_query = "DELETE FROM extrabed WHERE id_extrabed='$_GET[id]'";
  $saved =mysqli_query($konek,$edit_query);
  if ($saved) {
     echo "<script>alert('Extrabed berhasil di hapus !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }else{
     echo "<script>alert('Extrabed gagal di hapus !!')</script>";
     echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_extrabed>";
  }
}
?>