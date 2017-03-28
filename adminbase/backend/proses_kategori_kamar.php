<?php include "../../config/koneksi.php";
$act= $_GET['act'];
//MANAJEMEN KATEGORI KAMAR
//tambah Kategori
if ($act=='add_kategori'){
    //upload foto script
    $lokasi_file    = $_FILES['foto']['tmp_name'];
    $nama_file      = $_FILES['foto']['name'];
    $acak           = rand(000000,999999);
    $nama_file_unik = $acak.$nama_file;
    $vdir_upload    = "../../uploads/kamar/";
    move_uploaded_file($_FILES["foto"]["tmp_name"],$vdir_upload . $nama_file_unik);

    $fasilitas =mysqli_real_escape_string($konek,$_POST['fasilitas']);

    $addkate = "INSERT INTO kategori_kamar(id_kategori_kamar,
                                           type_kamar,
                                           jumlah_kamar,
                                           foto_kamar,
                                           fasilitas,
                                           deskripsi,
                                           tarif)
                                  VALUES('$_POST[id_kategori_kamar]',
                                         '$_POST[type_kamar]',
                                         '$_POST[jumlah_kamar]',
                                         '$nama_file_unik',
                                         '$fasilitas',
                                         '$_POST[deskripsi]',
                                         '$_POST[tarif]')";

    $success = mysqli_query($konek,$addkate);

    if($success) {
        echo "<script>alert('Kategori kamar berhasil di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    }else {
        echo "<script>alert('Kategori kamar gagal di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    }
}
//update Kategori
elseif ($act=='edit_kategori'){
  //upload foto script
    $lokasi_file    = $_FILES['foto']['tmp_name'];
    $nama_file      = $_FILES['foto']['name'];
    $acak           = rand(000000,999999);
    $nama_file_unik = $acak.$nama_file;
    $vdir_upload    = "../../uploads/kamar/";
    move_uploaded_file($_FILES["foto"]["tmp_name"],$vdir_upload . $nama_file_unik);

    $fasilitas =mysqli_real_escape_string($konek,$_POST['fasilitas']);

  //jika fotonya kosong !
  if (empty($lokasi_file)) {
    $q="UPDATE kategori_kamar SET type_kamar        ='$_POST[type_kamar]',
                                  jumlah_kamar      ='$_POST[jumlah_kamar]',
                                  fasilitas         ='$fasilitas',
                                  deskripsi         ='$_POST[deskripsi]',
                                  tarif             ='$_POST[tarif]'
                            WHERE id_kategori_kamar ='$_POST[id]'";
    $success=mysqli_query($konek,$q);
  }else{
    //kondisi update foto baru
    if ($nama_file_unik != $_POST['foto_lama']) {
      unlink($vdir_upload . $_POST['foto_lama']);
    }

    $q="UPDATE kategori_kamar SET type_kamar         ='$_POST[type_kamar]',
                                  jumlah_kamar       ='$_POST[jumlah_kamar]',
                                  foto_kamar         ='$nama_file_unik',
                                  fasilitas          ='$fasilitas',
                                  deskripsi          ='$_POST[deskripsi]',
                                  tarif              ='$_POST[tarif]'
                            WHERE id_kategori_kamar  ='$_POST[id]'";
    $success=mysqli_query($konek,$q);
    if($success) {
        echo "<script>alert('Kategori kamar berhasil di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    }else {
        echo "<script>alert('Kategori kamar gagal di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    }
  }
}
//delete kategori
elseif ($act=='delete_kategori'){

    $ambil = mysqli_fetch_array(mysqli_query($konek,"select foto_kamar from kategori_kamar WHERE id_kategori_kamar='$_GET[id]'"));
    $vdir_upload    = "../../uploads/kamar/";
    unlink($vdir_upload . $ambil['foto_kamar']);

    $q = "DELETE FROM kategori_kamar WHERE id_kategori_kamar='$_GET[id]'";
    $success = mysqli_query($konek,$q);
    if($success) {
        echo "<script>alert('Kategori kamar berhasil di hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    } else {
        echo "<script>alert('Kategori kamar berhasil di hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kategori_kamar>";
    }
}

?>