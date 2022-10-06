<?php
session_start();
include "conf/connect.php"; 

if(empty($_SESSION['uname'])){
	echo
		"<script language=javascript>
			parent.location.href='login.php';
		</script>";
}
if($_SESSION['priv'] == '1' or $_SESSION['priv'] == '2'){
	echo
		"<script language=javascript>
			parent.location.href='admin_index.php';
		</script>";
}
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<?php include "structure/head.php"; ?>
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">

				<!-- sidebar-menu -->
				<?php include "structure/sidebar-menu.php"; ?> 

				<!-- top navigation -->
				<?php include "structure/top-nav.php"; ?>

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h4>
										<b>TOP 10 CSR Bulan Ini</b>
									</h4>
								</div>
								<div class="x_content">
									<?php
									$thismonth = date('Ym');
									$sql_rank = "SELECT NAMA, NILAI, PLASA FROM (SELECT ID_USER, NAMA, NILAI, PLASA, RANK() OVER (PARTITION BY ID_USER ORDER BY NILAI DESC) AS myrank FROM (SELECT DISTINCT ID_USER, NAMA, NILAI, PLASA FROM CC_QOL_TRANSAKSI_CX A JOIN CC_USER_LOGIN_CX B ON A.ID_USER = B.NIK WHERE PRIVILEGE = '4' AND TGL_MULAI = '$thismonth' AND NILAI != 0 GROUP BY ID_USER, NAMA, PLASA, NILAI ORDER BY NILAI DESC)) WHERE myrank = 1 AND ROWNUM <= 10 ORDER BY NILAI DESC";
									$stmt_rank = mysqli_query($connect, $sql_rank);
									$no = 1;
									while($col = mysqli_fetch_array($stmt_rank)){	
										$naam	=$col["NAMA"];
										$nilai		=$col["NILAI"];
										$plasa	=$col["PLASA"];
										$baris	= mysqli_num_rows($stmt_rank);
									?>
									<div class="feature" style="width:20%;">
										<img src="images/cup/cup<?php echo $no; ?>.png" class="img_cup" style="width: 100%; margin-bottom: 20px; float: center;"></img>
										<h4>
											<b>
												<?php echo $naam; ?>
											</b>
										</h4>
										<p>PLASA <?php echo $plasa; ?>
											<br/>Nilai: <?php echo $nilai; ?>
										</p>
									</div>
									<?php
										$no++;
									} while ($no <= 10) {
									?>
									<div class="feature" style="width:20%;">
										<img src="images/cup/cup<?php echo $no; ?>.png" class="img_cup" style="width: 100%; margin-bottom: 20px; float: center;"></img>
										<h3>
											<b>???</b>
										</h3>
										<p>PLASA ?<br/>Nilai: ?</p>
									</div>
									<?php
									$no++;
									}
									?>
								</div>
							</div>
						</div>

						<!-- footer content -->
						<?php include "structure/footer.php"; ?>
					</div>
				</div>

				<!-- jQuery -->
				<script src="js/jquery.min.js"></script>
				<!-- Bootstrap -->
				<script src="js/bootstrap.min.js"></script>
				<!-- FastClick -->
				<script src="js/fastclick.js"></script>
				<!-- NProgress -->
				<script src="js/nprogress.js"></script>
				<!-- jQuery custom content scroller -->
				<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
				<!-- Custom Theme Scripts -->
				<script src="js/custom.min.js?123"></script>

			</div>
		</div>
	</body>

</html>