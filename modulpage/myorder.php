<?php include "fungsi/function_transaksi.php";
$userid = $_SESSION['id_member'];
	if (empty($_SESSION['id_member'])) {
		echo "<script>alert('Maaf anda tidak memiliki hak akses !!')</script>";
		echo "<meta http-equiv=refresh content=0;url=$site"."index.php?modul=homepage>";
	}else{
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#disabled").prop("disabled", false);
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
		<h1 class="fnt-style">MY ORDER</h1>
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
								<li><a class="none-underline" href="<?php echo "$site"."index.php?modul=history_pemesanan";?>"><i class="fa fa-search-plus fa-fw"></i> History pemesanan</a></li>
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
								$getdata_booking = "SELECT b.kd_booking, m.id_member, m.nama_lengkap, m.kebangsaan ,b.checkin, b.checkout, b.status_userbook
													FROM booking b JOIN member m ON b.id_member=m.id_member
													WHERE m.id_member='$userid' AND b.status_userbook!='CO'";
								$saved = mysqli_query($konek, $getdata_booking);
								$no=1;
								while ($data=mysqli_fetch_array($saved)) {
								if ($data['status_userbook']=='CI') {$link ='disabled'; }else{$link =''; } ?>
								<tr>
									<td><?php echo $data['kd_booking'];?></td>
									<td><?php echo $data['nama_lengkap'];?></td>
									<td><?php echo $data['kebangsaan'];?></td>
									<td><?php echo tgl_indo($data['checkin']);?></td>
									<td><?php echo tgl_indo($data['checkout']);?></td>
									<td style="color:#fff;<?php echo colored_status($data['status_userbook']);?>"><?php echo statuspemesanan($data['status_userbook']);?></td>
									<td colspan="2">
										<a id="<?php echo $link;?>" class="none-underline" href="<?php echo $site;?>index.php?modul=konfrimasi_pembayaran&kode_book=<?php echo $data['kd_booking'];?>">Konfrimasi ||</a>
										<a class="none-underline" href="<?php echo $site;?>index.php?modul=orderdetail&id=<?php echo $data['kd_booking']?>">View ||</a>
										<!-- <a class="none-underline" href="<?php echo $site;?>index.php?modul=cetak_buktibooking&id=<?php echo $data['kd_booking']?>">Cetak</a> -->		
										<a id="<?php echo $link;?>" class="<?php echo $link;?> none-underline" href="<?php echo $site;?>index.php?modul=cancelorder&kode_book=<?php echo $data['kd_booking'];?>" onclick="return confirm('Anda yakin batal order !!');"> Cancel Order</a>
									</td>
								</tr>
								<?php $no++; } ?>	
							</tbody>
						</table>	
					</form>
					</div>
					<?php
						$get_booked = mysqli_query($konek,"SELECT * FROM booking WHERE id_member='$userid' AND status_userbook!='CO'");
						while ($view_booking = mysqli_fetch_array($get_booked)) {
							if ($view_booking['status_userbook']=='BK' || $view_booking['status_userbook']=='KF' || $view_booking['status_userbook']=='RF'){
								$link_act ='disabled';
							}else{
								$link_act ='';
							}
					?>
					<div class="row">
						<div class="col-lg-12">
							<p>Status Transaksi & Kebijakan Transaksi</p>
							<div class="iconia-status-user">
								<article class="notifier-user">
									<p><div class="block-notifred"></div> Waiting payment / belum melakukan pembayaran DP / LUNAS</p>
									<p><div class="block-notifyellow"></div> Waiting confirmation / sudah melakukan pembayaran DP ataupun LUNAS, menunggu konfrimasi Admin Balecatur Hotel </p>
									<p><div class="block-notifgreen"></div> Approve confrimation transaksi sudah dikonfrimasi oleh admin Balecatur Hotel, untuk melanjutkan prosedur reservasi diharapkan
									anda untuk mencetak bukti pemesanan di link bawah ini. 
										<a id="<?php echo $link_act;?>" class="none-underline alink-confirm" href="<?php echo $site;?>index.php?modul=cetak_buktibooking&kode_book=<?php echo $view_booking['kd_booking']?>">
										Cetak Bukti  </a></p>
									<p>* catatan : Jika pemesanan anda tidak mengkonfirmasi maka pemesanan akan diblokir otomatis oleh sistem dan hak anda sebagai tamu untuk menginap pada permintaan anda akan kami batalkan.</p>
								</article>
							</div>
							<?php } ?>
						</div><!-- col-lg-12-->
					</div>
				</div>
			</div>
			
		</div><!-- main container primary -->
	</div>
</div>
<?php } ?>