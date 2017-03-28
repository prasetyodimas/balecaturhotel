<?php  //setting page maodul
    $modul = isset($_GET['modul']) ? $_GET['modul'] : null;

        if ($_GET['modul'] =="") {
            include ("modulpage/homepage.php");
        }
        elseif ($_GET['modul']=="available_room") {
            include ("modulpage/available_room.php");
        }
        elseif ($_GET['modul']=="available_room_date") {
            include ("modulpage/available_room_date.php");
        }
        elseif ($_GET['modul'] == "homepage") {
            include ("modulpage/homepage.php");
        }
        elseif ($_GET['modul'] == "akomodasi"){
            include ("modulpage/akomodasi.php");
        }
        elseif ($_GET['modul'] == "gallery"){
            include ("modulpage/gallery.php");
        }
        elseif ($_GET['modul'] == "roomfeature"){
            include ("modulpage/roomfeature.php");
        }
        elseif ($_GET['modul'] == "testimonial"){
            include ("modulpage/testimonial.php");
        }
        elseif ($_GET['modul'] == "signup"){
            include ("modulpage/signup.php");
        }
        elseif ($_GET['modul'] == "about_us"){
            include ("modulpage/about_us.php");
        }
        elseif ($_GET['modul'] == "faq"){
            include ("modulpage/faq.php");
        }
        elseif ($_GET['modul'] == "contact_us"){
            include ("modulpage/contact_us.php");
        }
        elseif ($_GET['modul'] == "reservation"){
            include ("modulpage/reservation.php");
        }
        elseif ($_GET['modul'] == "myorder") {
            include ("modulpage/myorder.php");
        }
        elseif ($_GET['modul'] == "history_pemesanan") {
            include ("modulpage/history_pemesanan.php");
        }
        elseif ($_GET['modul']== "manageakun") {
            include ('modulpage/manageakun.php');
        }
        elseif ($_GET['modul']== "manageakunedit") {
            include ('modulpage/manageakunedit.php');
        }
        elseif ($_GET['modul']== "orderdetail") {
            include ('modulpage/orderdetail.php');
        }
        elseif ($_GET['modul']== "cancelorder") {
            include ('modulpage/cancel_order.php');
        }
        elseif ($_GET['modul']== "konfrimasi_pembayaran") {
            include ('modulpage/konfrimasi_pembayaran.php');
        }
        elseif ($_GET['modul'] == "detail-roomstandart") {
            include ("modulpage/detail-roomstandart.php");
        }
        elseif($_GET['modul'] == "moreinformation"){
            include ("modulpage/moreinformation.php");
        }
        elseif ($_GET['modul'] =="cetak_buktibooking") {
            include ("modulpage/cetak_buktibooking.php");
        }
        elseif ($_GET['modul'] == "konfrimasi") {
            include ("modulpage/konfrimasi.php");
        }
        elseif ($_GET['modul'] == "bukti_reservasi_online") {
            include ("modulpage/bukti_reservasi_online.php");
        }
        elseif ($_GET['modul']=="getall_transaction") {
            include ("modulpage/getall_transaction.php");
        }
        elseif ($_GET['modul'] == "konfirmasi_user") {
            include ("modulpage/konfirmasi_user.php");
        }elseif ($_GET['modul'] == "export_buktihotel") {
            include ("modulpage/export_buktihotel.php");
        }elseif ($_GET['modul'] == "partner") {
            include ("modulpage/partner.php");
        }else {
            echo "<p><b>halaman yang diminta tidak ada !!</b></p>";

        }

?>