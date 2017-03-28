<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tambah').click(function(){
      $('.tambah-content').slideToggle();
		});
    //jquery data-tables
    $('#tables-laundry').dataTable( {
          // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
        // Set the default no. of rows to display
        "pageLength": 5
    });
 /* tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        onchange_callback: function(editor) {
          tinyMCE.triggerSave();
          $("#" + editor.id).valid();
        }
    });*/

    var validator = $('#addman_rental').submit(function() {

      }).validate({

          rules : {
              jenis_laundry :{
                  required:true,
              },
              harga_laundry:{
                  required : true,
                  number: true,
              },
              ket_laundry:{
                  required:true,
              }
          },
          messages : {

              jenis_laundry : {
                required : 'kategori laundry tidak boleh kosong !!',
              },
              harga_laundry : {
                required : 'harga laundry tidak boleh kosong !',
                number : ' tidak valid harus angka !'
              },
              ket_laundry:{
                required:'keterangan laundry tidak boleh kosong !!',
              }
              
          }

      });

    });

/*  });*/
</script>
<style type="text/css">
  table > thead > tr > th {
      border: none !important;
      
  }
</style>
<div class="row">
    <div class="col-lg-12">  
      <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Laundry</h1>                
      </div>       
    </div>                
    <div class="col-lg-12">
      <button class="btn btn-small btn-success tambah">Tambah Laundry</button>
      <div style="margin-bottom:20px;"></div>   
      <div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:50%;">
          <form role="form" action="backend/proses_laundry.php?act=add_laundry" method="post" id="addman_rental" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <select name="jenis_laundry" class="form-control" autofocus required >
  	                	<option value=""> Pilih Kategori </option>
                      <option>Layanan Biasa</option>
  	                	<option>Layanan Express</option>
  	                	<option>Layanan Kilat</option>
                    </select>
                </div>
                <div class="form-group">
                	<input type="text" id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" autocomplete="off"
                  name="harga_laundry" class="form-control" placeholder="Harga Laundry" autofocus required>
                  <span style='display: block;position: relative;top: -27px;left:482px;' id="format"></span>
                </div>
                <div class="form-group">
                <label>Keterangan</label>
                    <textarea name="ket_laundry" placeholder="" cols="20" rows="7"  class="form-control" required></textarea>
                </div>
                <input type="submit" value="Submit" class="btn btn-small btn-success">
            </fieldset>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover" id="tables-laundry">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis Laundry</th>
              <th>Harga Laundry</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php

            $tampildata_laundry=mysqli_query($konek,"SELECT * FROM laundry");
            $no=1;
            while ($data=mysqli_fetch_array($tampildata_laundry)) {
          
          ?>
            <tr>
              <td width="50"><?php echo $no;?></td>
              <td><?php echo $data['jenis_laundry'];?></td>
              <td>Rp.<?php echo formatuang($data['harga_laundry']);?></td>
              <td width="400"><?php echo $data['ket_laundry'];?></td>
              <td>
                <a href="<?php echo "homeadmin.php?modul=man_laundry_edit&id=$data[id_laundry]"?>">Edit</a> |
                <a href="<?php echo "backend/proses_laundry.php?act=delete_laundry&id=$data[id_laundry]";?>">Delete</a>
              </td>
            </tr>
          <?php $no++; } ?>
          </tbody>
        </table>
      </div>
    </div>       
</div>                