<div class="col-md-3 left_col menu_fixed">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="index.php" class="site_title"> <span>Test Reliability Internal TR5</span></a>
		</div>
		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_info">
				<span>Welcome,</span>
				<h2><?php echo ucfirst($_SESSION['nama']); ?></h2>
			</div>
		</div>
		<!-- /menu profile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<!--<h3>General</h3>-->
				<ul class="nav side-menu">
					<?php
					if($priv == '4' or $priv == '5'){
					?>
					<li><a href="index.php"> Home</a></li>
					<li><a href="petunjuk_soal.php"> Test Online</a></li>
					<!-- <li><a href="daftar_nilai.php"> Daftar Nilai</a></li> -->
					<?php
					}
					?>
					
					<?php
					if($priv == '1' or $priv == '2'){
					?>
					<li><a href="admin_index.php"> Home</a></li>
					<li><a href="admin_input_nilai_wwc.php"> Input Nilai Wawancara</a></li>
					<li><a href="admin_input_nilai_rpl.php"> Input Nilai Role Play</a></li>
					<li><a href="admin_rekap_nilai_cc.php"> Rekap Nilai CC</a></li>
					<li><a href="admin_rekap_nilai_cm.php"> Rekap Nilai CM</a></li>
					<li><a href="admin_input_soal.php"> Input Soal Baru</a></li>
					<li><a href="admin_update_soal.php?kategori=ALL"> Update Soal</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->

		<!-- /menu footer buttons -->
		<!-- /menu footer buttons -->
	</div>
</div>