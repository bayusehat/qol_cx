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

$stmt_kategori = mysqli_query($connect, "SELECT DISTINCT KATEGORI FROM CC_QOL_MASTER_SOAL WHERE KATEGORI IS NOT NULL ORDER BY KATEGORI");

$ktg = $_GET['kategori'];
if($ktg == "ALL")
{
	$sql_select =
	"SELECT KODE_SOAL, KATEGORI, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, KUNCI_JAWABAN
	FROM CC_QOL_MASTER_SOAL
	ORDER BY KODE_SOAL";
}
else
{
	$sql_select =
	"SELECT KODE_SOAL, KATEGORI, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, KUNCI_JAWABAN
	FROM CC_QOL_MASTER_SOAL
	WHERE KATEGORI = '".$ktg."'
	ORDER BY KODE_SOAL";
}
$stmt_select = mysqli_query($connect, $sql_select);

if(isset($_POST['update'])){
	$soal_new = $_POST['soal'];
	$pilihan_a_new = $_POST['pilihan_a'];
	$pilihan_b_new = $_POST['pilihan_b'];
	$pilihan_c_new = $_POST['pilihan_c'];
	$pilihan_d_new = $_POST['pilihan_d'];
	$kunci_jawaban_new = strtoupper($_POST['kunci_jawaban']);
	$kode_soal_new = $_POST['kode_soal_new'];
	
	$sql_update = "UPDATE CC_QOL_MASTER_SOAL SET PERTANYAAN = '".$soal_new."', OPSI_A = '".$pilihan_a_new."', OPSI_B = '".$pilihan_b_new."', OPSI_C = '".$pilihan_c_new."', OPSI_D = '".$pilihan_d_new."', KUNCI_JAWABAN = '".$kunci_jawaban_new."', KETERANGAN = '".$usr."' WHERE KODE_SOAL = '".$kode_soal_new."'";
	
	$stmt_update = mysqli_query($connect, $sql_update);
		
		echo "<script language=javascript>
		parent.location.href='admin_update_soal.php';
		</script>";
}
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
					<h4><b>Daftar Soal CSR</b></h4>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12" style="margin-top: 10px; margin-bottom: 30px; border-style: solid; border-width: 1.5px; padding-top: 10px; padding-bottom: 15px;">
					<form name="form_filter" id="form_filter" method="get">
						<div class="col-md-8 col-sm-12 col-xs-12">
							<label>KATEGORI</label>
							<select name="kategori" id="kategori" class="form-control input-sm">
								<option selected class="all" value="ALL">ALL</option>
								<?php
								while($l_kategori = mysqli_fetch_array($stmt_kategori)){ 
								?>
								<option class="<?php echo $l_kategori[0]; ?>" value="<?php echo $l_kategori[0]; ?>"
								<?php if($_GET['kategori'] == $l_kategori[0] || $ktg == $l_kategori[0]) { echo "selected"; } ?>><?php echo $l_kategori[0]; ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
							<label><br></label>
							<input type="submit" value="SUBMIT" class="btn-sm-modern" style="width:100%;">
						</div>
					</form>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12" id="msg" style="text-align:center;">
					<div class="loading"></div>
					Loading, please wait...
				</div>
				<table id="table" class="table table-bordered" style="width:100%; display:none;">
					<thead>
						<th>ID</th>
						<th>KATEGORI</th>
						<th>PERTANYAAN</th>
						<th>OPSI A</th>
						<th>OPSI B</th>
						<th>OPSI C</th>
						<th>OPSI D</th>
						<th>KEY</th>
						<th>ACTION</th>
					</thead>
					<tbody>
						<form name="form_soal" id="form_soal" method="post">
							<?php
							while($col = mysqli_fetch_array($stmt_select)){
								$kode_soal			=$col["KODE_SOAL"];
								$kategori				=$col["KATEGORI"];
								$pertanyaan		=$col["PERTANYAAN"];
								$opsi_a					=$col["OPSI_A"];
								$opsi_b				=$col["OPSI_B"];
								$opsi_c					=$col["OPSI_C"];
								$opsi_d				=$col["OPSI_D"];
								$kunci_jawaban=$col["KUNCI_JAWABAN"];
							?>
							
							<tr>		
								<td><?php echo $kode_soal; ?></td>
								<td><?php echo $kategori; ?></td>
								<td><?php echo $pertanyaan; ?></td>
								<td><?php echo $opsi_a; ?></td>
								<td><?php echo $opsi_b; ?></td>
								<td><?php echo $opsi_c; ?></td>
								<td><?php echo $opsi_d; ?></td>
								<td><?php echo $kunci_jawaban; ?></td>
								<td style="text-align:center;">
									<button type="button" class="btn-sm-modern" style="padding-left:8px; padding-right:8px;" data-toggle="modal" data-target="#myModal<?php echo $kode_soal; ?>"><i class="fa fa-edit"></i></button>
									<button  name="delete<?php echo $kode_soal; ?>" id="delete" class="btn-sm-modern" style="padding-left:10px; padding-right:10px;" onclick="deleteRow<?php echo $kode_soal; ?>()"><i class="fa fa-remove"></i></button>
								</td>
								<input type="hidden" name="kode_soal" value="<?php echo $kode_soal; ?>">
							</tr>
							
							<script>
							function deleteRow<?php echo $kode_soal; ?>() {
								var table = $('#table').DataTable();
								var kode = "<?php echo $kode_soal; ?>";	
								if(confirm( "Are you sure you want to delete the selected rows?" ) ) {
									$.ajax({
									   url: "delete_soal.php", 
									   method:"POST",
									   data:{xkode:kode},
									   success : function(data){
										  //delete the row
										  table
									   .row( $('button[name="delete<?php echo $kode_soal; ?>"]').parents('tr') )
											.remove()
											.draw();
										},
									   error: function(xhr){
										   //error handling
										}}); 
									}
							}
							</script>
						</form>
						
						<!-- Modal -->
						<div id="myModal<?php echo $kode_soal; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
							
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header" style="padding-bottom:5px;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Edit Soal</h4>
									</div>
									
									<form name="form_update" id="form_update" method="post">
										<div class="modal-body">
							
											<div class="form-group">
												<label class="control-label" for="soal">SOAL</label>
												<input class="form-control" id="soal" name="soal" value="<?php echo $pertanyaan; ?>" required>
											</div>  
							   
											<div class="form-group">
												<label class="control-label" for="pilihan_a">PILIHAN A</label>
												<input class="form-control" id="pilihan_a" name="pilihan_a" value="<?php echo $opsi_a; ?>" required>
											</div> 
											  
											<div class="form-group">
												<label class="control-label" for="pilihan_b">PILIHAN B</label>
												<input class="form-control" id="pilihan_b" name="pilihan_b" value="<?php echo $opsi_b; ?>"  required>
											</div>
											
											<div class="form-group">
												<label class="control-label" for="pilihan_c">PILIHAN C</label>
												<input class="form-control" id="pilihan_c" name="pilihan_c" value="<?php echo $opsi_c; ?>"  required>
											</div>
											  
											<div class="form-group">
												<label class="control-label" for="pilihan_d">PILIHAN D</label>
												<input class="form-control" id="pilihan_d" name="pilihan_d" value="<?php echo $opsi_d; ?>"  required>
											</div>
											  
											<div class="form-group">
												<label class="control-label" for="kunci_jawaban">KUNCI JAWABAN</label>
												<input class="form-control" id="kunci_jawaban" name="kunci_jawaban" style="text-transform:uppercase" maxlength="1" value="<?php echo $kunci_jawaban; ?>" required>
											</div> 
											
											<div class="form-group" style="padding-top: 20px; padding-bottom: 30px;">
												<input type="hidden" name="kode_soal_new" value="<?php echo $kode_soal; ?>">
												<input type="submit" value="Update Soal" name="update" class="btn-next btn-sm-modern" style="margin-bottom: 20px;">
											</div> 
											
										</div>
									</form>
								</div>
							</div>
						</div>
						
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
	$('#table').show();
	$('#msg').hide();
	
	$('#table').dataTable({
		"order": [[ 0, "asc" ]],
		deferRender: true
	});	
});

$('#kategori').change(function() {
	$('#textkategori').val($(this).val());
});

$('#kategori').on('input', function() {
	if($(this).val() != '')
		$('#textkategori').prop('readonly', true);
	else
		$('#textkategori').prop('readonly', false);
});
</script>
	
</body>
</html>