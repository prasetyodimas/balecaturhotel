<?php error_reporting(0);?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox-effects-a').fancybox();
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="post-rulefontorder">
			<h1 class="fnt-style">GALLERY</h1>
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Gallery</li>
				</ol>
	  		    <div class="row">
				<?php
					$getdatakamar = mysqli_query($konek,"SELECT * FROM gallery ORDER BY id_gallery DESC");
					while ($data=mysqli_fetch_array($getdatakamar)) {
					$urlpic = $site."uploads/gallery/$data[foto_gallery]";
				?>
	  		    <div class="col-md-4">
	  		    	<div class="box-imagescreen">
	  		    		<a class="fancybox-effects-a" href="<?php echo $urlpic;?>" title="<?php echo $data['deskripsi_foto'];?>">
	      				<img class="img-responsive" src="<?php echo $urlpic;?>" alt=""/></a>
	  		    	</div>
	  		    	<div class="judul-roomfeatures">
						<?php echo $data['type_kamar']; ?>
					</div>
	  		    </div>
				<?php } ?>
	  		    </div>
	  		<div class="clearfix-bottoms"></div>
		</div>
	</div>
</div>













