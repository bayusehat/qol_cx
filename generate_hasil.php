<?php
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

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$usr = $_SESSION['uname']; 
$nm = $_SESSION['nama'];
$priv = $_SESSION['priv'];
$date = date("Y-m-d H:i:00");


if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id_trans = $_POST['id_trans'];
	
	$sql_today = "UPDATE CC_QOL_TRANSAKSI_CX SET TGL_SELESAI = '$date' WHERE ID_TRANS = '".$id_trans."'";
	$stmt_today = mysqli_query($connect, $sql_today);
	//echo $sql_today;
	
	$sql_select = "SELECT A.ID_TRANS, A.KODE_SOAL, IF(A.JAWABAN = B.KUNCI_JAWABAN, 'BENAR', 'SALAH') AS KETERANGAN FROM CC_QOL_DETIL_CX A LEFT JOIN CC_QOL_MASTER_SOAL_CX B ON (A.KODE_SOAL = B.KODE_SOAL) WHERE A.ID_TRANS = '".$id_trans."'";

	$stmt_select = mysqli_query($connect, $sql_select);
	while ($col = mysqli_fetch_array($stmt_select)) {
		
		$sql_update = "UPDATE CC_QOL_DETIL_CX SET KETERANGAN = '".$col[2]."' WHERE ID_TRANS = '".$col[0]."' AND KODE_SOAL = '".$col[1]."'";
		$stmt_update = mysqli_query($connect, $sql_update);
	}
	
	$sql_status = "SELECT ID_TRANS, ID_USER, NILAI, IF(NILAI >= 85,'LULUS','TIDAK LULUS') AS STATUS FROM CC_QOL_TRANSAKSI_CX WHERE ID_TRANS = '".$id_trans."'";

	$stmt_status = mysqli_query($connect, $sql_status);
	while ($col3 = mysqli_fetch_array($stmt_status)) {
		
		$sql_update3 = "UPDATE CC_QOL_TRANSAKSI_CX SET STATUS = '".$col3[3]."' WHERE ID_TRANS = '".$col3[0]."'";
		$stmt_update3 = mysqli_query($connect, $sql_update3);
	}
	$kons = 2;
	if($priv == "6"){
		$kons = 4;
	} 
	$sql_nilai = "SELECT COUNT(KETERANGAN) AS JML_BENAR, COUNT(KETERANGAN)*$kons AS NILAI FROM CC_QOL_DETIL_CX WHERE ID_TRANS = '".$id_trans."' AND KETERANGAN = 'BENAR'";
	/*echo $sql_nilai;*/
	$stmt_nilai = mysqli_query($connect, $sql_nilai);
	while ($col2 = mysqli_fetch_array($stmt_nilai)) {
		
		$sql_update2 = "UPDATE CC_QOL_TRANSAKSI_CX SET JML_BENAR = ".$col2[0].", NILAI = ".$col2[1]." WHERE ID_TRANS = '".$id_trans."'";
		$stmt_update2 = mysqli_query($connect, $sql_update2);
	}
	/*echo $sql_update2;*/
	
	echo "
	<script language=javascript>
		parent.location.href='petunjuk_soal.php';
    </script>
	";
}
?>