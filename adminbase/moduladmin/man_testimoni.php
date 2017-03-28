<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
      $('.tambah').click(function() {
        $('.tambah-content').slideToggle();
      });
       //jqeury data-tables
      $('#data_testimoni').dataTable( {
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
        <h1 class="page-header">Manajemen Testimoni</h1>
      </div>
    </div>
   	<div class="col-lg-12">
      <div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:60%;">
          <form role="form" action="backend/proses_akomodasi.php?act=add_akomodasi" method="post" id="add-news" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Judul Akomodasi" name="judul_akomodasi" type="text" autofocus required>
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
      <div class="table-responsive">
        <table class="table table-hover" id="data_testimoni">
          <thead>
            <tr>
              <th width="50">No</th>
              <th>Email </th>
              <th>Nama</th>
              <th width="300">Keterangan</th>
              <th>Blokir</th>
              <th width="50">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $no=1;
               $query = mysqli_query($konek,"select * from testimonial t join member m on t.id_member=m.id_member order by id_testimonial DESC");
               while ($result = mysqli_fetch_array($query)) { ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $result['email'];?></td>
              <td><?php echo $result['nama_lengkap'];?></td>
              <td><?php echo $result['keterangan_testi'];?></td>
              <td><?php echo $result['blokir_testi'];?></td>
              <td width="150">
                <a href="<?php echo "homeadmin.php?modul=man_testimoni_edit&id=$result[id_testimonial]"?>"><i class="fa fa-edit"></i> Blokir</a> |
                <a href="<?php echo "backend/proses_testimoni.php?act=delete_testi&id=$result[id_testimonial]";?>" onclick="return confirm('Anda yakin menghapus ?');">
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
</div>
