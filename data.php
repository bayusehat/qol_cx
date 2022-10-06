<?php
session_start();
include "conf/connect.php"; 

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$thismonth = date('Ym');

$sql_select = "
SELECT KETERANGAN, COUNT(*) AS JUMLAH
FROM (SELECT NIK,
    CASE
    WHEN A.STATUS = 'LULUS' THEN 'LULUS'
    WHEN A.STATUS = 'TIDAK LULUS' THEN 'TIDAK LULUS'
    END KETERANGAN
FROM CC_QOL_TRANSAKSI_CX A FULL JOIN CC_USER_LOGIN_CX B ON A.ID_USER = B.NIK
WHERE PRIVILEGE = '4' AND TGL_MULAI = '".$thismonth."' GROUP BY KETERANGAN
";
$stmt_select = mysqli_query($connect, $sql_select);

$rows = array();
while($r = mysqli_fetch_array($stmt_select)) {
	
	$row[0] = $r[0];
	$row[1] = $r[1];
	
	/*$kode= $r[0];
	$row[0] = $r[1];
	
	$hasil2 = mysql_query("SELECT count(*) as jum FROM master WHERE jrsn_pil1 = '$kode'");
    $data2 = mysql_fetch_row($hasil2);
    $row[1] = $data2[0];*/
	
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
?> 
