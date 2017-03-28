<?php include "../fungsi/function_transaksi.php";?>
<script type="text/javascript">
$(document).ready(function(){
	$("#disabled").prop("disabled", false);
	$('.tabs-menu a').click(function(event){
		event.preventDefault();
		$(this).parent().addClass("reserver");
		$(this).parent().siblings().removeClass("reserver");
		/*var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display","none");
		$(tab).fadeIn();*/
	});
	$('#tb-reserveperson-konfirmasi').dataTable( {
	        // Sets the row-num-selection "Show %n entries" for the user
	      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ], 
	      // Set the default no. of rows to display
	      "pageLength": 10 
     });
	$('#tb-reserveperson-cancel').dataTable( {
	        // Sets the row-num-selection "Show %n entries" for the user
	      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ], 
	      // Set the default no. of rows to display
	      "pageLength": 10 
     });
});
</script>

<div class="row">
	<div class="col-lg-12">
	<div id="tab-1" class="tab-content">
		<div class="font-sizerheading">
			<h1 class="page-header">Manajemen Reserve Online & Konfirmasi Pesan</h1>
		</div>
		<div class="heading-status_booked" style="text-align:center;">
			<h4>Status Pemesanan : <span style="color:#FF5722;">Sudah dikonfirmasi</span></h4>
		</div>
		<div>
		<div class="table-responsive">
			<table class="table table-hover" id="tb-reserveperson-konfirmasi">
				<thead>
					<tr>
						<th>No</th>
						<th>kdbook</th>
						<th>Nama pemesan</th>
						<th>Tgl pesan</th>
						<th>Check in</th>
						<th>Check out</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php 
					$no = 1;
					$getreserve_online = mysqli_query($konek,
						"SELECT b.kd_booking, m.id_member, m.nama_lengkap, m.alamat, b.checkin, b.checkout, b.tgl_booking, b.status_userbook
						 FROM booking b
						 JOIN member m ON b.id_member=m.id_member WHERE status_userbook!='BK' AND status_userbook!='CO' AND status_userbook!='CI'
						 ORDER BY  b.checkin DESC");
					while ($data=mysqli_fetch_array($getreserve_online)) {
					if ($data['status_userbook']=='CI') {$link ='disabled'; }else{$link =''; } ?>
				<tbody>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['kd_booking'];?></td>
						<td><?php echo $data['nama_lengkap'];?></td>
						<td><?php echo tgl_indo($data['tgl_booking']).gettimer($data['tgl_booking'])?></td>
						<td><?php echo tgl_indo($data['checkin']);?></td>
						<td><?php echo tgl_indo($data['checkout']);?></td>
						<td style="color:#fff;<?php echo colored_status($data['status_userbook']);?>"><?php echo statuspemesanan($data['status_userbook']);?></td>
						<td colspan="2">
							<a id="<?php echo $link;?>" class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserveonline_confrimation&id=$data[kd_booking]"; ?>"><i class="fa fa-check-square"></i> Confrim </a> 
							<a class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserveonline_detail&id=$data[kd_booking]"; ?>"> <i class="fa fa-search-plus"></i> View </a> 
							<a id="<?php echo $link;?>" class="none-underline" href="<?php echo "backend/proses_konfirmasi_pesan.php?act=hapus_reserveonline&id=$data[kd_booking]";?>" onclick="return confirm('Anda yakin meghapus pemesanan !!');"> <i class="fa fa-times"></i> Delete </a> 
						</td>
					</tr>
				</tbody>
			<?php $no++; } ?>
			</table>
			<div class="heading-status_booked" style="text-align:center;margin-top:150px;">
				<h4>Status Pemesanan : <span style="color:#FF5722;">Belum dikonfirmasi</span></h4>
			</div>
			<table class="table table-hover" id="tb-reserveperson-cancel">
				<thead>
					<tr>
						<th>No</th>
						<th>kdbook</th>
						<th>Nama pemesan</th>
						<th>Tgl pesan</th>
						<th>Check in</th>
						<th>Check out</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php 
					$no = 1;
					$getreserve_online = mysqli_query($konek,
						"SELECT b.kd_booking, m.id_member, m.nama_lengkap, m.alamat, b.checkin, b.checkout, b.tgl_booking, b.status_userbook
						 FROM booking b
						 JOIN member m ON b.id_member=m.id_member WHERE b.status_userbook='BK'
						 ORDER BY  b.checkin DESC");
					while ($data=mysqli_fetch_array($getreserve_online)) {
				?>
				<tbody>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['kd_booking'];?></td>
						<td><?php echo $data['nama_lengkap'];?></td>
						<td><?php echo tgl_indo($data['tgl_booking']).gettimer($data['tgl_booking'])?></td>
						<td><?php echo tgl_indo($data['checkin']);?></td>
						<td><?php echo tgl_indo($data['checkout']);?></td>
						<td style="color:#fff;<?php echo colored_status($data['status_userbook']);?>"><?php echo statuspemesanan($data['status_userbook']);?></td>
						<td colspan="2">
							<a class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserveonline_confrimation&id=$data[kd_booking]"; ?>"> <i class="fa fa-check-square"></i> Confrim </a> 
							<a class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserveonline_detail&id=$data[kd_booking]"; ?>"> <i class="fa fa-search-plus"></i> View </a>
							<a id="<?php echo $link;?>" class="none-underline" href="<?php echo "backend/proses_konfirmasi_pesan.php?act=hapus_reserveonline&id=$data[kd_booking]";?>" onclick="return confirm('Anda yakin meghapus pemesanan !!');"> <i class="fa fa-times"></i> Delete </a>
						</td>
					</tr>
				</tbody>
			<?php $no++; } ?>
			</table>
		</div>
		</div>
	</div>
</div>
