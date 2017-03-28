<?php include "../fungsi/function_transaksi.php"; ?>
<div class="row">
    <div class="col-lg-12"> 
        <div class="font-sizerheading">
          <h1 class="page-header">Manajemen Edit Laundry</h1>                
        </div>               
    </div>                
  	<div class="col-lg-12">
<?php 
    $aksi="backend/proses_laundry.php";
    $edit=mysqli_query($konek,"select * from laundry where id_laundry='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
echo "
    <form method=post enctype='multipart/form-data' id='edit-berita' action='$aksi?modul=man_laundry_edit&act=edit_laundry'>
      <input type=hidden name=id value='$r[id_laundry]'>";?>
 <table>
        <tbody>
          <tr>
            <td>Jenis Laundry</td>
            <td>:</td>
            <td><label class='spacer-form' style="font-weight:normal;">
                <select name='jenis_laundry' class='form-control' autofocus required>
                  <option value='<?php echo $r['jenis_laundry'];?>'><?php echo $r['jenis_laundry'];?></option>
                  <option>Layanan Biasa</option>
                  <option>Layanan Express</option>
                  <option>Layanan Kilat</option>
                </select>
              </label>
            </td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>:</td>
            <td><label class='spacer-form' style="font-weight:normal;">
              <input id="num" onkeyup="document.getElementById('format').innerHTML=formatCurrency(this.value);"  type='text' name='harga_laundry' value='<?php echo $r['harga_laundry']?>' class='form-control'>
                      <span style='display: block;position: relative;top: -27px;left:482px;' id="format"></span>
              </label>
            </td>
          </tr>
          <tr>
            <td>Keterangan kendaraan</td>
            <td>:</td>
            <td><label class='spacer-form' style="font-weight:normal;">
              <textarea name='ket_laundry' cols='80' rows='8' class='form-control'><?php echo $r['ket_laundry']?></textarea>
              </label>
            </td>
          </tr>
        </tbody>
      </table>
     <div class="navigation-rolelaundry">
        <input type='submit' value='Update' class='btn btn-small btn-success'>
        <input type='button' value='Batal' class='btn btn-small' onclick='self.history.back()'>
    </div>
</form>



