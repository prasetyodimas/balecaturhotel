<?php include "../fungsi/function_transaksi.php"; ?>

<script type="text/javascript">
      $(document).ready(function() {
      /*  tinymce.init({
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
  */
          var validator = $("#edit-kategori").submit(function() {
              tinyMCE.triggerSave();
           }).validate({ 
              ignore: "",
              messages: {
                  type_kamar: "Kolom type kamar tidak boleh kosong!",
                  tarif: "Kolom tarif kamar tidak boleh kosong!",
                  jumlah_kamar: "Kolom jumlah kamar tidak boleh kosong!",
                  fasilitas: "Kolom fasilitas kamar tidak boleh kosong!"
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

<style type="text/css">
  .spacer-form{
      margin-bottom: 10px;
      width: 100%;
      margin-left: 10px;
      font-weight: normal;
  }
  .space-outer-images{
      margin-bottom: 10px;
  }
</style>

<div class="row">
    <div class="col-lg-12"> 
      <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Extrabed</h1>                
      </div>               
    </div>                
  	<div class="col-lg-12">
    <?php 

    $aksi="backend/proses_extrabed.php";

        $edit=mysqli_query($konek,"select * from extrabed where id_extrabed='$_GET[id]'");
        $r=mysqli_fetch_array($edit);
    echo "
    <form method=POST enctype='multipart/form-data' id='edit-kategori' action='$aksi?modul=man_kategori_edit&act=edit_extrabed'>
      <input type=hidden name=id value='$r[id_extrabed]'>
        <table>
        <tr>
          <td>Harga Extrabed</td>
        	<td>:</td>
        	<td><label class='spacer-form'></label>";?>
              <input type='text' id='num' onkeyup='document.getElementById("format").innerHTML=formatCurrency(this.value);' name='harga_extrabed' class='form-control' required value='<?php echo $r['harga_extrabed'];?>'>
              <span style='display: block;position: relative;top: -27px;left:214px;' id='format'></span>
          </td>
    	  </tr>
        </table>
        <div class='navigation-formsubmit2'>
          <input type=submit value=Edit class='btn btn-small btn-success'>
          <input type=button value=Batal class='btn btn-small' onclick=self.history.back()></td></tr>
        </div>
    </form>
    <div style="margin-bottom:50px;"></div>
</div>
</div>