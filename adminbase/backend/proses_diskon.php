<?php include "../../config/koneksi.php";error_reporting(0);
$act= $_GET['act'];
// MANAGEMENT DISKON
//tambah diskon
if ($act== 'add_diskon') {
    $pecahtgl1 = explode("/", $_POST['dari_tgl']);
    $date1 = $pecahtgl1[0]."-".$pecahtgl1[1]."-".$pecahtgl1[2];
    $pecahtgl2 = explode("/", $_POST['sampai_tgl']);
    $date2 = $pecahtgl2[0]."-".$pecahtgl2[1]."-".$pecahtgl2[2];
    //variable menentukan tanggal sekarang !!
    $datenows = date("d");
  //cek validasi form yang diinput user  !!
  if ($date1 == $date2) {
      echo "<script>alert('Maaf tanggal yang di inputkan tidak boleh sama !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
  }else{
  //validasi tanggal
  $cektanggalnya = mysqli_query($konek,"SELECT * FROM diskon WHERE dari_tgl='$date1' AND sampai_tgl='$date2' AND id_kategori_kamar='$_POST[id_kategori_kamar]'");
  $cekbaris = mysqli_num_rows($cektanggalnya);
    if ($cekbaris > 0) {
      echo "<script>alert('Maaf tanggal diskon dan kamarnya tidak boleh sama !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
    }else{
      //filter diskon
      $ket_diskon = mysqli_real_escape_string($konek,$_POST['ket_diskon']);
      $querydisc = "INSERT INTO diskon (id_kategori_kamar,
                                        besar_diskon,
                                        dari_tgl,
                                        sampai_tgl,
                                        keterangan_diskon)
                                VALUES ('$_POST[id_kategori_kamar]',
                                        '$_POST[besar_diskon]',
                                        '$date1',
                                        '$date2',
                                        '$ket_diskon')";
      $savedisc  = mysqli_query($konek,$querydisc);
      if ($savedisc) {
          echo "<script>alert('Data diskon berhasil disimpan !')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
      }else{
          echo "<script>alert('Data diskon gagal disimpan !')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
      }
    }
  }

}elseif ($act =='update_mandiskon') {
  //validasi diskon
  $cektanggalnya = mysqli_query($konek,"SELECT * FROM diskon WHERE dari_tgl='$_POST[dari_tgl]' AND sampai_tgl='$_POST[sampai_tgl]'");
  $cekbaris = mysqli_num_rows($cektanggalnya);
  if ($cekbaris > 0) {
        echo "<script>alert('Maaf tanggal diskon tidak boleh sama atau kosong !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
  }else{
        $tanggal_konvers1 = explode("/", $_POST['dari_tgl']);
        $date1 = $tanggal_konvers1[0]."-".$tanggal_konvers1[1]."-".$tanggal_konvers1[2];
        $tanggal_konvers2 = explode("/", $_POST['sampai_tgl']);
        $date2 = $tanggal_konvers2[0]."-".$tanggal_konvers2[1]."-".$tanggal_konvers2[2];

        //filtering discount
        $discount = $_POST['besar_diskon'];
        $filtering_disc = str_replace('%', '' ,$discount);

        $update_diskon = "UPDATE diskon SET id_kategori_kamar ='$_POST[id_kategori_kamar]', 
                                            besar_diskon      ='$filtering_disc',
                                            dari_tgl          ='$date1', 
                                            sampai_tgl        ='$date2',
                                            keterangan_diskon ='$_POST[keterangan_diskon]' WHERE id_diskon='$_POST[id]'";
        $saved_update=mysqli_query($konek,$update_diskon);
        if ($saved_update) {
          echo "<script>alert('Data diskon berhasil disimpan !')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
        }else{
          echo "<script>alert('Data gagal disimpan !')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
        }
    }

}elseif ($act=='delete_diskon') {

  $hapusdisk = "DELETE fROM diskon WHERE id_diskon='$_GET[id]'";
  $succefully = mysqli_query($konek,$hapusdisk);

  if ($succefully) {
    echo "<script>alert('Data diskon berhasil dihapus !')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_diskon>";
  }else{
    echo "<script>alert('Data gagal dihapus !')</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?moudl=man_diskon>";
  }

}

?>