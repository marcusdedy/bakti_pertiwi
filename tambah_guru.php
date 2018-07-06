<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO guru (g_nip, u_uname, u_nama, g_tmp_lhr, g_tgl_lhr, g_jk, g_alamat, g_agama, g_status, nonaktif) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['g_nip'], "text"),
                       GetSQLValueString($_POST['g_nip'], "text"),
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['g_tmp_lhr'], "text"),
                       GetSQLValueString($_POST['g_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['g_jk'], "text"),
                       GetSQLValueString($_POST['g_alamat'], "text"),
                       GetSQLValueString($_POST['g_agama'], "text"),
                       GetSQLValueString($_POST['g_status'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Guru</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table class="table-form">
    <tr>
      <td width="83">NIP</td>
      <td width="393"><span id="sprytextfield1">
              <input class="form-control" type="text" name="g_nip" value="" size="32" placeholder="NIP"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="u_nama" value="" size="40" placeholder="Nama"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td><input class="form-control" type="text" name="g_tmp_lhr" value="" size="40" placeholder="Tempat Lahir"/></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><span id="sprytextfield3">
              <input class="form-control" type="text" name="g_tgl_lhr" value="" size="15" placeholder="Tanggal Lahir"/>
              <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.g_tgl_lhr);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
      <span class="textfieldRequiredMsg">Wajib Diisi</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select class="form-control" name="g_jk">
        <option value="Laki-laki" <?php if (!(strcmp("Laki-laki", ""))) {echo "SELECTED";} ?>>Laki-laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", ""))) {echo "SELECTED";} ?>>Perempuan</option>
      </select>      </td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="g_alamat" value="" size="50" placeholder="Alamat"/></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="g_agama" id="g_agama">
        <option value="Islam" selected="selected">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Hindu">Hindu</option>
        <option value="Budha">Budha</option>
        <option value="Konghucu">Konghucu</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Status</td>
      <td><input class="form-control" type="text" name="g_status" value="" size="32" placeholder="Status"/></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", ""))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", ""))) {echo "SELECTED";} ?> selected="selected">N</option>
      </select>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_guru'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy-mm-dd", validateOn:["change"]});
//-->
</script>
