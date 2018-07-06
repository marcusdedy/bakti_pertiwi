<?php


require ("Inc/fungsi.php");
require 'Inc/config.php';

?>
<!DOCTYPE>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Print Laporan</title>
<link rel="stylesheet" href="Asset/css/print.css" type="text/css" />
</head>

<body onload="javascript:window.print()">
<?php

if (isset($_REQUEST['print']))
{
$print = $_REQUEST['print']; include "$print";
}
?>
</body>
</html>
