<?php session_start(); error_reporting(0);
include "config/koneksi.php";?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta deskripsi-->
  <meta charset="utf-8">
  <!-- Mobile Specific Metas -->
  <meta name="description">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="descreption" content="hotel murah dijalan wates,hotel murah dan berkualitas, hotel murah kenyamanan extra menginap di hotel balecatur inn, hotel termurah di yogyakarta, hotel jogja, hotel yogyakarta, yogyakarta hotel, cari hotel ga perlu ribet sekarang, penginapan jogja, penginapan yogyakarta,hotel murah daerah yogyakarta">
  <meta name="keyword" content="hotel murah di jalan wates,hotel murah dan berkualitas, hotel murah kenyamanan extra menginap di hotel balecatur inn, hotel termurah di yogyakarta, hotel jogja, hotel yogyakarta, yogyakarta hotel, cari hotel ga perlu ribet sekarang, penginapan jogja, penginapan yogyakarta,hotel murah daerah yogyakarta">
  <title>Hotel Balecatur Inn</title>
  <!-- FAVICON-->
  <link rel="shorcut icon" href="<?php echo "$site";?>frontend/icon/favicon.ico.png">
	<!-- CSS -->
  <link href="<?php echo $site;?>frontend/css/basehotel.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>frontend/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>frontend/css/responsive.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>frontend/css/font-awesome-4.6.3/css/font-awesome.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>frontend/css/flexslider.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>library/data_tables/jquery.dataTables.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>library/zebra_datepicker/css/bootstrap-zebradatepicker.css" type="text/css" rel="stylesheet">
  <link href="<?php echo $site;?>library/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">
  <link href="adminbase/frontend/css/lightbox.css" rel="stylesheet" type="text/css">
	<!-- JQUERY VERSION 1.11.1 -->
  <script src="<?php echo $site;?>frontend/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo $site;?>frontend/js/bootstrap.min.js"></script>
  <script src="<?php echo $site;?>frontend/js/jquery-ui.js"></script>
  <script src="<?php echo $site;?>frontend/js/jquery.number.min.js"></script>
  <!-- FANCY BOX -->
  <script type="text/javascript" src="<?php echo $site;?>library/fancybox/source/jquery.fancybox.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $site;?>library/fancybox/source/jquery.fancybox.css" media="screen"/>
  <!-- JQUERY PRICE FORMAT -->
  <script src="<?php echo $site;?>frontend/js/jquery.flexslider.js"></script>
  <!-- DATEPICKER -->
  <script src="<?php echo $site;?>library/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo $site;?>library/zebra_datepicker/zebra_datepicker.src.js"></script>
  <script src="<?php echo $site;?>library/zebra_datepicker/core.js"></script>
  <!-- JQUERY DATATABLE -->
  <script src="<?php echo $site;?>library/data_tables/jquery.dataTables.js"></script>
  <!-- JQUERY VALIDATOR -->
  <script src="<?php echo $site;?>adminbase/frontend/js/jquery.validate.min.js"></script>
  <!-- SLIDER FUNCTION  -->
	<script type="text/javascript">
      $(document).ready(function() {
        $('.flexslider').flexslider ({
            animation:"slide"
        });
      });
	</script>
</head>
<body> 
<!--************************************** NAVBAR *********************************************-->           
<div class="row">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <div class="row">
        <div class="container">
        <div class="col-lg-12">
          <div class="nav-collapse navbar-right">
            <ul class="nav navbar-nav">
            <?php
                $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                
                if($url == $site."index.php?modul=homepage") {
                    $url_homepage = "current";
                }
                elseif ($url==  $site."index.php?modul=akomodasi") {
                    $url_accomodation ="current";
                }
                elseif ($url==  $site."index.php?modul=gallery") {
                    $url_gallery ="current";
                }
                elseif ($url==  $site."index.php?modul=roomfeature") {
                    $url_roomfeature ="current";
                }
                elseif ($url==  $site."index.php?modul=testimonial") {
                    $url_testimonial ="current";
                }
                elseif ($url==  $site."index.php?modul=reservation") {
                    $url_reservation ="current";
                }
                elseif ($url==  $site."index.php?modul=myorder") {
                    $url_myorder ="current";
                }

              ?>
                <li><a id="<?php echo $url_homepage;?>" href="<?php echo $site;?>index.php?modul=homepage">Homepage</a></li>
                <li><a id="<?php echo $url_accomodation;?>" href="<?php echo $site;?>index.php?modul=akomodasi">Accomodation</a></li>
                <li><a id="<?php echo $url_gallery;?>" href="<?php echo $site;?>index.php?modul=gallery">Gallery</a></li>
                <li><a id="<?php echo $url_roomfeature;?>" href="<?php echo $site;?>index.php?modul=roomfeature">Room features</a></li>
                <li><a id="<?php echo $url_testimonial;?>" href="<?php echo $site;?>index.php?modul=testimonial">Testimonial</a></li>
              <?php if(@$_SESSION['id_member']) { ?>
                <li><a id="<?php echo $url_myorder;?>" href="<?php echo $site;?>index.php?modul=myorder">My order</a></li>
                <li><a href="<?php echo $site;?>auth/session_log/logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i></i> Logout<a/></li>
              <?php } else { ?>
                <li><a href="<?php echo $site;?>index.php?modul=signup">
                    <input type="submit" value="Sign Up" class="btnsignup"></a></li>
                <li><a href="<?php echo $site;?>auth/session_log/signin.php"><i class="fa fa-sign-in" aria-hidden="true"></i></i> Login<a/></li>
              <?php } ?>
                
            </ul>
          </div>
        </div>
      </div><!--container-navbartop-->
    </div><!--navbar-inner-->
  </div><!-- top-nav -->
</div><!-- row-->
<div class="asidelogo-right">
  <img src="<?php echo $site;?>frontend/logo/logo.png">
</div><!-- asidelogo-right-->
<!--************************************** content *********************************************-->            
<div class="container">
    <!--page open setup -->
    <?php include "fungsi/auto_load/config_pageopen.php";?>
</div>
<!--************************************** end of content **************************************-->       
<!--************************************** footer *********************************************-->
<footer class="footer-area">
  <div class="footer-top">
      <div class="footer">
        <div class="container">
            <div class="our-mission">
                <div class="col-md-4">
                    <h4 class="heading-footer">OUR MISSION</h4>
                    <p>A wonderful serenity has taken possesion of my entire soul.like these sweeet mornings of spring which i 
                    enjoy with my hole heart</p>
                  </div>
              </div>
                <!-- END OF OUR MISSION -->
                <div class="col-md-2 col-sm-5 col-xs-12">
                  <div class="site-map">
                    <h4 class="heading-footer">SITE MAP</h4>
                      <ul class="site-map-ul list-unstyled">
                          <li class="site-map-li"><a class="site-map-a" href="<?php echo $site;?>index.php?modul=faq">FaQ</a></li>
                          <li class="site-map-li"><a class="site-map-a" href="<?php echo $site;?>index.php?modul=partner">Partners</a></li>
                          <li class="site-map-li"><a class="site-map-a" href="<?php echo $site;?>index.php?modul=about_us">About Us</a></li>
                          <li class="site-map-li"><a class="site-map-a" href="<?php echo $site;?>index.php?modul=contact_us">Contact us</a></li>
                      </ul>
                  </div>
                </div>
                <div class="col-md-2 hidden-sm col-xs-12">
                <h4 class="heading-footer">BOOKING</h4>
                  <ul class="site-booking-ul list-unstyled">
                    <li class="site-booking-li"><img class="img-icon" src="<?php echo $site;?>frontend/icon/telp.png"><span class="site-booking-space"> 0854545341</span></li>
                    <li class="site-booking-li"><img class="img-icon" src="<?php echo $site;?>frontend/icon/phone.png"><span class="site-booking-space">02747174206</span></li>
                  </ul>
                </div>
                <!-- END OF SITEMAP -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="site-locate">
                    <h4 class="heading-footer">LOCATION</h4>
                      <a href="https://goo.gl/maps/wgq8SbQLNLM2" target="_blank" class="find-ourlocation"><img src="<?php echo $site;?>frontend/icon/icon location.png"></img> Our Location</a>
                      <p class="cnt-fntstylelocation">Jln Wates km 8 Balecatur Gamping Sleman Yogyakarta</p>
                  </div>
                  <div class="payments-methods">
                    <p>Payment Methods</p> 
                      <div>
                        <span><img src="<?php echo $site;?>frontend/icon/MASTERCARD2.png" class="ico-bordered"></span>
                        <span><img src="<?php echo $site;?>frontend/icon/VISA2.png" class="ico-bordered"></span>               
                        <span><img src="<?php echo $site;?>frontend/icon/BRI2.png" class="ico-bordered"></span>                
                        <span><img src="<?php echo $site;?>frontend/icon/BNI2.png" class="ico-bordered"></span>                
                      </div>
                  </div> 
                </div><!-- col md 4-->
            </div>
          </div>
        </div>
      </div>
    </div><!-- footer -->
  </div><!-- footer top -->
</footer>  
<div class="copyright-site">
  <div class="container">
      <div class="col-md-6 col-sm-6 col-xs-12">
          <p>Copyright &copy; 2014 - <?php echo date("Y");?> Balecatur Hotel </p>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="footer-right text-right">
          <a href=""><img src="<?php echo $site;?>frontend/icon/tweet.png"></a>
          <a href=""><img src="<?php echo $site;?>frontend/icon/insta.png"></a>
          <a href=""><img src="<?php echo $site;?>frontend/icon/fb.png"></a>
        </div>
      </div>
</body>
</html>

