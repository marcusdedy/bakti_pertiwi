<?php

require ("Inc/config.php");
require ("Inc/fungsi.php");

// *** Validate request to login to this site.

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  //$level = $_POST['level']; Update v4.0
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);

  $LoginRS__query=sprintf("SELECT u_uname, u_pass, level, u_nama FROM view_users WHERE u_uname=%s AND u_pass=md5(%s)",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));

  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  if ($loginFoundUser) {
     $loginStrGroup = "";

	 $level = mysql_result($LoginRS, 0, 'level');
	 $nama = mysql_result($LoginRS, 0, 'u_nama');

    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['Level'] = $level;
	$_SESSION['nama'] = $nama;

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    sleep(3);
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<!DOCTYPE>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login Sistem :: Sistem Informasi SD SWASTA BHAKTI PERTIWI</title>
<meta name="description" content="Sistem Informasi Sekolah">
<meta name="author" content="marcus dedy">
<link rel="shortcut icon" href="Asset/images/favicon.ico" />
<link href="Asset/css/bootstrap.css" rel="stylesheet" type="text/css" />


<style type="text/css">
body {
	padding-top: 50px;
	padding-bottom: 20px;
	font-size: 12px;
	background-image: url();
	background-repeat: no-repeat;
	margin-left: 0px;
	margin-top: 0px;
}
.login-avatar {float: left;padding: 3px;position: absolute;margin-top: 40px;margin-left: 10px;width: 200px;cursor: pointer;}
.login-title {color: #ffffff;margin-left: 220px;text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);}
.jumbotron {background-color: #026fa6;background-image: url(Asset/images/background-body.png); background-repeat: repeat;border-bottom: 10px solid #CCC;}
.space { height: 50px;}
h1,h2,h3,h4,h5,h6 {
	font-family: "lucida grande", tahoma, verdana, arial, sans-serif;
}
</style>




</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="index.php">Sistem Informasi Sekolah</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="formlogin">
              <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success" name="blogin" id="blogin">Login</button>
          </form>
        </div>
      </div>
    </div>
    <div class="jumbotron">
      <div class="container">
        <div class="login-avatar"><img src="Asset/images/logo-bakti-pertiwi.png" /></div>
        <div class="space"></div>
        <div class="login-title">
        <h2 align="center">SISTEM INFORMASI SEKOLAH</h2>
        <h2 align="center">SD SWASTA BHAKTI PERTIWI</h2>
        <h4 align="center">Alamat : Perum Puri Rajeg Blok D2 No.1 Ds.Lembangsari Kec.Rajeg-tangerang-banten 15540</h4>
        </div>
      </div>
    </div>
    <div class="container">

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

<div class="judul">
<h3> Informasi Kalender Pendidikan dan Kegiatan</h3>
</div>
<p><img src="Asset/images/print-icon.png" /> <a href="print2.php?print=print_kegiatan.php" target="_blank">Print</a></p>
<table class="table table-bordered">
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
    <footer>
        Copyright &copy; 2018. Sistem Informasi Sekolah </a>
    </footer>
    </div>
<script src="Asset/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="Asset/js/bootstrap.js" type="text/javascript"></script>
<script src="Asset/js/application.js" type="text/javascript"></script>
</body>
</html>
