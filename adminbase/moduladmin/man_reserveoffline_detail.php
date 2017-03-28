<?php include "../fungsi/function_transaksi.php";
$getreserve_online = mysqli_fetch_array(mysqli_query($konek,
                     "SELECT  tl.kd_transaksilgsng, 
                              tl.checkin_lgsng,
                              tl.checkout_lgsng,
                              m.nama_lengkap,
                              m.id_member,
                              km.type_kamar,
                              km.tarif,
                              k.no_kamar,
                              tl.jumlah_pesan,
                              km.tarif
                     FROM transaksi_langsung tl JOIN member m ON tl.id_member=m.id_member
                     JOIN kategori_kamar km ON tl.id_kategori_kamar=km.id_kategori_kamar 
                     JOIN kamar k ON tl.id_kamar=k.id_kamar")); 
//menghitung jumlah harinya dari checkin - checkout
$jumlah_hari = round((strtotime($getreserve_online['checkout_lgsng'])-strtotime($getreserve_online['checkin_lgsng']))/86400)+1; 
// kondisi default harinya
$total_seluruh_hari = 0;
// menghitung total menginap dan transaksi kamar * harinya menginap
$total_seluruh_hari+=($$getreserve_online['tarif']*$jumlah_hari);
?>
<style type="text/css">

   .outer-space{
      padding-bottom: 5px;
   }
   .form-kodebook{
      margin-left: 200px;
   }
   .form-kendaraan{
      margin-left: 170px;
   }
   .form-daritanggal{
      margin-left: 196px;
   }
   .form-sampaitanggal{
      margin-left: 174px;
   }
   .form-namakendaraan{
      margin-left: 163px;
   }
   .form-idmember{
      margin-left: 219px;
   }
   .form-namapemesan{
      margin-left: 186px;
   }
   .form-kamar{
      margin-left: 215px;
   }
   .form-hargakamar{
      margin-left: 203px;
   }
   .form-checkin{
      margin-left: 238px;
   }
   .form-checkout{
      margin-left: 230px;
   }
   .form-beberapaorang{
      margin-left: 203px;
   }
   .form-extrabed{
      margin-left: 211px;
   }
   .form-hargaextrabed{
      margin-left: 120px;
   }
   .total_menginap{
      margin-left: 200px;
   }
   .form-nokamar{
      margin-left: 228px;
   }
   .form-rental{
      margin-left: 210px;
   }
   .total_menginap{
      margin-left: 193px;
   }
   .form-namapaket{
      margin-left: 200px;
   }
   .form-keterangan_menunya{
      margin-left: 223px;
   }
   .form-harga_paket{
      margin-left: 198px;
   }
   .form-jenislaundry{
      margin-left: 187px;
   }
   .form-hargalaundry{
      margin-left: 187px;
   }

</style>
<div class="row">
   <div class="col-lg-12">
      <div class="wrapper-detailreserveonline">
          <div class="main-containerreserveonline">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <div class="font-sizerheading">
               <h1 class="page-header">Detail Reservation Offline (Transaksi langsung)</h1>                
            </div> 
         <div>
            <a href="javascript:history.back(-1);"><~ Go Back</a>
         </div> 
         <section style="display:inline-block;width:100%;">
            <div>
               <label>Detail Transaksi</label>
            </div>
            <div>
               <div class="outer-space">Kode Booking 
                  <span class="form-kodebook">: <?php echo $_GET['id']?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Id Member 
                  <span class="form-idmember">: <?php echo $getreserve_online['id_member']?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Nama Pemesan 
                  <span class="form-namapemesan">: <?php echo $getreserve_online['nama_lengkap']?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Tipe Kamar 
                  <span class="form-kamar">: <?php echo $getreserve_online['type_kamar']; ?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Harga Kamar 
                  <span class="form-hargakamar">: pernight@ / Rp.<?php echo number_format("$price_room",0,",",".").",-" ?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Checkin 
                  <span class="form-checkin">: <?php $changedate1 = tgl_indo($tanggal1); echo $changedate1;?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Checkout 
                  <span class="form-checkout">: <?php $changedate2 = tgl_indo($tanggal2); echo $changedate2;?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Total menginap
                  <span class="total_menginap">:<?php echo $jumlah_hari." Hari Rp.";echo number_format("$total_seluruh_hari",0,",",".").",-";?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">No kamar 
                  <span class="form-nokamar">: Kamar No <?php echo $getreserve_online['no_kamar'];?></span>
               </div>
            </div>
            <div>
               <div class="outer-space">Berapa orang 
                  <span class="form-beberapaorang">: <?php echo $getreserve_online['jumlah_pesan']?> Orang</span>
               </div>
            </div>
            <div style="margin-top:20px;">      
               <label>Layanan Tambahan</label>
               <div class="outer-space">
             <?php 

               //cek transaksi tmabahan
               $getdata_detail =mysqli_fetch_array(mysqli_query($konek,"SELECT tl.kd_transaksilgsng, tl.checkin_lgsng, tl.checkout_lgsng, tl.id_paket, tl.id_rental,tl.id_laundry, tl.extrabed_lgsng
                                                                            FROM transaksi_langsung tl JOIN kategori_kamar km ON km.id_kategori_kamar=tl.id_kategori_kamar
                                                                            WHERE tl.kd_transaksilgsng='$_GET[id]'"));  
               //view query layanan tambahan 
               if ($getdata_detail['id_rental']=='-' OR $getdata_detail['id_paket']=='-' OR $getdata_detail['id_laundry']=='-' OR $getdata_detail['extrabed_lgsng']=='tidak') {

               $price_room    = $getreserve_online['tarif'];
               $price_paket   = $getdata_detail['harga_paket'];
               $price_rent    = $getdata_detail['harga_kendaraan'];
               $price_laundry = $getdata_detail['harga_laundry'];

               }else{


               $getdata_detail = mysqli_fetch_array(mysqli_query($konek,"SELECT tl.kd_transaksilgsng, tl.id_member, tl.id_rental, r.nama_kendaraan ,r.harga_kendaraan, 
                                                                              r.kate_kendaraan, dbl.tgl_awal_sewa, dbl.tgl_akhir_sewa, p.nama_paket, dp.keterangan_menunya,
                                                                              p.harga_paket, l.harga_laundry, l.jenis_laundry , tl.extrabed_lgsng 
                                                                        FROM transaksi_langsung tl JOIN rental r ON r.id_rental=tl.id_rental
                                                                        JOIN paket p ON tl.id_paket=p.id_paket
                                                                        JOIN laundry l ON tl.id_laundry=l.id_laundry
                                                                        JOIN detail_paket dp ON tl.id_paket=dp.id_paket
                                                                        JOIN detail_booking_rental dbl ON tl.id_rental=r.id_rental
                                                                        WHERE tl.kd_transaksilgsng='$_GET[id]'"));
               $price_room    = $getreserve_online['tarif'];
               $price_paket   = $getdata_detail['harga_paket'];
               $price_rent    = $getdata_detail['harga_kendaraan'];
               $price_laundry = $getdata_detail['harga_laundry'];

               //jika layanan tambahan tidak dipesan

               }


               ?>


             <?php  if ($getdata_detail['id_rental']=='-' OR $getdata_detail['id_paket']=='-' OR $getdata_detail['id_laundry']=='-' OR $getdata_detail['extrabed_lgsng']=='tidak') { ?>
             
                  <label style="margin-left:20px;font-style:italic;">Sewa Rental :</label>
                     <div style="margin-left:20px;">
                        <div class="outer-space">Nama Kendaraan<span class="form-namakendaraan">: -</span></div>
                        <div class="outer-space">Harga Kendaran<span class="form-kendaraan">:-</span></div>
                        <div class="outer-space">Dari Tanggal<span class="form-daritanggal">:-</span></div>
                        <div class="outer-space">Sampai Tanggal<span class="form-sampaitanggal">:-</span></div>
                     </div>
                 <label style="margin-left:20px;font-style:italic;">Restorasi :</label>
                     <div style="margin-left:20px;">
                        <div class="outer-space">Nama Paket<span class="form-namapaket">:-</span></div>
                        <div class="outer-space">Isi Paket<span class="form-keterangan_menunya">:-</span></div>
                        <div class="outer-space">Harga Paket<span class="form-harga_paket">:-</span></div>
                     </div>
                  <label style="margin-left:20px;font-style:italic;">Extra Bed :</label>
                     <div style="margin-left:20px;">
                        <p>Extra bed <span class="form-extrabed">:-</span></p> 
                        <p>Harga @Rp.7500,- /bed <span class="form-hargaextrabed">:-</span></p> 
                     </div>
                  <label style="margin-left:20px;font-style:italic;">Laundry :</label>
                     <div style="margin-left:20px;">
                        <p>Jenis Laundry<span class="form-jenislaundry">:-</span></p>
                        <p>Harga Laundry<span class="form-hargalaundry">:-</span></p>
                     </div>
               <div style="float:right;">
                  <label>Subtotal Transaksi :</label>
                     <div>
                     Rp.
                     <?php
                        $subtotal =($price_rent+$total_seluruh_hari+$price_paket+$price_laundry);
                        echo formatuang($subtotal);?>
                     </div>
               </div>

               <?php }else{?>

                  <label style="margin-left:20px;font-style:italic;">Sewa Rental :</label>
                     <div style="margin-left:20px;">
                        <div class="outer-space">Nama Kendaraan<span class="form-namakendaraan">: <?php echo $getdata_detail['nama_kendaraan']?></span></div>
                        <div class="outer-space">Harga Kendaran<span class="form-kendaraan">: Rp.<?php echo formatuang($getdata_detail['harga_kendaraan']);?></span></div>
                        <div class="outer-space">Dari Tanggal<span class="form-daritanggal">: <?php echo tgl_indo($getdata_detail['tgl_awal_sewa']);?></span></div>
                        <div class="outer-space">Sampai Tanggal<span class="form-sampaitanggal">: <?php echo tgl_indo($getdata_detail['tgl_akhir_sewa']);?></span></div>
                     </div>
                  <label style="margin-left:20px;font-style:italic;">Restorasi :</label>
                     <div style="margin-left:20px;">
                        <div class="outer-space">Nama Paket<span class="form-namapaket">: <?php echo $getdata_detail['nama_paket'];?></span></div>
                        <div class="outer-space">Isi Paket<span class="form-keterangan_menunya">: <?php echo $getdata_detail['keterangan_menunya'];?></span></div>
                        <div class="outer-space">Harga Paket<span class="form-harga_paket">: Rp.<?php echo formatuang($getdata_detail['harga_paket']);?></span></div>
                     </div>
                  <label style="margin-left:20px;font-style:italic;">Extra Bed :</label>
                     <div style="margin-left:20px;">
                        <p>Extra bed <span class="form-extrabed">: <?php echo $getdata_detail['extrabed_lgsng']?></span></p> 
                        <p>Harga @Rp.7500,- /bed <span class="form-hargaextrabed">: Rp.<?php echo formatuang(hargaextrabed()); ?></span></p> 
                     </div>
                  <label style="margin-left:20px;font-style:italic;">Laundry :</label>
                     <div style="margin-left:20px;">
                        <p>Jenis Laundry<span class="form-jenislaundry">: <?php echo $getdata_detail['jenis_laundry']; ?></span></p>
                        <p>Harga Laundry<span class="form-hargalaundry">: Rp.<?php echo formatuang($getdata_detail['harga_laundry']); ?></span></p>
                     </div>
               </div><!--Outer space-->
               <article>
                  Keterangan : * Jika dalam waktu 3 hari x 24 jam pelanggan tidak mengkonfrimasi pembayaran maka transaksi akan kami batalkan 
                  sesuai dengan peraturan kebijakan manajemen balecatur hotel.
               </article>
               <div style="float:right;">
                  <label>Subtotal Transaksi :</label>
                  <div>
                  Rp.
                  <?php
                     $subtotal =($price_rent+$total_seluruh_hari+hargaextrabed()+$price_paket+$price_laundry);
                     echo formatuang($subtotal);?>
                  </div>
               </div>
               <?php } ?>
               <div>
                  <button type="submit">Checkout</button>
               </div>
               <div style="margin-top:50px;margin-bottom:10%;"></div>
            </div>
      </section>
      </div>
   </div>
</div>

