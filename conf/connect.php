<?php
date_default_timezone_set("Asia/Jakarta");
// buat koneksi dengan database mysql

$dbhost = "localhost";
$dbuser = "cc_qol";
$dbpass = "telkom135";
$dbname = "ccaretre_qol";
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

//periksa koneksi, tampilkan pesan kesalahan jika gagal
if(!$connect){
die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
	 " - ".mysqli_connect_error());
}
?>
