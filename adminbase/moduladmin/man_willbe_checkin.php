<?php include "../fungsi/function_transaksi.php";error_reporting(0); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#validate-this").validate({
			rules:{
				kode_booking:{
					required:true,
				},
			},messages:{
				kode_booking:"Kode booking tidak boleh kosong !!",
			}
		});
		//jqeury data-tables
        $('#listcheckin').dataTable( {
        	/*"bFilter": false,*///hide filter control
            // Sets the row-num-selection "Show %n entries" for the user
            "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ],
            // Set the default no. of rows to display
            "pageLength": 5
        });
	});
</script>
<style type="text/css">
	.sizing-borderpanels{height: 400px;margin:56px 0px; } 
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Manajemen Transaksi Check-in</h1>
		</div>	
		<ul class="tabs-menu">
			<li class="reserver"><a href="<?php echo 'homeadmin.php?modul=man_willbe_checkin'?>">Reserve will be checkin / Sudah Pesan ingin checkin</a></li>
			<li><a href="<?php echo 'homeadmin.php?modul=man_justreserve'?>">Just Reserve / Hanya pesan</a></li>
			<li><a href="<?php echo 'homeadmin.php?modul=man_checkin_now'?>">Checkin Now / Checkin Sekarang</a></li>
		</ul>
			<div class="panel panel-default sizing-borderpanels">
				<div class="col-md-4" style="padding:20px;">
					<form action="homeadmin.php?modul=man_willbe_checkin_findbook" method="post" enctype="multipart/form-data" id="validate-this">
						<p>Cek Kode Pemesanan / Kode Booking</p>
						<input type="text" name="kode_booking" autofocus required="" class="form-control" placeholder="Input This Code Here">
						<span style="margin-top:10px;"></span>
						<div style="margin-top:10px;">
							<button name="submit">Cek Kode Booking</button>
						</div>
					</form>
				</div>
				<div class="col-lg-12 panel-information" style="padding:20px;">
					<label>Information :</label>
					<p>1.Ketentuan transaksi checkin jika tamu telat melakukan checkin sesuai tanggal yang di minta maka transaksi tidak dapat dilanjutkan atau diaanggap hangus,</br>
					jika transaksi tanggal checkin tepat pada waktu yang diminta tetapi tamu yang datang hanya telat beberapa menit, hal tersebut masih dianggap wajar.</p>
				</div>
			</div><!-- panel default-->
	</div>	
</div>	