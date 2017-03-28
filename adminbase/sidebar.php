 <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <p class="centered" style="text-align:center; margin:5% auto;">
          <a href="#"><img src="frontend/images/lg1.png" class="img-circle" width="60"></a>
        </p>
        <li>
            <a href="homeadmin.php?modul=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>
        <?php if($_SESSION['level_admin']==3 OR $_SESSION['level_admin']==1) { ?>
        <!-- Data Master -->
        <li>
            <a href="#"><i class="fa fa-plus-square fa-fw"></i> Data Master </a>
            <i class="fa fa-sort-down has-children"></i>
            <ul class="nav nav-second-level">
                <li><a href="homeadmin.php?modul=man_member"><i class="fa fa-user fa-fw"></i> Man. Member</a>
                <li><a href="homeadmin.php?modul=man_akomodasi"><i class="fa fa-picture-o"></i>  Man. Akomodasi</a></li>
                <li><a href="homeadmin.php?modul=man_testimoni"><i class="fa fa-comments"></i>  Man. Testimoni</a></li>
                <li><a href="homeadmin.php?modul=man_gallery"><i class="fa fa-picture-o"></i> Man. Gallery</a></li>
                <li><a href="homeadmin.php?modul=man_kategori_kamar"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Kategori Kamar</a></li>
                <li><a href="homeadmin.php?modul=man_kamar"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Kamar </a></li>
                <li><a href="homeadmin.php?modul=cek_kamar"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Check Kamar </a></li>
                <li><a href="homeadmin.php?modul=man_diskon"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Diskon</a></li>
                <li><a href="homeadmin.php?modul=man_extrabed"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Extrabed</a></li>
                <li><a href="homeadmin.php?modul=man_rental"><i class="fa fa-car fa-fw"></i> Man. Rental</a></li>
                <li><a href="homeadmin.php?modul=man_laundry"><i class="fa fa-bitbucket fa-fw"></i> Man Laundry</a></li>
                <li><a href="homeadmin.php?modul=man_katepaket"><i class="fa fa-cutlery fa-fw"></i> Man Kategori Paket</a></li>
                <li><a href="homeadmin.php?modul=man_menu"><i class="fa fa-cutlery fa-fw"></i> Man Menu</a></li>
            </ul>
        </li>
        <?php }?>
        <!--  Data Transaksi -->
        <?php if ($_SESSION['level_admin']==4) { ?>
        <li>
            <a href=""><i class="fa fa-plus-square fa-fw"></i> Man Pengelolaan Kamar</a>
            <i class="fa fa-sort-down has-children"></i>
            <ul>
                <li><a href="homeadmin.php?modul=man_listcheckin"><i class="glyphicon glyphicon-bed fa-fw"></i> List Trans Checkin</a></li>
                <li><a href="homeadmin.php?modul=cek_kamar"><i class="glyphicon glyphicon-bed fa-fw"></i> Man. Check Kamar </a></li>
            </ul>
        </li>
        <?php } elseif ($_SESSION['level_admin']==2) { ?>
        <li>
            <a href=""><i class="fa fa-plus-square fa-fw"></i> Manajemen Transaksi</a>
            <i class="fa fa-sort-down has-children"></i>
            <ul>
                <li><a href="homeadmin.php?modul=man_reserveonline"><i class="glyphicon glyphicon-bed fa-fw"></i> Reserve Online</a></li>
                <li><a href="homeadmin.php?modul=man_willbe_checkin"><i class="glyphicon glyphicon-bed fa-fw"></i> Reservasi Offline </a></li>
                <li><a href="homeadmin.php?modul=man_listcheckin"><i class="glyphicon glyphicon-bed fa-fw"></i> List Trans Checkin</a></li>
                <li><a href="homeadmin.php?modul=man_listcheckout"><i class="glyphicon glyphicon-bed fa-fw"></i> List Trans Checkout</a></li>
                <li><a href="homeadmin.php?modul=cek_kamar"><i class="glyphicon glyphicon-bed fa-fw"></i> Man Check Kamar </a></li>
            </ul>
        </li>
        <?php } ?>
        <!-- Data Laporan -->
        <?php if ($_SESSION['level_admin']==3) { ?>
        <li>
            <a href="homeadmin.php?page=man_ongkir"><i class="fa fa-file-text-o fa-fw"></i> Data Laporan</a>
            <i class="fa fa-sort-down has-children"></i>
            <ul>
                 <li><a href="homeadmin.php?modul=laporan_reservasi">Laporan Reservasi</a></li>
                <li><a href="homeadmin.php?modul=laporan_memberhotel">Laporan Member Hotel</a></li>
                <li><a href="homeadmin.php?modul=laporan_invoice">Laporan Invoice</a></li>
                <li><a href="homeadmin.php?modul=laporan_pemasukan">Laporan Pemasukan</a></li>
               <!--  <li><a href="homeadmin.php?modul=laporan_sewarental">Laporan Sewa Mobil / Motor</a></li> -->
            </ul>
        </li>
        <?php } ?>
    </ul>               
</div>                