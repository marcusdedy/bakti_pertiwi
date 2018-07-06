<?php


require ("Inc/config.php");
require ("Inc/fungsi.php");

if ((isset($_POST['f'])) && ($_POST['f'] == "jadwal") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM jadwal WHERE j_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_jadwal');
}

if ((isset($_POST['f'])) && ($_POST['f'] == "absensi") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM absen WHERE a_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_absensi');
}

if ((isset($_POST['f'])) && ($_POST['f'] == "kalender") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM kalender WHERE k_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_kal');
}