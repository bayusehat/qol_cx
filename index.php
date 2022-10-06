
<!DOCTYPE html>
<html lang="en">

	<head>
		<?php include "structure/head.php"; ?>
	</head>

	<?php
	if($_SESSION['priv'] == '1' or $_SESSION['priv'] == '2'){
		echo
			"<script language=javascript>
				parent.location.href='admin_index.php';
			</script>";
	}
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
								<!-- <div class="x_title">
									<h4>
										<b>Tahapan Indihome Frontliner Contest CSR Plasa Telkom Regional V</b>
									</h4>
								</div>
								<div class="x_content">
									<div class="feature">
										<i class="fa fa-laptop"></i>
										<h3>#TEST ONLINE</h3>
										<p>Soal test online berupa pilihan ganda sebanyak 50 soal untuk CSR. Anda hanya dapat melaksanakan test online di waktu yang ditentukan. Pastikan anda mengerjakan menggunakan browser Chrome.</p>
									</div>
									<div class="feature">
										<i class="fa fa-user-secret"></i>
										<h3>#ROLE PLAY</h3>
										<p>Dikerjakan dalam waktu 60 menit. Jika waktu sudah TIDAK TERSISA, maka jawaban otomatis akan disubmit.</p>
									</div>
									<div class="feature">
										<i class="fa fa-users"></i>
										<h3>#WAWANCARA</h3>
										<p>Jika saat mengerjakan soal test online terasa lambat, Anda dapat me-refresh (reload) halaman.</p>
									</div>
									<div class="feature">
										<i class="fa fa-slideshare"></i>
										<h3>#PRESENTASI (KHUSUS TL)</h3>
										<p>Setiap hari soal akan diacak. Jika browser tidak sengaja tertutup, jawaban Anda akan tetap tersimpan.</p>
									</div>
								</div> -->
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