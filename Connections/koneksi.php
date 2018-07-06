<?php

$hostname_koneksi = "localhost";
$database_koneksi = "bakti_pertiwi";
$username_koneksi = "root";
$password_koneksi = "cahbagoes";
$koneksi = mysql_pconnect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_koneksi, $koneksi);
?>
