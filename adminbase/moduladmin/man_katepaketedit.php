<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
    $(document).ready(function(){

        var validator = $("#edit_katemenu").submit(function() {
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
        margin: 23px 0px;
    }
</style>
<div class="row">
<div class="col-lg-12">   
    <div class="font-sizerheading">
        <h1 class="page-header">Manajemen edit kategori paket</h1>                
    </div>             
<?php
    $aksi="backend/proses_kategori_paket.php";
    $getdatamenu = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM paket WHERE id_paket='$_GET[id]'"));
?>
    <form action='<?php echo $aksi;?>?modul=man_katepaketedit&act=edit_paket' method='post' enctype='multipart/form-data' id='edit_katemenu'>
        <input type='hidden' name='id_paket' value='<?php echo $_GET['id'] ?>'></input>
        <div style='width:30%;'>
            <div>
                <label class='spacer-form'>Nama Paket</label>
                <select name="nama_paket" id="nama_paket" class="form-control">
                    <option value="<?php echo $getdatamenu['nama_paket']?>"><?php echo $getdatamenu['nama_paket']?></option>
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
            <div>
                <label class='spacer-form'>Harga Menu</label>
                <input type='text'id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);" name='harga_paket' class='form-control' value='<?php echo $getdatamenu['harga_paket']?>'>
                <span style='display: block;position: relative;top: -27px;left:314px;' id="format"></span>
            </div>
        </div>
        <div class='navigation-formsubmit'>
            <input type='submit' value='Ubah' class='btn btn-small btn-success'></input>
            <input type='submit' value='Batal' class='btn btn-small btn-success' onclick='javascript:history.back();'>
        </div>
    </form>
    </div>
</div> 
