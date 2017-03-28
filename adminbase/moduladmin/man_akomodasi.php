<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
      $('.tambah').click(function() {
        $('.tambah-content').slideToggle();
      });
       //jqeury data-tables
      $('#data_akomodasi').dataTable( {
        "bFilter": false,//hide filter control
          // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
        // Set the default no. of rows to display
        "pageLength": 5
      });
      tinymce.init({
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
      });

     var validator = $("#add-news").submit(function() {
          tinyMCE.triggerSave();
       }).validate({
          ignore: "",
          messages: {
              judul_akomodasi: "Kolom akomodasi tidak boleh kosong!",
              ket_akomodasi: "Kolom Keterangan tidak boleh kosong!"
          }
      });
      validator.focusInvalid = function() {
      // put focus on tinymce on submit validation
      if (this.settings.focusInvalid) {
        try {
          var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
          if (toFocus.is("textarea")) {
            tinyMCE.get(toFocus.attr("id")).focus();
          } else {
            toFocus.filter(":visible").focus();
          }
        } catch (e) {
          // ignore IE throwing errors when focusing hidden elements
        }
      }
    }
    });
</script>
<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Akomodasi</h1>
      </div>
    </div>
   	<div class="col-lg-12">
      <button class="btn btn-small btn-success tambah">Tambah Akomodasi</button>
      <div style="margin-bottom:20px;"></div>
      <div class="tambah-content" style="display:none;">
        <div class="row">
          <div class="col-md-8 col-lg-8">
              <form role="form" action="backend/proses_akomodasi.php?act=add_akomodasi" method="post" id="add-news" enctype="multipart/form-data">
                <fieldset style="margin-bottom:50px;">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                            <input class="form-control" placeholder="Judul Akomodasi" name="judul_akomodasi" type="text" autofocus required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea id="editor1" name="ket_akomodasi" placeholder="Keterangan" cols="20" rows="7"  class="form-control" required></textarea>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <input type="submit" value="Submit" class="btn btn-small btn-success">
                </fieldset>
              </form>
            </div>
          </div>
        </div>
   		<table class="table table-hover" id="data_akomodasi">
   			<thead>
   				<tr>
   					<th>No.</th>
            <th>Judul Akomodasi</th>
   					<th>Ket Akomodasi</th>
   					<th>Action</th>
   				</tr>
   			</thead>
   			<tbody>
   				<?php

    			   $no=1;
   					 $query = mysqli_query($konek,"select * from akomodasi");
					   while ($result = mysqli_fetch_array($query)) { ?>

					<tr>
            <td width="50"><?php echo $no;?></td>
						<td width="100"><?php echo $result['judul_akomodasi'];?></td>
            <td width="100"><?php echo removeTags($result['ket_akomodasi']);?></td>
						<td width="50">
							<a href="<?php echo "homeadmin.php?modul=man_akomodasi_edit&id=$result[id_akomodasi]"?>"><i class="fa fa-edit"></i> Edit</a> |
							<a href="<?php echo "backend/proses_akomodasi.php?act=hapus_akomodasi&id=$result[id_akomodasi]";?>" onclick="return confirm('Anda yakin menghapus ?');">
							   <i class="fa fa-close"></i> Delete
							</a>
						</td>
					</tr>
				<?php $no++; } ?>
   			</tbody>
   		</table>
     <div class="clearfix-bottom-100"></div>
   	</div>
</div>
