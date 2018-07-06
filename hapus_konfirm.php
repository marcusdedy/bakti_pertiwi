<?php


$f = mysql_real_escape_string($_GET['f']);
$id = mysql_real_escape_string($_GET['id']);

function alert_proses($f, $id, $kembali)
{
  echo "<form method='POST' action='hapus_proses.php'>
      <input type='hidden' name='f' value='".$f."'>
      <input type='hidden' name='id' value='".$id."'>
    <div class='bs-callout bs-callout-info'>
    <h4>Apakah anda ingin menghapus data ini?</h4>
    <p><input class='btn btn-danger' type='submit' value='Lanjutkan'> <a class='btn btn-success' href=".$kembali.">Batal</a></p>
    </div></form>";        
}

switch ($f)
{
    case "jadwal":
        alert_proses($f, $id, '?page=tampil_jadwal'); 
        break;
    case "absensi":
        alert_proses($f, $id, '?page=tampil_jadwal'); 
        break;
    case "kalender":
        alert_proses($f, $id, '?page=tampil_kal'); 
        break;
    default :
        echo "<h3>Proses tidak diketahui</h3>";
        break;
}
