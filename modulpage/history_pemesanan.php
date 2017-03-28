<script type="text/javascript">
	$(document).ready(function(){
		$("#disable").prop("disabled", false);
	});
</script>
<?php include "fungsi/function_transaksi.php";
$userid=$_SESSION['id_member'];?>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">HISTORY PEMESANAN</h1>
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
          		<li class="active">My Order</li>
			</ol>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading"><strong><h6>DASHBOARD USER</h6></strong></div>
						<div class="left-sidebarorder">
							<ul class="list-unstyled">
								<?php 
									$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
									if($url == $site."index.php?modul=myorder") {
										$url_myorder = "active";
									}
								?>
								<li><a class="none-underline <?php echo $url_myorder; ?>" href="<?php echo "$site"."index.php?modul=myorder";?>"><i class="fa fa-shopping-basket fa-fw"></i> My order</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=manageakun";?>"><i class="fa fa-user fa-fw"></i> My profil</a></li>
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=";?>"><i class="fa fa-search-plus fa-fw"></i> History pemesanan</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="table-responsive clearfix-bottom-50">
					<form action="<?php echo $site;?>modulpage/proses/reservation-proses.php" method="post" enctype="multipartformdata">
						<table class="table table-inverse table-hover" id="table-myorder" style="font-size:12px;">
							<thead>
								<tr>
									<th>Kode Booking</th>
									<th>Nama Pemesan</th>
									<th>Kebangsaan</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Status</th>
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no=1;
								$getdata_booking = "SELECT b.kd_booking, m.id_member, m.nama_lengkap, m.kebangsaan ,b.checkin, b.checkout, b.status_userbook
													FROM booking b JOIN member m ON b.id_member=m.id_member
													WHERE m.id_member='$userid' AND b.status_userbook='CO'";
								$saved = mysqli_query($konek, $getdata_booking);
								while ($data=mysqli_fetch_array($saved)) {
							?>
								<tr>
									<td><?php echo $data['kd_booking'];?></td>
									<td><?php echo $data['nama_lengkap'];?></td>
									<td><?php echo $data['kebangsaan'];?></td>
									<td><?php echo tgl_indo($data['checkin']);?></td>
									<td><?php echo tgl_indo($data['checkout']);?></td>
									<td style="color:#fff;<?php echo colored_status($data['status_userbook']);?>"><?php echo statuspemesanan($data['status_userbook']);?></td>
									<td colspan="2">
										<a class="none-underline" href="<?php echo $site;?>index.php?modul=orderdetail&id=<?php echo $data['kd_booking']?>">View </a>
									</td>
								</tr>
								<?php $no++; } ?>	
							</tbody>
						</table>	
					</form>
					</div>
				</div>
			</div>
		</div><!-- main container primary -->
	</div>
</div>