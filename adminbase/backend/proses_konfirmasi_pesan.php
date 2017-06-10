<?php include "../../config/koneksi.php";
$act= $_GET['act'];
//konfirmasi setelah melakukan pembayaran
if($act=="update_konfirmasi_pesan") {
    $cek_konfirmasi = mysqli_query($konek,"SELECT * FROM booking WHERE status_userbook='CI' AND kd_booking='$_GET[id]'");
    $cek_rows_konfrimasi = mysqli_num_rows($cek_konfirmasi);
    if ($cek_rows_konfrimasi > 0) {
          echo "<script>alert('Maaf konfirmasi telah dilakukan !!')</script>";
          echo "<meta http-equiv=refresh content=1;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
    }else{
      $update_status_konfrimasi = "UPDATE booking SET status_userbook ='LS' WHERE kd_booking ='$_GET[id]'";
      $success_konfirmasi =mysqli_query($konek,$update_status_konfrimasi);
      if ($success_konfirmasi) {
          echo "<script>alert('Konfirmasi pemesanan berhasil di acc ke user !!')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
      }else{
          echo "<script>alert('Konfirmasi pemesanan gagal di acc ke user !!')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
      }
    }
}
//hapus konfirmasi pesan
elseif ($act =="hapus_reserveonline") {
  //show jumlah pemesanan kamar 
  $get_booking = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking b 
                                                        JOIN temp_booking tb ON tb.id_member=b.id_member
                                                        JOIN kategori_kamar km ON km.id_kategori_kamar=tb.id_kategori_kamar
                                                         WHERE b.kd_booking='$_GET[id]'"));
  $delete_konfirmasi = "DELETE b, tb FROM booking b 
                        INNER JOIN temp_booking tb
                        WHERE b.kd_booking='$_GET[id]'";
  $konfimasi_query = mysqli_query($konek,$delete_konfirmasi);

  //var restoring booking 
  $permintaan = $get_booking['berapa_kamar'];
  $sisa_stock = $get_booking['jumlah_kamar_akhir'];
  $update_stock_baru = ($sisa_stock+$permintaan);
  $restoring_stock_room = "UPDATE kategori_kamar 
                           SET jumlah_kamar_akhir='$update_stock_baru' 
                           WHERE id_kategori_kamar='$get_booking[id_kategori_kamar]'";
  $update_status_book = mysqli_query($konek,$restoring_stock_room);
  if ($konfimasi_query && $update_status_book) {
      echo "<script>alert('Konfirmasi pemesanan berhasil di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
  }else{
      echo "<script>alert('Konfirmasi pemesanan gagal di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
  }
}
?>