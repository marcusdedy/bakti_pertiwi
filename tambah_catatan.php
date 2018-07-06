<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO catatan (c_nis, c_id_thn, c_tanggal, c_catatan) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['c_nis'], "text"),
					   GetSQLValueString($_POST['c_id_thn'], "text"),
                       GetSQLValueString($_POST['c_tanggal'], "text"),
                       GetSQLValueString($_POST['c_catatan'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}



if (isset($_GET['kuncitahun'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_list_jadwal = $_SESSION['kuncitahun'];
}
else {
	if (isset($_SESSION['kuncitahun'])) {
	$colname1_rec_list_jadwal = $_SESSION['kuncitahun'];
	}
	else {
	$colname1_rec_list_jadwal = "";
	}
}

if (isset($_GET['kuncikelas'])) {
  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_list_siswa = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncikelas'])) {
	$colname2_rec_list_siswa = $_SESSION['kuncikelas'];
	}
	else {
	$colname2_rec_list_siswa = "";
	}
}

$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_kd ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);

$query_rec_list_siswa = sprintf("SELECT siswa.s_nis, siswa.u_nama, siswa.s_kd_kls, kelas.k_kd FROM siswa, kelas WHERE siswa.s_kd_kls=kelas.k_kd AND siswa.s_kd_kls=%s", GetSQLValueString($colname2_rec_list_siswa, "text"));
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);

?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Catatan Siswa</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tambah_catatan" />
  <table width="284" border="0" cellpadding="4">
    <tr>
      <td width="139">Tahun Pelajaran</td>
      <td width="129"><select class="form-control" name="kuncitahun" id="kuncitahun">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $colname1_rec_list_jadwal))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
        <?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
      </select>
</td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="kuncikelas" id="kuncikelas">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_kd'], $colname2_rec_list_siswa))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
        <?php
} while ($row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas));
  $rows = mysql_num_rows($rec_list_kelas);
  if($rows > 0) {
      mysql_data_seek($rec_list_kelas, 0);
	  $row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
  }
?>
      </select>
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" name="button" id="button" value="Cari Data" /></td>
    </tr>
  </table>
</form>


<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
<input type="hidden" name="c_id_thn" value="<?php echo $_SESSION['kuncitahun']; ?>" />
<table class="table-form">
    <tr>
      <td width="92">Nama Siswa</td>
      <td width="473"><select class="form-control" name="c_nis" id="c_nis">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_siswa['s_nis']?>"<?php if (!(strcmp($row_rec_list_siswa['s_nis'], $row_rec_list_siswa['u_nama']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_siswa['u_nama']?></option>
        <?php
} while ($row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa));
  $rows = mysql_num_rows($rec_list_siswa);
  if($rows > 0) {
      mysql_data_seek($rec_list_siswa, 0);
	  $row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
  }
?>
      </select></td>
    </tr>

    <tr>
      <td>Tanggal</td>
      <td>
      <input class="form-control" type="text" name="c_tanggal" value="yyyy-mm-dd" size="10" /></td>
    </tr>
    <tr>
      <td>Catatan</td>
      <td>
      <input class="form-control" type="text" name="c_catatan" value="" size="70" /></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button2" id="button2" value="Kembali" onClick="location='index.php?page=tampil_catatan'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["change"], minChars:1, maxChars:3, minValue:0, maxValue:100});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["change"], minChars:1, maxChars:3, minValue:0, maxValue:100});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["change"], minChars:1, maxChars:3, minValue:0, maxValue:100});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["change"], minChars:1, maxChars:3, maxValue:100, minValue:0});
//-->
</script>
