<?php 


mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_peg = "SELECT * FROM pegawai ORDER BY p_id ASC";
$rec_tampil_peg = mysql_query($query_rec_tampil_peg, $koneksi) or die(mysql_error());
$row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg);
$totalRows_rec_tampil_peg = mysql_num_rows($rec_tampil_peg);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Pegawai</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_peg"> Tambah Pegawai</a></p>
<table class="table table-bordered">
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
    <th>Aksi</th>
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
      <td><a href="index.php?page=edit_peg&amp;p_id=<?php echo $row_rec_tampil_peg['p_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg)); ?>
</table>
