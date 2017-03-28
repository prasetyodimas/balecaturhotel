<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox-effects-a').fancybox();
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">ROOM FEATURES</h1>
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Room Features</li>
				</ol>
	  		    <div class="row">
				<?php
					$getdatakamar = mysqli_query($konek,"SELECT * FROM kategori_kamar ORDER BY type_kamar DESC");
					while ($data=mysqli_fetch_array($getdatakamar)) {
					$urlpic = $site."uploads/kamar/$data[foto_kamar]";
				?>
	  		    <div class="col-md-4">
	  		    	<div class="box-imagesreen">
		  		    	<a class="fancybox-effects-a" href="<?php echo $urlpic;?>">
			    		<img class="img-responsive" src="<?php echo $urlpic;?>"></a>
	  		    	</div>
	  		    	<div class="judul-roomfeatures">
						<?php echo $data['type_kamar']; ?>
					</div>
					<div>
  		    			<p><?php echo $data['fasilitas']; ?></p>
  		    			<p>Keterangan : <?php echo $data['deskripsi']; ?></p>
					</div>
	  		    </div>
				<?php } ?>
	  		    </div>
	  		<div class="clearfix-bottoms"></div>
		</div>
	</div>
</div>


