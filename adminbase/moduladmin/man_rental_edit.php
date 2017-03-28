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
            var validator = $("#edit-rental").submit(function() {
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
	.navigation-role{
	    margin-left: 160px;
    	margin-top: 20px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">   
			<h1 class="page-header">Manajemen Edit Rental</h1>
		</div>
<?php
	
$aksi="backend/proses_man_rental.php";

$get_manrental =mysqli_query($konek,"select * from rental where id_rental='$_GET[id]'");
$result=mysqli_fetch_array($get_manrental);
echo "
		<img src='$site"."uploads/rental/$result[foto_kendaraan]' width='160' height='auto'>
		<form action='$aksi?moduladmin=man_rental_edit&act=edit_rental' method='post' id='edit-rental' enctype=multipart/form-data>
			<input type='hidden' name='id' value='$result[id_rental]'>
			<input type='hidden' name='foto_lama' value='$result[foto_kendaraan]'>
		<table>
  			<tbody>
  				<tr>";?>
  				  				
  					<td>Kategori Kendaraan</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
		  					<select class='form-control' name='kate_kendaraan'>
	  						<?php if ($_GET['id']) {
						  echo "<option value='$result[kate_kendaraan]'>$result[kate_kendaraan]</option>"; ?>
		  						<option value=''>Pilih kategori</option>
		  						<option>Mobil</option>
		  						<option>Motor</option>
		  					</select>
	  					</label>
	  				</td>
	  					<?php }  ?>
		<?php echo "	
	  			</tr>
	  			<tr>
	  				<td>Nama kendaraan</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					<input type='text' name='nama_kendaraan' value='$result[nama_kendaraan]' class='form-control'>
	  					</label>
	  				</td>
	  			</tr>
	  			<tr>"?>
	  				<td>Harga kendaraan</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					<input id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);"  type='text' name='harga_kendaraan' value='<?php echo $result['harga_kendaraan']?>' class='form-control'>
	                    <span style='display: block;position: relative;top: -27px;left:482px;' id="format"></span>
	  					</label>
	  				</td>
	  			</tr>
	  	<?php echo"
	  			<tr>
	  				<td>Keterangan kendaraan</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					<textarea name='ket_kendaraan' cols='80' rows='8' class='form-control'>$result[ket_kendaraan]</textarea>
	  					</label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td>Foto kendaraan</td>
	  				<td>:</td>
	  				<td><label class='spacer-form'>
	  					<input type='file' name='foto_kendaraan' value='$result[harga_kendaraan]' class='form-control'>
	  					</label>
	  				</td>
	  			</tr>
	  		</tbody>
  		</table>
  		<div class='navigation-role'>
			<input type='submit' value='Edit' class='btn btn-small btn-success'>
			<input type='button' value='Batal' onclick='self.history.back();' class='btn btn-small'>
  		</div>
		</table>
		</form>
		";
		?>
		<div style="margin-bottom:20px;"></div>
	</div>
</div>