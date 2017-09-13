<?php error_reporting(0);
include "../fungsi/function_transaksi.php"; ?>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Reservasi Offline / Manajemen Transaksi Check-in</h1>
		<div class="form-group">
		<?php
			$no=1;
			$get_transaction = "SELECT b.kd_booking,
									   m.id_member,
									   m.nama_lengkap,
									   m.alamat,
									   m.kebangsaan,
									   b.checkin,
									   b.checkout,
									   b.company_or_other,
									   b.nama_atasnama,
									   b.tgl_booking,
									   km.type_kamar,
									   b.berapa_kamar,
									   b.total_biayasewa,
									   b.status_userbook
		     				    FROM booking b
		     				    JOIN member m ON b.id_member=m.id_member
		     				    JOIN temp_booking tb ON b.id_member=m.id_member
		     				    JOIN kategori_kamar km ON km.id_kategori_kamar=tb.id_kategori_kamar
		     				    WHERE kd_booking='$_POST[kode_booking]'";
			$find_code = mysqli_query($konek,$get_transaction);
			$hasil     = mysqli_fetch_array($find_code);
			// validasi checkin masuk
			$jumlah_hari = round((strtotime($hasil['checkout'])-strtotime($hasil['checkin']))/86400);
			$total_seluruh = 0;
			$checkout = strtotime($hasil['checkout']);
			$checkin  = strtotime($hasil['checkin']);
			/*if (time() > $checkout) {
				echo "<script>alert('Maaf anda terlambat checkin !!')</script>";
				echo "<script>location='homeadmin.php?modul=man_willbe_checkin'</script>";
			}
			if (time() < $checkin) {
				echo "<script>alert('Maaf anda belum siap untuk checkin, checkin anda pada tanggal ".tgl_indo($hasil['checkin'])." !!')</script>";
				echo "<script>location='homeadmin.php?modul=man_willbe_checkin'</script>";
			}*/
		?>
		</div>
		<!-- <form action="backend/proses_checkin_kamar.php?act=choose_room" id="myform-array-checkbox" method="post" enctype="multipart/form-data"> -->
		<form id="myform-array-checkbox" method="post" enctype="multipart/form-data">
		<input type="text" name="kdbook" value="<?php echo $_POST['kode_booking']; ?>">
		<h4>Data Ditemukan Sebagai Berikut :</h4>
		<div class="panel panel-default">
			<div class="panel-heading">KONFIRMASI CHECKIN</div>
			<div class="panel-body">
				<input type="hidden" name="kd_booking" value="<?php echo $hasil['kd_booking'];?>">
				<p>Transaksi pernah dilakukan oleh :</p>
				<p>Id member <span class="man-detail-idmember">: <?php echo $hasil['id_member'];?></span></p>
				<p>Nama Pemesan <span class="man-detail-namapemesan">: <?php echo $hasil['nama_lengkap'];?></span></p>
				<!-- ================= ATASNAMA ============ -->
			<?php if($hasil['company_or_other']=='-' || $hasil['nama_atasnama']=='-'){ ?>
			<?php }else{ ?>
				<p>Nama atasnama <span class="man-nama_atasnama">: <?php echo $hasil['nama_atasnama'];?></span></p>
				<p>Nama perusahaan / Other <span class="man-company_or_other">: <?php echo $hasil['company_or_other'];?></span></p>
			<?php } ?>
				<p>Alamat <span class="man-detail-alamat">: <?php echo $hasil['alamat'];?></span></p>
				<p>Kebangsaan <span class="man-detail-kebangsaan">: <?php echo $hasil['kebangsaan']; ?></span></p>
			</div>
			<div class="panel-heading">DETAIL PEMESANAN :</div>
			<div class="panel-body">
				<p>Kode booking <span class="detail-pemesanan-kdbooking">: <?php echo $hasil['kd_booking'];?></span></p>
				<p>Checkin <span class="detail-pemesanan-checkin">: <?php echo tgl_indo($hasil['checkin']);?></span></p>
				<p>Checkout <span class="detail-pemesanan-checkout">: <?php echo tgl_indo($hasil['checkout']);?></span></p>
				<p>Tanggal pesan <span class="detail-pemesanan-tglpesan">: <?php echo $hasil['tgl_booking'];?></span></p>
				<p>Lama menginap <span class="detail-pemesanan-lamamenginap">: <?php echo $jumlah_hari." Hari ";?></span></p>
				<p>Tipe Kamar <span class="detail-pemesanan-tipekamar">: <?php echo $hasil['type_kamar'];?></span></p>
				<p>Berapa Kamar <span class="detail-pemesanan-berapakamar">: <?php echo $hasil['berapa_kamar'];?></span></p>
			</div>
			<!-- =============== INFORMASI PEMBAYARAN =========== -->
			<div class="panel-heading">INFORMASI TRANSAKSI KEUANGAN</div>
			<?php
				$get_information_payment = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM knfrimasi_pmbyaran WHERE kd_booking='$hasil[kd_booking]'"));
				$hutang = ($hasil['total_biayasewa']-$get_information_payment['jumlah_bayar']);
				$url_pict = "../uploads/bukti/".$get_information_payment['bukti_pembayaran'];
			?>
			<?php if ($hasil['status_userbook']!='BK' || $hasil['status_userbook']!='RF'){?>
			<div class="panel-body">
				<p>Cara bayar <span class="information-carabayar">: <?php echo $get_information_payment['cara_bayar'];?></span></p>
				<p>Jenis bank <span class="information-jenisbank">: <?php echo $get_information_payment['jenis_bank']; ?></span></p>
				<p>Pelunasan <span class="information-pelunasan">: <?php echo $get_information_payment['pelunasan']; ?></span></p>
				<p>Jumlah bayar <span class="information-jumlahbayar">: Rp.<?php echo formatuang($get_information_payment['jumlah_bayar']); ?></span></p>
				<?php if ($get_information_payment['pelunasan']=='DP') { ?>
				<p>Hutang <span class="information-hutang">: Rp.<?php echo formatuang($hutang);?></span></p>
				<?php }else{ ?>
				<?php } ?>
				<p>Bukti pembayaran <span class="information-buktipembayaran">: <a href="<?php echo $url_pict;?>" data-lightbox="<?php echo $get_information['id_knfrimasi_pmbyaran']?>">
				<img width="200" height="auto" data-lightbox="<?php echo $get_information['id_knfrimasi_pmbyaran']?>" src="<?php echo $url_pict;?>"></a></span></p>
			</div>
			<?php }else{ ?>
				<div style="padding:40px 0px 30px;text-align:center;color: #ff0b0b;">Maaf anda belum melakukan pembayaran !!</div>
			<?php  } ?>
			<div class="row">
	            <div class="col-md-3 pull-right">
	               <p>Total Transaksi <span style="font-weight:bold;">Rp. <?php echo formatuang($hasil['total_biayasewa']);?></span></p>
	            </div>
         	</div>
		</div>
		<h4>Check tipe kamar yang dipesan & Acc Kamar :</h4>
		<div class="row">
			<!-- <div class="col-lg-12" style="margin-bottom:10px;margin-top:20px;">
				<a href="javascript:;" style="font-size:15px;color:#DD4814;" class="tambah-no-kamar">+ Klik disini untuk Acc no kamar</a>
			</div> -->
		</div>
		<div class="table-responsive">
			<table class="table" id="table-room">
				<thead>
					<tr>
						<th>Tipe kamar</th>
						<th>Berapa kamar</th>
						<th>Harga Asli</th>
						<th>Pajak</th>
						<th>Diskon</th>
						<th>Total Harga (pajak / jika ada diskon)</th>
						<th>Subtotal Harga / kamar x hari</th>
						<th>No kamar</th>
					</tr>
				</thead>
				<?php
					$get_trans_booking = mysqli_query($konek,"SELECT
                                                         b.kd_booking,
                                                         m.id_member,
                                                         km.type_kamar,
                                                         km.id_kategori_kamar,
                                                         km.tarif,
                                                         b.berapa_kamar
                                                         FROM temp_booking tb
                                                         JOIN member m ON tb.id_member=m.id_member
                                                         JOIN booking b ON b.id_member=m.id_member
                                                         JOIN kategori_kamar km ON tb.id_kategori_kamar=km.id_kategori_kamar
                                                         WHERE b.kd_booking='$hasil[kd_booking]'");
					while ($result = mysqli_fetch_array($get_trans_booking)) {
					$kategori_kamar= $result['id_kategori_kamar'];
					$price_room = $result['tarif'];
					//cek kamar tersebut ada diskon atau tidak
					$tarifnya = $get_price['tarif'];
					$x 		  = $get_price['id_kategori_kamar'];
					//buat diskon
					$getdiskon = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM diskon WHERE id_kategori_kamar='$kategori_kamar'"));
					//mendefinisikan get diskonya berdasarkan kamar yang ada diskon
					$y  		    = $getdiskon['id_kategori_kamar'];
					$available_disc = $getdiskon['besar_diskon'];
					//variable percent 10%
					$percent = (($price_room*10)/100);
					//variable discount
					$discount =(($price_room*$available_disc)/100);
					//tentukan perhitungan harga kamar + pajak
					$count_total_price_and_tax +=(($price_room+$percent-$discount)*$jumlah_hari);
				 ?>
				<tbody>
					<tr>
						<td><?php echo $kategori_kamar;?></td>
						<td><?php echo "x ".$result['berapa_kamar'];?></td>
						<td><?php echo formatuang($result['tarif']);?></td>
						<td><?php echo formatuang($percent);?></td>
						<td><?php if($x==$y){echo $available_disc; }else{echo " - "; } ?></td>
						<td>Rp.<?php echo formatuang($price_room+$percent+$discount);?></td>
						<td>Rp.<?php echo formatuang($count_total_price_and_tax);?></td>
						<td class="col-md-1">
							<?php
								$getno_kamar = mysqli_query($konek,"SELECT * FROM kamar
																	WHERE status_kamar!='3'
																	AND id_kategori_kamar='$kategori_kamar'
																	");
								while ($res_no_room = mysqli_fetch_array($getno_kamar)) {
									echo "<input type='checkbox' name='array_nokamar' id='kamar_aray' style='cursor:pointer;' value='".$res_no_room['id_kamar']."'>". $res_no_room['id_kamar'] ."</radio>";
								}
							 ?>
							<div id="add_room_again"></div>
						</td>
					</tr>
				</tbody>
				<?php } ?>
			</table>
		</div><!--table-responsive-->
		<div>
			<button class="btn btn-primary">Checkin Sekarang</button>
			<a class="btn btn-warning" href="homeadmin.php?modul=man_willbe_checkin">Cancel</a>
		</div>
		</form>
		<!-- ==== jika data nya yang dicari tidak ditemukan ===-->
		<!-- <?php
		if (mysqli_num_rows($find_code)==0) {
				echo "<script>alert('Maaf data yang anda cari tidak ditemukan !!')</script>";
				echo "<script>history.go(-1)</script>";
			}
		?> -->
	</div>
	<div class="clearfix-bottom-100"></div>
</div>
<style type="text/css">
	.show-content{
		margin-top: 5px;
	}
</style>
<script>
	$(document).ready(function(){
		var request_room_user = $('#room_reQ').val();
		var room_default = 1;
		var id_cate_room;
		$('.tambah-no-kamar').click(function(e) {
			e.preventDefault();
			var new_nokamar = $('.no_kamar div.hidding').clone();
			var cate_room   = $('.room_category div.hidding-roomcategory').clone();
			//kondisi statement jumlah request
			if (room_default < request_room_user ) {
				room_default++;
				$('#add_room_again').append(new_nokamar);
				$('#add_room_again').append(cate_room);
			}
			//user click on remove text
			$('.removed').click(function(e){
	        	e.preventDefault();
	        	$(this).parent().remove();
	    	});
		});
		// validaton select value not equal before choosing values
		$("select").on('focus', function () {
	    	previous = this.value;
	    	var x = $(this).attr('#validation-select');
	    	//console.log(x);
	    }).change(function() {
	    	//var change_val = $("select[value="+$(this).val()+"]").not(this).val(previous);
	    	var change_val = $("").not(this).val(previous);
	    	//console.log(change_val);
	    });
	});
	//adding class when window load
	$(window).load(function(){
		$('#adding-formselect').addClass('show-content');
	});
	//serialize array checxbox
	var array_data_kamar = [];
	$(document).on('click','#kamar_aray',function(){
		var nilai_room = $(this).val();
		//console.log(nilai_room);
		if ($(this).is(':checked')) {
			array_data_kamar.push($(this).val());
		}else{
			var index = array_data_kamar.indexOf(nilai_room);
			if(index >= 0){
				array_data_kamar.splice(index,1);
			}
		}
		console.log(array_data_kamar);
	});
	//serialize array checxbox
	var array_category_kamar = [];
	$('#table-room tr').click(function(){
		var data_cate_room = $(this).find('td').eq(0).html();
		//console.log(data_cate_room);
		if ($(this).is(':checked')) {
			data_cate_room.push($(this).val());
		}else{
			var index_cate_room = array_category_kamar.indexOf(data_cate_room);
			if (index_cate_room >= 0) {
				array_category_kamar.splice(index_cate_room,1);
			}

		}
		console.log(data_cate_room);
	});

	$('#myform-array-checkbox').submit(function(e){
		e.preventDefault();
		var category_kamar = '<?php echo $kategori_kamar;?>';
		// array_data_kamar.push($(this).val());
		// array_category_kamar.push($(this).val());
		// console.log(array_category_kamar);
		// console.log(array_data_kamar);
		$.ajax({
	    	type : 'POST',
	    	url  : 'backend/proses_checkin_kamar.php?act=choose_room',
	    	data : {'id_kamar':array_data_kamar,'kd_booking':<?php echo "'".$_POST['kode_booking']."'"?>,'id_kategori_kamar':category_kamar},
				succes:function(data, response) {
					window.location.href = "admin.php";
						// console.log(data);
				// if (data.success) { //If fails
				//     if (data.errors.name) { //Returned if any error from process.php
				//         $('.throw_error').fadeIn(1000).html(data.errors.name); //Throw relevant error
				//     }
				// }else{
				//     $('#success').fadeIn(1000).append('<p>' + data.posted + '</p>'); //If successful, than throw a success message
				// }
        },
	});

});
</script>
