<?php
session_start();
include "conf/connect.php";
$usr = $_SESSION['uname'];

try {
	if(isset($_POST['import'])){ // Jika user mengklik tombol Import
		$nama_file_baru = 'data.xlsx';
		
		// Load librari PHPExcel nya
		require_once 'PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		$sql_insert = "INSERT INTO CC_QOL_MASTER_SOAL (KATEGORI, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, KUNCI_JAWABAN) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$stmt_insert = $connect->prepare($sql_insert);
		$numrow = 1;
		foreach($sheet as $row){
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
				// Proses simpan ke Database
				$stmt_insert->bind_param("sssssss", $kategori, $pertanyaan, $opsi_a, $opsi_b, $opsi_c, $opsi_d, $kunci);
				$stmt_insert->execute(); // Eksekusi query insert
			}
    
			$numrow++; // Tambah 1 setiap kali looping
		}
	}
	header('location: admin_input_soal.php'); // Redirect ke halaman awal
}
catch(PDOException $error) {
	echo $error->getMessage();
}
?>