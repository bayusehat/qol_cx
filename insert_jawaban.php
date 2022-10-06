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
	/*echo 'Connected to database';*/
	
	if(isset($_POST["xjawaban"], $_POST["xnomor"]))
	{
		$query = "UPDATE CC_QOL_DETIL_CX SET JAWABAN = ? WHERE ID_TRANS = ? AND NO_SOAL = ?";
		/*echo $query;*/
		$statement= $connect->prepare($query);
		$statement->bind_param("sss", $_POST["xjawaban"], $_POST["xid_trans"], $_POST["xnomor"]);
		$statement->execute();
	}
}
catch(PDOException $error)
{
	echo $error->getMessage();
}
?>