<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Edit Member</h1>
      </div>
    </div>
  	<div class="col-lg-6">
<?php

    $edit =mysqli_query($konek,"select * from member where id_member='$_GET[id]'");
    $r    =mysqli_fetch_array($edit);
    //url images user member
    $base_imguser = $site."uploads/user/".$r['foto'];
    //url images user identitas
    $base_imgidentitas = $site."uploads/identitas/".$r['foto_identitas'];
    $urlaction = "backend/proses_man_member.php?modul=man_member_edit&act=update_member&id=$r[id_member]";
?>
      <form method='post' action="<?php echo $urlaction;?>" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $r['id_member']?>">
      <div class='wrapp-fotomember'>
          <!-- <div class='bingkai-member'>
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
          </div> -->
          <div class='box-fotomember'>
            <label> Foto Member</label>
          </div>
        </div>
        <div class='form-group'>
              <label>Nama Lengkap</label>
              <input type='text' name='nama_lengkap' value='<?php echo $r['nama_lengkap'];?>' class='form-control'>
          </div>
          <div class='form-group'>
              <label>Email</label>
              <input type='text' name='email' value="<?php echo $r['email'];?>" class='form-control'>
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type='password' name='password_user' value="<?php echo $r['password'];?>" class='form-control'>
          </div>
          <div class='form-group'>
              <label>Jenis kelamin</label>
              <input type='text' name='jenis_kelamin' value="<?php echo $r['jenis_kelamin'];?>" class='form-control'>
          </div>
          <div class='form-group'>
              <label>No telepon / Hp </label>
              <input type='text' name='no_telp' value="<?php echo $r['no_telp'];?>" class='form-control'>
          </div>
          <div class='form-group'>
              <label>Alamat</label>
              <textarea name='alamat' cols="10" rows="5" class='form-control'><?php echo $r['alamat'];?></textarea>
          </div>
          <div class="form-group">
              <label>Jenis Identitas</label>
              <select class="form-control" name="jenis_identitas">
                  <option><?php echo $r['jenis_identitas']; ?></option>
                  <option value="">KTP</option>
                  <option value="">SIM</option>
                  <option value="">PASSPORT</option>
              </select>
          </div>
          <div class="form-group">
              <label>Nomor Identitas</label>
              <input type="text" name="identitas_user" class="form-control" value="<?php echo $r['identitas_user'];?>" autocomplete="off">
          </div>
          <div class='form-group' style="margin-top:20px;">
        <?php
            //cek identitas terlampir atau tidak !!
            if ($r['foto_identitas']=='-') {
                $pesam_log = "Foto Identitas Belum Terlampir !!";
            ?>
            <label>Foto Identitas : </label>
            <p><?php echo $pesam_log; ?></p>
            <input type="file" name="foto_identitas"/>
        <?php }else{ ?>
            <div class="form-group">
              <a href="<?php echo $base_imgidentitas?>" data-lightbox="<?php echo $r['foto_identitas'];?>">
                <img src="<?php echo $site;?>uploads/identitas/<?php echo $r['foto_identitas'];?>" width='70' height='50'>
              </a>
            </div>
            <div class="form-group">
              <label>Jika ingin merubah identitas isikan file dibawah ini</label>
              <input type="file" name="foto_identitas"/>
            </div>
        <?php } ?>
          </div>
          <div style='margin-bottom:40px;'>
            <input type="submit" value="Edit" class="btn btn-small btn-success">
            <input type="button" value="Batal" class="btn btn-small" onclick="self.history.back()">
          </div>
        </form>
      </div>
  </div>
</div>
