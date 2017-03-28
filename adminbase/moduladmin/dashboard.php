<?php include "../fungsi/function_transaksi.php"; ?>
<div class="row">
    <div class="col-lg-12"> 
    	 <div class="font-sizerheading">
        	<h1 class="page-header">Dashboard</h1>                
    	 </div>
    </div>  
    <div class="col-lg-12"> 

    	<div>
    		<h4><?php echo "Selamat Datang ".$_SESSION['username']." di sistem balecatur inn" ?></h4>
            <p>Anda Login di sistem sebagai :<?php echo HakaksesUser($_SESSION['level_admin']);?></p>          
    	</div>  
    </div>  
</div>                