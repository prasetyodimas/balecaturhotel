<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tambah').click(function() {
            $('.tambah-content').slideToggle();
        });
        $('#data_kategorikamar').dataTable( {
          // Sets the row-num-selection "Show %n entries" for the user
          "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
          // Set the default no. of rows to display
          "pageLength": 5
        });
       /* tinymce.init({
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
        var validator = $("#add-kategori").submit(function() {
            tinyMCE.triggerSave();

         }).validate({

           rules:{
                id_kategori_kamar :{
                    required:true,
                },
                type_kamar:{
                    required:true,
                },
                tarif:{
                    required:true,
                    number:true,
                },
                jumlah_kamar:{
                    required:true,
                    number:true,
                },
                fasilitas:{
                    required:true,
                },
                deskripsi:{
                    required:true,
                },
                foto:{
                    required:true,
                }
           },
            messages: {
                id_kategori_kamar:"Kolom kode kamar tidak boleh kosong !",
                type_kamar: "Kolom tipe kamar tidak boleh kosong!",
                tarif:{
                    required:"Kolom tarif kamar tidak boleh kosong!",
                    number:"Tidak valid harus angka !!",
                },
                jumlah_kamar: {
                    required:"Kolom jumlah kamar tidak boleh kosong!",
                    number:"Tidak valid harus angka !!",
                },
                deskripsi:"Kolom deskripsi tidak boleh kosong !!",
                fasilitas: "Kolom fasilitas kamar tidak boleh kosong!",
                foto: "Kolom foto tidak boleh kosong!",
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
        <h1 class="page-header">Manajemen Kategori Kamar</h1>
    </div>
</div>
    <div class="col-lg-12">
        <button class="btn btn-small btn-success tambah">Tambah Kategori</button>
        <div style="margin-bottom:20px;"></div>
        <div class="tambah-content" style="display:none;">
        <!--Panel Body Width -->
        <div class="panel-body" style="width:50%;">
             <form role="form" action="backend/proses_kategori_kamar.php?act=add_kategori" method="post" id="add-kategori" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <select name="id_kategori_kamar" class="form-control" autofocus required>
                            <option value="">Kode Kamar</option>
                            <option>STNDR</option>
                            <option>DELX</option>
                            <option>DELXFAM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Tipe Kamar" autocomplete="off" name="type_kamar" type="text" autofocus required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Jumlah Kamar" autocomplete="off" name="jumlah_kamar" type="text" autofocus required>
                    </div>
                    <div class="form-group">
                        <input id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" autocomplete="off"
                        class="form-control" placeholder="Tarif Kamar" name="tarif" type="text" autofocus required>
                        <span style='display: block;position: relative;top: -27px;left: 484px;' id="format"></span>
                    </div>
                    <div>
                        <input type="text" class="form-control" autocomplete="off" placeholder="Deskripsi" name="deskripsi" autofocus required>
                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <label>Fasilitas Kamar</label>
                        <textarea name="fasilitas" placeholder="Fasilitas Kamar" cols="20" rows="7"  class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        Foto : <input class="form-control" name="foto" type="file" required>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <input type="submit" value="Submit" class="btn btn-small btn-success">
                </fieldset>
            </form>
    		</div>
    	</div>
        <div class="table-responsive">
            <table class="table table-hover" id="data_kategorikamar">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Tarif kamar</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $no=1;
                            $query = mysqli_query($konek,"SELECT  * FROM kategori_kamar ORDER BY id_kategori_kamar DESC");
                            while ($result = mysqli_fetch_array($query)) {
                            $path_pic = $site.'uploads/kamar/'.$result['foto_kamar'];
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $result['type_kamar'];?></td>
                            <td>Rp.<?php echo formatuang($result['tarif']);?></td>
                            <td><img src="<?php echo $path_pic;?>" width="150" height="auto"></td>
                            <td>
                                <a href="<?php echo "homeadmin.php?modul=man_kategorikamar_edit&id=$result[id_kategori_kamar]"?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |
                                <a href="<?php echo "backend/proses_kategori_kamar.php?act=delete_kategori&id=$result[id_kategori_kamar]";?>" onclick="return confirm('Hapus data ini ?');">
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
