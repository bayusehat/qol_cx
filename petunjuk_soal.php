<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "structure/head.php"; ?>
	</head>

	<?php
		$thismonth = date('Ymd');

		$stmt 	= "SELECT * FROM CC_QOL_TRANSAKSI_CX WHERE ID_USER = '".$usr."' AND DATE_FORMAT(TGL_MULAI,'%Y%m%d') = '".$thismonth."'";
		$sql 	= mysqli_query($connect,$stmt);

		$rows = mysqli_fetch_array($sql); 
	?>

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
								<?php
								$waktutes = strtotime("2021-03-05 13:50:00");

								$newformat = date('Y-m-d H:i:s',$waktutes);
								if (date("Y-m-d H:i:s") < $newformat){ ?>
									<div class="x_title">
										<h4><b>Quiz Online</b></h4>
									</div>
									<div class="x_content">
										<h3><b>Quiz Online akan dimulai pada <?php echo "$newformat";?></b></h3>
										<p>Harap refresh halaman setelah memasuki waktu tersebut</p>
									</div>	
								<?php 
									} else {
									if(empty($rows["TGL_SELESAI"])){
									?>
										<div class="x_title">
											<h4><b>Petunjuk Pengerjaan Quiz Online</b></h4>
										</div>
										<div class="x_content">
											<div class="col col-md-3 col-sm-12 col-xs-12 feature">
												<i class="fa fa-copy"></i>
												<h3>#JUMLAH SOAL</h3>
												<p>Soal test online berupa pilihan ganda sebanyak 50 soal untuk CSR. Anda hanya dapat melaksanakan test online di waktu yang ditentukan. Pastikan anda mengerjakan menggunakan browser Chrome.</p>
											</div>
											<div class="col col-md-3 col-sm-12 col-xs-12 feature">
												<i class="fa fa-clock-o"></i>
												<h3>#DURASI</h3>
												<p>Dikerjakan dalam waktu 30 menit. Jika waktu sudah TIDAK TERSISA, maka jawaban otomatis akan disubmit.</p>
											</div>
											<div class="col col-md-3 col-sm-12 col-xs-12 feature">
												<i class="fa fa-refresh"></i>
												<h3>#HALAMAN</h3>
												<p>Jika saat mengerjakan soal test online terasa lambat, Anda dapat me-refresh (reload) halaman. Jangan mencoba menyalin soal dengan cara apapun karena secara otomatis akan membuat anda terdiskualifikasi</p>
											</div>
											<div class="col col-md-3 col-sm-12 col-xs-12 feature">
												<i class="fa fa-save"></i>
												<h3>#SIMPAN</h3>
												<p>Soal akan diacak. Jika browser tidak sengaja tertutup, jawaban Anda akan tetap tersimpan.</p>
											</div>
										</div>
										<?php
											if(empty($rows["ID_TRANS"])){
										?>
											<form class="x_content" method="post" action="generate_soal.php" style="text-align:center;">
												<input type="submit" name="submit" value="MULAI TEST ONLINE" class="btn-modern"></input>
											</form>
										<?php
										}
										if(!empty($rows["ID_TRANS"]) && empty($rows["TGL_SELESAI"])){
										?>
											<form class="x_content" style="text-align:center; margin-bottom: 20px;">
												<a class="btn-modern" href="latihan_soal.php?id_trans=<?php echo $rows['ID_TRANS'];?>&awal=1&akhir=10">LANJUTKAN TEST ONLINE</a>
											</form>	
										<?php
										}
										if(!empty($rows["TGL_SELESAI"])){
										?> 
											
											<!-- <form class="x_content" style="text-align:center; margin-bottom: 20px;">
												<a href="review_jawaban.php?id_trans=<?php echo $rows['ID_TRANS']; ?>&awal=1&akhir=10" class="btn-modern">REVIEW JAWABAN</a>
											</form>	 -->
										<?php
										} 
									}
									else {
									?>
										<div class="x_title">
											<h4><b>Quiz Online</b></h4>
										</div>
										<div class="features">
											<div class="feature">
												<i class="fa fa-thumbs-up" style="font-size: 150px; margin-bottom: 10px;"></i>
												<h1>TES ONLINE SELESAI</h1>
												<p style="font-size: 15px;">Terima kasih telah berpartisipasi dalam tes online</p>
											</div>
										</div>
									<?php
									}
									
									?>
										
										</div>
									</div>
								<?php } ?>
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

						<!-- Custom Theme Scripts -->
						<script src="js/custom.min.js?123"></script>
					</body>
				</html>