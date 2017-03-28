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
        $('[data-toggle="tooltip"]').tooltip({
            placement : 'top'
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
              <li><a href="<?php echo 'homeadmin.php?modul=cek_booking_kamar'?>">Booking - Room</a></li>
            </ul>
            <div class="col pull-right">
                <h5>Tanggal <?php echo datenow("y-m-d");?>
                    <span id="clock"><?php print date('H:i:s'); ?></span>
                </h5>
            </div>
                <div class="col-lg-12">
                    <?php
                        //get type kamar
                        $cekkate_kamar = mysqli_query($konek, 
                            "SELECT tb.id_tempbooking, 
                                    tb.jumlah,
                                    tb.id_member,
                                    tb.id_kategori_kamar,
                                    tb.temp_checkin,
                                    tb.temp_checkout, 
                                    km.type_kamar, 
                                    km.jumlah_kamar_akhir, 
                                    k.status_kamar 
                                FROM temp_booking tb 
                                JOIN kategori_kamar km ON tb.id_kategori_kamar=km.id_kategori_kamar
                                JOIN kamar k ON km.id_kategori_kamar=k.id_kategori_kamar
                                GROUP BY km.id_kategori_kamar");
                        while ($result = mysqli_fetch_array($cekkate_kamar)) {
                        $get_data_member = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM member WHERE id_member='$result[id_member]'"));
                        $get_status_kamar = $result['status_kamar']+2;
                    ?>
                    <div class="font-sizecheck-kamar">
                            <h5>Tipe Kamar :<strong><?php echo $result['type_kamar']." ( ".$result['jumlah_kamar_akhir']." )";?></strong></h5>
                    </div><!--font-sizecheck-kamar-->
                    <?php
                        //mendefinisikan status warna kamar
                        if ($get_status_kamar=='0') {
                            $status_reserved ='coloring-thumbnail-grey';
                        }elseif ($get_status_kamar=='1'){
                            $status_reserved ='coloring-thumbnail-orange';
                        }elseif($get_status_kamar=='2'){
                            $status_reserved ='coloring-thumbnail-green';
                        }elseif ($get_status_kamar=='3'){
                            $status_reserved ='coloring-thumbnail-red';
                        }elseif ($get_status_kamar=='4'){
                            $status_reserved = 'coloring-thumbnail-yellow';
                        }
                    ?>
                    <!-- show color all room and type !!-->
                    <div class="block-barstatus">
                        <div class='col-xs-6 col-md-2' style='text-align:center;'>
                            <a href='#' class='<?php echo $status_reserved;?> thumbnail' data-toggle="tooltip" title="Dipesan oleh <?php echo $get_data_member['nama_lengkap'].
                            ' Tgl Checkin-checkout '.tgl_indo($result['temp_checkin']).' S/d '. tgl_indo($result['temp_checkout']);?>">
                            <?php echo $result['id_member'];?></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p></p>
                        <p></p>
                    </div>
                    <?php } ?>
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