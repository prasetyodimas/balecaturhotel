<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.tambah').click(function(){
        $('.tambah-content').slideToggle();
    });
    $('#tb-members').dataTable( {
        // Sets the row-num-selection "Show %n entries" for the user
      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
      // Set the default no. of rows to display
      "pageLength": 10
      });
    var validator = $('#add-member').submit(function(){
    }).validate({
        rules:{
            nama_lengkap:{
              required:true,
            },
            password_user:{
              required:true,
              minlength :5,
            },
            email_user:{
              required:true,
              email:true,
            },
            alamat_user:{
              required:true,
            },
            country_atasnama:{
              required:true,
            },
            notelp_atasnama:{
              required:true,
              number:true,
            },
            identitas_user:{
              required:true,
              number:true,
            }
        },
        messages: {

            nama_company : {
                required:"Nama perusahaan / rombongan tidak boleh kosong !!",
            },
            nama_atasnama : {
                required:"Nama alias tidak boleh kosong !!",
            },
            password_user:{
                required:"Password tidak boleh kosong !!",
                minlength:"Password minimal 5 karakter !!",
            },
            email_atasnama:{
                required:"Email tidak boleh kosong !!",
                email:"Email tidak valid !!",
            },
            alamat_atasnama :{
                required: "Alamat tidak boleh kosong !!",
            },
            country_atasnama:{
                required: "Kebangsaan tidak boleh kosong !!",
            },
            notelp_atasnama :{
                required: "No telp tidak boleh kosong !!",
                number:"No telp tidak valid !!",
            },
            foto_user : {
                required:"Foto tidak boleh kosong !!",
            },
            jenis_kelamin :{
                required: "Jenis kelamin tidak  boleh kosong !!",
            },
            jenis_identitas : {
                required:"Jenis identitas tidak boleh kosong !!",
            },
            identitas_user:{
                required:"Nomor identitas tidak boleh kosong !!",
                number:"Nomor identitas harus angka !!",
            },
        }
    });
  });
</script>
<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Member Atasnama</h1>
      </div>
    </div>
    <div class="col-lg-12">
      <button class="btn btn-small btn-success tambah">Tambah Member</button>
      <div style="margin-bottom:20px;"></div>
      <div class="tambah-content" style="display:none;">
         <form role="form" action="backend/proses_man_member_atasnama.php?act=add_member_atasnama" method="post" id="add-member" enctype="multipart/form-data">
            <fieldset>
            <div class="panel panel-default">
              <div class="panel-heading">Member Atasnama</div>
            </div>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                  	<span style="color: #DD4814;font-size:12px;">(*Bersifat optional disesuaikan dengan tipe rombongan atau nama perusahaan)</span>
                    <input class="form-control" placeholder="Nama (Perusahaan / Rombongan)" name="nama_company" type="text" autofocus required>
                  </div>
                  <div class="form-group">
                  	<span style="color: #DD4814;font-size:12px;">(*Nama Alias diisi dengan nama kepercayan)</span>
                    <input class="form-control" placeholder="Nama Alias" name="nama_atasnama" type="text" autofocus required>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email_atasnama" type="text" autofocus required>
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password_user" type="password" autofocus required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nomor Telp / Hp" name="notelp_atasnama" autofucos required>
                  </div>
                  <div class="form-group space-margin">
                    <label style="font-weight:normal;">Jenis Kelamin :</label>
                      <span style="margin-left:3px;">
                          <input type="radio" style="cursor:pointer;" name="jenis_kelamin" value="Pria" checked=""> Pria</input>
                          <input type="radio" style="cursor:pointer;" name="jenis_kelamin" value="Wanita"> Wanita</input>
                      </span>
                  </div>
                  <div class="form-group">
                    <textarea name="alamat_atasnama" cols='20' rows='5' class="form-control" placeholder="Alamat" autofocus required></textarea>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                      <select name="country_atasnama" class="form-control">
                          <option value="">Pilih kebangsaan</option>
                          <?php foreach ($countries as $key => $nilai_variable) { ?>
                          <option value="<?php echo $nilai_variable;?>"><?php echo htmlspecialchars($nilai_variable)?></option>
                          <?php } ?>
                       </select>
                  </div>
                  <div>
                    <select class="form-control" style="cursor:pointer;" name="jenis_identitas" autofocus required>
                      <option value="">Pilih Indentitas</option>
                        <option>KTP</option>
                        <option>SIM</option>
                        <option>Passport</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <span style="color: #DD4814;font-size:12px;">*masukkan nomor identitasnya disesuaikan dengan jenis identitas</span>
                    <input type="text" placeholder="No identitas" name="identitas_user" class="form-control" autofocus required>
                  </div>
                  <div class="form-group">
                    Foto Identitas : <input class="form-control" name="foto_identitas" type="file" required>
                  </div>
              </div>
              <div class="rorw">
                <div class="col-lg-12">
                  <div style="margin-bottom:50px;">
                    <input type="submit" value="Submit" class="btn btn-small btn-success">
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
      </div>

   		<table class="table" id="tb-members" style="font-size:13px;">
   			<thead>
   				<tr>
   					<th>No.</th>
            <th>Id Member</th>
   					<th>Nama Member</th>
            <th>Email</th>
   					<th>Jenis Kelamin</th>
            <th>No Tlp</th>
   					<th>KTP/SIM/Pass</th>
   					<th>Action</th>
   				</tr>
   			</thead>
   			<tbody>
   				<?php

    			$no=1;
   				$query = mysqli_query($konek,"select * from member order by id_member DESC");

					while ($result = mysqli_fetch_array($query)) { ?>
					<tr>
						<td><?php echo $no;?></td>
            <td><?php echo $result['id_member'];?></td>
						<td><?php echo $result['nama_lengkap'];?></td>
            <td><?php echo $result['email'];?></td>
						<td><?php echo $result['jenis_kelamin'];?></td>
            <td><?php echo $result['no_telp'];?></td>
            <td>
              <a href="<?php echo $site; ?>uploads/identitas/<?php echo $result['foto_identitas']; ?>" data-lightbox="<?php echo $result['id_member']?>">
                <i class="glyphicon glyphicon-picture"></i>
              </a>
            </td>
            <td>
              <a href="<?php echo "homeadmin.php?modul=man_member_edit&id=$result[id_member]"?>"><i class="fa fa-edit"></i> Edit </a>
							<a href="<?php echo "homeadmin.php?modul=man_memberdetail&id=$result[id_member]"?>"><i class="glyphicon glyphicon-eye-open"></i> Detail</a> |
							<a href="<?php echo "backend/proses_man_member.php?act=delete_member&id=$result[id_member]";?>" onclick="return confirm('Anda ingin menghapus ?');"><i class="fa fa-close"></i> Delete</a>
						</td>
					</tr>
				<?php $no++; } ?>
   			</tbody>
   		</table>
      <div style="margin-bottom:70px;"></div>
   	</div>
</div>
