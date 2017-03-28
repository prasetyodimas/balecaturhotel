<script type="text/javascript">
    $(document).ready(function() {
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
      
      var validator = $("#edit-akomodasi").submit(function() {
          tinyMCE.triggerSave();
       }).validate({ 
          ignore: "",
          messages: {
              judul_berita: "Kolom judul akomodasi tidak boleh kosong!",
              isi_berita: "Kolom isi akomodasi tidak boleh kosong!"
          }
      });
      validator.focusInvalid = function() {
            // put focus on tinymce on submit validation
            if (this.settings.focusInvalid) {
              
              try {

                var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                
                  if (toFocus.is("textarea")) {
                    tinyMCE.get(toFocus.attr("id")).focus();
                  }else{
                    toFocus.filter(":visible").focus();
                  }

                }catch (e) {
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
  .td-berita{
      padding: 9px 7px;
  }
</style>

<div class="row">
    <div class="col-lg-12"> 
        <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Edit Akomodasi</h1>                
        </div>               
<?php 

    $aksi="backend/proses_akomodasi.php";
    
    $edit=mysqli_query($konek,"select * from akomodasi where id_akomodasi='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
echo "
    <form method=post enctype='multipart/form-data' id='edit-akomodasi' action='$aksi?modul=man_akomodasi_edit&act=update_akomodasi'>
      <input type=hidden name=id value='$r[id_akomodasi]'>
        <table>
          <tr>
            <td class='td-berita'>Judul Akomodasi</td>
          	<td class='td-berita'>:</td>
          	<td class='td-berita'><input type='text' name='judul_akomodasi' class='form-control' style='width:50%;' required value='$r[judul_akomodasi]'></td>
      	  </tr>
          <tr>
            <td class='td-berita'>Keterangan</td>
            <td class='td-berita'>:</td>
            <td class='td-berita'><textarea name='ket_akomodasi' cols='100' rows='10' class='form-control' required>$r[ket_akomodasi]</textarea></td>
          </tr>
        </table>
        <div style='margin:21px 148px;'>
            <input type=submit value=Update class='btn btn-small btn-success'>
            <input type=button value=Batal class='btn btn-small' onclick=self.history.back()>
        </div>
    </form>";
?>
  </div>
	</div>
</div>