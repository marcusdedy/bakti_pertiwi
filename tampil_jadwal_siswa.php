<?php


if (isset($_GET['kuncitahun'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_jadwal_siswa = $_SESSION['kuncitahun'];
}
else {
	if (isset($_SESSION['kuncitahun'])) {
	$colname1_rec_jadwal_siswa = $_SESSION['kuncitahun'];
	}
	else {
	$colname1_rec_jadwal_siswa = "";
	}
}

if (isset($_GET['kuncikelas'])) {
  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_jadwal_siswa = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncikelas'])) {
	$colname2_rec_jadwal_siswa = $_SESSION['kuncikelas'];
	}
	else {
	$colname2_rec_jadwal_siswa = "";
	}
}

if (isset($_GET['kuncisiswa'])) {
  $_SESSION['kuncisiswa'] = $_GET['kuncisiswa'];
  $colname3_rec_jadwal_siswa = $_SESSION['kuncisiswa'];
}
else {
	if (isset($_SESSION['kuncisiswa'])) {
	$colname3_rec_jadwal_siswa = $_SESSION['kuncisiswa'];
	}
	else {
	$colname3_rec_jadwal_siswa = "";
	}
}

$maxRows_rec_jadwal_siswa = 10;
$pageNum_rec_jadwal_siswa = 0;
if (isset($_GET['pageNum_rec_jadwal_siswa'])) {
  $pageNum_rec_jadwal_siswa = $_GET['pageNum_rec_jadwal_siswa'];
}
$startRow_rec_jadwal_siswa = $pageNum_rec_jadwal_siswa * $maxRows_rec_jadwal_siswa;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_jadwal_siswa = sprintf("SELECT tahun.t_id, tahun.t_nm, tahun.t_jn,
kelas.k_kd, kelas.k_nm,
mapel.m_kode, mapel.m_nama,
jadwal.j_id, jadwal.j_id_thn, jadwal.j_kd_kls, jadwal.j_kd_mapel, jadwal.j_id_guru, jadwal.j_hari, jadwal.j_jam,
hari.h_id, hari.h_nama,
guru.g_id, guru.u_nama
FROM tahun, kelas, mapel, jadwal, hari, guru, siswa
WHERE jadwal.j_id_thn=tahun.t_id
AND kelas.k_kd = siswa.s_kd_kls
AND jadwal.j_kd_kls=kelas.k_kd
AND jadwal.j_kd_mapel=mapel.m_kode
AND jadwal.j_hari=hari.h_id
AND jadwal.j_id_guru=guru.g_id
AND jadwal.j_id_thn=%s
AND jadwal.j_kd_kls=%s
AND siswa.s_nis=%s
ORDER BY jadwal.j_hari ASC",
	GetSQLValueString($colname1_rec_jadwal_siswa, "text"),
	GetSQLValueString($colname2_rec_jadwal_siswa, "text"),
	GetSQLValueString($colname3_rec_jadwal_siswa, "text"));
$query_limit_rec_jadwal_siswa = sprintf("%s LIMIT %d, %d", $query_rec_jadwal_siswa, $startRow_rec_jadwal_siswa, $maxRows_rec_jadwal_siswa);
$rec_jadwal_siswa = mysql_query($query_limit_rec_jadwal_siswa, $koneksi) or die(mysql_error());
$row_rec_jadwal_siswa = mysql_fetch_assoc($rec_jadwal_siswa);

if (isset($_GET['totalRows_rec_jadwal_siswa'])) {
  $totalRows_rec_jadwal_siswa = $_GET['totalRows_rec_jadwal_siswa'];
} else {
  $all_rec_jadwal_siswa = mysql_query($query_rec_jadwal_siswa);
  $totalRows_rec_jadwal_siswa = mysql_num_rows($all_rec_jadwal_siswa);
}
$totalPages_rec_jadwal_siswa = ceil($totalRows_rec_jadwal_siswa/$maxRows_rec_jadwal_siswa)-1;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N'";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N'";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);

if ($_SESSION['Level'] == 'siswa' ) {
mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_siswa = "SELECT * FROM siswa WHERE nonaktif='N' AND s_kd_kls='".$colname2_rec_jadwal_siswa."' AND u_nama='".$_SESSION['nama']."'";
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);
}
else {
mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_siswa = "SELECT * FROM siswa WHERE nonaktif='N' AND s_kd_kls='".$colname2_rec_jadwal_siswa."' ORDER BY u_nama";
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);
}
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Jadwal</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tampil_jadwal_siswa" />
  <table width="279" border="0">
    <tr>
      <td width="113">Tahun Pelajaran</td>
      <td width="150"><select class="form-control" name="kuncitahun" id="kuncitahun">
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $colname1_rec_jadwal_siswa))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
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
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_kd'], $colname2_rec_jadwal_siswa))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
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
<!-- create by Marcuz Dedy -->
        <?php
do {
?>
        <option value="<?php echo $row_rec_list_siswa['s_nis']?>"<?php if (!(strcmp($row_rec_list_siswa['s_nis'], $colname3_rec_jadwal_siswa))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_siswa['u_nama']?></option>
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
      <td><input class="btn btn-info" type="submit" name="button" id="button" value="Lihat Jadwal" /></td>
    </tr>
  </table>
</form>
<p><img src="Asset/images/print-icon.png" /> <a href="print.php?print=print_jadwal_siswa.php" target="_blank">Print Jadwal</a></p>
<table class="table table-bordered">
  <thead>
  <tr>
    <th>#</th>
    <th>Tahun</th>
    <th>Kelas</th>
    <th>Mata Pelajaran</th>
    <th>Guru</th>
    <th>Hari</th>
    <th>Jam</th>
  </tr>
</thead>
<tbody>
<?php $no=0; do { $no++; ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['t_nm']; ?> - <?php echo $row_rec_jadwal_siswa['t_jn']; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['k_nm']; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['m_nama']; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['u_nama']; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['h_nama']; ?></td>
    <td><?php echo $row_rec_jadwal_siswa['j_jam']; ?></td>
  </tr>
<?php } while ($row_rec_jadwal_siswa = mysql_fetch_assoc($rec_jadwal_siswa)); ?>
</tbody>
</table>
