<?php
// echo '<pre>';
// echo '<center>Access Denied, no schedule today for exam</center>';
// echo '</pre>';
// exit;
session_start();
include "conf/connect.php";

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

if($_SESSION['tzone']==1){
	date_default_timezone_set('Asia/Jakarta');
}else{
	date_default_timezone_set('Asia/Ujung_Pandang');
}

$date = date('Y-m-d H:i:00',strtotime('now'));
$enddate = date('Y-m-d H:i:00',strtotime('+32 minutes',strtotime($date)));
$iddate = date("ymd");
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$usr = $_SESSION['uname'];
$priv = $_SESSION['priv'];

if(isset($_POST['submit'])) {
	$id_trans = $usr.$iddate;
	$sql_tabel = "INSERT INTO CC_QOL_TRANSAKSI_CX(ID_TRANS, ID_USER, TGL_MULAI, ESTIMATED_TGL_SELESAI) VALUES('".$id_trans."', '".$usr."', '".$date."', '".$enddate."')";
	$log = mysqli_query($connect, $sql_tabel);

	// if($priv == "4"){
	// 	$details = [["CoC",10],["Product Knowledge",13],["Akhlak",5],["Kebijakan",12],["ComSkill",5],["IFCCX",5]];
	// }else{
	// 	$details = [["CoC",8],["Product Knowledge",10],["Akhlak",5],["Kebijakan",12],["ComSkill",5],["IFCCX",5],["Leadership",5]];
	// }

	$details = [["APLIKASI",5],["COC",15],["KNOWLEDGE",25],["AKHLAK",5]];
	$no = 1;

	// foreach ($details as $det) {
		// $hasil = mysqli_query($connect, "SELECT KODE_SOAL FROM CC_QOL_MASTER_SOAL WHERE KATEGORI = '$det[0]' ORDER BY rand() LIMIT $det[1]");
		$hasil = mysqli_query($connect, "SELECT KODE_SOAL FROM CC_QOL_MASTER_SOAL_CX ORDER BY KODE_SOAL");
		while ($i = mysqli_fetch_array($hasil)){

			$sql_insert = "INSERT INTO CC_QOL_DETIL_CX(ID_TRANS, KODE_SOAL, NO_SOAL) VALUES('".$id_trans."', '".$i[0]."', ".$no.")";
			$insert = mysqli_query($connect, $sql_insert);

			$no++;
		}
	// }

	echo "
	<script language=javascript>
		parent.location.href='latihan_soal.php?id_trans=".$id_trans."&awal=1&akhir=10';
    </script>
	";
}
?>
