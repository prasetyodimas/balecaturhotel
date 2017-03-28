<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tambah').click(function() {
            $('.tambah-content').slideToggle();
        });
         //jqeury data-tables
        $('#tables-katepaket').dataTable( {
              // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
            // Set the default no. of rows to display
            "pageLength": 5
        });
        // tinymce.init({
        //     selector: "textarea",
        //     plugins: [
        //         "advlist autolink lists link charmap print preview anchor",
        //         "searchreplace visualblocks code fullscreen",
        //         "insertdatetime table contextmenu paste"
        //     ],
        //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        //     onchange_callback: function(editor) {
        //       tinyMCE.triggerSave();
        //       $("#" + editor.id).valid();
        //     }
        // });

        var validator = $("#tambah_katemenu").submit(function() {
            tinyMCE.triggerSave();
         }).validate({

            rules:{
                nama_paket:{
                    required:true
                },
                harga_paket:{
                    required:true,
                    number:true
                },
            },
            messages: {
                nama_paket:{
                    required :"Kolom nama paket tidak boleh kosong!"
                }, 
                harga_paket:{
                    required :"Kolom harga paket tidak boleh kosong!",
                    number   :"kolom harga tidak valid harus angka !"
                }, 
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
        <h1 class="page-header">Manajemen Kategori Paket </h1>
    </div>
    	<button class="btn btn-small btn-success tambah">Tambah Kategori paket</button>
        <div style="margin-bottom:20px;"></div>
    	<div class="tambah-content" style="display:none;">
            <div class="panel-body" style="width:30%;">
    		 <form role="form" action="backend/proses_kategori_paket.php?act=add_paket" method="post" id="tambah_katemenu" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <div style="margin-bottom:10px;">
                            <select name="nama_paket" class="form-control" autofocus required>
                                <option value=""> Nama paket </option>
                                <option>A1</option>
                                <option>A2</option>
                                <option>A3</option>
                                <option>A4</option>
                                <option>A5</option>
                                <option>B1</option>
                                <option>B2</option>
                                <option>B3</option>
                                <option>B4</option>
                                <option>B5</option>
                            </select>
                        </div>
                        <input class="form-control" id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" placeholder="Harga paket" name="harga_paket" type="text" autofocus required>
                        <span style='display: block;position: relative;top: -27px;left:278px;' id="format"></span>    
                    </div>
                    <div>
                        <input type="submit" value="Submit" class="btn btn-small btn-success">
                    </div>
                </fieldset>
            </form>
    		</div>
    	</div>
        <div class="table-responsive">
            <table class="table table-hover" id="tables-katepaket">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Paket</th>
                        <th>Harga Paket</th>
                        <th width="130">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1;
                        $query = mysqli_query($konek,"SELECT * FROM paket ORDER BY nama_paket ASC");
                        while ($result = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $result['nama_paket'];?></td>
                            <td>Rp.<?php echo formatuang($result['harga_paket']);?></td>
                            <td>
                                <a href="<?php echo "homeadmin.php?modul=man_katepaketedit&id=$result[id_paket]"?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |
                                <a href="<?php echo "backend/proses_kategori_paket.php?act=delete_paket&id=$result[id_paket]";?>" onclick="return confirm('Delete?');">
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
