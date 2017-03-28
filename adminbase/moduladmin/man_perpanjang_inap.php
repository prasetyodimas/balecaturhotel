<?php include "../fungsi/function_transaksi.php";?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.clikced').click(function(){
			$('.show-date').show('slow');			
		});
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="font-sizerheading">
			<h1 class="page-header">Man Perpanjang Inap</h1>
		</div>
		<style type="text/css">
			.man_information-user .man-kode_pemesan{margin-left: 88px; } 
			.man_information-user .man-nama_pemesan{margin-left: 100px; } 
			.man_information-user .man-alamat-pemesan{margin-left: 158px; } 
			.man_information-user .man-kebangsaan-pemesan{margin-left: 122px; } 
			.man_information-user .man-checkin-pemesan{margin-left: 98px; }
			.man_information-user .man-checkout-pemesan{margin-left: 89px; } 
			.man_information-user .man-tgl-pemesan{margin-left: 109px; } 
			/*TABLES*/
			table > thead > tr > th.information-price{
				padding: 20px;
			}
			table > tbody > tr > td.informa-prices{
				padding: 5px;
			}
			table > tfoot > tr > th.information-subtotal{
				padding: 3px 9px;
			}
		</style>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Informasi Pemesan</label>
				</div>
				<section class="man_information-user">
					<?php
						$get_boook = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM booking b JOIN member m ON b.id_member=m.id_member WHERE b.kd_booking='$_GET[id]'"));
					?>
						<p>Kode Pemesanan<span class='man-kode_pemesan'>: <?php echo $_GET['id'];?></span></p>
						<p>Nama Pemesan<span class='man-nama_pemesan'>: <?php echo $get_boook['nama_lengkap'];?></span></p>
						<p>Alamat<span class='man-alamat-pemesan'>: <?php echo $get_boook['alamat'];?></span></p>
						<p>Tanggal Checkin<span class='man-checkin-pemesan'>: <?php echo tgl_indo($get_boook['checkin']);?></span></p>
						<p>Tanggal Checkout<span class='man-checkout-pemesan'>: <?php echo tgl_indo($get_boook['checkout']);?></span></p>					
						<p>Tanggal Pesan<span class='man-tgl-pemesan'>: <?php echo tgl_indo($get_boook['tgl_booking']);$convert=substr($get_boook['tgl_booking'],10); echo $convert;?></span></p>					
				</section>
				<div class="row form-group">
					<div class="col-md-3">
					<button class="clikced" value="submit">Perpanjang Inap Kamar</button>
						<input type="text" class="show-date form-control" name="perp_checkout" id="datepicker-example7-end" style="display:none;cursor:pointer;">
					</div>
				</div>
				<!-- INFORMASI KEUANGAN -->
				<section class="man_information-keuangan form-group">
					<div class="form-group">
						<label>Informasi Keuangan</label>
					</div>
					<div class="table-responsive">
						<table border="1" class="table-hover">
							<thead>
								<tr>
									<th class="information-price">No</th>
									<th class="information-price">Nama kamar</th>
									<th class="information-price">No kamar</th>
									<th class="information-price">Biaya perkamar</th>
									<th class="information-price">Total biaya layanan</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no=1;
								$get_kamar = mysqli_query($konek,
								   "SELECT dbk.kd_booking, k.id_kamar, km.id_kategori_kamar, km.type_kamar, km.tarif 
								    FROM kamar k JOIN detail_booking_kamar dbk ON k.id_kamar=dbk.id_kamar
									JOIN kategori_kamar km ON k.id_kategori_kamar=km.id_kategori_kamar
									WHERE dbk.kd_booking='$_GET[id]'");
									while ($res = mysqli_fetch_array($get_kamar)) {

								
							?>
								<tr>
									<td class="informa-prices"><?php echo $no;?></td>
									<td class="informa-prices"><?php echo $res['type_kamar'];?></td>
									<td class="informa-prices"><?php echo $res['id_kamar'];?></td>
									<td class="informa-prices">Rp.<?php echo formatuang($res['tarif']);?>/ night</td>
									<td class="informa-prices">-</td>
								</tr>
							</tbody>
							<?php $no++; } ?> 
							<tfoot>
								<tr>
									<th class="information-subtotal" colspan="4">Biaya keterlambatan checkout</th>
									<th class="information-subtotal">0</th>
									<th class="information-subtotal">-</th>
								</tr>
								<tr>
									<th class="information-subtotal" colspan="4">Hutang checkin</th>
									<th class="information-subtotal">Rp.</th>
									<th class="information-subtotal">-</th>
								</tr>
								<tr>
									<th class="information-subtotal" colspan="4">Biaya perpanjangan</th>
									<th class="information-subtotal">-</th>
									<th class="information-subtotal">-</th>
								</tr>
								<tr>
									<th class="information-subtotal" colspan="4">Total yang harus dibayar saat checkout</th>
									<th class="information-subtotal" colspan="2">Rp.<?php echo formatuang($get_boook['total_biayasewa']);?></th>
								</tr>
							</tfoot>
						</table>
					</div><!-- responsive tabel -->
				</section>
				<!-- END OF KONFIRMASI KEUANGAN -->
				<div class="action-button">
					<button type="submit">Cetak Bukti</button>
				</div>
				<div class="clearfix-bottom-100"></div>
			</div>
		</div>
	</div>
</div>