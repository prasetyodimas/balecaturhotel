<?php session_start();
include "../../config/koneksi.php";
include "../../fungsi/function_transaksi.php"; 

$act=$_GET['act'];
//Add Member
if ($act=='add_member') {
  //cek seluruh data member
  $cek = mysqli_query($konek,"select * from member");
  $row = mysqli_num_rows($cek);
  $antrian = $row + 1;
  $jlh = strlen($antrian);
  if ($jlh == 4) {
      $urut = $antrian;
  } else if ($jlh == 3) {
      $urut = "0" . $antrian;
  } else if ($jlh == 2) {
      $urut = "00" . $antrian;
  } else if ($jlh == 1) {
      $urut = "000" . $antrian;
  }
  //function get random id member
  $acak_karakter                = acakangkahuruf(3);
  $acak_random                  = rand(2, 99);
  $id_user_new                  = $urut.$acak_karakter;
  // generate passmember MD5
  $pass_mem_person              = md5($_POST['password_user']);
  // add foto member personal
  $lokasi_file_mem_personal     = $_FILES['foto_identitas']['tmp_name'];
  $nama_file_mem_personal       = $_FILES['foto_identitas']['name'];
  $acak                         = rand(000000,999999);
  $nama_file_unik_mem_personal  = $acak.$nama_file_mem_personal;
  $vdir_upload                  = "../../uploads/identitas/";

  move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload.$nama_file_unik_mem_personal);

  $addmember= "INSERT INTO member (id_member,
                                   nama_lengkap,
                                   password,
                                   email,
                                   alamat,
                                   kebangsaan,
                                   jenis_kelamin,
                                   jenis_identitas,
                                   identitas_user,
                                   no_telp,
                                   foto_identitas,
                                   foto)
                            VALUES('$id_user_new',
                                   '$_POST[nama_lengkap]',
                                   '$pass_mem_person',
                                   '$_POST[email_user]',
                                   '$_POST[alamat_user]',
                                   '$_POST[country]',
                                   '$_POST[jenis_kelamin]',
                                   '$_POST[jenis_identitas]',
                                   '$_POST[identitas_user]',
                                   '$_POST[notelp_user]',
                                   '$nama_file_unik_mem_personal',
                                   '-')";
    $success = mysqli_query($konek,$addmember);
    if ($success) {
        echo "<script>alert('member berhasil disimpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    }else{
        echo "<script>alert('data member gagal disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
    }

}elseif($act=='update_member') {
  //identitas_user image
  $lokasi_file    = $_FILES['foto_identitas']['tmp_name'];
  $nama_file      = $_FILES['foto_identitas']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  $vdir_upload    = "../../uploads/identitas/";
  move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload.$nama_file_unik);
  $pass_member = md5($_POST['password_user']);

  //check jika lokasi file nya kosong !!
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

      $success = mysqli_query($konek,$updated_emptyimg);
      
      if ($success) {
        echo "<script>alert('member berhasil di simpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
      }else {
        echo "<script>alert('data member gagal disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
      }
  }else{

       //kondisi update foto baru
       if ($nama_file_unik != $_POST['foto_lama']) {
           unlink($vdir_upload . $_POST['foto_lama']);
       }

       $updated = "UPDATE member SET  nama_lengkap     ='$_POST[nama_lengkap]',
                                      password         ='$pass_member',
                                      email            ='$_POST[email]',
                                      alamat           ='$_POST[alamat]',
                                      jenis_kelamin    ='$_POST[jenis_kelamin]',
                                      jenis_identitas  ='$_POST[jenis_identitas]',
                                      identitas_user   ='$_POST[identitas_user]',
                                      no_telp          ='$_POST[no_telp]',
                                      foto_identitas   ='$nama_file_unik'
                                      WHERE id_member  ='$_GET[id]'";
        $success = mysqli_query($konek,$updated);
        if ($success) {
          echo "<script>alert('member berhasil diubah!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
        }else {
          echo "<script>alert('member gagal diubah !!');</script>";
          echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
        }
  }

// Hapus Member
}elseif ($act=='delete_member'){
  //get image user from path spesific
  $get_imagemember = mysqli_fetch_array(mysqli_query($konek,"SELECT foto_identitas, foto FROM member WHERE id_member='$_GET[id]'"));
  $vdir_upload = "../../uploads/identitas/";
  unlink($vdir_upload.$get_imagemember['foto_identitas']);
  $success = mysqli_query($konek,"DELETE FROM member WHERE id_member='$_GET[id]'");
  
  if($success) {
    echo "<script>alert('Member berhasil dihapus!');</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
  }else {
    echo "<script>alert('Member gagal dihapus!');</script>";
    echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_member>";
  }



//Add Member Baru 
}elseif($act=='add_member_baru') {
  //cek seluruh data member
  $cek = mysqli_query($konek,"select * from member");
  $row = mysqli_num_rows($cek);
  $antrian = $row + 1;
  $jlh = strlen($antrian);
  if ($jlh == 4) {
      $urut = $antrian;
  } else if ($jlh == 3) {
      $urut = "0" . $antrian;
  } else if ($jlh == 2) {
      $urut = "00" . $antrian;
  } else if ($jlh == 1) {
      $urut = "000" . $antrian;
  }
  //function get random id member
  $acak_karakter                = acakangkahuruf(3);
  $acak_random                  = rand(2, 99);
  $id_user_new                  = $urut.$acak_karakter;
  //CONVERT TO SESSION VAR
  $_SESSION['session_user']     = $id_user_new;

  // generate passmember MD5
  $pass_mem_person              = md5($_POST['password_user']);
  // add foto member personal
  $lokasi_file_mem_personal     = $_FILES['foto_identitas']['tmp_name'];
  $nama_file_mem_personal       = $_FILES['foto_identitas']['name'];
  $acak                         = rand(000000,999999);
  $nama_file_unik_mem_personal  = $acak.$nama_file_mem_personal;
  $vdir_upload                  = "../../uploads/identitas/";

  move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload.$nama_file_unik_mem_personal);

  $addmember= "INSERT INTO member (id_member,
                                   nama_lengkap,
                                   password,
                                   email,
                                   alamat,
                                   kebangsaan,
                                   jenis_kelamin,
                                   jenis_identitas,
                                   identitas_user,
                                   no_telp,
                                   foto_identitas,
                                   foto)
                            VALUES('$id_user_new',
                                   '$_POST[nama_lengkap]',
                                   '$pass_mem_person',
                                   '$_POST[email_user]',
                                   '$_POST[alamat_user]',
                                   '$_POST[country]',
                                   '$_POST[jenis_kelamin]',
                                   '$_POST[jenis_identitas]',
                                   '$_POST[identitas_user]',
                                   '$_POST[notelp_user]',
                                   '$nama_file_unik_mem_personal',
                                   '-')";
    $success = mysqli_query($konek,$addmember);

    if ($success) {
        echo "<script>alert('member berhasil disimpan!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_getall_transaction>";
    }else{
        echo "<script>alert('data member gagal disimpan !!');</script>";
        echo "<meta http-equiv=refresh content=0;url=$site"."adminbase/homeadmin.php?modul=man_justreserve>";
    }
}
?>
