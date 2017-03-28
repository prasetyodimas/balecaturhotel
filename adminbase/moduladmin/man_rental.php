<?php include "../fungsi/function_transaksi.php"; ?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.tambah').click(function(){
      $('.tambah-content').slideToggle();
		});
    //jqeury data-tables
    $('#tables-rental').dataTable( {
          // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
        // Set the default no. of rows to display
        "pageLength": 5
    });

    var validator = $('#addman_rental').submit(function() {

      }).validate({

        rules : {
            kate_kendaraan :{
                required:true,
            },
            nama_kendaraan :{
                required:true,
            },
            harga_kendaraan :{
                required : true,
                number: true,
            },
            foto_kendaraan :{
                required:true,
            },
            ket_kendaraan  :{
                required:true,
            }
        },
        messages : {

            kate_kendaraan : {
              required : 'Kategori kendaran tidak boleh kosong !!',
            },
            nama_kendaraan : {
              required : 'Nama kendaraan tidak boleh kosong !!',
            },
            harga_kendaraan : {
              required : 'Harga kendaraan tidak boleh kosong !!',
              number : 'Tidak valid harus diisi angka !!'
            },
            foto_kendaraan : {
              required : 'Foto kendaran tidak boleh kosong !!',
            },
            ket_kendaraan : {
              required : 'Keterangan kendaraan tidak boleh kosong !!'
            }
        },
      });
    });
</script>
<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Rental</h1>
      </div>
    </div>
    <div class="col-lg-12">
      <button class="btn btn-small btn-success tambah">Tambah Rental</button>
      <div style="margin-bottom:20px;"></div>
      <div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:50%;">
          <form role="form" action="backend/proses_man_rental.php?act=add_rental" method="post" id="addman_rental" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <select name="kate_kendaraan" class="form-control" autofocus required >
  	                	<option value=""> Pilih Kategori </option>
  	                	<option>Mobil</option>
  	                	<option>Motor</option>
                    </select>
                </div>
                <div class="form-group">
                	<input type="text" name="nama_kendaraan" autocomplete="off" class="form-control" placeholder="Nama Kendaraan" autofocus required>
                </div>
                <div class="form-group">
                	<input type="text" id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" autocomplete="off"
                  name="harga_kendaraan" class="form-control" placeholder="Harga Kendaraan" autofocus required>
                  <span style='display: block;position: relative;top: -27px;left:482px;' id="format"></span>
                </div>
                <div class="form-group">
                  <!-- 450px X 350px -->
                	foto kendaraan : <input type="file" class="form-control" name="foto_kendaraan" autofocus required>
                </div>
                <div class="form-group">
                <label>Keterangan</label>
                    <textarea name="ket_kendaraan" placeholder="" cols="20" rows="7"  class="form-control" required></textarea>
                </div>
                <input type="submit" value="Submit" class="btn btn-small btn-success">
            </fieldset>
          </form>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover" id="tables-rental">
          <thead>
            <tr>
              <th>No</th>
              <th width="90">Foto</th>
              <th>Kategori</th>
              <th>Nama </th>
              <th>Harga</th>
              <th>Keterangan</th>
              <th width="100">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $tampildata_rental=mysqli_query($konek,"SELECT * FROM rental");
            $no=1;
            while ($data=mysqli_fetch_array($tampildata_rental)) {
            $url_pict = $site."uploads/rental/".$data['foto_kendaraan'];
          ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><img src="<?php echo $url_pict;?>" width="200" height="auto"></td>
              <td><?php echo $data['kate_kendaraan'];?></td>
              <td><?php echo $data['nama_kendaraan'];?></td>
              <td>Rp.<?php echo formatuang($data['harga_kendaraan']);?></td>
              <td><?php echo $data['ket_kendaraan'];?></td>
              <td>
                <a href="<?php echo "homeadmin.php?modul=man_rental_edit&id=$data[id_rental]"?>">Edit</a> |
                <a href="<?php echo "backend/proses_man_rental.php?act=hapus_rental&id=$data[id_rental]";?>">Delete</a>
              </td>
            </tr>
          <?php $no++; } ?>
          </tbody>
        </table>
        <div class="clearfix-bottom-100"></div>
      </div>
    </div>
</div>
