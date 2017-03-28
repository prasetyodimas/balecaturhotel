<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tambah').click(function() {
            $('.tambah-content').slideToggle();
                /*$('#dari_tgl').datepicker();
                $('#sampai_tgl').datepicker();*/
        });
        //jqeury data-tables
        $('#tables-diskon').dataTable( {
              // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
            // Set the default no. of rows to display
            "pageLength": 5
        });
    /*    tinymce.init({
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
        var validator = $("#tambah_diskon").submit(function() {
            tinyMCE.triggerSave();

         }).validate({
            rules:{
                id_kategori_kamar:{
                    required:true,
                },
                besar_diskon:{
                    required:true,
                    number:true,
                },
                dari_tgl:{
                    required:true,
                },
                sampai_tgl:{
                    required:true,
                },
                ket_diskon:{
                    required:true,
                }
            },
            messages: {

                id_kategori_kamar: "Kolom pilih kamar tidak boleh kosong !!",
                besar_diskon:{
                    required:"Kolom diskon tidak boleh kosong !!",
                    number:"Tidak valid harus angka !!",
                },
                dari_tgl:"batas diskon tidak boleh kosong!",
                sampai_tgl:"batas diskon tidak boleh kosong!",
                ket_diskon: "Kolom keterangan diskon tidak boleh kosong!",
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
    .date-group{
        width: 100%;
    }
    .boxgroup-date{
        display: inline-block;
       /* width: 20%;*/
        height: 20px;
        padding: 13px 12px;
        color: hsl(0, 0%, 33%);
        border-radius: 4px;
        border: 1px solid hsl(0, 0%, 80%);
    }
</style>
<div class="row">
<div class="col-lg-12">
    <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Diskon</h1>
    </div>
</div>
    <div class="col-lg-12">
        <button class="btn btn-small btn-success tambah">Tambah Diskon</button>
        <div style="margin-bottom:20px;"></div>
    	<div class="tambah-content" style="display:none;">
        <div class="panel-body" style="width:50%;">

    	 <form role="form" action="backend/proses_diskon.php?act=add_diskon" method="post" id="tambah_diskon" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <select class="form-control" name="id_kategori_kamar" autofocus required>
                        <option value="">Pilih kategori kamar</option>
                        <?php
                                $getkamar =mysqli_query($konek,"SELECT * FROM kategori_kamar");
                                while ($row = mysqli_fetch_array($getkamar)) {
                                    $select =($row['type_kamar']==$type_kamar) ? 'select"=select"' :'';
                                    echo "<option value='".$row['id_kategori_kamar']."'$select>".$row['type_kamar']."</option>";
                                }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div style="margin-bottom:10px;">
                        <input type="text" name="besar_diskon" class="form-control" placeholder="besar diskon" autofocus required>
                    </div>
                    <label>batas diskon</label>
                    <div class="date-group">
                        <input type="text" name="dari_tgl" id="datepicker-example7-start" style="cursor:pointer;" class="boxgroup-date" placeholder="Tanggal"  autofocus required> s/d
                        <input type="text" name="sampai_tgl" id="datepicker-example7-end" style="cursor:pointer; "class="boxgroup-date" placeholder="Tanggal"  autofocus required>
                    </div>
                </div>
                <div>
                <label>Keterangan diskon</label>
                    <textarea name="ket_diskon" clos="20" rows="7" class="form-control" autofocus required></textarea>
                </div>
                <div style="margin-top:20px;">
                    <input type="submit" value="Submit" class="btn btn-small btn-success">
                </div>
            </fieldset>
        </form>

	    </div>
    	</div>
        <table class="table table-hover" id="tables-diskon">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th width="120">Kategori Kamar</th>
                    <th width="100">Besar Diskon</th>
                    <th>Batas Diskon</th>
                    <th>Keterangan</th>
                    <th width="130">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $no=1;
                    $query = mysqli_query($konek,"SELECT * FROM diskon JOIN  kategori_kamar ON diskon.id_kategori_kamar=kategori_kamar.id_kategori_kamar");
                    while ($result = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td width="50"><?php echo $no;?></td>
                        <td><?php echo $result['type_kamar'];?></td>
                        <td><?php echo $result['besar_diskon'];?>&#37;</td>
                        <td width=""><?php  $tanggal1=tgl_indo($result['dari_tgl']);
                                   $tanggal2=tgl_indo($result['sampai_tgl']);
                              echo $tanggal1.' s/d '. $tanggal2; ?></td>
                        <td width="300"><?php echo $result['keterangan_diskon'];?></td>
                        <td width="100">
                            <a href="<?php echo "homeadmin.php?modul=man_diskon_edit&id=$result[id_diskon]"?>">
                                <i class="fa fa-edit"></i> Edit
                            </a> |
                            <a href="<?php echo "backend/proses_diskon.php?act=delete_diskon&id=$result[id_diskon]";?>" onclick="return confirm('Anda yakin menghapus data ini ?');">
                                <i class="fa fa-close"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </div>
</div>
