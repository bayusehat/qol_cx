<?php
session_start();
include "../conf/connect.php"; 

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}
$usr = $_SESSION['uname']; 
$nm = $_SESSION['nama'];
$priv = $_SESSION['priv'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Consumer Operation Center</title>
	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatables -->
	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- jQuery custom content scroller -->
	<link href="../css/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
	<!-- Animate.css -->
	<link href="../css/animate.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="../css/custom.css" rel="stylesheet">
	<!-- Dropzone.js -->
	<link href="../css/dropzone.min.css" rel="stylesheet">
</head>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<!-- sidebar-menu -->
<?php include "../structure/sidebar-menu.php"; ?>
<!-- sidebar-menu -->

<!-- top navigation -->
<?php include "../structure/top-nav.php"; ?>
<!-- /top navigation -->

<!-- page content -->
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>TOP 10 CSR Bulan Ini</b></h4>
				</div>
				<div class="features">
				<?php
				$today = date('Ym');
$sql_rank = "
SELECT NAMA, NILAI, PLASA FROM
    (SELECT ID_USER, NAMA, NILAI, PLASA, RANK() OVER (PARTITION BY ID_USER ORDER BY NILAI DESC) AS myrank FROM
        (SELECT DISTINCT ID_USER, NAMA, NILAI, PLASA FROM CC_QOL_TRANSAKSI A JOIN CC_USER_LOGIN B ON A.ID_USER = B.NIK
        WHERE PRIVILEGE = '4' AND TO_CHAR(TGL_MULAI,'YYYYMM') = '".$today."' AND NILAI != 0 GROUP BY ID_USER, NAMA, PLASA, NILAI ORDER BY NILAI DESC))
    WHERE myrank = 1 AND ROWNUM <= 10 ORDER BY NILAI DESC
";
$stmt_rank = oci_parse($connect, $sql_rank);
oci_execute($stmt_rank);
				$no = 1;
				while($col = oci_fetch_array($stmt_rank)){
					
					$naam=$col["NAMA"];
					$nilai=$col["NILAI"];
					$plasa=$col["PLASA"];
					$baris=oci_num_rows($stmt_rank);
				?>
					<div class="feature" style="width:20%;">
						<img src="../images/cup/cup<?php echo $no; ?>.png" class="img_cup" style="width: 100%; margin-bottom: 20px; float: center;"></img>
						<h3><b><?php echo $naam; ?></b></h3>
						<p>PLASA <?php echo $plasa; ?><br>Nilai: <?php echo $nilai; ?></p>
					</div>
				<?php
				$no++;
				}
				?>
			</div>
		</div>
	</div>
<!-- /page content -->

<!-- footer content -->
<?php include "../structure/footer.php"; ?>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../js/fastclick.js"></script>
<!-- NProgress -->
<script src="../js/nprogress.js"></script>
<!-- jQuery custom content scroller -->
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../js/custom.min.js"></script>
</body>
</html>