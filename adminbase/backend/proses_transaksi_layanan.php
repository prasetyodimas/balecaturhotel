<?php error_reporting(0);
include "../../config/koneksi.php";
include "../../fungsi/function_transaksi.php";
//variable get function 
$act =$_GET['act'];
if($act=='add_transac'){
//MANAGEMENT ADD TRANS LAYANAN
$code_book    = $_POST['kd_book'];
$rental       = $_POST['id_rental'];
$restaurant   = $_POST['id_paket'];
$laundry      = $_POST['id_laundry'];
$extrabed     = $_POST['id_extrabed'];
$harga_rental = $_POST['harga_rental'];
$harga_paket  = $_POST['harga_paket'];
//tgl_transaksi
$date_now = date('Y-m-d');

  //cek jika transaksi nya tidak sama  dengan kosong !!
  $cek_transaksi_tambahan = mysqli_fetch_array(mysqli_query($konek,"SELECT layanan_extra FROM booking WHERE kd_booking='$_POST[kd_book]'"));
  if($cek_transaksi_tambahan){
    /*if(empty($_POST['id_paket']=='')){
      echo "<script>alert('Maaf Anda Belum memilih satupun transaksi yang diinginkan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_listcheckin>";
    }else{*/
    if($_POST['id_paket']!='') {
        //jika pesan paket saja
        $transaksi_resto = "INSERT INTO transaksi_layanan(id_transaksi_layanan,
                                                                       kd_booking,
                                                                       id_rental,
                                                                       id_laundry,
                                                                       id_extrabed,
                                                                       id_paket,
                                                                       tgl_transaksi) 
                                                                VALUES ('',
                                                                        '$code_book',
                                                                        '-',
                                                                        '-',
                                                                        '-',
                                                                        '$restaurant',
                                                                        '$date_now')";
        $saved_transaksi_resto = mysqli_query($konek,$transaksi_resto);
        //update transaksi from tabel booking 
        $data_booking =  "UPDATE booking SET layanan_extra='Ya' WHERE kd_booking='$code_book'";
        $success_fully_saved = mysqli_query($konek,$data_booking);
        
        if($saved_transaksi_resto && $success_fully_saved) {
          echo "<script>alert('Transaksi layanan berhasil di simpan!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_listcheckin>";
        }else{
          echo "<script>alert('Transaksi layanan gagal di simpan!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_listcheckin>";
        }
    }


    
  }
      /*if($_POST['id_paket']!='') {

        //jika pesan rental saja
        $transaksi_rent = "INSERT INTO transaksi_layanan(id_transaksi_layanan,
                                                                       kd_booking,
                                                                       id_rental,
                                                                       id_laundry,
                                                                       id_extrabed,
                                                                       id_paket,
                                                                       tgl_transaksi) 
                                                                VALUES ('',
                                                                        '$code_book',
                                                                        '$rental',
                                                                        '-',
                                                                        '-',
                                                                        '-',
                                                                        '$date_now')";
        $saved_transaksi_rent = mysqli_query($konek,$transaksi_rent);
        $last_id = mysqli_insert_id($saved_transaksi_rent);

        $transaksi_rent_detail = "INSERT INTO detail_booking_rental (id_detail_booking_rental, 
                                                                    kd_booking,
                                                                    id_rental, 
                                                                    tgl_awal_sewa,
                                                                    tgl_akhir_sewa) 
                                                            VALUES ('$last_id',
                                                                    '$code_book',
                                                                    '$rental',
                                                                    '$_POST[dari_tgl]',
                                                                    '$_POST[sampai_tgl]')";
        $transaksi_rent_detail = mysqli_query($konek,$transaksi_rent_detail);
        if($saved_transaksi_rent && $transaksi_rent_detail) {
          echo "<script>alert('Transaksi layanan berhasil di simpan!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
        }else{
          echo "<script>alert('Transaksi layanan gagal di simpan!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_willbe_checkin>";
        }*/
  }
?>

