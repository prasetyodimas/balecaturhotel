<?php include "../../config/koneksi.php";
$act=$_GET['act'];
//MANAGEMENT KAMAR
// add kamar
if ($act=='add_kamar'){
//validasi kamar
  $getdata_kamar =mysqli_query($konek,"SELECT * FROM kamar WHERE id_kamar='$_POST[id_kamar]'");
  $cek_datakamar =mysqli_num_rows($getdata_kamar);
  if ($cek_datakamar > 0 ) {
      echo "<script>alert('Maaf nomor kamar sudah simpan!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
  }else{
    $q = "INSERT INTO kamar (id_kamar, id_kategori_kamar, status_kamar) VALUES ('$_POST[id_kamar]','$_POST[kategori]','2')";
    $success = mysqli_query($konek,$q);
   
    if($success) {
        echo "<script>alert('Kamar berhasil di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
    } else {
        echo "<script>alert('Kamar gagal di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
    }
  }
// edit kamar
}elseif ($act=='update_kamar'){
    //cek stok kamar
    if ($_POST['status_kamar']==0) {
        $cek_stock_kamar = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$_POST[kategori]'")); 
        $stok_kamar = $cek_stock_kamar['jumlah_kamar_akhir'];
        $counting_room = ($stok_kamar-1);
        //update stok kamar & status kamar nya sedang dicek keadaan kamar nya
        $q = "UPDATE kamar k JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar 
              SET k.id_kategori_kamar   ='$_POST[kategori]',
                  k.status_kamar        ='$_POST[status_kamar]',
                  km.jumlah_kamar_akhir ='$counting_room'
              WHERE k.id_kamar          ='$_POST[id]'";
        $success = mysqli_query($konek,$q);
        if($success) {
            echo "<script>alert('Kamar berhasil di edit!');</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }else {
          echo "<script>alert('Kamar gagal di edit!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }
    }elseif ($_POST['status_kamar']==1) {
        //update stok kamar & status kamar nya sedang dilakukan pembersihan
       $q = "UPDATE kamar 
              SET   id_kategori_kamar   ='$_POST[kategori]',
                    status_kamar        ='$_POST[status_kamar]'
              WHERE id_kamar            ='$_POST[id]'";
        $success = mysqli_query($konek,$q);
        if($success) {
            echo "<script>alert('Kamar berhasil di edit!');</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }else {
          echo "<script>alert('Kamar gagal di edit!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }
    }elseif ($_POST['status_kamar']==2) {
        $cek_stock_kamar = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM kategori_kamar WHERE id_kategori_kamar='$_POST[kategori]'")); 
        $stok_kamar = $cek_stock_kamar['jumlah_kamar_akhir'];
        $counting_room = ($stok_kamar+1);
        //update stok kamar & status kamar nya sedang dilakukan pembersihan
        $q = "UPDATE kamar k JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar 
              SET k.id_kategori_kamar   ='$_POST[kategori]',
                  k.status_kamar        ='$_POST[status_kamar]',
                  km.jumlah_kamar_akhir ='$counting_room'
              WHERE k.id_kamar          ='$_POST[id]'";
        $success = mysqli_query($konek,$q);
        if($success) {
            echo "<script>alert('Kamar berhasil di edit!');</script>";
            echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }else {
          echo "<script>alert('Kamar gagal di edit!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
        }
    } 
}
// delete Kamar
elseif ($act=='delete_kamar'){
  $q="DELETE FROM kamar WHERE id_kamar='$_GET[id]'";
   $success = mysqli_query($konek,$q);

    if($success) {
        echo "<script>alert('Kamar berhasil di hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
    } else {
        echo "<script>alert('Kamar gagal di hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_kamar>";
    }
}
