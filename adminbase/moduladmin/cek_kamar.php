<?php include "../fungsi/function_transaksi.php";?>
<script type="text/javascript">
	$(document).ready(function() {
        var validator= $('#cheking_kamar').submit(function(){
            }).validate({
                rules:{
                    cek_kamar:{
                        required:true,
                    }

                },messages:{
                    cek_kamar:"kolom tanggal tidak boleh kosong !!",
                }
        });
    });
    //set timezone real time waktu
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<style type="text/css">
    .title-postion-checkroom{
        position: absolute;
        top: 0px;
        left: 70px;
    }
</style>
<body onload="setInterval('displayServerTime()', 1000);">
<div class="row">
    <div class="col-lg-12">
        <div class="font-sizerheading">
            <h1 class="page-header">Avaibility Room / Check Ketersediaan Kamar</h1>
            <form action="homeadmin.php?modul=cek_kamar&tgl=" method="post" enctype="multipart/form-data">
                <div style="float:right;display:inline-flex;">
                    <div class="form-group flex">
                        <input type="text" name="cek_kamar" id="datepicker-example1" class="form-control" placeholder="Pilih Tanggal" autofucos required>
                        <span style="margin-left: 8px;"><input type="submit" value="Submit" class="btn btn-small btn-success"></span>
                    </div>
                </div>
            </form>
            <!-- Menu tabs top -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo 'homeadmin.php?modul=cek_kamar'?>">Aviability - Room</a></li>
              <!-- <li><a href="<?php echo 'homeadmin.php?modul=cek_booking_kamar'?>">Booking - Room</a></li> -->
            </ul>
            <div class="col pull-right">
                <h5>Tanggal <?php echo datenow("y-m-d");?>
                    <span id="clock"><?php print date('H:i:s'); ?></span>
                </h5>
            </div>
                <div class="col-lg-12">
                    <?php
                        //get type kamar
                        $cekkate_kamar      = mysqli_query($konek, "SELECT * FROM kategori_kamar");
                        while ($tipekmarnya = mysqli_fetch_array($cekkate_kamar)) {
                    ?>
                    <div class="font-sizecheck-kamar">
                        <h5>Tipe Kamar :<strong><?php echo $tipekmarnya['type_kamar']." ( ".$tipekmarnya['jumlah_kamar_akhir']." )";?></strong></h5>
                    </div><!--font-sizecheck-kamar-->
                    <?php
                        $getkamar1  = mysqli_query($konek,"SELECT * FROM kamar WHERE id_kategori_kamar='$tipekmarnya[id_kategori_kamar]'");
                        while ($roomStatus=mysqli_fetch_array($getkamar1)) {
                        //cek status kamarnya
                        $get_status = mysqli_fetch_array(mysqli_query($konek,"SELECT status_kamar
                                                                         			FROM kamar WHERE id_kategori_kamar='$roomStatus[id_kategori_kamar]'"));
                        $get_status_booking = mysqli_fetch_array(mysqli_query($konek,
																																							"SELECT * FROM booking b
																																							 JOIN detail_booking_kamar dbk ON b.kd_booking=dbk.kd_booking
                                                                         			 WHERE dbk.id_kategori_kamar='$roomStatus[id_kategori_kamar]'"));
                        //mendefinisikan status warna kamar
                        if ($roomStatus['status_kamar']=='0') {
                            $status_reserved ='coloring-thumbnail-grey';
                        }elseif ($roomStatus['status_kamar']=='1'){
                            $status_reserved ='coloring-thumbnail-orange';
                        }elseif($roomStatus['status_kamar']=='2'){
                            $status_reserved ='coloring-thumbnail-green';
                        }elseif ($roomStatus['status_kamar']=='3'){
                            $status_reserved ='coloring-thumbnail-red';
                        }elseif ($roomStatus['status_kamar']=='4'){
                            $status_reserved = 'coloring-thumbnail-yellow';
                        }
                    ?>
                    <!-- show color all room and type !!-->
                    <div class="block-barstatus">
                        <div class='col-xs-6 col-md-2' style='text-align:center;'>
                            <a href='#' class='<?php echo $status_reserved;?> thumbnail'><?php echo $roomStatus['id_kamar'];?></a>
                        </div>
                    </div>
                    <?php } }  ?>
                </div>

            </div>
            <div class="clearfix" style="margin-top:5%;"></div>
            <div class="wrapper-statuskamar">
                <div class="container-statbar">
                    <div class="font-sizerheading">
                        <h4>Status Kamar</h4>
                    </div>
                    <div class="form-inline">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-2">
                                    <div class="block-statreserve1"></div>
                                    <strong style="position:relative;top:-4px;left:3px;">Terisi</strong>
                                </div>
                                <div class="col-md-2">
                                    <div class='block-statreserve2'></div>
                                    <strong style="position:relative;top:-4px;left:3px;">Dipesan</strong>
                                </div>
                                <div class="col-md-2">
                                    <div class="block-statreserve3"></div>
                                    <strong style="position:relative;top:-4px;left:3px;">Tersedia</strong>
                                </div>
                                <div class="col-md-2">
                                    <div class="block-statreserve4"></div>
                                    <strong style="position:relative;top:-4px;left:3px;">Sedang dicek</strong>
                                </div>
                                <div class="col-md-3">
                                    <div class="block-statreserve5"></div>
                                    <strong style="position:relative;top:-4px;left:3px;">Sedang dibersihkan</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div><!-- tab content -->
        <div class="clearfix" style="margin-bottom:5%;"></div>
    </div> <!-- .col-lg-12 -->
</div>
</body>
