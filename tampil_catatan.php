<?php


if (isset($_GET['kuncitahun'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_tampil_catatan = $_SESSION['kuncitahun'];
}
else {
	if (isset($_SESSION['kuncitahun'])) {
	$colname1_rec_tampil_catatan = $_SESSION['kuncitahun'];
	}
	else {
	$colname1_rec_tampil_catatan = "";
	}
}

if (isset($_GET['kuncikelas'])) {
  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_tampil_catatan = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncikelas'])) {
	$colname2_rec_tampil_catatan = $_SESSION['kuncikelas'];
	}
	else {
	$colname2_rec_tampil_catatatn = "";
	}
}

if (isset($_GET['kuncisiswa'])) {
  $_SESSION['kuncisiswa'] = $_GET['kuncisiswa'];
  $colname3_rec_tampil_catatan = $_SESSION['kuncisiswa'];
}
else {
	if (isset($_SESSION['kuncisiswa'])) {
	$colname3_rec_tampil_catatan = $_SESSION['kuncisiswa'];
	}
	else {
	$colname3_rec_tampil_catatan = "";
	}
}

$maxRows_rec_tampil_catatan = 10;
$pageNum_rec_tampil_catatan = 0;
if (isset($_GET['pageNum_rec_tampil_catatan'])) {
  $pageNum_rec_tampil_catatan = $_GET['pageNum_rec_tampil_catatan'];
}
$startRow_rec_tampil_catatan = $pageNum_rec_tampil_catatan * $maxRows_rec_tampil_catatan;

$query_rec_tampil_catatan = sprintf("SELECT catatan.c_id, catatan.c_nis, catatan.c_id_thn, catatan.c_tanggal, catatan.c_catatan,
kelas.k_kd, kelas.k_nm,
siswa.s_nis, siswa.u_nama as s_nama,
tahun.t_id, tahun.t_nm, tahun.t_jn
FROM catatan, kelas, siswa, tahun
WHERE catatan.c_nis=siswa.s_nis
AND catatan.c_id_thn=tahun.t_id
AND catatan.c_id_thn=%s
AND kelas.k_kd=%s
AND catatan.c_nis=%s",
	GetSQLValueString($colname1_rec_tampil_catatan, "text"),
	GetSQLValueString($colname2_rec_tampil_catatan, "text"),
	GetSQLValueString($colname3_rec_tampil_catatan, "text"));
$query_limit_rec_tampil_catatan = sprintf("%s LIMIT %d, %d", $query_rec_tampil_catatan, $startRow_rec_tampil_catatan, $maxRows_rec_tampil_catatan);
$rec_tampil_catatan = mysql_query($query_limit_rec_tampil_catatan, $koneksi) or die(mysql_error());
$row_rec_tampil_catatan = mysql_fetch_assoc($rec_tampil_catatan);

if (isset($_GET['totalRows_rec_tampil_catatan'])) {
  $totalRows_rec_tampil_catatan = $_GET['totalRows_rec_tampil_catatan'];
} else {
  $all_rec_tampil_catatan = mysql_query($query_rec_tampil_catatan);
  $totalRows_rec_tampil_catatan = mysql_num_rows($all_rec_tampil_catatan);
}
$totalPages_rec_tampil_catatan = ceil($totalRows_rec_tampil_catatan/$maxRows_rec_tampil_catatan)-1;

$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N'";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N'";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);

$query_rec_list_siswa = "SELECT * FROM siswa WHERE nonaktif='N' AND s_kd_kls='".$colname2_rec_tampil_catatan."' ORDER BY u_nama";
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Catatan</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tampil_catatan" />
  <table width="279" border="0">
    <tr>
      <td width="113">Tahun Pelajaran</td>
      <td width="150"><select class="form-control" name="kuncitahun" id="kuncitahun">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $colname1_rec_tampil_catatan))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
        <?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
      </select>      </td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="kuncikelas" id="kuncikelas">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_kd'], $colname2_rec_tampil_catatan))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
        <?php
} while ($row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas));
  $rows = mysql_num_rows($rec_list_kelas);
  if($rows > 0) {
      mysql_data_seek($rec_list_kelas, 0);
	  $row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
  }
?>
      </select>      </td>
    </tr>
    <tr>
      <td>Siswa</td>
      <td><select class="form-control" name="kuncisiswa" id="kuncisiswa">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_siswa['s_nis']?>"<?php if (!(strcmp($row_rec_list_siswa['s_nis'], $colname3_rec_tampil_catatan))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_siswa['u_nama']?></option>
        <?php
} while ($row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa));
  $rows = mysql_num_rows($rec_list_siswa);
  if($rows > 0) {
      mysql_data_seek($rec_list_siswa, 0);
	  $row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
  }
?>
      </select>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" name="button" id="button" value="Cari" /></td>
    </tr>
  </table>
</form>
<p><a class="btn btn-success" href="index.php?page=tambah_catatan">Tambah Catatan</a></p>
<table class="table table-bordered">
    <thead>
  <tr>
    <th width="20">#</th>
    <th>Tahun</th>
    <th>Kelas</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
	  <th>Tanggal</th>
    <th>Catatan</th>
    <th width="35">Aksi</th>
  </tr>
    </thead>
    <tbody>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rec_tampil_catatan['c_id']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['t_nm']; ?> - <?php echo $row_rec_tampil_catatan['t_jn']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['k_nm']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['s_nis']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['s_nama']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['c_tanggal']; ?></td>
      <td><?php echo $row_rec_tampil_catatan['c_catatan']; ?></td>

      <td><a href="index.php?page=edit_catatan&amp;c_id=<?php echo $row_rec_tampil_catatan['c_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
  <?php } while ($row_rec_tampil_catatan = mysql_fetch_assoc($rec_tampil_catatan)); ?>
    </tbody>
</table>
