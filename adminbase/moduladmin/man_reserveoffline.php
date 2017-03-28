<?php include "../fungsi/function_transaksi.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		//show hide layanan tambahan
		$('.click-function').click(function(){
			$('.click-showhiding').slideToggle();
		});
		// disable button
		$( "#tested" ).prop( "disabled", false );

		var validator = $('#add_trans').submit(function(){
   
		}).validate({

			rules:{

				id_member:{
					required:true,
				},
				nama_pemesan:{
					required:true,
				},
				id_kategori_kamar:{
					required:true,
				},
				checkin_lgsng:{
					required:true,
				},
				checkout_lgsng:{
					required:true,
				},
				qty_pesan:{
					required:true,
				},
				alamat_tamu:{
					required:true,
				},
				id_kamar:{
					required:true,
				},
				jumlah_pesan:{
					required:true,
				}
			},
			messages:{
				id_member:{
					required:"Id member tidak boleh kosong !!",
				},
				nama_pemesan:{
					required:"kolom nama pemesan tidak boleh kosong !!",
				},
				id_kategori_kamar:{
					required:"kolom tipe kamar tidak boleh kosong !!",
				},
				checkin_lgsng:{
					required:"kolom checkin tidak boleh kosong !!",
				},
				checkout_lgsng:{
					required:"kolom checkout tidak boleh kosong !!",
				},
				qty_pesan:{
					required:"kolom jumlah pemesan tidak boleh kosong !!",
				},
				alamat_tamu:{
					required:"Kolom alamat tidak boleh kosong !!",
				},
				id_kamar:{
					required:"Kolom nomor kamar tidak boleh kosong !!",
				},
				jumlah_pesan:{
					required:"Jumlah pemesan tidak boleh kosong !!",
				}
			}
		});

		//jquery clone select tipe kamar
		$('#tambah-kategori-kamar').click(function(e) {
			e.preventDefault();
			var new_cat = $('.kategori-kamar div.a').clone();
			$('#select0').append(new_cat);

			$('.removed').click(function(e){ //user click on remove text
	        	e.preventDefault(); 
	        	$(this).parent().remove();
	    	});
		});

		//jquery clone select kamar
		$('#tambah-no-kamar').click(function(batal){
			batal.preventDefault();
			var add_roms = $('.nomor_kamar div.b').clone();
			$('#select1').append(add_roms);

			$('.removeds').click(function(batal){
				batal.preventDefault();
				$(this).parent().remove();

			});
		});

</script>

<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Reservasi Offline / Transaksi Langsung</h1>
		<!-- <div class="top-containerright">
			Tanggal <?php  $format_default = date('Y-m-d'); $tanggal_indo=tgl_indo($format_default);  echo $tanggal_indo; ?> 
						 		
			/ Jam <?php date_default_timezone_set("Asia/Jakarta"); $hari= date('h:i:s a'); echo $hari; ?>		 		
		</div> -->
	<div class="row">
		<div class="col-md-12"> 
			<ul class="tabs-menu">
				<li><a href="<?php echo "homeadmin.php?modul=man_willbe_checkin"?>">Reserve will be checkin / Sudah Pesan ingin checkin</a></li>
				<li><a href="<?php echo "homeadmin.php?modul=man_justreserve"?>">Just Reserve / Hanya pesan</a></li>
				<li><a href="<?php echo "homeadmin.php?modul=man_checkin_now"?>">Checkin Now / Checkin Sekarang</a></li>
			</ul>
		</div>
	</div>
</div>
</div>