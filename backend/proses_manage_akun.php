<?php include "../config/koneksi.php"; error_reporting(0);

$act=$_GET['act'];

if ($act=='update_member') {
	//upload foto script member
    $lokasi_file_foto_member   		= $_FILES['foto_member']['tmp_name'];
    $nama_file_member      			= $_FILES['foto_member']['name'];
    $acak            				= rand(000000,999999);
    $nama_file_unik_foto_member     = $acak.$nama_file_member; 
    $vdir_upload_foto_member    	= "../uploads/user/";
    move_uploaded_file($_FILES["foto_member"]["tmp_name"],$vdir_upload_foto_member . $nama_file_unik_foto_member);
	/*//upload foto script member
    $lokasi_file_foto_identitas     = $_FILES['foto_identitas']['tmp_name'];
    $nama_file_identitas      	    = $_FILES['foto_identitas']['name'];
    $acak           			    = rand(000000,999999);
    $nama_file_unik_identitas 		= $acak.$nama_file_identitas; 
    $vdir_upload_identitas    	    = "../uploads/identitas/";
    move_uploaded_file($_FILES["foto_identitas"]["tmp_name"],$vdir_upload_identitas . $nama_file_unik_identitas);*/

	if (empty($lokasi_file_foto_member)){
		$update_member ="UPDATE member SET nama_lengkap     ='$_POST[nama_lengkap]', 
										   password         ='$_POST[password]', 
										   email            ='$_POST[email]', 
										   alamat           ='$_POST[alamat]',
										   jenis_kelamin    ='$_POST[jenis_kelamin]',
										   jenis_identitas  ='$_POST[jenis_identitas]',
										   identitas_user   ='$_POST[identitas_user]',
										   no_telp 			='$_POST[no_telp]',
										   WHERE id_member  ='$_GET[id]'";
		$sucess =mysqli_query($konek,$update_member);
		if ($sucess) {
			echo "<script>alert('data berhasil di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=manageakun>";
		}else{
			echo "<script>alert('data gagal di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=manageakun>";
		}
    }else{
	    //kondisi update foto baru
	    if ($nama_file_unik_foto_member != $_POST['foto_member'] || $nama_file_unik_identitas != $_POST['foto_identitas'] ) {
	      	unlink($vdir_upload_foto_member . $_POST['foto_member']);
	      	unlink($vdir_upload_identitas . $_POST['foto_identitas']);
	    }
	    $update_member ="UPDATE member SET nama_lengkap     ='$_POST[nama_lengkap]', 
										   password         ='$_POST[password]', 
										   email            ='$_POST[email]', 
										   alamat           ='$_POST[alamat]',
										   jenis_kelamin    ='$_POST[jenis_kelamin]',
										   jenis_identitas  ='$_POST[jenis_identitas]',
										   identitas_user   ='$_POST[identitas_user]',
										   no_telp 			='$_POST[no_telp]',
										   foto 			='$nama_file_unik_foto_member' 
										   WHERE id_member  ='$_GET[id]'";
		echo $update_member;
		$sucess =mysqli_query($konek,$update_member);
		if ($sucess) {
			echo "<script>alert('data berhasil di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=manageakun>";
		}else{
			echo "<script>alert('data gagal di update !!');</script>";
			echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=manageakun>";
		}
    }
}
?>

