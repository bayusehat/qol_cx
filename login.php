	<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "conf/connect.php";

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = mysqli_query($connect, "SELECT NAMA, PRIVILEGE,WITEL, PLASA, TZONE FROM CC_USER_LOGIN_CX WHERE NIK = '".$username."' and PASSWORD = '".$password."'");
	$row = mysqli_fetch_array($sql);
	
	if(!empty($row[0]))
	{
		$_SESSION['uname'] = $username;
        $_SESSION['nama'] = $row[0];
        $_SESSION['priv'] = $row[1];
		$_SESSION['witel']= $row[2];
		$_SESSION['plasa'] = $row[3];
		$_SESSION['tzone'] = $row[4];
	
		if($row[1] == '1' or $row[1] == '2')
		{
			echo "<script language=javascript>
				  parent.location.href='admin_index.php';
				  </script>";
		}
		else
		{
			echo "<script language=javascript>
				  parent.location.href='petunjuk_soal.php';
				  </script>";
		}
	}
	else
	{
		echo "<div class=\"alert alert-warning\">
			  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
				Login gagal !</div>";
	}
}
?>
<html lang="en">

	<head>
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

	</head>

	<body class="login">
		<div class="login_wrapper">
			<section class="login_content">
				<form name="form-login" method="post">
					<h1 style = "font-size: 30px; margin-bottom: 40px;">LOGIN FORM</h1>
					<input type="text" name="username" class="form-control" placeholder="Username" required="" />
					<input type="password" name="password" class="form-control" placeholder="Password" required="" />			
					<input type="submit" name="submit" class="btn btn-modern" value="LOGIN" />
					<br/>
					<br/>
					<p>&#169 2022 All Rights Reserved.<br/> Build by TREG5 Customer Care Division.</p>


					<!--<div class="separator">
					<div class="clearfix"></div>
					<br />

					<div>
						<h2><i class="fa fa-user"></i> CSR</h2>
						<h3> Consumer Service Relation</h3>
						<br><br><br>
						<p>&#169 2018 All Rights Reserved.<br> Build by TREG5 Consumer Care Division.</p>
					</div>
				</div>-->
				</form>
			</section>
		</div>
	</body>
</html>
