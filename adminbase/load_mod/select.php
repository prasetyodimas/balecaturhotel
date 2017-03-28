<?php
    //get modul
    if (!isset($_GET['modul'])) {
        include('moduladmin/dashboard.php');

    }else{
        $page = $_GET['modul'];
        switch($page) {

            case 'dashboard':
                include('moduladmin/dashboard.php');
                break;
            case 'profil':
                include('moduladmin/profil.php');
                break;
            /* master user atau member */
            case 'man_user':
                include('moduladmin/man_user.php');
                break;
            case 'man_user_edit':
                include('moduladmin/man_user_edit.php');
                break;
            case 'man_member':
                include('moduladmin/man_member.php');
                break;
            case 'man_member_edit':
                include('moduladmin/man_member_edit.php');
                break;
            case 'man_memberdetail':
                include('moduladmin/man_memberdetail.php');
                break;
            case 'man_member_atasnama':
                include('moduladmin/man_member_atasnama.php');
                break;
            /* master type kamar */
            case 'man_kategori_kamar':
                include('moduladmin/man_kategori_kamar.php');
                break;
            case 'man_kategorikamar_edit':
                include('moduladmin/man_kategori_kamar_edit.php');
                break;
            /* master manajemen diskon*/
            case 'man_diskon':
                include('moduladmin/man_diskon.php');
                break;
            case 'man_diskon_edit':
                include('moduladmin/man_diskon_edit.php');
                break;
            /* master kamar */
            case 'man_kamar':
                include('moduladmin/man_kamar.php');
                break;
            case 'man_kamar_edit':
                include('moduladmin/man_kamar_edit.php');
                break;
            /* cek kamar  */
            case 'cek_kamar':
                include('moduladmin/cek_kamar.php');
                break;
            case 'cek_booking_kamar':
                include('moduladmin/cek_booking_kamar.php');
                break;
            /* master reservasi */
            case 'man_reserveonline':
                include('moduladmin/man_reserveonline.php');
                break;
            case 'man_reserveoffline_detail':
                include ('moduladmin/man_reserveoffline_detail.php');
                break;
            case 'man_reserveonline_confrimation':
                include('moduladmin/man_reserveonline_confrimation.php');
                break;
            case 'man_reserveonline_detail':
                include('moduladmin/man_reserveonline_detail.php');
                break;
            /*manajemen available room*/    
            case 'man_available_room':
                include('moduladmin/man_available_room.php');
                break;
            case 'man_getall_transaction':
                include('moduladmin/man_getall_transaction.php');
                break;
            case 'man_reserve_struck':
                include('moduladmin/man_reserve_struck.php');
                break;
            case 'man_reserveoffline':
                include('moduladmin/man_reserveoffline.php');
                break;
            case 'man_reserveoffline_transaksi':
                include('moduladmin/man_reserveoffline_transaksi.php');
                break;
            case 'man_checkmember':
                include('moduladmin/man_checkmember.php');
                break;
            /* master rental */
            case 'man_rental':
                include('moduladmin/man_rental.php');
                break;
            case 'man_rental_edit':
                include('moduladmin/man_rental_edit.php');
                break;
            /* master laundry */
            case 'man_laundry':
                include('moduladmin/man_laundry.php');
                break;
            case 'man_laundry_edit':
                include('moduladmin/man_laundry_edit.php');
                break;
            /* master gallery*/
            case 'man_gallery':
                include('moduladmin/man_gallery.php');
                break;
            case 'man_gallery_edit':
                include('moduladmin/man_gallery_edit.php');
                break;
            /* master testimoni*/
            case 'man_testimoni':
                include('moduladmin/man_testimoni.php');
                break;
            case 'man_testimoni_edit':
                include('moduladmin/man_testimoni_edit.php');
                break;
            /* master berita */
            case 'man_akomodasi':
                include('moduladmin/man_akomodasi.php');
                break;
            case 'man_akomodasi_edit':
                include('moduladmin/man_akomodasi_edit.php');
                break;
            case 'man_accomodation_add':
                include('moduladmin/man_accomodation_add.php');
                break;
            /* master restorasi */
            case 'man_menu':
                include ("moduladmin/man_menu.php");
                break;
            case 'man_menu_edit':
                include ('moduladmin/man_menu_edit.php');
                break;
            /* master extrabed */
            case 'man_extrabed':
                include("moduladmin/man_extrabed.php");
                break;
            case 'man_extrabed_edit':
                include("moduladmin/man_extrabed_edit.php");
                break;
            case 'man_katepaket':
                include ("moduladmin/man_katepaket.php");
                break;
            case 'man_katepaketedit':
                include("moduladmin/man_katepaketedit.php");
                break;
            /*transaksi*/
            case 'man_listcheckin':
                include("moduladmin/man_listcheckin.php");
                break;
            case 'man_listcheckout':
                include("moduladmin/man_listcheckout.php");
                break;
            case 'man_transaksicheckin_detail':
                include("moduladmin/man_transaksi_checkin_detail.php");
                break;
            case 'man_transaksi_checkout':
                include("moduladmin/man_transaksi_checkout.php");
                break;
            case 'man_willbe_checkin':
                include("moduladmin/man_willbe_checkin.php");
                break;
            case 'man_willbe_checkin_findbook':
                include("moduladmin/man_willbe_checkin_findbook.php");
                break;
            case 'man_willbe_checkin_detail':
                include("moduladmin/man_willbe_checkin_detail.php");
                break;
            case 'man_justreserve':
                include("moduladmin/man_justreserve.php");
                break;
            case 'man_checkin_now':
                include("moduladmin/man_checkin_now.php");
                break;
            case 'man_perpanjang_inap':
                include("moduladmin/man_perpanjang_inap.php");
                break;
            /*laporan hotel*/
            case 'laporan_reservasi':
                include ("moduladmin/laporan_reservasi.php");
                break;
            case 'laporan_reservasidetail':
                include ("moduladmin/laporan_reservasidetail.php");
                break;
            case 'laporan_memberhotel':
                include "moduladmin/laporan_memberhotel.php";
                break;
            case 'laporan_memberdetail':
                include('moduladmin/laporan_memberdetail.php');
                break;
            case 'laporan_pemasukan':
                include ("moduladmin/laporan_pemasukan.php");
                break;
            case 'laporan_invoice':
                include ("moduladmin/laporan_invoice.php");
                break;
            case 'laporan_invoicedetail':
                include ("moduladmin/laporan_invoicedetail.php");
                break;
            case 'laporan_sewarental':
                include ("moduladmin/laporan_sewarental.php");
                break;
            case 'jqfunction':
                include ("moduladmin/jqfunction.php");
                break;
        }
    }

?>
