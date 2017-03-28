<script type="text/javascript">
	$(document).ready(function(){

		$('#tb-reservecahsier').dataTable( {
	        // Sets the row-num-selection "Show %n entries" for the user
	      "lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ], 
	      // Set the default no. of rows to display
	      "pageLength": 10 
	      });

	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Reservasi Offline / Manajemen Transaksi Check-in Langsung</h1>
		</div>
		<form action="<?php echo $site;;?>adminbase/proses.php?act=acc_kamar" method="post" role="form" enctype="multipart/form-data">
		<table class="table tables-bordered" id="tb-reservecahsier">
			<thead>
				<tr>
					<th>No</th>
					<th>kd booking</th>
					<th>Nama pemesan</th>
					<th>Tipe kamar</th>
					<th>Check-in</th>
					<th>Check-out</th>
					<th>Action</th>
				</tr>
			</thead>
				<tbody>
				<?php 

					$getreserve_online = mysqli_query($konek,"SELECT * FROM transaksi_langsung tr JOIN member m ON  m.id_member=tr.id_member
																		JOIN kategori_kamar k ON tr.id_kategori_kamar=k.id_kategori_kamar 
																		ORDER BY tr.kd_transaksilgsng DESC");
					$no = 1;
					while ($data=mysqli_fetch_array($getreserve_online)) {
					
					//define status booking
					if ($data['status']==0) {
							$statusbooking='waiting payment';
					}elseif($data['status']==1) {
							$statusbooking='payment accepted';			
					}elseif($data['status']==2) {
							$statusbooking='payment complete';	
					}
					 
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['kd_transaksilgsng'];?></td>
						<td><?php echo $data['nama_lengkap'];?></td>
						<td><?php echo $data['type_kamar'];?></td>
						<td><?php echo tgl_indo($data['checkin_lgsng']);?></td>
						<td><?php echo tgl_indo($data['checkout_lgsng']);?></td>
						<td colspan="2">
							<a class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserveoffline_detail&id=$data[kd_transaksilgsng]"; ?>"
								<i class="fa fa-search-plus"></i> View
							</a>
							<a class="none-underline" href="<?php echo "homeadmin.php?modul=man_reserve_struck&id=$data[kd_transaksilgsng]"; ?>"
							 onclick="return confirm('Cetak transaksi untuk tamu ?');">
							 	<i class="fa fa-clipboard"></i> Cetak Transaksi
							</a>
							<a class="none-underline" href="<?php echo "proses.php?act=hapus_trnaslangsung&id=$data[kd_transaksilgsng]";?>" onclick="return confirm('Anda yakin meghapus pemesanan !!');">
								<i class="fa fa-times"></i> Delete
							</a>
						</td>
					</tr>
				<?php $no++; } ?>
				</tbody>
		</table>
		</form>
		</div>
	</div>
</div>