<div class="row">
    <div class="col-lg-12">                
        <h1 class="page-header">Admin Profil | Ganti Password</h1>                
    </div>                
  	<div class="col-lg-12">
   	<div class="panel-body" style="width:30%;">
        <?php $ambil = mysql_fetch_array(mysql_query("select * from member where level = 'admin'"));
              $passwordlama = $ambil['password'];
        ?>
         <form role="form" action="<?php ?>" method="post">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password Lama" name="lama" type="password" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password Baru" name="baru" type="password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Ulangi Password Baru" name="baru2" type="password">
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <input type="submit" value="Submit" name="submit" class="btn btn-small btn-success">
                </fieldset>
            </form>
        </div>
        <?php 
          if (isset($_POST['submit'])) {
            if(empty($_POST['lama']) or empty($_POST['baru']) or empty($_POST['baru2'])) {
                echo '<div class="alert alert-danger">Tidak Boleh Kosong</div>';
            }
            else {
              if (md5($_POST['lama']) == $passwordlama) {

                if ($_POST['baru'] == $_POST['baru2']) {
                  $new = md5($_POST['baru']);
                  mysql_query("UPDATE member SET password ='$new' WHERE id_member = 1");
                  echo '<div class="alert alert-success">Password telah berubah silahkan Logout</div>';
                } else {
                  echo '<div class="alert alert-danger">Password tidak Sama</div>';
                }
              } else {
                  echo '<div class="alert alert-danger">Password Lama Salah</div>';
              }
            }
          }
        ?>
   	</div>       
</div>                