<?php
date_default_timezone_set("Asia/Bangkok");

//Koneksi ke Database
$oraHost  = '10.96.2.233';
$oraHostPort = '1521';
$oraSID   = 'dcspool';
$oraUser  = 'ccare';
$oraPwd   = 'ccare2014';
$db   	  = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $oraHost)(PORT = $oraHostPort))(CONNECT_DATA = (SID = $oraSID)))";
$connect  = OCILogon($oraUser,$oraPwd,$db);
//Baris akhir koneksi

//function sql_ora
if (!function_exists('sql_ora')) {
function sql_ora($sql=""){
global $connect,$sql;
$state=OCIparse($connect,$sql);
OCIexecute($state);
}
}
//end of function sql_ora
?>