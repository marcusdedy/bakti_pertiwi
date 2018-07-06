<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pegawai (p_nip, p_nama, p_tmp_lhr, p_tgl_lhr, p_jk, p_alamat, p_agama, p_status, nonaktif) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['p_nip'], "text"),
                       GetSQLValueString($_POST['p_nama'], "text"),
                       GetSQLValueString($_POST['p_tmp_lhr'], "text"),
                       GetSQLValueString($_POST['p_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['p_jk'], "text"),
                       GetSQLValueString($_POST['p_alamat'], "text"),
                       GetSQLValueString($_POST['p_agama'], "text"),
                       GetSQLValueString($_POST['p_status'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Pegawai</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table class="table-form">
    <tr>
      <td>NIP</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="p_nip" value="" size="32" placeholder="NIP"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="p_nama" value="" size="32" placeholder="Nama"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td><input class="form-control" type="text" name="p_tmp_lhr" value="" size="32" placeholder="Tempat Lahir"/></td>
    </tr>
    <tr>
      <td>Tgl Lahir</td>
      <td><input class="form-control" type="text" name="p_tgl_lhr" value="" size="15" placeholder="Tanggal Lahir"/>
            <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.p_tgl_lhr);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
      </td>
    </tr>
    <tr>
      <td>Jenik Kelamin</td>
      <td><select class="form-control" name="p_jk" id="p_jk">
        <option value="Laki-laki" selected="selected">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="p_alamat" value="" size="32" placeholder="Alamat"/></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="p_agama" id="p_agama">
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
      <td><input class="form-control" type="text" name="p_status" value="" size="32" placeholder="Status"/></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="N" selected="selected">N</option>
        <option value="Y">Y</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_peg'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>
