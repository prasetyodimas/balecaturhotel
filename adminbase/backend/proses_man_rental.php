<?php include '../../config/koneksi.php';
$act= $_GET['act'];
//MANAGEMENT RENTAL
//tambah rental
if ($act=='add_rental') {
  //validasi rental
  $cekdata_rent = mysqli_query($konek,"SELECT * FROM rental WHERE nama_kendaraan='$_POST[nama_kendaraan]'");
  $return_cek   = mysqli_num_rows($cekdata_rent);
  if ($return_cek > 0) {
    echo "<script>alert('Data sudah di input !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
  }else{

    $lokasi_file = $_FILES['foto_kendaraan']['tmp_name'];
    $nama_file   = $_FILES['foto_kendaraan']['name'];
    $acak        = rand(000000,999999);
    $nama_file_unik = $acak . $nama_file;
    $vdir_upload  = "../../uploads/rental/";
    move_uploaded_file($_FILES['foto_kendaraan']['tmp_name'], $vdir_upload.$nama_file_unik);
    $ket_kendaraan =mysqli_real_escape_string($konek,$_POST['ket_kendaraan']);

    $query ="INSERT INTO rental (kate_kendaraan, nama_kendaraan, harga_kendaraan, foto_kendaraan, ket_kendaraan)
             VALUES ('$_POST[kate_kendaraan]', '$_POST[nama_kendaraan]', '$_POST[harga_kendaraan]', '$nama_file_unik', '$ket_kendaraan')";

    $berhasil =mysqli_query($konek,$query);
    if ($berhasil) {
      echo "<script>alert('Data berhasil disimpan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
    }else{
      echo "<script>alert('Data gagal disimpan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
    }
  }
}
//edit rental
elseif ($act=='edit_rental') {
  $lokasi_file    = $_FILES['foto_kendaraan']['tmp_name'];
  $nama_file      = $_FILES['foto_kendaraan']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak . $nama_file;
  $vdir_upload    = "../../uploads/rental/";
  move_uploaded_file($_FILES['foto_kendaraan']['tmp_name'], $vdir_upload.$nama_file_unik);
  $ket_kendaraan =mysqli_real_escape_string($konek,$_POST['ket_kendaraan']);

  if (empty($lokasi_file)) {
    $get_query ="UPDATE rental SET kate_kendaraan='$_POST[kate_kendaraan]', nama_kendaraan='$_POST[nama_kendaraan]',
                harga_kendaraan='$_POST[harga_kendaraan]', ket_kendaraan='$ket_kendaraan' WHERE id_rental='$_POST[id]'";
    $saved_update=mysqli_query($konek,$get_query);
    if ($saved_update) {
      echo "<script>alert('Data rental berhasil diubah !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
    }else{
      echo "<script>alert('Data gagal disimpan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
    }

  }else{

    if ($nama_file_unik != $_POST['foto_lama']) {
          unlink($vdir_upload . $_POST['foto_lamaa']);
    }


    $get_query = "UPDATE rental SET kate_kendaraan  ='$_POST[kate_kendaraan]',
                                    nama_kendaraan  ='$_POST[nama_kendaraan]',
                                    harga_kendaraan ='$_POST[harga_kendaraan]',
                                    foto_kendaraan  ='$nama_file_unik',
                                    ket_kendaraan   ='$_POST[ket_kendaraan]'
                              WHERE id_rental       ='$_POST[id]'";
    $saved_update=mysqli_query($konek,$get_query);

    if ($saved_update) {
        echo "<script>alert('Data berhasil disimpan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
    }else{
        echo "<script>alert('Data gagal disimpan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";

    }

  }

}
//hapus rental
elseif ($act=='hapus_rental') {
  //get image
  $get_image = mysqli_fetch_array(mysqli_query($konek,"select foto_kendaraan from rental where id_rental='$_GET[id]'"));
  $vdir_upload ="../../uploads/rental/";
  unlink($vdir_upload . $get_image['foto_kendaraan']);

  $data_rental =mysqli_query($konek,"DELETE FROM rental WHERE id_rental='$_GET[id]'");
  if ($data_rental) {
    echo "<script>alert('Data berhasil dihapus !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
  }else{
    echo "<script>alert('Data gagal dihapus !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
  }
}
?>