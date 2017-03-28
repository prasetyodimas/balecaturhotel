<style type="text/css">
	.spacer-form{margin-bottom: 10px; width: 100%; margin-left: 10px; font-weight: normal; } 
  .td-gallery{ padding: 9px 4px; } 
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Edit Gallery</h1>
        </div>
    </div>
  	<div class="col-lg-12">
      <div style="width:50%">
      
      <?php

      $aksi = "backend/proses_gallery.php";

      $editgalle = mysqli_query($konek,"select * from gallery where id_gallery='$_GET[id]'");
      $res   = mysqli_fetch_array($editgalle);

      echo "<img src='$site"."uploads/gallery/$res[foto_gallery]' width='300' height='auto' class='space-outer-images'>
          <form method=post enctype='multipart/form-data' id='edit-gallery' action='$aksi?modul=man_editgalle&act=update_gallery'>
            <input type=hidden name=id value='$res[id_gallery]'>
              <table>
                <tr>
                  <td class='td-gallery'>Keterangan Foto</td>
                  <td class='td-gallery'>:</td>
                  <td class='td-gallery'><textarea name='deskripsi_foto' cols='100' rows='6' class='form-control' required>$res[deskripsi_foto]</textarea></td>
                </tr>
                <tr>
                  <td class='td-gallery'>Foto Gallery</td>
                  <td class='td-gallery'>:</td>
                  <td class='td-gallery'><input type='file' name='foto_gallery' class='form-control'></td>
                </tr>
              </table>
              <div class='navigation-gallery'>
                  <input type=submit value=Update class='btn btn-small btn-success'>
                  <input type=button value=Batal class='btn btn-small' onclick=self.history.back()>
              </div>
          </form>";
      ?>

    </div>
  </div>
</div>
