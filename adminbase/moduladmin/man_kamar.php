<?php include "../fungsi/function_transaksi.php"; ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.tambah').click(function() {
        $('.tambah-content').slideToggle();
      });
      $('#data_tableskamar').dataTable( {
        // Sets the row-num-selection "Show %n entries" for the user
      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
      // Set the default no. of rows to display
      "pageLength": 5
      });
      $("#add-kamar").validate({
          rules: {
              kategori: {
                  selectcheck: true
              },
              id_kamar:{
                selectcheck : true
              }
          },
          messages: {
              id_kamar: "Kolom nomor kamar tidak boleh kosong!"
          }
      });
      $.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "Kolom pilih kategori kamar harus dipilih!");
    });
  </script>
<style type="text/css">
/*thumbnail green*/
.thumbnail, .coloring-thumbnail-green {
        margin-bottom:0;
        height:100px;
        line-height: 85px;
        background: #2BE214;
        color: #fff;
        font-size: 20px;
        text-decoration: none !important;
        margin-top: 10px;
        margin-right: -16px;
}
/*thumbnail yellow*/
.thumbnail, .coloring-thumbnail-yellow {
        margin-bottom:0;
        height:100px;
        line-height: 85px;
        background: #fff82a;
        color: #fff;
        font-size: 20px;
        text-decoration: none !important;
        margin-top: 10px;
        margin-right: -16px;
}
/*thumbnail red*/
.thumbnail, .coloring-thumbnail-red {
        margin-bottom:0;
        height:100px;
        line-height: 85px;
        background: #ea0303;
        color: #fff;
        font-size: 20px;
        text-decoration: none !important;
        margin-top: 10px;
        margin-right: -16px;
}
/*thumbnail grey*/
.thumbnail, .coloring-thumbnail-grey {
        margin-bottom:0;
        height:100px;
        line-height: 85px;
   /*     background:#6b6b6b;*/
        color: #fff;
        font-size: 20px;
        text-decoration: none !important;
        margin-top: 10px;
        margin-right: -16px;
}
/*thumbnail orange*/
.thumbnail, .coloring-thumbnail-orange {
        margin-bottom:0;
        height:100px;
        line-height: 85px;
       /* background:#6b6b6b;*/
        color: #fff;
        font-size: 20px;
        text-decoration: none !important;
        margin-top: 10px;
        margin-right: -16px;
}
.font-sizecheck-kamar{
        font-size: 12px !important;
        display: inline-block;
        position: relative;
        width: 100%;
}
.coloring-thumbnail-red{
        background: rgb(226, 20, 20);
}
.coloring-thumbnail-yellow{
        background: #E3DD1A;
}
.coloring-thumbnail-green{
        background: #2BE214;
}
.coloring-thumbnail-grey{
        background: #6b6b6b;
}
.coloring-thumbnail-orange{
        background: #ff8000;
}
.coloring-thumbnail:hover{
        border: 2px solid #757575;
}
.wrapper-statuskamar{
        margin-top:40px;
}
.block-statreserve1 {
        background: #EA0303;
        display: inline-block;
        width: 20px;
        height: 20px;
}
.block-statreserve2 {
        background: #FFF82A;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 50px;
}
.block-statreserve3 {
        background: #2BE214;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 70px;
}
.block-statreserve4 {
        background: #6b6b6b;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 70px;
}
.block-statreserve5 {
        background: #ff8000;
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 70px;
}
.block-statreserve1 .statreseve-heading{
        margin-left: 28px;
        font-weight: bold;
}
.block-statreserve2 .statreseve-heading{
        margin-left: 28px;
        font-weight: bold;
}
.block-statreserve3 .statreseve-heading{
        margin-left: 28px;
        font-weight: bold;
}
.block-statreserve4 .statreseve-heading{
        margin-left: 28px;
        font-weight: bold;
}
.block-statreserve5 .statreseve-heading{
        margin-left: 28px;
        font-weight: bold;
}

.block-barstatus{
        float: none;
        display: block;
        width: 100%;
}
.flex{
        display: inline-flex;
}
.block-custom-status{
    width: 25px;
    height: 25px;
    display: inherit;
}
</style>
<div class="row">
<div class="col-lg-12">
  <div class="font-sizerheading">
    <h1 class="page-header">Manajemen Kamar</h1>
  </div>
    </div>
    <div class="col-lg-12">
    	<button class="btn btn-small btn-success tambah">Tambah Kamar</button>
      <div style="margin-bottom:20px;"></div>
    	<div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:30%;">
    		 <form role="form" action="backend/proses_kamar.php?act=add_kamar" method="post" enctype="multipart/form-data" id="add-kamar">
            <fieldset>
                <div class="form-group">
                  <select name="id_kamar" class="form-control">
                  <option value='0'> Pilih no kamar </option>
                    <?php

                      foreach(array('KMR001','KMR002','KMR003','KMR004','KMR005','KMR006','KMR007','KMR008','KMR009','KMR010','KMR011','KMR012','KMR013','KMR014') as $cat) {
                        $selected = ($jenis_kamar==$cat)? ' selected="selected"': '';
                        echo "<option value='$cat'".$selected.">$cat </option>";
                    }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                	<select name="kategori" class="form-control" required>
        				<option value='0'> Pilih tipe kamar</option>";
                		<?php
                    			$tampil=mysqli_query($konek,"SELECT * FROM kategori_kamar ORDER BY id_kategori_kamar ASC");
    					            while($r=mysqli_fetch_array($tampil)){
    					              echo "<option value=$r[id_kategori_kamar]>$r[type_kamar]</option>";
    			               }
		                ?>
                	</select>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <input type="submit" value="Submit" class="btn btn-small btn-success">
            </fieldset>
          </form>
    		</div>
    	</div>
      <div style="margin-bottom:90px;">
      <table class="table table-hover" id="data_tableskamar">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kategori Kamar</th>
            <th>No Kamar</th>
            <th>Status Kamar</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
        
            $no=1;
            $query = mysqli_query($konek,"SELECT * FROM kamar k JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar ORDER BY km.id_kategori_kamar ASC");
            while ($result = mysqli_fetch_array($query)) { 
              //mendefinisikan status warna kamar
              if ($result['status_kamar']=='0') {
                  $status_reserved ='coloring-thumbnail-grey';
              }elseif ($result['status_kamar']=='1'){
                  $status_reserved ='coloring-thumbnail-orange';
              }elseif($result['status_kamar']=='2'){
                  $status_reserved ='coloring-thumbnail-green';
              }elseif ($result['status_kamar']=='3'){
                  $status_reserved ='coloring-thumbnail-red';
              }elseif ($result['status_kamar']=='4'){
                  $status_reserved = 'coloring-thumbnail-yellow';
              }
          ?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $result['type_kamar'];?></td>
            <td><?php echo $result['id_kamar'];?></td>
            <td><?php echo checkStatuskamar($result['status_kamar']);?></td>
            <td>
                <div class="<?php echo $status_reserved;?> block-custom-status thumbnail"></div></td>
            <td>
              <a href="<?php echo "homeadmin.php?modul=man_kamar_edit&id=$result[id_kamar]"?>">
                <i class="fa fa-edit"></i> Edit
              </a> |
              <a href="<?php echo "backend/proses_kamar.php?act=delete_kamar&id=$result[id_kamar]";?>" onclick="return confirm('Delete?');">
                <i class="fa fa-close"></i> Delete
              </a>
            </td>
          </tr>
        <?php $no++; } ?>
        </tbody>
      </table>
      </div>
    </div>
</div>
