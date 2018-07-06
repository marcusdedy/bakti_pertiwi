<?php


require ("Inc/config.php");
require ("Inc/fungsi.php");

$showAvatar = mysql_query("SELECT * FROM photo WHERE p_uname='".$_SESSION['MM_Username']."' ORDER BY p_id DESC") or die(mysql_error());
$detailAvatar = mysql_fetch_assoc($showAvatar);

if (mysql_num_rows($showAvatar) == 0) {
    $createAvatar = "Photo/no-photo.jpg";
}
else {
    $smallAvatar = $detailAvatar['p_image_small'];
    $middleAvatar = $detailAvatar['p_image_middle'];
    $defaultAvatar = $detailAvatar['p_image_default'];

    $createAvatar = "Photo/100/".$middleAvatar;
    }

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF'] . "?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")) {
    $logoutAction .="&" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
    //to fully log out a visitor we need to clear the session varialbles
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['PrevUrl'] = NULL;
    $_SESSION['Level'] = NULL;
    $_SESSION['nama'] = NULL;

    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['PrevUrl']);
    unset($_SESSION['Level']);
    unset($_SESSION['nama']);

    session_destroy();

    $logoutGoTo = "login.php";
    if ($logoutGoTo) {
        header("Location: $logoutGoTo");
        exit;
    }
}

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";


function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {

    $isValid = False;


    if (!empty($UserName)) {

        $arrUsers = Explode(",", $strUsers);
        $arrGroups = Explode(",", $strGroups);
        if (in_array($UserName, $arrUsers)) {
            $isValid = true;
        }
        // Marcus Dedy.
        if (in_array($UserGroup, $arrGroups)) {
            $isValid = true;
        }
        if (($strUsers == "") && true) {
            $isValid = true;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
    $MM_qsChar = "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    if (strpos($MM_restrictGoTo, "?")) {
        $MM_qsChar = "&";
    }
    if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) {
        $MM_referrer .= "?" . $QUERY_STRING;
    }
    $MM_restrictGoTo = $MM_restrictGoTo . $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: " . $MM_restrictGoTo);
    exit;
}
?>

<!DOCTYPE>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistem Informasi SD SWASTA BHAKTI PERTIWI</title>

        <link href="Asset/css/style.css" rel="stylesheet" type="text/css" />
        <link href="Asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="Asset/images/favicon.ico" rel="shortcut icon" />

        <script src="Asset/js/jquery-1.10.2.min.js" type="text/javascript"></script>

        <script src="Asset/js/bootstrap.js" type="text/javascript"></script>
        <script src="Asset/js/application.js" type="text/javascript"></script>

        <script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Fixed navbar Marcus Dedy-->
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
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=tampil_ugeneral"><strong><?php echo $_SESSION['nama']; ?></strong></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=tampil_ugeneral">General</a></li>
                                <li><a href="?page=tampil_uprofil">Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-lock"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="space"></div>

        <div class="container">
            <div class="main-layout">
                <div class="main-header">
                    <div class="title-layout">
                        <img src="Asset/images/logo-bakti-pertiwi.png" height="100" width="100" />
                        <h4>YAYASAN PENDIDIKAN INDRA KEMALA (YPIK)</h4>
						<h4>SISTEM INFORMASI SEKOLAH SD SWASTA BHAKTI PERTIWI</h4>
                        <h5>Alamat : Perum Puri Rajeg Blok D2 No.1 Ds.Lembangsari Kec.Rajeg-tangerang-banten 15540</h5>
                    </div>
                    <div class="cover-avatar">
                        <a href="?page=tampil_uprofil"><img src="<?php echo $createAvatar; ?>"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <ul id="MenuBar1" class="MenuBarHorizontal">
                        <li><a href="index.php">Home</a></li>
                        <?php if ($_SESSION['Level'] == 'admin') { ?>
                            <li><a href="#" class="MenuBarItemSubmenu">Master</a>
                                <ul>
                                    <li><a href="index.php?page=tampil_jadwal"><span class="glyphicon glyphicon-calendar"></span> Jadwal</a></li>
                                    <li><a href="index.php?page=tampil_nilai"><span class="glyphicon glyphicon-list-alt"></span> Nilai</a></li>
                                    <li><a href="index.php?page=tampil_absensi"><span class="glyphicon glyphicon-check"></span> Absensi</a></li>
                                </ul>
                            </li>
                            <li><a class="MenuBarItemSubmenu" href="#">Modul</a>
                                <ul>
                                    <li><a href="index.php?page=tampil_kal"><span class="glyphicon glyphicon-check"></span> Kalender</a></li>
                                    <li><a href="index.php?page=tampil_tp"><span class="glyphicon glyphicon-check"></span> Tahun Pelajaran</a></li>
                                    <li><a href="index.php?page=tampil_mp"><span class="glyphicon glyphicon-check"></span> Mata Pelajaran</a></li>
                                    <li><a href="index.php?page=tampil_guru"><span class="glyphicon glyphicon-check"></span> Guru</a></li>
                                    <li><a href="index.php?page=tampil_kelas"><span class="glyphicon glyphicon-check"></span> Kelas</a></li>
                                    <li><a href="index.php?page=tampil_peg"><span class="glyphicon glyphicon-check"></span> Pegawai</a></li>
                                    <li><a href="index.php?page=tampil_siswa"><span class="glyphicon glyphicon-check"></span> Siswa</a> </li>
                                </ul>
                            </li>
                            <li><a href="#" class="MenuBarItemSubmenu">Sistem</a>
                                <ul>
                                    <li><a href="index.php?page=tampil_admin"><span class="glyphicon glyphicon-user"></span> User Admin</a></li>
                                    <li><a href="index.php?page=tampil_uguru"><span class="glyphicon glyphicon-user"></span> User Guru</a></li>
                                    <li><a href="index.php?page=tampil_usiswa"><span class="glyphicon glyphicon-user"></span> User Siswa</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="MenuBarItemSubmenu">Laporan</a>
                                <ul>
                                    <li><a href="index.php?page=lap_absensi"><span class="glyphicon glyphicon-print"></span> Absensi</a></li>
                                    <li><a href="index.php?page=lap_nilai"><span class="glyphicon glyphicon-print"></span> Nilai</a></li>
                                    <li><a href="index.php?page=lap_guru"><span class="glyphicon glyphicon-print"></span> Guru</a></li>
                                    <li><a href="index.php?page=lap_peg"><span class="glyphicon glyphicon-print"></span> Pegawai</a></li>
                                </ul>
                            </li>
                        <?php } else if ($_SESSION['Level'] == 'guru') { ?>
                            <li><a href="#" class="MenuBarItemSubmenu">Input</a>
                                <ul>
                                    <li><a href="index.php?page=tampil_nilai">Nilai</a></li>
                                    <li><a href="index.php?page=tampil_catatan">Catatan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="MenuBarItemSubmenu">Laporan</a>
                                <ul>
                                    <li><a href="index.php?page=lap_absensi">Absensi</a></li>
                                    <li><a href="index.php?page=lap_nilai">Nilai</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                          <li><a href="index.php?page=tampil_jadwal_siswa">Jadwal</a></li>
                            <li><a href="#" class="MenuBarItemSubmenu">Laporan</a>
                                <ul>
                                    <li><a href="index.php?page=lap_absensi">Absensi</a></li>
                                    <li><a href="index.php?page=lap_nilai">Nilai</a></li>
                                    <li><a href="index.php?page=lap_catatan_siswa">Catatan</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="main-konten">
                    <?php
                    /**

                     */
                    //** Jika anda yang memanggil kata-kata page=nama_file //
                    if (isset($_GET["page"]) && $_GET["page"] != "home") {

                        //** Cari apakah file yang dipanggil ada
                        if (file_exists(htmlentities($_GET["page"]) . ".php")) {

                            //** Jika ada, panggil File tersebut
                            include(htmlentities($_GET["page"]) . ".php");
                        } else {
                            //** Jika tidak tampilkan 404.php
                            include("404.php");
                        }
                    } else {
                        //jika tidak ada yang di panggil, tampilkan home.php
                        include("home.php");
                    }
                    ?>
                </div>
            </div>
            <div class="footer-layout">
                Copyright &copy; 2018. Sistem Informasi Sekolah SD SWASTA BHAKTI PERTIWI

            </div>
        </div>


        <script type="text/javascript">
            <!--
        var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown: "SpryAssets/SpryMenuBarDownHover.gif", imgRight: "SpryAssets/SpryMenuBarRightHover.gif"});
//-->
        </script>
    </body>
</html>
