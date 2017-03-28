<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
       /*   tinymce.init({
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
    
          var validator = $("#edit-diskon").submit(function() {
              tinyMCE.triggerSave();
           }).validate({ 
              ignore: "",
              messages: {
                  judul_berita: "Kolom judul berita tidak boleh kosong!",
                  isi_berita: "Kolom isi berita tidak boleh kosong!"
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
</style>
<div class="row">
    <div class="col-lg-12">    
    	<div class="font-sizerheading">            
        	<h1 class="page-header">Manajemen Edit Diskon</h1>                
    	</div>
    </div>                
  	<div class="col-lg-12">
<?php
  $aksi="backend/proses_diskon.php?";
  $getman_editdiskon=mysqli_query($konek,"select * from diskon d join kategori_kamar kk on d.id_kategori_kamar=kk.id_kategori_kamar where id_diskon='$_GET[id]'");
	$result=mysqli_fetch_array($getman_editdiskon);?>
  <form action='<?php echo $aksi?>moduladmin=man_diskon_edit&act=update_mandiskon' method='post' id='edit-diskon' ectype='multipart/form-data'>
	   <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
  		<table>
  			<tbody>
  				<tr>	
    				<td>Tipe kamar</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					<select class='form-control' name='id_kategori_kamar'>
               <option value='<?php echo $result['id_kategori_kamar'];?>'><?php echo $result['type_kamar'];?></option>
              <?php 
                $g = mysqli_query($konek,"SELECT * FROM kategori_kamar ");
                     while ($x = mysqli_fetch_array($g)) { ?>
                    <option value='<?php echo $x['id_kategori_kamar'];?>'><?php echo $x['type_kamar'];?></option>
              <?php } ?>
	  					</select>
              </label>
            </td>
          </tr>
	  			<tr>
	  				<td>Besar diskon</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					    <input type='text' name='besar_diskon' value='<?php echo $result['besar_diskon']?>' class='form-control'>
	  					  </label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td>Dari tanggal</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					    <input type='text' name='dari_tgl' id="datepicker-example7-start" value='<?php echo $result['dari_tgl'];?>' class='form-control'>
	  					  </label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td>Sampai tanggal</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					    <input type='text' name='sampai_tgl' id='datepicker-example7-end' value='<?php echo $result['sampai_tgl'];?>' class='form-control'>
	  				    </label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td>Keterangan diskon</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					    <textarea name='keterangan_diskon' cols='80' rows='10' class='form-control'><?php echo $result['keterangan_diskon']?></textarea>
	  					  </label>
	  				</td>
	  			</tr>
	  		</tbody>
  		</table>
  		<div style='margin: 20px 133px;'>
			  <input type='submit' value='Edit' class='btn btn-small btn-success'>
			  <input type='button' value='Batal' onclick='self.history.back();' class='btn btn-small'>
  		</div>
  		</form>
  	</div>
</div>

