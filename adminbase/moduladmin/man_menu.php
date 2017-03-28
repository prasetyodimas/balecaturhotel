<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#id_paket").change(function(){
            var getValue= $(this).val();
            if(getValue == 0) {
                $("#harga_paket").html("<option value=''>Pilih paket dulu</option>");
            }else{
                $.getJSON('json/getdata_paket.php',{ 'id_paket' : getValue},
                    function(data){
                        var showData;
                        $.each(data,function(index,value){
                            showData += "<option>"+value.harga_paket+"</option>";
                        })
                        $("#harga_paket").html(showData)
                    });
            }
         });
        //jquery data-tables
        $('#tables-menu').dataTable( {
              // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
            // Set the default no. of rows to display
            "pageLength": 5
        });
        // slide toogle content
        $('.tambah').click(function() {
            $('.tambah-content').slideToggle();
        });
/*
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
*/
        var validator = $("#tambah_menu").submit(function() {
            tinyMCE.triggerSave();

        }).validate({
            ignore: "",
            messages: {
                id_paket: "Kolom pilih paket tidak boleh kosong!",
                harga_paket: "Kolom harga paket tidak boleh kosong!",
                keterangan_menunya: "Kolom menu tidak boleh kosong!",
                foto: "Kolom foto tidak boleh kosong!"
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
        <h1 class="page-header">Manajemen Data Menu </h1>
    </div>
    	<button class="btn btn-small btn-success tambah">Tambah Menu</button>
        <div style="margin-bottom:20px;"></div>
    	<div class="tambah-content" style="display:none;">
            <div class="panel-body" style="width:50%;">

    		 <form role="form" action="backend/proses_kategori_menu.php?act=tambah_menu" method="post" id="tambah_menu" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <div style="margin-bottom:10px;">
                        <select name="id_paket" id="id_paket" class="form-control" autofocus required >
                            <option value=""> Pilih paket </option>
                            <?php
                                $getpaket = "SELECT id_paket, nama_paket FROM paket";
                                $saved =mysqli_query($konek,$getpaket);
                                $output = '';
                                while ($hasil =mysqli_fetch_array($saved)) {
                                    $output .="<option value='".$hasil['id_paket']."'>".$hasil['nama_paket']."</option>";
                                }
                                echo $output;
                            ?>
                        </select>
                        </div>
                        <select name='harga_paket' id="harga_paket" class="form-control">
                            <option value=""> Harga paket </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Menu</label>
                        <textarea name="keterangan_menunya" placeholder="menu" cols="20" rows="7" class="form-control" autofocus required></textarea>
                    </div>
                    <!-- <div class="form-group">
                        Foto : <input class="form-control" name="foto" type="file" autofocus required>
                    </div> -->
                    <div>
                        <input type="submit" value="Submit" class="btn btn-small btn-success">
                    </div>
                </fieldset>
            </form>
    		</div>
    	</div>
        <div class="table-responsive">
            
            <table class="table table-hover" id="tables-menu">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Menu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no=1;
                    $query = mysqli_query($konek,"SELECT dp.id_detail_paket, pk.id_paket, pk.nama_paket, pk.harga_paket, dp.keterangan_menunya
                                                  FROM detail_paket dp JOIN paket pk ON dp.id_paket=pk.id_paket");
                    while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td width="50"><?php echo $no;?></td>
                        <td><?php echo $data['nama_paket'];?></td>
                        <td>Rp.<?php echo formatuang($data['harga_paket']);?></td>
                        <td width="550"><?php echo removetags($data['keterangan_menunya']);?></td>
                        <td>
                            <a href="<?php echo "homeadmin.php?modul=man_menu_edit&id=$data[id_paket]"?>">
                                <i class="fa fa-edit"></i> Edit
                            </a> |
                            <a href="<?php echo "backend/proses_kategori_menu.php?act=hapus_manmenu&id=$data[id_detail_paket]";?>" onclick="return confirm('Anda ingin menghapus ?');">
                                <i class="fa fa-close"></i> Delete
                            </a>
                        </td>
                    <?php $no++; } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
