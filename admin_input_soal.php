<?php
session_start();
$tload = microtime(true); 
include "conf/connect.php";

$usr = $_SESSION['uname'];

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$getKategori = mysqli_query($connect, "SELECT DISTINCT KATEGORI FROM CC_QOL_MASTER_SOAL WHERE KATEGORI IS NOT NULL ORDER BY KATEGORI");
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
		</style>
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
					<h4><b>Input Soal Baru</b></h4>
					<div class="clearfix"></div>
				</div>
				
				<div class="x_content">
				<!-- form edit profile -->
				<div class="col-md-6 col-sm-12 col-xs-12">
	            <form name="form1" id="form1" method="post" action="">
				  
				  <?php 
                  if(isset($_POST['submit'])){
					  $kategori = strtoupper($_POST['textkategori']);
					  $soal = $_POST['soal'];
					  $pilihan_a = $_POST['pilihan_a'];
					  $pilihan_b = $_POST['pilihan_b'];
					  $pilihan_c = $_POST['pilihan_c'];
					  $pilihan_d = $_POST['pilihan_d'];
					  $kunci_jawaban = strtoupper($_POST['kunci_jawaban']);
					  
						  $sql_insert = "INSERT INTO CC_QOL_MASTER_SOAL (KATEGORI, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, KUNCI_JAWABAN, KETERANGAN) VALUES('".$kategori."', '".$soal."', '".$pilihan_a."',  '".$pilihan_b."',  '".$pilihan_c."',  '".$pilihan_d."',  '".$kunci_jawaban."', '".$usr."')";
						  $stmt_insert = mysqli_query($connect, $sql_insert);
						  
						  echo "<script language=javascript>
							parent.location.href='admin_input_soal.php';
						</script>";
						  echo "<p><div class=\"alert alert-dismissable alert-success\">
						  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
						  Soal berhasil ditambahkan.
						  </div></p>"; 
                    }
                  ?>

              <div class="form-group">
				<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
					<label class="control-label" for="kategori">KATEGORI</label>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4" style="padding-left:0; padding-right:10px;">
					<!--<input class="form-control" id="kategori" name="kategori">-->
					<select name="kategori" id="kategori" class="form-control input">
						<option disabled selected value style="display:none">- pilih opsi -</option>
						<?php while($col_kategori = mysqli_fetch_array($getKategori)) { ?>
						<option value="<?php echo $col_kategori[0]; ?>"><?php echo $col_kategori[0]; ?></option>
						<?php } ?>
						<option value="">OTHER</option>
					</select>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-8" style="padding-left:0; padding-right:0;">
					<input readonly class="form-control" id="textkategori" name="textkategori" style="text-transform:uppercase" required>
				</div>
			</div>
			  
			  <div class="form-group"  style="padding-top: 70px;">
                <label class="control-label" for="soal">SOAL</label>
                <input class="form-control" id="soal" name="soal" required>
              </div>  
           
              <div class="form-group" >
                <label class="control-label" for="pilihan_a">PILIHAN A</label>
                <input class="form-control" id="pilihan_a" name="pilihan_a" required>
              </div> 
			  
			  <div class="form-group">
                <label class="control-label" for="pilihan_b">PILIHAN B</label>
                <input class="form-control" id="pilihan_b" name="pilihan_b" required>
              </div>
			  
			  <div class="form-group">
                <label class="control-label" for="pilihan_c">PILIHAN C</label>
                <input class="form-control" id="pilihan_c" name="pilihan_c" required>
              </div>
			  
			  <div class="form-group">
                <label class="control-label" for="pilihan_d">PILIHAN D</label>
                <input class="form-control" id="pilihan_d" name="pilihan_d" required>
              </div>
			  
			  <div class="form-group">
                <label class="control-label" for="kunci_jawaban">KUNCI JAWABAN</label>
                <input class="form-control" id="kunci_jawaban" name="kunci_jawaban" style="text-transform:uppercase" maxlength="1" required>
              </div> 

              <div class="form-group">
              <input type="submit" value="Input Soal" name="submit" class="btn-next btn-sm-modern" style="margin-top: 20px; margin-bottom: 20px;">
              </div>

			  </form>
              </div>	
			<!-- /form edit profil -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="border-style: dashed; border-width: 1.5px; padding: 10px;">
				<div class="x_title">
					<h4>Import Soal dari File Excel</h4>
				</div>
			
						<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
						<form method="post" action="" enctype="multipart/form-data">
						<p style="text-align:justify">Untuk memudahkan dalam menginput banyak soal sekaligus, dapat menggunakan fitur upload soal dari file Excel (.xlsx) menggunakan format yang dapat diunduh di bawah ini.</p>
							
							<a href="format.xlsx" class="btn btn-default">
								<span class="glyphicon glyphicon-download"></span> Download Format
							</a><br><br>
						
						<!-- 
						-- Buat sebuah input type file
						-- class pull-left berfungsi agar file input berada di sebelah kiri
						-->
						<input type="file" id="selectedFile" name="file" class="pull-left btn btn-default">
						<!--<input type="button" value="Browse..." class="btn btn-default" onclick="document.getElementById('selectedFile').click();">
						-->
						
						<button type="submit" name="preview" class="btn btn-new-success btn-next">
						  <span class="glyphicon glyphicon-eye-open"></span> Preview
						</button>
					  </form>
					  
					  <!--<hr>-->
					  
					  <!-- Buat Preview Data -->
					  <?php
					  // Jika user telah mengklik tombol Preview
					  if(isset($_POST['preview'])){
						$nama_file_baru = 'data.xlsx';
						
						// Cek apakah terdapat file data.xlsx pada folder tmp
						if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
						  unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
						
						$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
						$tmp_file = $_FILES['file']['tmp_name'];
						
						// Cek apakah file yang diupload adalah file Excel (.xlsx)
						if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
						  // Upload file yang dipilih ke folder tmp
						  move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
						  
						  // Load librari PHPExcel nya
						  require_once 'PHPExcel/PHPExcel.php';
						  
						  $excelreader = new PHPExcel_Reader_Excel2007();
						  $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
						  $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
						  
						  echo "<br>";
						  
						  // Buat sebuah tag form untuk proses import data ke database
						  echo "<form method='post' action='admin_import_soal.php'>";
						  
						  // Buat sebuah div untuk alert validasi kosong
						  echo '<div class="alert alert-danger" id="kosong">
						  Semua data belum diisi. Ada <span id="jumlah_kosong"></span> baris data yang belum diisi.
						  </div>';
						  ?>
						  
						  <table id='table_preview' class='table table-bordered' style="width:100%;">
						  <thead>
							<th>Kategori</th>
							<th>Pertanyaan</th>
							<th>Opsi A</th>
							<th>Opsi B</th>
							<th>Opsi C</th>
							<th>Opsi D</th>
							<th>Kunci</th>
						  </thead>
						  
						  <tbody>
						  <?php
						  $numrow = 1;
						  $kosong = 0;
						  foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
							// Ambil data pada excel sesuai Kolom
							$kategori = $row['A']; // Ambil data kategori
							$pertanyaan = $row['B']; // Ambil data pilihan
							$opsi_a = $row['C']; // Ambil data opsi a
							$opsi_b = $row['D']; // Ambil data opsi b
							$opsi_c = $row['E']; // Ambil data opsi c
							$opsi_d = $row['F']; // Ambil data opsi d
							$kunci = $row['G']; // Ambil data kunci jawaban
							
							// Cek jika semua data tidak diisi
							if(empty($kategori) && empty($pertanyaan) && empty($opsi_a) && empty($opsi_b) && empty($opsi_c)&& empty($opsi_d)&& empty($kunci))
							  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
							
							// Cek $numrow apakah lebih dari 1
							// Artinya karena baris pertama adalah nama-nama kolom
							// Jadi dilewat saja, tidak usah diimport
							if($numrow > 1){
							  // Validasi apakah semua data telah diisi
							  $kategori_td = ( ! empty($kategori))? "" : " style='background: #E07171;'"; // Jika kategori kosong, beri warna merah
							  $pertanyaan_td = ( ! empty($pertanyaan))? "" : " style='background: #E07171;'"; // Jika pertanyaan kosong, beri warna merah
							  $opsi_a_td = ( ! empty($opsi_a))? "" : " style='background: #E07171;'"; // Jika opsi a kosong, beri warna merah
							  $opsi_b_td = ( ! empty($opsi_b))? "" : " style='background: #E07171;'"; // Jika opsi b kosong, beri warna merah
							  $opsi_c_td = ( ! empty($opsi_c))? "" : " style='background: #E07171;'"; // Jika opsi c kosong, beri warna merah
							  $opsi_d_td = ( ! empty($opsi_d))? "" : " style='background: #E07171;'"; // Jika opsi d kosong, beri warna merah
							  $kunci_td = ( ! empty($kunci))? "" : " style='background: #E07171;'"; // Jika kunci jawaban kosong, beri warna merah
							  
							  // Jika salah satu data ada yang kosong
							  if(empty($kategori) or empty($pertanyaan) or empty($opsi_a) or empty($opsi_b) or empty($opsi_c) or empty($opsi_d) or empty($kunci)){
							  	var_dump($pertanyaan);
								$kosong++; // Tambah 1 variabel $kosong
							  }
							  ?>
							  <tr>
							  <td<?php echo $kategori_td; ?>><?php echo $kategori; ?></td>
							  <td<?php echo $pertanyaan_td; ?>><?php echo $pertanyaan; ?></td>
							  <td<?php echo $opsi_a_td; ?>><?php echo $opsi_a; ?></td>
							  <td<?php echo $opsi_b_td; ?>><?php echo $opsi_b; ?></td>
							  <td<?php echo $opsi_c_td; ?>><?php echo $opsi_c; ?></td>
							  <td<?php echo $opsi_d_td; ?>><?php echo $opsi_d; ?></td>
							  <td<?php echo $kunci_td; ?>><?php echo $kunci; ?></td>
							  </tr>
							  <?php
							}
							$numrow++; // Tambah 1 setiap kali looping
						  }
						  ?></tbody><?php
						  
						  ?> </table>
						  <script>
							$(document).ready(function() {
								$('#table_preview').dataTable({
									"iDisplayLength": 5,
									"aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
									"ordering": false
										});
							});
							</script>
						  <?php
						  echo "<br><br><br>";
						  
						  // Cek apakah variabel kosong lebih dari 1
						  // Jika lebih dari 1, berarti ada data yang masih kosong
						  if($kosong > 0){
						  ?>  
							<script>
							$(document).ready(function(){
							  // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							  $("#jumlah_kosong").html('<?php echo $kosong; ?>');
							  
							  $("#kosong").show(); // Munculkan alert validasi kosong
							});
							</script>
						  <?php
						  }else{ // Jika semua data sudah diisi
							// Buat sebuah tombol untuk mengimport data ke database
							echo "<button type='submit' name='import' class='btn btn-next btn-new-success'><span class='glyphicon glyphicon-upload'></span> Import</button>";
						  }
						  
						  echo "</form>";
						}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
						  // Munculkan pesan validasi
						  echo "<div class='alert alert-danger'>
						  Hanya File Excel (.xlsx) yang diperbolehkan
						  </div>";
						}
					  }
					  ?>
					  </div>
					  </div>
					</div>
				</div>
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
	
	<script>
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