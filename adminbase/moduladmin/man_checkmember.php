<?php include '../fungsi/function_transaksi.php';
//CONVERT VARIABLES POST INTO SESSION VAR
$_SESSION['session_checkin']  = $_POST['checkin_tgl'];
$_SESSION['session_checkout'] = $_POST['checkout_tgl'];
//convert var to session 
$array_room = $_POST['kategori_kamar'];
$_SESSION['sessi_kamar'] = $array_room;
//print_r($_SESSION['sessi_kamar']);
if (empty($array_room)) {
	echo "<script>alert('Maaf anda belum memilih kamar !!')</script>";
	echo "<script>history.go(-2);</script>";
}else{
	$var_checkin     = $_POST['checkin_tgl'];
	$var_checkout    = $_POST['checkout_tgl'];
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#validate-checkmember').validate({
			rules:{
				id_member:{
					required:true
				},
			},messages:{
				id_member :'Id member tidak boleh kosong !!',
			}
		});
		$('#validate-addmember').validate({
			rules:{
				nama_lengkap:{
					required:true
				},
				email_user:{
					required:true
				},
				password_user:{
					required:true
				},
				notelp_user:{
					required:true
				},
				country:{
					required:true
				},
				alamat_user:{
					required:true
				},
				jenis_identitas:{
					required:true
				},
				identitas_user:{
					required:true,
					number:true
				},
				foto_identitas:{
					required:true
				},
			},messages:{
				nama_lengkap:{
					required:'Nama lengkap tidak boleh kosong !!',
				},
				email_user:{
					required:'Email anda tidak boleh kosong !!',
				},
				password_user:{
					required:'Password anda tidak boleh kosong !!',
				},
				notelp_user:{
					required:'Nomor telepon tidak boleh kosong !!',
				},
				country:{
					required:'Kebangsaan tidak boleh kosong !!',
				},
				alamat_user:{
					required:'Alamat tidak boleh kosong !!',
				},
				jenis_identitas:{
					required:'Jenis identitas tidak boleh kosong !!'
				},
				identitas_user:{
					required:'No identitas tidak boleh kosong !!',
				},
				foto_identitas:{
					required:'Bukti identitas anda tidak boleh kosong !!'
				}
			}	
		});
	});
	function isNumberKey(evt){
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
	    return true;
	}    
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Man Check Member</h1>
			<p>Apakah Tamu Tersebut Sudah Terdaftar Sebelumnya ?</p>
		</div>
			<div class="col-md-3">
				<form id="validate-checkmember" action="backend/proses_man_checkmember.php?act=check_member" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Masukan ID member anda</label>
						<input type="text" name="id_member" autofocus required="" class="form-control">
					</div>
					<button>Cek Id Member</button>
				</form>
			</div>
			<form id="validate-addmember" action="backend/proses_man_member.php?act=add_member_baru" enctype="multipart/form-data" method="post">
			<div class="col-md-4">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="nama_lengkap" autofocus required="" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email_user" autofocus required="" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password_user" autofocus required="" class="form-control">
				</div>
				<div class="form-group">
					<label>No telp / Hp</label>
					<input type="text" name="notelp_user" onkeypress="return isNumberKey(event)" autofocus required="" class="form-control">
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<label class="radio-inline"></label>
						<input type="radio" name="jenis_kelamin" value="pria" checked="" style="cursor:pointer;"> Pria
					<label class="radio-inline"></label>
						<input type="radio" name="jenis_kelamin" value="wanita" style="cursor:pointer;"> Wanita
				</div>
				<div>
					<button>Lanjut</button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Kebangsaan</label>
					<select name="country" class="form-control" autofocus required"">
						<option value="">Choose Country</option>
						<?php
							foreach ($countries as $key => $value) {
								echo "<option value='$value'>$value</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat_user" class="form-control" autofocus required=""></textarea>
				</div>
				<div class="form-group">
					<label>Jenis identitas</label>
					<select name="jenis_identitas" autofocus required="" class="form-control">
						<option value="">Jenis Identitas</option>
						<option value="KTP">KTP</option>
						<option value="SIM">SIM</option>
						<option value="Passport">Passport</option>
					</select>
				</div>
				<div class="form-group">
					<label>No Identitas</label>
					<input type="text" name="identitas_user" onkeypress="return isNumberKey(event)" class="form-control"> 
				</div>
				<div class="form-group">
					<label>Bukti Identitas</label>
					<input type="file" name="foto_identitas" autofocus required="">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>