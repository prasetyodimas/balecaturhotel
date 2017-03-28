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

    $aksi="backend/proses_testimoni.php?act=update_testi";
    $edit=mysqli_query($konek,"select m.id_member, t.id_testimonial, m.nama_lengkap, m.email, t.keterangan_testi, t.blokir_testi
                               from testimonial t join member m on t.id_member=m.id_member where id_testimonial='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
echo "
    <form method=post enctype='multipart/form-data' id='edit-testimoni' action='$aksi'>
      <input type='hidden' name='id_testimonial' value='$_GET[id]'>
      <input type='hidden' name='id_member' value='$r[id_member]'>
        <table>
          <tr>
            <td class='td-berita'>Nama</td>
          	<td class='td-berita'>:</td>
          	<td class='td-berita'><input type='text' name='nama' class='form-control' style='width:50%;' required value='$r[nama_lengkap]'></td>
      	  </tr>
          <tr>
            <td class='td-berita'>Email</td>
            <td class='td-berita'>:</td>
            <td class='td-berita'><input type='text' name='email' class='form-control' style='width:50%;' required value='$r[email]'></td>
          </tr>
          <tr>
            <td class='td-berita'>Keterangan</td>
            <td class='td-berita'>:</td>
            <td class='td-berita'><textarea name='keterangan_testi' cols='100' rows='10' class='form-control' required>$r[keterangan_testi]</textarea></td>
          </tr>
          <tr>
            <td class='td-berita'>Blokir</td>
            <td class='td-berita'>:</td>
            <td class='td-berita'>
              <select name='blokir_testi' class='form-control' style='width:50%;'>
                  <option value=''>Choose Action</option>
                  <option value='Y'>Ya</option>
                  <option value='N'>Tidak</option>
              </select>
            </td>
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