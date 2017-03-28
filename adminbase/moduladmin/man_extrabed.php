<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tambah').click(function() {
            $('.tambah-content').slideToggle();
        });
        //jquery data-tables
        $('#tables-extrabed').dataTable( {
            "bFilter": false,//hide filter control
            // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
            // Set the default no. of rows to display
            "pageLength": 5
        });
     
        var validator = $("#tambah_katemenu").submit(function() {
            tinyMCE.triggerSave();
         }).validate({
            ignore: "",
            messages: {

                harga_extrabed: "Kolom harga extrabed tidak boleh kosong!"
            }
        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
    <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Extrabed</h1>
    </div>
<!--     	<button class="btn btn-small btn-success tambah">Tambah extrabed</button> -->
        <div style="margin-bottom:20px;"></div>
    	<!-- <div class="tambah-content" style="display:none;"> -->
             <form role="form" action="backend/proses_extrabed.php?act=add_extrabed" method="post" id="tambah_katemenu" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group" style="width:30%;">
                        <input id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" class="form-control" 
                         placeholder="Harga Extrabed" name="harga_extrabed" type="text" autofocus required autocomplete="off">
                        <span style='display: block;position: relative;top: -27px;left: 308px;' id="format"></span>
                    </div>
                    <div style="margin: 34px 0px 20px;">
                        <input type="submit" value="Submit" class="btn btn-small btn-success">
                    </div>
                </fieldset>
            </form>
    	<!-- </div> -->
        <div class="table-responsive">
            <table class="table table-hover" id="tables-extrabed">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="400">Harga Extrabed</th>
                        <th width="50">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $no=1;
                        $query = mysqli_query($konek,"SELECT * FROM extrabed");
                        while ($result = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td width="50"><?php echo $no;?></td>
                            <td width="200">Rp.<?php echo formatuang($result['harga_extrabed']);?></td>
                            <td width="100">
                                <a href="<?php echo "homeadmin.php?modul=man_extrabed_edit&id=$result[id_extrabed]"?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |
                                <a href="<?php echo "backend/proses_extrabed.php?act=delete_extrabed&id=$result[id_extrabed]";?>" onclick="return confirm('Delete?');">
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
