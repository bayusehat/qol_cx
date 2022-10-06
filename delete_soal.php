<?php
session_start();
include "conf/connect.php"; 

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

try
{
	if(isset($_POST["xkode"])){
		$query = "DELETE FROM CC_QOL_MASTER_SOAL_CX WHERE KODE_SOAL = ?";
		/*echo $query;*/
		$statement= $connect->prepare($query);
		$statement->bind_param("i", $_POST["xkode"]);
		$statement->execute();
	}
}
catch(PDOException $error)
{
	echo $error->getMessage();
}
?>