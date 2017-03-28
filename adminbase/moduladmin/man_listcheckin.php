<?php include "../fungsi/function_transaksi.php";?>
<script type="text/javascript">
	$(document).ready(function(){
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
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">List Transaksi Check-in</h1>
		</div>
		<div class="row">
		<div style="margin-top:20px;"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
				<table class="table table-hover" id="listcheckin">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode booking</th>
							<th>Nama Pemesan</th>
							<th>Checkin</th>
							<th>Checkout</th>
							<th>Tanggal booking</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=1;
						$x = mysqli_query($konek,"SELECT  b.kd_booking, m.id_member, m.nama_lengkap, b.checkin, b.checkout, b.tgl_booking, b.status_userbook, m.alamat
							FROM booking b JOIN member m ON b.id_member=m.id_member WHERE b.status_userbook='CI'");
						while ($r = mysqli_fetch_array($x)) {
						?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $r['kd_booking'];?></td>
							<td><?php echo $r['nama_lengkap'];?></td>
							<td><?php echo tgl_indo($r['checkin']);?></td>
							<td><?php echo tgl_indo($r['checkout']);?></td>
							<td><?php echo tgl_indo($r['tgl_booking']).gettimer($r['tgl_booking']);?></td>
							<td style="<?php echo colored_status($r['status_userbook']);?>; color:#fff;"><?php echo statuspemesanan($r['status_userbook']);?>
							</td>
							<td>
								<a href="<?php echo "homeadmin.php?modul=laporan_invoicedetail&id=$r[kd_booking]&member=$r[id_member]"?>">Create Invoice</a> ||
								<a href="<?php echo "homeadmin.php?modul=man_transaksi_checkout&id=$r[kd_booking]"?>"></i> Checkout</a> ||
								<a href="<?php echo "homeadmin.php?modul=man_transaksicheckin_detail&id=$r[kd_booking]"?>"><i class="fa fa-edit"></i> View</a> || 
								<a href="<?php echo "homeadmin.php?modul=man_accomodation_add&id=$r[kd_booking]"?>"><i class="fa fa-plus" aria-hidden="true"></i> layanan</a> 
								<!--<a href="<?php echo "homeadmin.php?modul=&id=$r[kd_booking]"?>"></i> Perpanjang</a> ||-->
							</td>
						</tr>
					<?php $no++; } ?> 
					</tbody>
				</table>
				</div><!-- responsive tabel -->
			</div>
		</div>
	</div>
</div>