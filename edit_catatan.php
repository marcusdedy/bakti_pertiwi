<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE catatan SET c_tanggal=%s, c_catatan=%s WHERE c_id=%s",
                       GetSQLValueString($_POST['c_tanggal'], "text"),
                       GetSQLValueString($_POST['c_catatan'], "text"),
                       GetSQLValueString($_POST['c_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_catatan = "-1";
if (isset($_GET['c_id'])) {
  $colname_rec_edit_catatan = $_GET['c_id'];
}

$query_rec_edit_catatan = sprintf("SELECT * FROM catatan WHERE c_id = %s", GetSQLValueString($colname_rec_edit_catatan, "int"));
$rec_edit_catatan = mysql_query($query_rec_edit_catatan, $koneksi) or die(mysql_error());
$row_rec_edit_catatan = mysql_fetch_assoc($rec_edit_catatan);
$totalRows_rec_edit_catatan = mysql_num_rows($rec_edit_catatan);

$query_rec_tampil_siswa = sprintf("SELECT catatan.c_nis, siswa.s_nis, siswa.u_nama FROM catatan, siswa WHERE catatan.c_nis = siswa.s_nis AND catatan.c_id = %s", GetSQLValueString($colname_rec_edit_catatan, "int"));
$rec_tampil_siswa = mysql_query($query_rec_tampil_siswa, $koneksi) or die(mysql_error());
$row_rec_tampil_siswa = mysql_fetch_assoc($rec_tampil_siswa);
$totalRows_rec_tampil_siswa = mysql_num_rows($rec_tampil_siswa);

$query_rec_tampil_tahun = sprintf("SELECT catatan.c_id_thn, tahun.t_id, tahun.t_nm, tahun.t_jn FROM catatan, tahun WHERE catatan.c_id_thn=tahun.t_id AND catatan.c_id = %s", GetSQLValueString($colname_rec_edit_catatan, "int"));
$rec_tampil_tahun = mysql_query($query_rec_tampil_tahun, $koneksi) or die(mysql_error());
$row_rec_tampil_tahun = mysql_fetch_assoc($rec_tampil_tahun);
$totalRows_rec_tampil_tahun = mysql_num_rows($rec_tampil_tahun);

?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Catatan Siswa</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIS :</td>
      <td><strong><?php echo htmlentities($row_rec_tampil_siswa['s_nis'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_tampil_siswa['u_nama'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Tahun :</td>
      <td><strong><?php echo htmlentities($row_rec_tampil_tahun['t_nm'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_tampil_tahun['t_jn'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>

    <tr>
      <td>Tanggal :</td>
      <td><input class="form-control" type="text" name="c_tanggal" value="<?php echo htmlentities($row_rec_edit_catatan['c_tanggal'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Catatan :</td>
      <td><input class="form-control" type="text" name="c_catatan" value="<?php echo htmlentities($row_rec_edit_catatan['c_catatan'], ENT_COMPAT, 'utf-8'); ?>" size="70" /></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_catatan'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="c_id" value="<?php echo $row_rec_edit_catatan['c_id']; ?>" />
</form>
