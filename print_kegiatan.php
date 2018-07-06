<?php



mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_kal = "select * from (
SELECT kalender.k_id, kalender.k_t_id, kalender.k_mulai, kalender.k_selesai, kalender.k_ket, tahun.t_id, tahun.t_nm, tahun.t_jn
FROM kalender, tahun WHERE kalender.k_t_id=tahun.t_id)a
where k_selesai >= sysdate()";
$rec_tampil_kal = mysql_query($query_rec_tampil_kal, $koneksi) or die(mysql_error());
$row_rec_tampil_kal = mysql_fetch_assoc($rec_tampil_kal);
$totalRows_rec_tampil_kal = mysql_num_rows($rec_tampil_kal);
?>

<hr />
<center><h2> Informasi Kalender Pendidikan dan Kegiatan</h2></center>
<hr />
<table width="100%" border="0" class="gridtable">
  <thead>
<tr>
  <th>No</th>
  <th>Tahun Pelajaran</th>
  <th>Mulai</th>
  <th>Selesai</th>
  <th>Keterangan</th>
</tr>
  </thead>
  <tbody>
<?php $no=0; do { $no++;?>
  <tr>
      <td><?php echo $no; ?></td>
    <td><?php echo $row_rec_tampil_kal['t_nm']; ?> - <?php echo $row_rec_tampil_kal['t_jn']; ?></td>
    <td><?php echo $row_rec_tampil_kal['k_mulai']; ?></td>
    <td><?php echo $row_rec_tampil_kal['k_selesai']; ?></td>
    <td><?php echo $row_rec_tampil_kal['k_ket']; ?></td>
   </a></td>
  </tr>

  <?php } while ($row_rec_tampil_kal = mysql_fetch_assoc($rec_tampil_kal)); ?>
  </tbody>
</table>
