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
	
	$sql = mysqli_query($connect, "SELECT NAMA, PRIVILEGE FROM CC_USER_LOGIN WHERE NIK = '".$username."' and PASSWORD = '".$password."'");
	$row = mysqli_fetch_array($sql);
	
	if(!empty($row[0]))
	{
		$_SESSION['uname'] = $username;
        $_SESSION['nama'] = $row[0];
        $_SESSION['priv'] = $row[1];
	
		if($row[1] == '1' or $row[1] == '2')
		{
			echo "<script language=javascript>
				  parent.location.href='change_pass_absen.php';
				  </script>";
		}
		else
		{
			echo "<script language=javascript>
				  parent.location.href='change_pass_absen.php';
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
		<?php include "structure/head.php"; ?>
	</head>

	<body class="login">
		<div class="login_wrapper">
			<section class="login_content">
				<form name="form-login" method="post">
					<h1 style = "font-size: 30px; margin-bottom: 40px;">FORM ABSENSI</h1>
					<input type="text" name="username" class="form-control" placeholder="Username" required="" />
					<input type="password" name="password" class="form-control" placeholder="Password" required="" />			
					<input type="submit" name="submit" class="btn btn-modern" value="SUBMIT" />
					<br/>
					<br/>
					<p>&#169 2018 All Rights Reserved.<br/> Build by TREG5 Consumer Care Division.</p>


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
