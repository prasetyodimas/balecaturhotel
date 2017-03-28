<?php include "../../config/koneksi.php";
$act= $_GET['act'];
//MANAGEMENT LAUNDRY
//tambah laundry
if ($act=='add_laundry') {
  $addlaundry ="INSERT INTO laundry (jenis_laundry, harga_laundry, ket_laundry) VALUES
              ('$_POST[jenis_laundry]','$_POST[harga_laundry]','$_POST[ket_laundry]')";
  $saving =mysqli_query($konek,$addlaundry);
  if ($saving) {
    echo "<script>alert('Data berhasil disimpan !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }else{
    echo "<script>alert('Data gagal disimpan !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }
}
//edit laundry
elseif ($act=='edit_laundry') {
  $editlaundry= "UPDATE laundry SET jenis_laundry ='$_POST[jenis_laundry]',
                                    harga_laundry ='$_POST[harga_laundry]',
                                    ket_laundry   ='$_POST[ket_laundry]'
                              WHERE id_laundry    ='$_POST[id]'";
  $success =mysqli_query($konek,$editlaundry);
  if ($success) {
    echo "<script>alert('data berhasil di update !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }else{
    echo "<script>alert('data gagal di update !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }
}

//hapus laundry
elseif ($act=='delete_laundry') {
  $hapuslaundry = mysqli_query($konek," DELETE FROM laundry WHERE id_laundry='$_GET[id]'");
  if ($hapuslaundry) {
    echo "<script>alert('data berhasil di hapus !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }else{
    echo "<script>alert('data gagal di hapus !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }
}
?>