<?php session_start(); // Ini adalah script session yang akan mengecek identitas admin (status = 0). include "../config/koneksi.php";
    include "../config/koneksi.php";
//check level session admin
if ($_SESSION['level_admin']=="1" || $_SESSION['level_admin']=="2" || $_SESSION['level_admin']=="3" || $_SESSION['level_admin']=='4') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Balecatur Hotel - Admin Panel</title>
    <link rel="shorcut icon" href="<?php echo "$site";?>frontend/icon/favicon.ico.png">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $site;?>frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $site;?>frontend/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo $site;?>library/zebra_datepicker/css/bootstrap-zebradatepicker.css" type="text/css" rel="stylesheet">
    <!--<link href="frontend/css/datepicker.css" rel="stylesheet">-->
    <link href="<?php echo $site;?>adminbase/frontend/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo $site;?>adminbase/frontend/css/lightbox.css" rel="stylesheet" type="text/css">
    <!-- MetisMenu CSS -->
    <link href="<?php echo $site;?>adminbase/frontend/css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $site;?>adminbase/frontend/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo $site;?>adminbase/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../library/data_tables/jquery.dataTables.css" type="text/css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?php echo $site;?>adminbase/frontend/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $site;?>frontend/js/jquery.validate.min.js"></script>
    <script src="<?php echo $site;?>adminbase/frontend/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $site;?>adminbase/frontend/js/jquery.number.min.js"></script>
    <!-- DATEPICKER -->
    <script src="<?php echo $site;?>library/zebra_datepicker/zebra_datepicker.src.js"></script>
    <script src="<?php echo $site;?>library/zebra_datepicker/core.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $site;?>frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo $site;?>frontend/js/jquery-ui.js"></script>
    <!--<script src="frontend/js/bootstrap-datepicker.js"></script>-->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $site;?>adminbase/frontend/js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $site;?>adminbase/frontend/js/sb-admin-2.js"></script>
    <!-- Custom data tables jquery -->
    <script src="../library/data_tables/jQuery.dataTables.js"></script>
    <script src="<?php echo $site; ?>library/ckeditor_config/ckeditor/ckeditor.js"></script>
    <script src="<?php echo $site; ?>library/ckeditor_config/ckfinder/ckfinder.js"></script>
</head>
<?php
//check hak akses user
function HakaksesUserheader($args){
    if ($args==1) {
        $status_user = 'Admin Sistem';
    }elseif ($args==2) {
        $status_user = 'Receptionist';
    }elseif ($args==3) {
        $status_user = 'Pimpinan';
    }elseif ($args==4) {
        $status_user = 'Room Boy';
    }
    return $status_user;
}

 ?>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $site; ?>" target="_blank">Balecatur Hotel Admin Panel</a>
            </div>

            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a style="color:#fff;">Status administrator : <?php echo HakaksesUserheader($_SESSION['level_admin']);?> (<?php echo $_SESSION['username']; ?>)</a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <?php if ($_SESSION['level_admin']=='1' || $_SESSION['level_admin']=='3') { ?>
                        <li>
                            <a href="homeadmin.php?modul=man_user"><i class="fa fa-user fa-fw"></i> Setting User</a>
                        </li>
                    <?php } ?>
                        <!-- <li class="divider"></li> -->
                        <li><a href="logout.php" onclick="return confirm('Anda Yakin Ingin Keluar Sistem !!');"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <?php include "sidebar.php"; ?>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php include "load_mod/select.php"; ?>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<script src="frontend/js/lightbox.js" type="text/javascript"></script>
<!-- <script src="frontend/js/lightbox-plus-jquery.min.js" type="text/javascript"></script>
 -->
</body>

</html>
<?php
}else{
    header("Location: index.html");
}
?>
