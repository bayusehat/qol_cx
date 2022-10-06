<?php
include "conf/config.php";
$tload = microtime(true); 
session_start();
if(empty($_SESSION['uname']))
{
  echo "<script language=javascript>
      parent.location.href='login.php';
    </script>";
}
$usr = $_SESSION['uname']; 
$nm = $_SESSION['nama'];
$wtl = $_SESSION['witel'];

include "conf/connect.php";

$perbut_now = date('Ym');

$getWitel = OCIParse($connect, "SELECT DISTINCT WITEL FROM rc_master WHERE WITEL IS NOT NULL ORDER BY WITEL");
ociexecute($getWitel);

$getJaringan = oci_parse($connect, "select distinct jaringan from rc_master WHERE JARINGAN IS NOT NULL");
oci_execute($getJaringan);

$getHasil = OCIParse($connect, "SELECT HASIL FROM rc_hvisit ORDER BY NOID");
ociexecute($getHasil);

$getPerbut = oci_parse($connect, "select distinct(periode_cabut) from rc_master");
oci_execute($getPerbut);

if((empty($_GET['witel']))||($_GET['witel']=='ALL')){$quewit = " WITEL IS NOT NULL ";}
else{$quewit = " WITEL = '".$_GET['witel']."' ";}

if((empty($_GET['jaringan']))||($_GET['jaringan']=='ALL')){  $quejar = " (JARINGAN IS NOT NULL OR JARINGAN IS NULL)";}
else{$quejar = " JARINGAN = '".$_GET['jaringan']."' ";}

if((empty($_GET['hasil']))||($_GET['hasil']=='ALL') ||($_GET['hasil']=='NOT CONTACTED')){  $quehas = " ND_REFERENCE IS NOT NULL ";}
else{$quehas = " hasil_visit = '".$_GET['hasil']."' ";}

if((empty($_GET['periode'])))
{
	$perbut = $perbut_now;
	$queper = " PERIODE_CABUT ='".$perbut_now."' ";
}
elseif($_GET['periode'] == 'ALL')
{
	$perbut = "ALL";
	$queper = " PERIODE_CABUT IS NOT NULL ";
}
else
{
	$perbut = $_GET['periode'];
	$queper = " PERIODE_CABUT = '".$_GET['periode']."' ";
}

if($wtl == "ALL")
{
	$stmt = "select nd_reference, nd, nama, alamat, hasil_visit from rc_master WHERE ".$quewit."AND".$quejar."AND".$quehas."AND".$queper." ORDER BY TGL_VISIT DESC";
}
else
{
	$stmt = "select nd_reference, nd, nama, alamat, hasil_visit from rc_master WHERE witel = '".$wtl."' and ".$quejar."AND".$quehas."AND".$queper." ORDER BY TGL_VISIT DESC";
}
//echo $stmt;
$stmt_2 = oci_parse($connect,$stmt);
oci_execute($stmt_2);

$tsql = microtime(true);
ociexecute($tes);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo $title; ?></title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<style>
  body{padding-top:30px}
  th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
</head>
<body>
<form name="form1" method="get">
<div class="container">
<div class="col-md-12">
	<div class="panel panel-danger">
		<div class="col-md-6">
			<h4><b><i class="fa fa-phone"></i> <?php echo $title; ?></b></h4>
			<b><i class="fa fa-tags"></i> DAFTAR INPUT</b> <font color=red>|</font> <i class="fa fa-user-secret"></i> <?=$_SESSION['nama']; ?> <font color=red>|</font> <a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a>
		</div>
		<div class="col-md-6" align="right">
			<img src="img/logo.png" width="110" class="img img-responsive">
		</div>
		<div class="col-md-12">
			<div class="col-md-3">
				<label for="witel">WITEL</label>
				<select name="witel" class="form-control input-sm" <?php if($wtl != "ALL") { echo "disabled"; } ?>>
					<option value="ALL">ALL</option>
			<?php
				while($l_witel = oci_fetch_array($getWitel))
				{ ?>
					<option value="<?php echo $l_witel[0]; ?>"
						<?php if($_GET['witel'] == $l_witel[0] || $wtl == $l_witel[0]) { echo "selected"; } ?>><?php echo $l_witel[0]; ?>
					</option>
			<?php
				} ?>
				</select>
			</div>
			<div class="col-md-2">
				<label for="jaringan">JARINGAN</label>
				<select name="jaringan" class="form-control input-sm">
					<option value="ALL">ALL</option>
			<?php
				while($l_jaringan = oci_fetch_array($getJaringan))
				{ ?>
					<option value="<?php echo $l_jaringan[0]; ?>"
					</option>
			<?php
				} ?>
				</select>
			</div>
			<div class="col-md-3">
				<label for="hasil">HASIL VISIT</label>
				<select name="hasil" class="form-control input-sm">
					<option value="ALL">ALL</option>
			<?php
				while($l_hasil = oci_fetch_array($getHasil))
				{ ?>
					<option value="<?php echo $l_hasil[0]; ?>"
						<?php if($_GET['hasil'] == $l_hasil[0]) { echo "selected"; } ?>><?php echo $l_hasil[0]; ?>
					</option>
			<?php
				} ?>
				</select> 
			</div>
			<div class="col-md-2">
				<label for="periode">PERIODE WO</label>
				<select name="periode" class="form-control input-sm">
					<option value="ALL" selected>ALL</option>
			<?php
				while($l_perbut = oci_fetch_array($getPerbut))
				{ ?>
					<option value="<?php echo $l_perbut[0]; ?>"
						<?php if($_GET['periode'] == $l_perbut[0]) { echo "selected"; } ?>><?php echo $l_perbut[0]; ?>
					</option>
			<?php
				} ?>
				</select> 
			</div>
			<div class="col-md-2"><br>
				<input type="submit" class="btn btn-sm btn-primary" value="REFRESH DATA">
			</div>
		</div>
		<div class="col-md-12">
			<hr style="border-top: 1px solid red">
		</div>
		<div class="panel-body">
			<?php
			if(!empty($_GET['act'])){
			echo "<div class=\"row\"><div class=\"col-md-6\"><div class=\"alert alert-success\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
			<strong>Terima Kasih!</strong> Hasil call nomor ".$_GET['id']." telah disimpan!
			</div></div></div>"; }
			?>
			<table id="table_id" class="display table table-bordered">
				<thead>
					<tr class="danger">
					<th width="10%">ACT</th>
					<th width="15%">INTERNET</th>
					<th width="15%">POTS</th>  
					<th>NAMA</th>
					<th>ALAMAT</th>
					</tr>
				</thead>
				<tbody>
				<?php
				while($row = oci_fetch_array($stmt_2))
				{ ?>
					<tr>
						<td align="center">
			<?php 		if(empty($row[4]))
						{ ?>
							<a href="quiz.php?id=<?php echo $row[0]; ?>" class="btn btn-xs btn-primary"><strong><i class="fa fa-pencil-square"></i> Entry Hasil</a></strong>
			<?php 		}
						else if($row[4]=='JANJI BAYAR')
						{ ?>
							<a href="edit.quiz.php?id=<?php echo $row[0]; ?>" class="btn btn-xs btn-success"><strong><i class="fa fa-retweet"></i> Update Hasil</a></strong>
			<?php 		}
						else
						{ ?>
							<a href="view.php?id=<?php echo $row[0]; ?>" class="btn btn-xs btn-default"><i class="fa fa-check-square"></i> OK</a>
			<?php 		} ?>
						</td>
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $row[3]; ?></td>
					</tr>
		<?php	} ?>
				</tbody>
			</table>
		<?php
			$tsql = microtime(true) - $tsql;
			$tload = microtime(true) - $tload;
		?>
			<p><b>Load time</b> : <?php echo round($tload, 3)." detik "; ?><b> Query time</b> : <?php echo round($tsql, 3)." detik"; ?></p>
			<p><a href="dl_detil.php?perbut=<?php echo $perbut; ?>"><b><i class="fa fa-download"></i> KLIK UNTUK DOWNLOAD DATACENTER</b></a><br>
		</div>
	</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#table_id').DataTable({
      "scrollX": true
    });  
} );
</script>
</form>
</body>
</html>