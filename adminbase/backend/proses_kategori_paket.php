<?php include "../../config/koneksi.php";
$act= $_GET['act'];
//MANAGEMENT RESTORASI
//tambah kategori paket
if ($act=='add_paket') {
  $get_katemenu = mysqli_query($konek,"SELECT * FROM paket WHERE nama_paket='$_POST[nama_paket]'");
  $cek_datakatemenu = mysqli_num_rows($get_katemenu);
  if ($cek_datakatemenu > 0) {
    echo "<script>alert('Data sudah di input !!')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
  }else{
    $query_katemenu = "INSERT INTO paket (nama_paket, harga_paket) VALUES('$_POST[nama_paket]','$_POST[harga_paket]')";
    $berhasil = mysqli_query($konek, $query_katemenu);

    if ($berhasil) {
        echo "<script>alert('Data berhasil disimpan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
    }else{
        echo "<script>alert('Data gagal disimpan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
    }
  }
}
//edit kategori paket
elseif($act=='edit_paket') {
  //validasi update
  $getq= mysqli_query($konek,"SELECT * FROM paket WHERE nama_paket='$_POST[id_paket]'");
  $cekbaris = mysqli_num_rows($getq);
  if ($cekbaris > 0) {
        echo "<script>alert('Data berhasil di update !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
  }else{
    $Qpaket = "UPDATE paket SET nama_paket='$_POST[nama_paket]', harga_paket='$_POST[harga_paket]' WHERE id_paket='$_POST[id_paket]'";
    $success =mysqli_query($konek,$Qpaket);

    if ($success) {
        echo "<script>alert('Data berhasil di update !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
    }else{
        echo "<script>alert('Data gagal disimpan !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
    }

  }

}
//hapus kategori paket
elseif($act=='delete_paket') {
  $hapuspaket = mysqli_query($konek,"DELETE FROM paket WHERE id_paket='$_GET[id]'");

  if ($hapuspaket) {
      echo "<script>alert('Data berhasil di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
  }else{
      echo "<script>alert('Data gagal di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";

  }
}
?>