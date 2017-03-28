<?php include 'fungsi/function_transaksi.php';?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#validate-this').validate({
            rules:{
                checkin:{
                    required:true,
                },
                checkout:{
                    required:true,
                },
                roomtype:{
                    required:true,
                },
                berapa_orang:{
                    required:true,
                },
                berapa_kamar:{
                    required:true,
                },
            },messages:{
                checkin :{
                    required:"Kolom checkin tidak boleh kosong !!",
                },
                checkout:{
                    required:"Kolom checkout tidak boleh kosong !!",
                },
                roomtype:{
                    required:"Kolom tipe kamar tidak boleh kosong !!",
                },
                berapa_orang:{
                    required:"Tidak boleh kosong !",
                },
                berapa_kamar:{
                    required:"Tidak boleh kosong !",
                }
            }
        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <div style="margin-top:85px;"></div>
        <div class="flexslider">
            <ul class="slides">
                  <li><img src="<?php echo $site;?>image/imageslider/4.jpg"/></li>
                  <li><img src="<?php echo $site;?>image/imageslider/3.jpg"/></li>
                  <li><img src="<?php echo $site;?>image/imageslider/hotel2.jpg"/></li>
            </ul>
        </div><!-- flexslider -->
    </div>
</div>
<?php 
    if (isset($_POST['submit'])) {
        $checkin  = $_POST['check-in'];
        $checkout = $_POST['checkout'];
        //convert to $_SESSION var date
        $_SESSION['session_checkin']  = $checkin;
        $_SESSION['session_checkout'] = $checkout;
        $findroom =mysqli_query($konek,"SELECT * FROM kamar");
        while ($resdata = mysqli_fetch_array($findroom)) {
        }
    }
?>
<div class="row">
    <div class="col-md-4">
        <div class="box-aviability">
        <form action="index.php?modul=available_room" method="post" enctype="multipart/form-data" id="validate-this">
            <div class="form-group">
                <div>
                    <label>Checkin</label>
                    <input type="text" style="cursor:pointer;" name="checkin" id="datepicker-example7-start" class="form-control" required="" placeholder="Dari tanggal"> 
                </div>
                <div>
                    <label>Checkout</label>
                    <input type="text" style="cursor:pointer;" name="checkout" id="datepicker-example7-end" class="form-control" required="" placeholder="Sampai tanggal">
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div>
                            <label>Berapa Orang</label>
                            <input type="number" name="berapa_orang" class="form-control" min="1" required="">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Berapa Kamar</label>
                            <input type="number" name="berapa_kamar" class="form-control" min="1" required="">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" style="font-size:14px;">Check Aviability</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Selamat Datang di Aplikasi Hotel Balecatur Inn
            </div>
              <!--   <div class="showcase sweet">
                    <h4>Sweet Alert</h4>
                    <button>Show error message</button>
                    <h5>Code:</h5>
                    <pre><span class="attr">sweetAlert</span>(<span class="str">"Oops..."</span>, <span class="str">"Something went wrong!"</span>, <span class="str">"error"</span>);</pre>
                </div> -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="fnt-style">FEATURES PACKAGE</h1>
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Features package</li>
            </ol>
            <div class="row">
            <?php
                $getdatakamar = mysqli_query($konek,"SELECT * FROM kategori_kamar ORDER BY type_kamar DESC");
                while ($data=mysqli_fetch_array($getdatakamar)) {
                $get_price = mysqli_fetch_array(mysqli_query($konek,"SELECT tarif, fasilitas, deskripsi, id_kategori_kamar FROM kategori_kamar WHERE id_kategori_kamar='$data[id_kategori_kamar]'"));
                //deklarasi variable tarif
                $tarifnya = $get_price['tarif'];
                $x        = $get_price['id_kategori_kamar'];
                //buat diskon
                $getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$data[id_kategori_kamar]'"));
                //mendefinisikan get diskonya berdasarkan kamar yang ada diskon
                $diskon_kamar = $getdiskon['besar_diskon'];
                $y            = $getdiskon['id_kategori_kamar'];
    
                $urlpic = $site."uploads/kamar/$data[foto_kamar]";
                //catatan mengitung percent ((harga/100)*berapa persent));
                $tentukan_percent = (($data['tarif']/100)*10);
                $total_price = ($data['tarif']+$tentukan_percent);
            ?>
            <div class="col-md-4 col-xs-12 col-lg-4">
                <img class="img-responsive" src="<?php echo $urlpic;?>">
                <div class="panel panel-default">
                    <div class="panel-heading"> <div class="judul-roomfeatures"><?php echo $data['type_kamar'];?></div></div>
                <div class="panel-body">
                    <div class="box-description">
                    <dt><dl>Description Room</dl></dt>
                        <p>Price<span style="font-weight:bold;"> : Rp.<?php echo formatuang($tarifnya);?></span></p>
                    <?php if ($x == $y) { ?>
                        <p>Pajak <span style="font-weight:bold;">: <?php echo $diskon_kamar. "%";?></span></p>
                    <?php }elseif($y ==""){ ?>
                        <p>Discount <span style="font-weight:bold;">: -</span></p>
                    <?php } ?>
                        <p>Harga Sudah Termasuk Pajak 10%</p>
                        <p><i class="fa fa-cutlery fa-fw"></i> Termasuk Breakfast Morning</p>
                    </div>
                    <a class="btn btn-block btn-lg btn-custom-balecatur-hotel" href="<?php echo $site;?>index.php?modul=moreinformation&id=<?php echo $data['id_kategori_kamar'];?>">More Information</a>
                </div>
                </div>
            </div>
            <?php } ?>
            </div>
        <div style="margin-bottom:50px"></div>
    </div>
</div>