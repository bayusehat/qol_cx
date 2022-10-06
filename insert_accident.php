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
	if(isset($_POST["accident"], $_POST['xid_trans']))
	{
		$query1=mysqli_query($connect, "SELECT accident FROM CC_QOL_TRANSAKSI_CX WHERE ID_TRANS = '$_POST[xid_trans]'");
        $row = mysqli_fetch_array($query1);
        $accident = $row["accident"]." ".$_POST["accident"]."; ";
		$query=mysqli_query($connect, "UPDATE CC_QOL_TRANSAKSI_CX SET ACCIDENT = '$accident'");
	}
}
catch(PDOException $error)
{
	echo $error->getMessage();
}
?>