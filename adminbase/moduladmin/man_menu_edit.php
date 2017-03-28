<script type="text/javascript">
$(document).ready(function(){

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

        var validator = $("#edit_menu").submit(function() {
            tinyMCE.triggerSave();
         }).validate({ 
            ignore: "",
            messages: {
                nama_paket: "Kolom nama paket tidak boleh kosong!",
                nama_menu: "Kolom nama menu kamar tidak boleh kosong!",
                harga_paket: "Kolom harga paket tidak boleh kosong!"
            }
        });
});

</script>
<style type="text/css">
	.navigation-formsubmit{
	    margin: 31px 84px;
	}
	.space-datamenu{
		padding: 0px 20px;
	}

</style>
<div class="col-lg-12">   
    <div class="font-sizerheading">
        <h1 class="page-header">Manajemen edit data menu</h1>                
    </div>             
</div>             

<?php

	/* function format uang Rp */
    function formatuang($nilai_matauang){
        $var = number_format($nilai_matauang,0,",",".").',-';
        return $var;
    }    

	$aksi="backend/proses_kategori_menu.php";

	$getdatamenu = mysqli_query($konek,"SELECT * FROM detail_paket m JOIN paket pk on m.id_paket=pk.id_paket where pk.id_paket='$_GET[id]'");
	$hasil =mysqli_fetch_array($getdatamenu);

?>	

	<form action=<?php echo "$aksi?modul=man_datamenuedit&act=update_datamenu"?> method='post' enctype='multipart/form-data' id='edit_menu'>
	<input type='hidden' name='id_paket' value=<?php echo $hasil['id_paket']?>></input>
	<input type='hidden' name='id_detail_paket' value=<?php echo $hasil['id_detail_paket']?>></input>
		<table>
			<tr>
				<td>Nama Paket</td>
				<td>:</td>
				<td class="space-datamenu">
					<label class="spacer-form"></label>
					<select name="nama_paket" class="form-control" style="width:30%;">
						<option value=""><?php echo $hasil['nama_paket']?></option>
					</select>
				</td>
			</tr>		
			<tr>
				<td>Harga menu</td>
				<td>:</td>
				<td class="space-datamenu"><label class="spacer-form"></label>
					<input type='text' name='harga_paket' style="width:30%;" class='form-control' readonly value='Rp. <?php echo formatuang($hasil['harga_paket']);?>'></input>
				</td>
			</tr>
			<tr>
				<td>Nama menu</td>
				<td>:</td>
				<td class="space-datamenu"><label class="spacer-form"></label>
					<textarea class="form-control" name='keterangan_menunya'><?php echo $hasil['keterangan_menunya']?></textarea > 
				</td>
			</tr>
		</table>
		<div style="margin: 31px 102px;">
			<input type='submit' value='Ubah' class='btn btn-small btn-success'></input>
			<input type='submit' value='Batal' class='btn btn-small btn-success' onclick="javascript:history.back();"></input>
		</div>
	</form>



