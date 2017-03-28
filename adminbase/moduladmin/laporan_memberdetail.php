<?php  include "../fungsi/function_transaksi.php"; include "../fungsi/function_windowprint.php"; ?>
<style type="text/css">
	/*using media print to write a code into document !!*/
	@media print {
		body, html, #wrapper {
		  width: 100%;
		  display: inline-block;
	      font-size: 11px !important;
		}
		/* remove all when button print already click*/
		.btn-warning, .page-header, .navigation-rules {
			display: none;
		}
	}
	.main-headermemberspace{
    	margin-bottom: 20px;
	}
	.main-containerdetail{
		display: block;
		padding: 0px 66px;
	}
	td{
		padding: 6px;
	}
	.img_member{
		display: block;
		float: right;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading"><h1 class="page-header">Laporan Member</h1>
			<div style="margin-bottom:20px;">
				<a href="homeadmin.php?modul=laporan_memberhotel" class="navigation-rules"><~ Go back</a>
			</div>
			<input type="hidden" value="<?php echo $_GET['id'];?>">
			<div class="main-headermember">
				<img style="display:inline-block;width:88%;height: auto;" src="<?php echo "$site"."frontend/icon/header-member.png";?>">
			</div>
			<?php

				$getdatamember = mysqli_query($konek,"SELECT * FROM member WHERE id_member='$_GET[id]'");
				while ($data=mysqli_fetch_array($getdatamember)) {
				$url_pic = $site."uploads/identitas/".$data['foto_identitas'];
				
			?>
			<div class="main-containerdetail">
				<img class="img_member" width="150" height="auto" src="<?php echo $site;?>uploads/user/<?php echo $data['foto'];?>">
			<table>
				<tr>
					<td>Id Member </td>
					<td> :</td>
					<td><?php echo $data['id_member'];?></td>
					<td class="margin-right:100px;"></td>
				</tr>
				<tr>
					<td>Nama Lengkap </td>
					<td> :</td>
					<td><?php echo $data['nama_lengkap'];?></td>
				</tr>
				<tr>
				</tr>
					<td>Jenis Kelamin</td>
					<td> :</td>
					<td><?php echo $data['jenis_kelamin'];?></td>
				<tr>
					<td>No Telp</td>
					<td>: </td>
					<td><?php echo $data['no_telp']; ?></td>
				</tr>					
					<td>Email</td>
					<td>: </td>
					<td><?php echo $data['email']; ?></td>
				<tr>
					<td>Alamat</td>
					<td>: </td>
					<td><?php echo $data['alamat']; ?></td>
				</tr>
				<tr>
					<td>Kebangsaan</td>
					<td>: </td>
					<td><?php echo $data['kebangsaan']; ?></td>
				</tr>
				<tr>
					<td>Jenis Identitas</td>
					<td>: </td>
					<td><?php echo $data['jenis_identitas']; ?></td>
				</tr>
				<tr>
					<td>Nomor Identitas</td>
					<td>: </td>
					<td><?php echo $data['identitas_user']; ?></td>
				</tr>
				<tr>
					<td>Bukti Identitas</td>
					<td>: </td>
					<td><img width="150" height="auto" src="<?php echo $url_pic;?>"></td>
				</tr>
			<?php } ?>	
			</table>
			</div>
				<div class="row" style="margin-top:100px;">
					<div class="col-md-3 pull-right">
						<p style="font-weight:bold;">Yogyakarta <?php echo tgl_indo($datenow =date('Y-m-d'));?></p>
						<p style="margin-bottom:50px;">Mengetahui</p>
						<p>Liany Heviana</p>
					</div>
				</div>
				<div style="margin:50px 0px 6% 70px">
					<a href="" onclick="windowprint();" class="btn btn-warning">Cetak Laporan Member</a>
				</div>
		</div>
	</div>
</div>
