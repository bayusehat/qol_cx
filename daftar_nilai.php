<?php
session_start();
include "conf/connect.php"; 

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$usr = $_SESSION['uname'];
$nm = $_SESSION['nama'];
$priv = $_SESSION['priv'];

$sql_select = "SELECT TO_DATE(TO_CHAR(TGL_MULAI, 'DD-MM-YYYY'), 'DD-MM-YYYY') AS TANGGAL_UJIAN, JML_BENAR AS TOTAL_BENAR, 50-JML_BENAR AS TOTAL_SALAH, NILAI, STATUS FROM CC_QOL_TRANSAKSI_CX WHERE ID_USER = '".$usr."' ORDER BY 1 DESC";
$stmt_select = mysqli_query($connect, $sql_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "structure/head.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css?123">
</head>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<!-- sidebar-menu -->
<?php include "structure/sidebar-menu.php"; ?> 
<!-- sidebar-menu -->

<!-- top navigation -->
<?php include "structure/top-nav.php"; ?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Daftar Nilai <?php echo $nm; ?></b></h4>
				</div>
				<div class="x_content">
	
	<table id="table" class="table table-bordered">
		<thead>
			<th>TANGGAL UJIAN</a></th>
			<th>JUMLAH BENAR</a></th>
			<th>JUMLAH SALAH</a></th>
			<th>NILAI</a></th>
			<th>STATUS</a></th>
		</thead>
		<tbody>	
			<?php
			while($col = mysqli_fetch_array($stmt_select)){
				$tanggal_ujian=$col["TANGGAL_UJIAN"];
				$total_benar=$col["TOTAL_BENAR"];
				$total_salah=$col["TOTAL_SALAH"];
				$total_nilai=$col["NILAI"];
				$status=$col["STATUS"];
            ?>
			<tr>		
				<td><?php echo $tanggal_ujian; ?></td>
				<td><?php echo $total_benar; ?></td>
				<td><?php echo $total_salah; ?></td>
				<td><?php echo $total_nilai; ?></td>
				<td><?php echo $status; ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>		
	</table>
			</div>
			</div>
		</div>
	</div>
<!-- /page content -->

<!-- footer content -->
<?php include "structure/footer.php"; ?>
<!-- /footer content -->
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

<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<!-- Custom Theme Scripts -->
<script src="js/custom.min.js?123"></script>
<script>
$(document).ready(function() {
	$('#table').dataTable( {
		"columnDefs": [{
			"defaultContent": "-",
			"targets": "_all"
		}]
	});
});
</script>
</body>
</html>