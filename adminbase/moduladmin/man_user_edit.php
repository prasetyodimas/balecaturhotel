<div class="row">
    <div class="col-lg-12">
      <div class="font-sizerheading">
        <h1 class="page-header">Manajemen Edit User</h1>
      </div>
    </div>
<div class="col-lg-12">

<?php

$aksi="backend/proses_man_user.php";

    $edit=mysqli_query($konek,"select * from admin where id_admin='$_GET[id]'");
    $r=mysqli_fetch_array($edit);

echo "<form method=POST action=$aksi?modul=man_user_edit&act=updateUser>
          <input type=hidden name=id value='$r[id_admin]'>
          <fieldset>
          <table>
            <tbody>
              <tr>
                <td><label class=''>Nama User :</label></td>
                <td><input type='text' name='username' class='form-control' value='$r[username]'></input></td>
              </tr>
              <tr>
                <td><label>Hak akses</label></td>
                <td>
                  <select name='' class='form-control' style='width:20%;'>
                    <option value='1'></option>
                    <option value='2'></option>
                    <option value='3'></option>
                    <option value='4'></option>
                  </select>            
                </td>
              </tr>
            </tbody>
          </table>
          <div class='form-group'>
          	Blokir User : "?>
              <?php
              if ($r['status'] == "Y") {
                echo '<label class="radio-inline">
                          <input type="radio" name="blokir" value="Y" checked> Ya
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="blokir" value="N"> Tidak
                        </label>';

              } else {
                echo '<label class="radio-inline">
                          <input type="radio" name="blokir" value="Y"> Ya
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="blokir" value="N" checked> Tidak
                        </label>';

              }

            ?>
<?php echo"</div>
          <input type=submit value=Update class='btn btn-small btn-success'>
          <input type=button value=Batal class='btn btn-small' onclick=self.history.back()>
          </fieldset>
    </form>";
?>

	</div>
</div>
