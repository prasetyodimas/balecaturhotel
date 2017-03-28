<script type="text/javascript">
  $(document).ready(function(){
    $('.tambah').click(function(){
      $('.tambah-content').slideToggle();
    });
    //jqeury data-tables
    $('#data_gallery').dataTable( {
      "bFilter": false,//hide filter control
        // Sets the row-num-selection "Show %n entries" for the user
      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
      // Set the default no. of rows to display
      "pageLength": 5
    });
    //validation
    var validator = $('#add-gallerys').submit(function(){
      }).validate({
          ignore : "",
          messages:{
            deskripsi_foto : "deskripsi foto tidak boleh kosong !!",
            foto_gallery : "foto tidak boleh kosong !!"
         }
      });
  });
</script>
<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Gallery</h1>
      </div>
    </div>
   	<div class="col-lg-12">
      <button class="btn btn-small btn-success tambah">Tambah Gallery</button>
      <div style="margin-bottom:20px;"></div>
      <div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:30%;">
          <form role="form" action="backend/proses_gallery.php?act=add_gallery" method="post" id="add-gallerys" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Deskripsi Foto" name="deskripsi_foto" type="text" autofocus required="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" name="foto_gallery" autofocus required="">
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <input type="submit" value="Submit" class="btn btn-small btn-success">
            </fieldset>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover" id="data_gallery">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Deskripsi foto</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $no =1;
                $q =mysqli_query($konek,"SELECT * FROM gallery ORDER BY id_gallery DESC");
                  while ($data= mysqli_fetch_array($q)) {
                  $path_file = $site."uploads/gallery/".$data['foto_gallery'];
             ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><img width="150" height="auto" src="<?php echo $path_file;?>"></td>
              <td><?php echo $data['deskripsi_foto'];?></td>
              <td>
                <a href="<?php echo "homeadmin.php?modul=man_gallery_edit&id=$data[id_gallery]";?>"><i class="fa fa-edit"></i> Edit</a> |
                <a href="<?php echo "backend/proses_gallery.php?act=delete_galllery&id=$data[id_gallery]"; ?>" onclick="return confirm('Anda yakin menghapus ?');">
                  <i clas="fa fa-close"></i>Delete</a>
              </td>
            </tr>
           <?php $no++; } ?>
          </tbody>
        </table>
        <div class="clearfix-bottom-100"></div>
      </div>
    </div>
  </div>
</div>
