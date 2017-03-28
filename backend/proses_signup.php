<?php error_reporting(0);
include '../config/koneksi.php';
include "../fungsi/function_transaksi.php"; 
//tanggapi action
$act = $_GET['act'];
//member 
if ($act=='tambah') {
	//var status 
	$personal = $_POST['tipe_member'];
	$atasnama = $_POST['tipe_member_atasnama'];

	//default status
	$deff_status_mem ='personal';

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
	$acak = acakangkahuruf(3);
	$id_user_new 			 	= $urut . $acak;
	$acak            			=rand(2, 99);
	//get pass MD5 function
	$password_member_personal	=md5($_POST['password_member']);
	//======================== SCRIPT MEMBER IDENTITAS  =======================//
	//uploads foto identitas user member 
	$lokasi_file_identitas  		   =$_FILES['foto_identitas']['tmp_name'];
	$tipe_file_ktp   	   			   =$_FILES['foto_identitas']['type'];
	$nama_identitas        			   =$_FILES['foto_identitas']['name'];
	$dirr_identitas    				   ="../uploads/identitas/";
	$nama_file_identitas 			   =$nama_identitas;
	move_uploaded_file($lokasi_file_identitas, $dirr_identitas.$nama_file_identitas);
	//======================== SCRIPT MEMBER IDENTITAS  =======================//
	//uploads foto identitas user member 
	$lokasi_file_fotoprofil 			=$_FILES['foto_profil']['tmp_name'];
	$tipe_file_fotoprofil  				=$_FILES['foto_profil']['type'];
	$nama_fotoprofil         			=$_FILES['foto_profil']['name'];
	$direktori_fotoprofil  				="../uploads/user/";
	$nama_file_fotoprofil 			  	=$nama_fotoprofil;
	move_uploaded_file($lokasi_file_fotoprofil, $direktori_fotoprofil.$nama_file_fotoprofil);

	$cekvalidation =mysqli_query($konek,"SELECT * FROM member WHERE email='$email'");
	$cekrowsmember =mysqli_num_rows($cekvalidation);

	if ($cekrowsmember > 0) {
		echo "<script>alert(' email anda sudah terdaftar !!');</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=signup>";
	}else{

		//MEMBER PERSON
		$mem_personal ="INSERT INTO member (id_member,
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
							VALUES ('$id_user_new',
									'$_POST[nama_lengkap]',
									'$password_member_personal',
									'$_POST[email]',
									'$_POST[alamat]',
									'$_POST[kebangsaan]',
									'$_POST[jen_kel]',
									'$_POST[jenis_identitas]',
									'$_POST[no_identitas]',
									'$_POST[no_telp]',
									'$nama_file_identitas',
									'$nama_file_fotoprofil')";
	/*	echo $mem_personal; exit();*/
		$succes_person =mysqli_query($konek,$mem_personal);
		if ($succes_person) { ?>
				<link href="../frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet">
				<div class="row">
					<div class="container">
						<div class="col-lg-12" style="margin-top:20px;">
							<div class="alert alert-success" role="alert">
		 						<strong>Succes!</strong> Terimakasih anda telah melakukan pendaftaran member !
								<a href="<?php echo "$site";?>auth/session_log/signin.php">Klik disini untuk login !</a>
							</div>
						</div>
					</div>
				</div>
		<?php   }else{
				echo "<script>alert('Data gagal disimpan !!');</script>";
				echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=signup>";
			}

	}
}
?>
