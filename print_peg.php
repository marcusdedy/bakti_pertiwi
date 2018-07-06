<?php



mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_peg = "SELECT * FROM pegawai ORDER BY p_id ASC";
$rec_tampil_peg = mysql_query($query_rec_tampil_peg, $koneksi) or die(mysql_error());
$row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg);
$totalRows_rec_tampil_peg = mysql_num_rows($rec_tampil_peg);
?>

<hr />
<center>
<h2> Laporan Daftar Pegawai</h2>
</center>
<hr />
<table width="100%" border="0" class="gridtable">
  <tr>
    <th>#</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Tempat Lhr</th>
    <th>Tgl Lhr</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Agama</th>
    <th>Status</th>
    <th>Nonaktif</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rec_tampil_peg['p_id']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_nip']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_nama']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_tmp_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_tgl_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_jk']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_alamat']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_agama']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_status']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_peg['nonaktif']; ?>.gif" border="0" /></td>
    </tr>
    <?php } while ($row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg)); ?>
</table>
