<?php
include "conf/connect.php"; 

session_start();
date_default_timezone_set('Asia/Jakarta');

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$usr = $_SESSION['uname'];
$priv = $_SESSION['priv'];
$nm		= $_SESSION['nama'];

?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Test Reliability Internal TR5 2022</title>
<!-- Bootstrap -->
<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- jQuery custom content scroller -->
<link href="css/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
<!-- Animate.css -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="css/custom.css" rel="stylesheet">
<!-- Dropzone.js -->
<link href="css/dropzone.min.css" rel="stylesheet">
