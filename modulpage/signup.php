<?php include "fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.click-rombongan').click(function(){
			$('.click-person').hide('slow');
		});
		$('.click-rombongan').click(function(){
			$('.show-member').show('slow');
		});
		$('#addmember').validate({
			rules: {
				nama_lengkap: "required",
				nama_lengkap: {
					required: true
				},
				password_member: {
					required: true,
					minlength: 5,
				},
				/*password_equalto: {
					required: true,
					minlength: 5,
					equalTo: "#password_member",
				},*/
				email: {
					required: true,
					email: true
				},
				no_telp:{
					required:true,
					number:true,
				},
				alamat: {
					required:true
				},
				kebangsaan:{
					required:true
				},
				jenis_identitas: {
					required:true,
				},
				no_identitas: {
					required: true,
					number: true,
				},
				foto_identitas:{
					required:true,
				},
				foto_profil:{
					required:true,
				},
				agrements:{
					required: true
				}
			},
			messages: {
				nama_lengkap: {
					required: "Nama anda tidak boleh kosong !!",
				},
				password_member: {
					required: "Password anda tidak boleh kosong !!",
					minlength: "Your password must be at least 5 characters long",
				},
				/*password_equalto: {
					required: "konfrimasi password anda tidak boleh kosong !!",
					minlength: "Your password must be at least 5 characters long",
					equalTo :"Password anda tidak sama !!",
				},*/
				email:{
					required:"Email anda tidak boleh kosong !!",
					email:"Email anda tidak valid !!",
				},
				no_telp:{
					required:"Nomor telepon tidak boleh kosong !!",
					number:"Nomor telepon tidak valid !!"
				},
				alamat:{
					required:"Alamat anda tidak boleh kosong !!",
				},
				kebangsaan:{
					required:"Kebangsaan tidak boleh kosong !!",
				},
				jenis_identitas:{
					required:"Jenis identitas anda tidak boleh kosong !!",
				},
				no_identitas:{
					required: "No identitas anda tidak boleh kosong !!",
					number: "Identitas User anda tidak valid harus angka !!",
				},
				foto_identitas:{
					required:"Foto identitas anda tidak boleh kosong !!",
				},
				foto_profil:{
					required: "Foto profil anda tidak boleh kosong !!",
				},
				agrements: "Kolom privacy and policy tidak boleh kosong !!  ",
			}
		});
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h2 class="fnt-style">REGISTRASI MEMBER HOTEL BALECATUR INN</h2>
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Signup</li>
			</ol>
			<p class="information-methods">
				Selamat datang member anggota Hotel Balecatur Inn ! ,setelah anda mengisi formulir informasi berikut ini, dan anda telah menyelesaikan data tersebut.
				Informasi yang anda berikan tidak akan digunakan dengan cara apapun / penyalahgunaan dalam bentuk kriminalitas internet ( Cyber Crime ).
			</p>
			<form action="<?php echo "$site"."backend/proses_signup.php?act=tambah"?>" method="post" enctype="multipart/form-data" id="addmember">
			<div class="row">
				<div class="col-lg-6">
				<!-- MEMBER PERSONAL -->
					<div class="panel panel-default ">
						<div class="panel-heading">Daftar Member</div>
							<div class="panel-body click-person">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" class="form-control" name="nama_lengkap" autocomplete="off" autofocus required>
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="form-control"  autocomplete="off" autofocus required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password_member" class="form-control"  autocomplete="off" autofocus required>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>No telp / Hp</label>
											<input type="text" name="no_telp" class="form-control"  autocomplete="off" autofocus required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Kebangsaan</label>
											<select name="kebangsaan" class="form-control" autofocus required>
												<option value="">Choose Country</option>
												<?php foreach ($countries as $key => $negara): ?>
												<option value="<?php echo $negara;?>"><?php echo $negara;?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<label class="radio-inline">
										<input type="radio" value="Pria" style="cursor:pointer;" name="jen_kel" checked="">Pria 
									</label>
									<label class="radio-inline">
										<input type="radio" value="Wanita" style="cursor:pointer;" name="jen_kel">Wanita 
									</label>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control" cols="4" rows="4"></textarea>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Jenis Identitas</label>
											<select name="jenis_identitas" class="form-control form-select" autofocus required>
												<option value=""> Pilih indentitas </option>
												<option>KTP</option>
												<option>SIM</option>
												<option>Passport</option>
											</select>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Foto Indentas</label>
											<input type="file" value="browse" class="flash-boxpic" name="foto_identitas" autofocus required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>No Identitas KTP / SIM / Passport</label>
									<span style="color:#db6a1b;">&nbsp;* sesuaikan dengan pilihan identitas anda</span>
									<input type="text" class="form-control" name="no_identitas"  autocomplete="off" autofocus required>
								</div>
								<div class="form-group">
									<label>Foto Profil</label>
									<input type="file" value="browse" class="flash-boxpic" name="foto_profil" autofocus required>
								</div>
								<div class="form-group">
									<input type="checkbox" style="cursor:pointer;" name="agrements" value="agrements" class="postion-checkbox" autofocus required>
										saya setuju dengan ketentuan dan kebijakan manajemen hotel
										<strong class="terms-bold">"Terms of Use Notice",</strong>Balecatur Hotel<strong class="terms-bold">"Privacy Policy"</strong>
								</div>
								<div class="form-group">
									<!-- member type -->
									<input type="hidden" name="tipe_member" value="personal">
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-custom-balecatur-hotel" value="Daftar Sekarang">
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>