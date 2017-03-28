<?php include "../fungsi/function_transaksi.php"; ?>
<style type="text/css">
  .spacer-form{
    margin-bottom: 10px;
    width: 100%;
    margin-left: 10px;
    font-weight: normal;
  }
/* CONFIGURE FORM SUBMIT*/
.navigation-formsubmit{
    margin-left: 78px;
    margin-top: 10px;
}
</style>
<div class="row">
  <div class="col-lg-12">   
    <div class="font-sizerheading">             
      <h1 class="page-header">Manajemen Edit Kamar</h1> 
    </div>               
  </div>                
<div class="col-lg-12">
<?php 
    $aksi="backend/proses_kamar.php";
    $getdatakamar=mysqli_query($konek,"select * from kamar where id_kamar='$_GET[id]'");
    $r=mysqli_fetch_array($getdatakamar);
echo "
    <form method=POST action='$aksi?modul=man_kamaredit&act=update_kamar' enctype=multipart/form-data>
        <input type=hidden name=id value='$r[id_kamar]'>
          <table>
            <tr>
                <td>No kamar </td>
                <td>:</td>
                <td><label class='spacer-form'>
                    <input type=text name='id_kamar' readonly='' class='form-control' value='$r[id_kamar]'>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Kategori kamar</td>
                <td>:</td>
                <td><label class='spacer-form'>
                    <select name='kategori' class='form-control'>"; ?>
              <?php 
                $tampil=mysqli_query($konek,"SELECT * FROM kategori_kamar ORDER BY id_kategori_kamar ASC");
                  if ($r['id_kategori_kamar']==0){
                    echo "<option value=0 selected>- Pilih Tipe Kamar -</option>";
                  }   
                  while($w=mysqli_fetch_array($tampil)){

                    if ($r['id_kategori_kamar']==$w['id_kategori_kamar']){
                      echo "<option value=$w[id_kategori_kamar] selected>$w[type_kamar]</option>";

                    }else{
                      echo "<option value=$w[id_kategori_kamar]>$w[type_kamar]</option>";
                    }
                  }
              echo "</label>
              </select>";
                ?>
<?php echo "</td>
          </tr>
          <tr>
              <td>Status kamar </td>
              <td>:</td>
              <td><label class='spacer-form'>
                  <select name='status_kamar' class='form-control'>";?>
                    <option value='<?php echo $r['status_kamar']?>'><?php echo checkStatuskamar($r['status_kamar']);?></option>
                    <option value="0">kamar sedang dicheck</option>
                    <option value="1">kamar sedang dibersikan</option>
                    <option value="2">kamar siap digunakan</option>
           <?php echo "</select>
                  </label>
              </td>
          </tr>
        </table>
      <div class='navigation-formsubmit'>
          <input type=submit value=Update class='btn btn-small btn-success'>
          <input type=button value=Batal class='btn btn-small' onclick=self.history.back()>
       </div>
    </form>";
?>
  </div>
</div>