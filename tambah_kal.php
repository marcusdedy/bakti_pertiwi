<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kalender (k_t_id, k_mulai, k_selesai, k_ket) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['k_t_id'], "int"),
                       GetSQLValueString($_POST['k_mulai'], "date"),
                       GetSQLValueString($_POST['k_selesai'], "date"),
                       GetSQLValueString($_POST['k_ket'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

$query_rec_list_tahun = "SELECT * FROM tahun ORDER BY t_id ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Kalender</h3>
</div>
<form class="well" method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table-form">
    <tr>
      <td>Tahun Pelajaran</td>
      <td><select class="form-control" name="k_t_id" id="k_t_id">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
        <?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Mulai</td>
      <td>
          <input class="form-control" type="text" name="k_mulai" value="" size="15" placeholder="Tanggal Mulai">
          <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.k_mulai);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
      </td>
    </tr>
    <tr>
      <td>Selesai</td>
      <td>
        <input class="form-control" type="text" name="k_selesai" value="" size="15" placeholder="Tangal Selesai">
        <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.k_selesai);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
      </td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><textarea class="form-control" name="k_ket" cols="32"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan">
      <input class="btn btn-info" type="button" name="button2" id="button2" value="Kembali" onClick="location='index.php?page=tampil_kal'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
