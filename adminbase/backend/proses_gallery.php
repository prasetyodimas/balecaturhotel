<?php include "../../config/koneksi.php";
$act= $_GET['act'];
// MANAGEMENT GALLERY
//add gallery
if ($act=='add_gallery'){
    $lokasi_file        = $_FILES['foto_gallery']['tmp_name'];
    $nama_file          = preg_replace('/\s+/', '_', $_FILES['foto_gallery']['name']);  
    $vdir_upload        ="../../uploads/gallery/";
    $move =  move_uploaded_file($_FILES['foto_gallery']['tmp_name'],$vdir_upload.$nama_file);

    $addgalle ="INSERT INTO gallery (foto_gallery, deskripsi_foto) VALUES ('$nama_file','$_POST[deskripsi_foto]')";
    $success =mysqli_query($konek,$addgalle);
    if($success) {
        echo "<script>alert('Data gallery berhasil disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }else{
        echo "<script>alert('Data gallery gagal disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }

}elseif ($act=='update_gallery'){
    $lokasi_file        = $_FILES['foto_gallery']['tmp_name'];
    $nama_file          = preg_replace('/\s+/', '_', $_FILES['foto_gallery']['name']);  
    $vdir_upload        = "../../uploads/gallery/";
    move_uploaded_file($_FILES['foto_gallery']['tmp_name'],$vdir_upload.$nama_file);

  if (empty($location_file)) {
      $q = "UPDATE gallery SET deskripsi_foto='$_POST[deskripsi_foto]' WHERE id_gallery='$_POST[id]'";
      $success =mysqli_query($konek,$q);

      if($success) {
          echo "<script>alert('Data gallery berhasil diubah !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
      }else{
          echo "<script>alert('Data gallery gagal diubah !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
      }

  }else{

    if ($nama_file != $_POST['foto_lama']) {
        unlink($vdir_upload . $_POST['foto_lama']);
    }
    $q ="UPDATE gallery SET foto_gallery='$nama_file', deskripsi_foto ='$_POST[deskripsi_foto]' WHERE id_gallery='$_POST[id]'";
    $success = mysqli_query($konek,$q);
      if ($success) {
        echo "<script>alert('Data gallery berhasil diubah !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
      }else{
        echo "<script>alert('Data gallery gagal diubah !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
      }
  }

}elseif($act=='delete_galllery'){
    $get_image   = mysqli_fetch_array(mysqli_query($konek, "select * from gallery where id_gallery='$_GET[id]'"));
    $vdir_upload = "../../uploads/gallery/";
    unlink($vdir_upload. $get_image['foto_gallery']);
    $eksekusi= "DELETE FROM gallery WHERE id_gallery='$_GET[id]'";
    $success = mysqli_query($konek, $eksekusi);
    if($success) {
      echo "<script>alert('Data gallery berhasil dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }else{
      echo "<script>alert('Data gallery gagal dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }
}
?>