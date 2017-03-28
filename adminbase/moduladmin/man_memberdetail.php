<style type="text/css">
  .id-member{margin-left: 110px;} 
  .nama-member{margin-left: 170px;}
  .nama-lengkap{margin-left: 80px;}
  .email-member{margin-left: 145px;}
  .tipe-member{margin-left: 186px;}
  .jenkel-member{margin-left: 87px;}
  .notelp-member{margin-left: 78px;}
  .alamat-member{margin-left: 138px;}
  .kebangsaan-member{margin-left: 99px}
  .foto-identitas-member{margin-left:85px;}
  .jenis-identitas-member{margin-left: 85px;}
  .no-identitas-member{margin-left:104px;}
</style>
<div class="row">
  <div class="col-lg-12">   
    <div class="font-sizerheading">
      <h1 class="page-header">Manajemen Detail Member</h1>                
    </div>             
  </div>                
  <div class="col-lg-12">
  <?php 
      $aksi="backend/proses_man_member.php";
      $edit =mysqli_query($konek,"select * from member where id_member='$_GET[id]'");
      $r    =mysqli_fetch_array($edit);
  ?>
  <form method="post" action="<?php echo $aski;?>modul=man_user_edit&act=updateUser">
    <input type='hidden' name='id' value='$r[id_member]'>
      <div class='col-md-8'>
          <div class='form-group'>
            <label>Id Member </label><span class='id-member'>: <?php echo $r['id_member'];?></span>
          </div>  
          <div class='form-group'>
            <label>Nama Lengkap</label><span class='nama-lengkap'>: <?php echo $r['nama_lengkap'];?></span>
          </div>
          <div class="form-group">
              <label>Email </label><span class='email-member'>: <?php  echo $r['email'];?></span>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin </label><span class='jenkel-member'>: <?php echo $r['jenis_kelamin'];?></span>
          </div>
          <div class='form-group'>
            <label>No telepon / Hp </label><span class='notelp-member'>: <?php echo $r['no_telp'];?></span>
          </div>
          <div class="form-group">
            <label>Alamat</label><span class='alamat-member'>: <?php echo $r['alamat'];?></span>
          </div>
          <div class="form-group">
            <label>Kebangsaan</label><span class='kebangsaan-member'>: <?php echo $r['kebangsaan'];?></span>
          </div>
          <div class="form-group">
            <label>Jenis Identitas</label><span class='jenis-identitas-member'>: <?php echo $r['jenis_identitas'];?></span>
          </div>
          <div class="form-group">
            <label>No identitas</label><span class='no-identitas-member'>: <?php echo $r['identitas_user'];?></span>
          </div>
          <div class="form-group">
              <label>Foto Identitas</label>
              <div class="">
                <a href='<?php echo $site?>uploads/identitas/<?php echo $r['foto_identitas']?>' data-lightbox='<?php echo $r['foto_identitas']?>'>
                <img src='<?php echo $site?>uploads/identitas/<?php echo $r['foto_identitas']?>' width='70' height='50'>
              </div>
          </div>
      </div>
      <div class="row">
          <div class='col-md-4'>
          <?php
            //cek foto user default
            if ($r['foto']=='-') {
              echo "<img src=".$site."uploads/blank_user/User.jpg width='200' height='auto'>";
            }else{
              echo"<div class='form-group'>
                  <a href='uploads/user/$r[foto]>' data-lightbox='$r[foto]'>
                  <img class='resizer-foto' src='uploads/user/$r[foto]'></a>";
            }
          ?>
          </div>
      </div>
      <div class='row'>
        <div class='col-lg-12'>
            <input type=button value='Kembali' class='btn btn-small' onclick='self.history.back()'>
        </div>
      </div>
      </form>
      <div class="clearfix-bottom-100"></div>
    </div>
  </div>
</div>