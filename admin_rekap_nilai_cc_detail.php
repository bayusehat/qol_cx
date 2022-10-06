<?php
session_start();
$tload = microtime(true); 
include "conf/connect.php";

$id_user = $_GET['id'];
$usr = $_SESSION['uname'];
if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}
$sql_select =
	"SELECT ID_USER, B.NAMA, PLASA, WITEL, NILAI, (SELECT GROUP_CONCAT(CONCAT(N1+N2+N3+N4+N5+N6+N7+N8+N9+N10+N11,' - ',KETERANGAN) SEPARATOR ' | ') FROM CC_RPL_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NRPL, (SELECT GROUP_CONCAT(CONCAT(N1+N2+N3+N4+N5+N6+N7,' - ',KETERANGAN) SEPARATOR ' | ') FROM CC_WWC_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NWWC, B.PRIVILEGE, (SELECT LOCATION FROM CC_CSR_GALLERY WHERE PERNER=A.ID_USER LIMIT 1) AS IMG FROM CC_QOL_TRANSAKSI A JOIN CC_USER_LOGIN B ON A.ID_USER = B.NIK WHERE A.ID_USER = '$id_user' ORDER BY TGL_SELESAI DESC";
$stmt_select = mysqli_query($connect, $sql_select);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "structure/head.php"; ?>
		
		<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
		
		<script>
			$(document).ready(function(){
			  // Sembunyikan alert validasi kosong
			  $("#kosong").hide();
			});
			</script>
		
		<style type="text/css">
			#hasil {
				width: 150px;
			}
			
			input {
			  border: 1px solid transparent;
			  background-color: #f1f1f1;
			  padding: 10px;
			  font-size: 16px;
			}
			
			.autocomplete-items {
			  position: absolute;
			  border: 1px solid #d4d4d4;
			  border-bottom: none;
			  border-top: none;
			  z-index: 99;
			  /*position the autocomplete items to be the same width as the container:*/
			  top: 100%;
			  left: 0;
			  right: 0;
			}
			.autocomplete-items div {
			  padding: 10px;
			  cursor: pointer;
			  background-color: #fff; 
			  border-bottom: 1px solid #d4d4d4; 
			}
			.autocomplete-items div:hover {
			  /*when hovering an item:*/
			  background-color: #e9e9e9; 
			}
			.autocomplete-active {
			  /*when navigating through the items using the arrow keys:*/
			  background-color: DodgerBlue !important; 
			  color: #ffffff; 
			}
		</style>
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
			
				<!-- sidebar-menu -->
				<!-- sidebar-menu -->
				
				<!-- top navigation -->
				<!-- /top navigation -->

			<!-- page content -->
			<div class="col" role="main">
				<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Detail Nilai Peserta</b></h4>
					<div class="clearfix"></div>
				</div>
				
				<!-- form edit profile -->
					
					<?php $col = mysqli_fetch_array($stmt_select);
					$id_user	=$col["ID_USER"];
					switch ($col["PRIVILEGE"]) {
						case '4':
							$privilege	='CSR';
							$krpl	=7;
							$kwwc	=5;
							break;
						case '5':
							$privilege	='TL';
							$krpl	=4;
							$kwwc	=7;
							break;
						case '6':
							$privilege	='SDG';
							$krpl	=7;
							$kwwc	=5;
							break;
						default:
							$privilege	='PEGAWAI';
							$krpl	=7;
							$kwwc	=5;
							break;
					}
					$nama		=$col["NAMA"];
					$plasa		=$col["PLASA"];
					$witel		=$col["WITEL"];
					$bulan		=$col["BULAN"];
					$waktu_mulai=$col["TGL_MULAI"];
					$temp_rpl	=explode(" | ",$col["NRPL"]);
					$temp_wwc	=explode(" | ",$col["NWWC"]);
					$rpl[0] = explode(" - ",$temp_rpl[0]);
					$rpl[1] = explode(" - ",$temp_rpl[1]);
					$wwc[0] = explode(" - ",$temp_wwc[0]);
					$wwc[1] = explode(" - ",$temp_wwc[1]);
					$qol=$col["NILAI"];
					$image=$col["IMG"];
					$rpl_1 = round(intval($rpl[0][0])/$krpl,2);
					$rpl_ket_1 = $rpl[0][1];
					$rpl_2 = round(intval($rpl[1][0])/$krpl,2);
					$rpl_ket_2 = $rpl[1][1];
					$wwc_1 = round(intval($wwc[0][0])/$kwwc,2);
					$wwc_ket_1 = $wwc[0][1];
					$wwc_2 = round(intval($wwc[1][0])/$kwwc,2);
					$wwc_ket_2 = $wwc[1][1];
					$rpl_total = round((($rpl_1+$rpl_2)/2),2);
					$wwc_total = round((($wwc_1+$wwc_2)/2),2);
					$qol_total = round($qol,2);
					$total = round((0.45*($rpl_total)+(0.35*($wwc_total))+(0.20*$qol_total)),2);
					?>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div id="image">
          					<img class='imgpp' src='<?php echo $image; ?>' height='150px'>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="col-md-12 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="id_trans">NAMA PESERTA</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="id_trans" type="text" name="id_trans" value="<?php echo $nama; ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							</br>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_wwc">ROLE</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_wwc" type="text" name="nilai_wwc" value="<?php echo $privilege; ?>" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_qol">PLASA</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_qol" type="text" name="nilai_qol" value="<?php echo $plasa; ?>" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_rpl">WITEL</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $witel; ?>" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_qol">QUIZ</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_qol" type="text" name="nilai_qol" value="<?php echo $qol;?>"  disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_wwc">WAWANCARA</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_wwc" type="text" name="nilai_wwc" value="<?php echo $wwc_total;?>" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_rpl">ROLE PLAY</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $rpl_total;?>" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									</br><label class="control-label">WAWANCARA 1</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $wwc_1;?>" disabled>
										<textarea class="form-control" disabled><?php echo $wwc_ket_1;?></textarea>
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									</br><label class="control-label">WAWANCARA 2</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $wwc_2;?>" disabled>
										<textarea class="form-control" disabled><?php echo $wwc_ket_2;?></textarea>
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									</br><label class="control-label">ROLE PLAY 1</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $rpl_1;?>" disabled>
										<textarea class="form-control" disabled><?php echo $rpl_ket_1;?></textarea>
									</div>
								</div>
							</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									</br><label class="control-label">ROLE PLAY 2</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="nilai_rpl" type="text" name="nilai_rpl" value="<?php echo $rpl_2;?>" disabled>
										<textarea class="form-control" disabled><?php echo $rpl_ket_2;?></textarea>
									</div>
								</div>
							</div>
					</div>
			<!-- /form edit profil -->
			
			</div>
		</div>

		<!-- HITUNG TOTAL NILAI SEMENTARA -->
		<!-- PAS FOTO PROFILE -->

			<!-- footer content -->
			<?php include "structure/footer.php"; ?>
			<!-- /footer content -->
		</div>

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
	
	<script src="js/jquery.dataTables.js?123"></script>
	
	</body>
</html>

