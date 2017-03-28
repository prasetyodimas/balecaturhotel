<?php

include "../../config/koneksi.php";
include "../../fungsi/kode_booking.php";

$act=$_GET['act'];

// MANAGEMENT CHECK KAMAR

// Cek Kamar Tanggal
elseif($act=='cekKamarTanggal'){



  $getquery = mysqli_query($konek,"SELECT * FROM ");


}



// MANAGEMENT GALLERY

//tambah gallery
elseif ($act=='addgallery'){

  $lokasi_file = $_FILES['foto_gallery']['tmp_name'];
  $nama_file   = $_FILES['foto_gallery']['name'];
/*  $acak = rand(000000,999999);*/
/*  $nama_file_unik = $acak . $nama_file;*/
  $vdir_upload ="../image/gallery/";
  move_uploaded_file($_FILES['foto_gallery']['tmp_name'],$vdir_upload.$nama_file);

  $addgalle ="INSERT INTO gallery (foto_gallery, deskripsi_foto) VALUES ('$nama_file','$_POST[deskripsi_foto]')";
  $success =mysqli_query($konek,$addgalle);

  if ($success) {
      echo "<script>alert('Data berhasil disimpan !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
  }else{
      echo "<script>alert('Data gagal disimpan !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
  }

}

//edit gallery
elseif ($act=='updategalle'){

  $lokasi_file = $_FILES['foto_gallery']['tmp_name'];
  $nama_file   = $_FILES['foto_gallery']['name'];
  $vdir_upload = "../image/gallery/";
  move_uploaded_file($_FILES['foto_gallery']['tmp_name'],$vdir_upload.$nama_file);

  if (empty($location_file)) {

    $q = "UPDATE gallery SET deskripsi_foto='$_POST[deskripsi_foto]' WHERE id_gallery='$_POST[id]'";
    $success =mysqli_query($konek,$q);

    if ($success) {
      echo "<script>alert('Data berhasil diubah !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }else{
      echo "<script>alert('Data gagal diubah !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }

  }else{

    if ($nama_file != $_POST['foto_lama']) {
        unlink($vdir_upload . $_POST['foto_lama']);
    }

    $q ="UPDATE gallery SET foto_gallery   ='$_POST[foto_gallery]',
                             deskripsi_foto ='$_POST[deskripsi_foto]'
                      WHERE id_gallery      ='$_POST[id]'";
    $success =mysqli_query($konek,$q);

    if ($success) {
      echo "<script>alert('Data berhasil diubah !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }else{
      echo "<script>alert('Data gagal diubah !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
    }
  }

}

//hapus gallery
elseif($act=='hapus_galle'){

  $get_image=mysqli_fetch_array(mysqli_query($konek, "select * from gallery where id_gallery='$_GET[id]'"));
  $vdir_upload = "../image/gallery/";
  unlink($vdir_upload. $get_image['foto_gallery']);

  $eksekusi= "DELETE FROM gallery WHERE id_gallery='$_GET[id]'";
  $success = mysqli_query($konek, $eksekusi);

  if ($success) {
      echo "<script>alert('Data berhasil dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
  }else{
      echo "<script>alert('Data gagal dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_gallery></script>";
  }
}


//MANAGEMENT RESTORASI

//tambah kategori paket
elseif ($act=='tambah_katemenu') {
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
elseif ($act=='update_katepaket') {

  //validasi update
  $getq= mysqli_query($konek,"SELECT * FROM paket WHERE nama_paket='$_POST[id_paket]'");
  $cekbaris = mysqli_num_rows($getq);

  if ($cekbaris > 0) {
        echo "<script>alert('Data berhasil di update !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";
  }else{

    $Qpaket = "UPDATE paket SET nama_paket='$_POST[nama_paket]', harga_paket='$_POST[harga_paket]' WHERE id_paket='$_POST[id_paket]'";
  /*  echo $Qpaket;*/
    $success =mysqli_query($konek,$Qpaket);
/*    echo $Qpaket;*/
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
elseif ($act=='hapus_katemenu') {

  $hapuspaket = mysqli_query($konek,"DELETE FROM paket WHERE id_paket='$_GET[id]'");

  if ($hapuspaket) {
      echo "<script>alert('Data berhasil di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";

  }else{

      echo "<script>alert('Data gagal di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_katepaket>";

  }


}

//add menu
elseif ($act=='tambah_menu') {

  $querymenu = "INSERT INTO detail_paket (id_paket,keterangan_menunya)
                VALUES ('$_POST[id_paket]','$_POST[keterangan_menunya]')";

 /*echo $querymenu;*/

  $berhasil =mysqli_query($konek, $querymenu);

  if ($berhasil) {
      echo "<script>alert('Data berhasi disimpan !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";
  }else{
      echo "<script>alert('Data Gagal disimpan !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";
  }
}

//update menu
elseif ($act=='update_datamenu') {

  $updatemenu = "UPDATE detail_paket SET id_paket='$_POST[id_paket]', keterangan_menunya='$_POST[keterangan_menunya]'
                 WHERE id_detail_paket='$_POST[id_detail_paket]'";
  /*echo $updatemenu;*/

  $berhasilupdate =mysqli_query($konek, $updatemenu);

    if ($berhasilupdate) {
        echo "<script>alert('Data berhasil di update !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";
    }else{
        echo "<script>alert('Data gagal di update !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";

    }
}

//hapus menu
elseif ($act=='hapus_manmenu') {

  $hapusmenu="DELETE FROM detail_paket WHERE id_detail_paket='$_GET[id]'";
  $success_delete = mysqli_query($konek,$hapusmenu);

  if ($success_delete) {
      echo "<script>alert('data berhasil dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";
  }else{
      echo "<script>alert('data gagal dihapus !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_datamenu>";
  }

}

//MANAGEMENT MEMBER & USER ADMIN

// Add User admin
elseif ($act=='addUser') {

  $pass = md5($_POST['password']);
  $q = "INSERT INTO admin (username, password, level, status)
        VALUES('$_POST[username]','$pass','$_POST[user]','$_POST[blokir]')";
  $success = mysqli_query($konek,$q);

    if($success) {
        echo "<script>alert('User Berhasil Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User Gagal Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}

// Update User admin
elseif ($act=='updateUser'){

  $success = mysqli_query($konek,"UPDATE admin SET username='$_POST[username]', status ='$_POST[blokir]' WHERE id_admin = '$_POST[id]'");
    if($success) {
        echo "<script>alert('User Berhasil Di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User Gagal Di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}

// Hapus User admin
elseif ($act=='hapusUser'){

  $success = mysqli_query($konek,"DELETE FROM admin WHERE id_admin='$_GET[id]'");
  if($success) {

        echo "<script>alert('User Berhasil Di Hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    } else {
        echo "<script>alert('User Gagal Di ubah!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_user>";
    }
}


//Add Member
elseif ($act=='add_member') {

    // add foto member
    $lokasi_file    = $_FILES['foto_identitas']['tmp_name'];
    $nama_file      = $_FILES['foto_identitas']['name'];
    $acak           = rand(000000,999999);
    $nama_file_unik = $acak.$nama_file;
    $vdir_upload    = "../image/identitas/";
    move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload.$nama_file_unik);
    // generate passmember MD5
    $passmember =md5($_POST['password_user']);


    $addmember= "INSERT INTO member (id_member,
                                     nama_lengkap,
                                     password,
                                     email,
                                     alamat,
                                     jenis_kelamin,
                                     jenis_identitas,
                                     identitas_user,
                                     no_telp,
                                     foto_identitas,
                                     foto)
                              VALUES('$id_user_new',
                                     '$_POST[nama_lengkap]',
                                     '$passmember',
                                     '$_POST[email_user]',
                                     '$alamatmem',
                                     '$_POST[jenis_kelamin]',
                                     '$_POST[jenis_identitas]',
                                     '$_POST[identitas_user]',
                                     '$_POST[notelp_user]',
                                     '$nama_file_unik',
                                     '-')";
    // echo $addmember;
    // exit();
    $success = mysqli_query($konek,$addmember);

    if ($success) {
       echo "<script>alert('member berhasil di simpan!');</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    }else{
      echo "<script>alert('data member gagal disimpan !!');</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    }
}

elseif ($act=='UpdateMember') {

   //identitas_user image
   $lokasi_file    = $_FILES['foto_identitas']['tmp_name'];
   $nama_file      = $_FILES['foto_identitas']['name'];
   $acak           = rand(000000,999999);
   $nama_file_unik = $acak.$nama_file;
   $vdir_upload    = "../image/identitas/";
   move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload.$nama_file_unik);
   $pass_member = md5($_POST['password_user']);

   if (empty($lokasi_file)) {
     $updated_emptyimg = "UPDATE member SET nama_lengkap    ='$_POST[nama_lengkap]',
                                            password        ='$pass_member',
                                            email           ='$_POST[email]',
                                            alamat          ='$_POST[alamat]',
                                            jenis_kelamin   ='$_POST[jenis_kelamin]',
                                            jenis_identitas ='$_POST[jenis_identitas]',
                                            identitas_user  ='$_POST[identitas_user]',
                                            no_telp         ='$_POST[no_telp]'
                                            WHERE id_member ='$_GET[id]'";
      echo $updated_emptyimg;
      exit();

      // $success = mysqli_query($konek,$updated_emptyimg);
      //
      // if ($success) {
      //   echo "<script>alert('member berhasil di simpan!');</script>";
      //   echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
      // }else {
      //   echo "<script>alert('data member gagal disimpan !!');</script>";
      //   echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
      // }



   }else{

       //kondisi update foto baru
       if ($nama_file_unik != $_POST['foto_lama']) {
         unlink($vdir_upload . $_POST['foto_lama']);
       }

       $updated = "UPDATE member SET  nama_lengkap     ='$_POST[nama_lengkap]',
                                      password        ='$pass_member',
                                      email           ='$_POST[email]',
                                      alamat          ='$_POST[alamat]',
                                      jenis_kelamin   ='$_POST[jenis_kelamin]',
                                      jenis_identitas ='$_POST[jenis_identitas]',
                                      identitas_user  ='$_POST[identitas_user]',
                                      no_telp         ='$_POST[no_telp]',
                                      foto_identitas  ='$nama_file_unik'
                                      WHERE id_member ='$_GET[id]'";

        // echo $updated;
        // exit();
        $success = mysqli_query($konek,$updated);
        if ($success) {
          echo "<script>alert('member berhasil di simpan!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
        }else {
          echo "<script>alert('data member gagal disimpan !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
        }
   }

}
// Hapus Member
elseif ($act=='hapusMember'){

  $get_imagemember = mysqli_fetch_array(mysqli_query($konek,"SELECT foto_identitas FROM member WHERE id_member='$_GET[id]'"));
  $vdir_upload = "../image/identitas/";
  unlink($vdir_upload . $get_imagemember['foto_identitas']);

  $success = mysqli_query($konek,"DELETE FROM member WHERE id_member='$_GET[id]'");

  if($success) {
        echo "<script>alert('User Berhasil Di Hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    } else {
        echo "<script>alert('User Gagal Di Hapus!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    }
}


//MANAGEMENT BERITA

// Tambah berita
elseif ($act=='addBerita'){

  $isi_berita =mysqli_real_escape_string($konek,$_POST['isi_berita']);

  $success = mysqli_query($konek, "INSERT INTO berita(judul_berita, isi_berita) VALUES ('$_POST[judul_berita]','$isi_berita')");

  if($success) {
        echo "<script>alert('Berita Berhasil Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
    } else {
        echo "<script>alert('Berita Gagal Di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
    }
}

// Update berita
elseif ($act=='updateBerita'){
  $isi_berita =mysqli_real_escape_string($konek,$_POST['isi_berita']);
  $success = mysqli_query($konek,"UPDATE berita SET judul_berita='$_POST[judul_berita]', isi_berita='$isi_berita' WHERE id_berita='$_POST[id]'");
  if($success) {
        echo "<script>alert('Berita Berhasil Di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
    } else {
        echo "<script>alert('Berita Gagal Di edit!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
    }
}

// Hapus berita
elseif ($act=='hapusberita') {
  $isi_berita =mysqli_query($konek,"DELETE FROM berita WHERE id_berita='$_GET[id]'");
  if ($isi_berita) {
      echo "<script>alert('Data berhasil dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
  }else{
      echo "<script>alert('Data gagal dihapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_berita>";
  }
}

//MANAGEMENT RENTAL

//Tambah rental
elseif ($act=='addman_rental') {
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
  $vdir_upload  = "../image/rental/";
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

// edit rental
elseif ($act=='edit_manrental') {

  $lokasi_file = $_FILES['foto_kendaraan']['tmp_name'];
  $nama_file   = $_FILES['foto_kendaraan']['name'];
  $acak        = rand(000000,999999);
  $nama_file_unik = $acak . $nama_file;
  $vdir_upload  = "../image/rental/";
  move_uploaded_file($_FILES['foto_kendaraan']['tmp_name'], $vdir_upload.$nama_file_unik);
  $ket_kendaraan =mysqli_real_escape_string($konek,$_POST['ket_kendaraan']);

  if (empty($lokasi_file)) {

    $get_query ="UPDATE rental SET kate_kendaraan='$_POST[kate_kendaraan]', nama_kendaraan='$_POST[nama_kendaraan]',
                harga_kendaraan='$_POST[harga_kendaraan]', ket_kendaraan='$ket_kendaraan' WHERE id_rental='$_POST[id]'";

       /* echo $get_query; exit();*/
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
                              WHERE id_rental='$_POST[id]'";
      /*  echo $get_query;*/
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

/// hapus rental
elseif ($act=='hapus_manrental') {
  //get image
  $get_image = mysqli_fetch_array(mysqli_query($konek,"select foto_kendaraan from rental where id_rental='$_GET[id]'"));
  $vdir_upload ="../image/rental/";
  unlink($vdir_upload . $get_image['foto_kendaraan']);

  $data_rental = mysqli_query($konek,"DELETE FROM rental WHERE id_rental='$_GET[id]'");

  if ($data_rental) {
        echo "<script>alert('Data berhasil dihapus !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
  }else{
        echo "<script>alert('Data gagal dihapus !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_rental>";
  }

}


//MANAGEMENT LAUNDRY

//tambah laundry
elseif ($act=='addman_laundry') {

  $addlaundry ="INSERT INTO laundry (jenis_laundry, harga_laundry, ket_laundry) VALUES
              ('$_POST[jenis_laundry]','$_POST[harga_laundry]','$_POST[ket_laundry]')";
  $saving =mysqli_query($konek,$addlaundry);

  if ($saving) {
      echo "<script>alert('Data berhasil disimpan !!')></script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }else{
      echo "<script>alert('Data gagal disimpan !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";


  }

}

//edit laundry
elseif ($act=='edit_manlaundry') {

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
elseif ($act=='hapus_manlaundry') {

  $hapuslaundry = mysqli_query($konek," DELETE FROM laundry WHERE id_laundry='$_GET[id]'");

  if ($hapuslaundry) {
      echo "<script>alert('data berhasil di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }else{
      echo "<script>alert('data gagal di hapus !!')</script>";
      echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_laundry>";
  }

}


//MANAJEMEN TRANSAKSI LANGSUNG / TRANSAKSI CHECK IN

//add transaksi reserve online
elseif ($act=="tambah_reserveoffline") {

  // cek sekarang tanggal berapa
  $datenow = date("d");

  // exploade format tgl checkin
  $pecahtgl_transaksi1 = explode("/", $_POST['checkin_lgsng']);
  $date_trasnski1      = $pecahtgl_transaksi1[2]."-".$pecahtgl_transaksi1[0]."-".$pecahtgl_transaksi1[1];
  $pecahtgl_transaksi2 = explode("/", $_POST['checkout_lgsng']);
  $date_trasnski2      = $pecahtgl_transaksi2[2]."-".$pecahtgl_transaksi2[0]."-".$pecahtgl_transaksi2[1];

  // exploade format tgl sewarental
  $pecahtgl_transaksi1 = explode("/", $_POST['dari_tgl']);
  $daritanggal         = $pecahtgl_transaksi1[2]."-".$pecahtgl_transaksi1[0]."-".$pecahtgl_transaksi1[1];
  $pecahtgl_transaksi2 = explode("/", $_POST['sampai_tgl']);
  $sampaitgl           = $pecahtgl_transaksi2[2]."-".$pecahtgl_transaksi2[0]."-".$pecahtgl_transaksi2[1];

  //validasi booking langsung
  $cek_translangsung = mysqli_query($konek,"SELECT * FROM transaksi_langsung WHERE id_member='$_POST[id_member]'");
  $cek_rowsnya = mysqli_num_rows($cek_translangsung);

  if ($cek_rowsnya > 0) {

       echo "<script>alert(' Maaf transaksi sudah di disimpan !!')</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline>";

  }else{

    //validasi tanggal yang dimasukkan tidak sesuai dengan tanggal sekarang !!
  /*  if ($date_trasnski1 != $datenow) {
        echo "<script>alert(' transaksi dibatalkan..! ,Maaf tanggal checkin yang anda input $date_trasnski1 adalah tanggal kemarin !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline>";
    }elseif ($date_trasnski2 != $datenow) {
        echo "<script>alert(' transaksi dibatalkan..! ,Maaf tanggal checkout yang anda input $date_trasnski2 adalah tanggal kemarin !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline>";
    }else{*/
/*

  $add_translangsung = "INSERT INTO transaksi_langsung (kd_transaksilgsng,
                                                        id_member,
                                                        id_kamar,
                                                        id_kategori_kamar,
                                                        id_paket,
                                                        id_rental,
                                                        id_laundry,
                                                        checkin_lgsng,
                                                        checkout_lgsng,
                                                        jumlah_pesan,
                                                        extrabed_lgsng)
                                                VALUES ('$_POST[kd_transaksilgsng]',
                                                        '$_POST[id_member]',
                                                        '$_POST[id_kamar]',
                                                        '$_POST[id_kategori_kamar]',
                                                        '$_POST[id_paket]',
                                                        '$_POST[id_rental]',
                                                        '$_POST[id_laundry]',
                                                        '$date_trasnski1',
                                                        '$date_trasnski2',
                                                        '$_POST[jumlah_pesan]'
                                                        '$_POST[extrabed_lgsng]')";


    $add_translangsung_rental  = "INSERT INTO detail_booking_rental (id_detail_booking_rental,
                                                                   kd_booking,
                                                                   id_rental,
                                                                   tgl_awal_sewa,
                                                                   tgl_akhir_sewa)
                                                           VALUES ('$last_id',
                                                                   '$_POST[kd_transaksilgsng]',
                                                                   '$_POST[id_rental]',
                                                                   '$daritanggal',
                                                                   '$sampaitgl')";


        //add transaksaksi langsung
        $succesfuly =mysqli_query($konek,$add_translangsung);
        $last_id    =mysqli_insert_id($succesfuly);

        $succesfuly2  = mysqli_query($konek,$add_translangsung_rental);

        if ($succesfuly && $succesfuly2) {
             echo "<script>alert('transaksi berhasil di disimpan !!')</script>";
             echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline_transaksi>";
        }else{
             echo "<script>alert('transaksi gagal di simpan !!')</script>";
             echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline>";
        }

      }
*/

   /* }*///end of validasi

//jika tidak memesan layanan tambahan : rental, restorasi, laundry, extrabed
if ($_POST['id_paket']=="" && $_POST['id_rental']=='' && $_POST['laundry']=='' && $_POST['extrabed_lgsng']=='') {


     $add_translangsung = "INSERT INTO transaksi_langsung (kd_transaksilgsng,
                                                        id_member,
                                                        id_kamar,
                                                        id_kategori_kamar,
                                                        id_paket,
                                                        id_rental,
                                                        id_laundry,
                                                        checkin_lgsng,
                                                        checkout_lgsng,
                                                        jumlah_pesan,
                                                        extrabed_lgsng)
                                                VALUES ('$_POST[kd_transaksilgsng]',
                                                        '$_POST[id_member]',
                                                        '$_POST[id_kamar]',
                                                        '$_POST[id_kategori_kamar]',
                                                        '-',
                                                        '-',
                                                        '-',
                                                        '$date_trasnski1',
                                                        '$date_trasnski2',
                                                        '$_POST[jumlah_pesan]',
                                                        'tidak')";

       /* echo $add_translangsung;*/
        $succesfuly =mysqli_query($konek,$add_translangsung);

        if ($add_translangsung) {
             echo "<script>alert('transaksi berhasil di disimpan !!')</script>";
             echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline_transaksi>";
        }else{
             echo "<script>alert('transaksi gagal di simpan !!')</script>";
             echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline>";
        }

}//end of transaksi langung

}


}elseif ($act=='hapus_trnaslangsung') {

  $delete_trans = mysqli_query($konek,"DELETE FROM transaksi_langsung WHERE kd_transaksilgsng='$_GET[id]'");

  if ($delete_trans) {
       echo "<script>alert('data  berhasil di hapus !!')</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline_transaksi>";
  }else{
       echo "<script>alert('data  gagal di hapus !!')</script>";
       echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveoffline_transaksi>";
  }

}


//MANAGEMENT ACC KAMAR


// acc kamar setelah memesan
elseif ($act=="acc_kamar") {

$getdate = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking WHERE kd_booking='$_GET[id]'"));
$checkin  = $getdate['checkin'];
$checkout = $getdate['checkout'];
//var tanggal sekarang
$sekarang_tgl = date("d-m-Y");

//convert date
$convert_year  = substr($checkin, 0,4);
$convert_month = substr($checkin, -5,2);
$convert_date  = substr($checkin, -2,4)+2;
$datejoiner    = ($convert_year."-".$convert_month."-".$convert_date);


//adding 3 day from nows
/*$now  = strtotime(date("Y-m-d"));
$date = date('Y-m-j', strtotime('+3 day', $now));*/

//validasi checkin
/*$in  = mktime(0,0,0),$convert_month,$convert_month,$convert_year);*/
/*$out = mktime(0,0,0),$convert_month,$convert_date,$convert_year);*/
/*$min = mktime(0,0,0,date("m"),date("d")+3,date("Y"));
$interval = mktime(0,0,0,$convert_month,$convert_date+2,$convert_year);*/
/*
echo $checkout."<br>";
echo $datejoiner;
*/
//validasi tanggal konfirmasi trasnsaksi !!!
/*echo $checkin;
echo $checkout;
if ($datejoiner < $checkin) {

  echo "<script>alert('transaksi tidak dapat diproses karena tanggal saat ini $sekarang_tgl, dan tanggal $checkin adalah checkin anda, batas pembayaran adalah tanggal $datejoiner konfrimasi sudah lebih dari yg ditentukan !!')</script>";
  echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";

}else{

*/
    $id_kamar = $_POST['id_kamar'];

    /*$add_no_room = "UPDATE booking SET id_member          ='$_POST[id_member]',
                                       id_kategori_kamar  ='$_POST[id_kategori_kamar]',
                                       id_rental          ='$_POST[id_rental]',
                                       id_laundry         ='$_POST[id_laundry]',
                                       nama_perusahaan    ='$_POST[nama_perusahaan]',
                                       atas_nama          ='$_POST[atas_nama]',
                                       email_atasnama     ='$_POST[email_atasnama]',
                                       checkin            ='$_POST[checkin]',
                                       checkout           ='$_POST[checkout]',
                                       qty_reserve        ='$_POST[qty_reserve]',
                                       extrabed           ='$_POST[extrabed]',
                                       status             ='$_POST[status]',
                                       id_kamar           ='$id_kamararray',
                                       stat_reservation   ='$_POST[stat_reservation]'
                                       WHERE kd_booking   ='$_POST[kd_booking]'";*/

    $add_no_room = "UPDATE booking SET status='1' WHERE kd_booking ='$_GET[id]'";

    /*echo $add_no_room;*/
    $success =mysqli_query($konek,$add_no_room);

      if ($success) {

          echo "<script>alert('kamar berhasil di acc ke user !!')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
      }else{
          echo "<script>alert('kamar gagal di acc ke user !!')</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
      }
/*  }*/
/*}*///validasi tanggal konfrimasi admin

}

//hapus man reserve online
elseif ($act =="hapus_reserveonline") {


  $get_reserve_online = mysqli_query($konek,"DELETE FROM booking WHERE kd_booking='$_GET[id]'");


    if ($get_reserve_online) {
        echo "<script>alert('data berhasil di hapus !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
    }else{
        echo "<script>alert('data gagal di hapus !!')</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_reserveonline>";
    }
}



?>
