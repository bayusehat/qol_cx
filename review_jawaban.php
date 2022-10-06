<?php
session_start();
include "conf/connect.php";

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$id_trans = $_GET['id_trans'];
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

$usr = $_SESSION['uname'];
$thismonth = date('Ym');

$stmt = "SELECT * FROM CC_QOL_TRANSAKSI_CX WHERE ID_USER = '".$usr."' AND TO_CHAR(TGL_MULAI,'YYYYMM') = '".$thismonth."'";
$sql = mysqli_query($connect,$stmt);

$rows = mysqli_fetch_array($sql);

if(empty($rows[6]))
{
	echo "<script language=javascript>
			parent.location.href='petunjuk_soal.php';
		  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "structure/head.php"; ?>
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
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
		<div class="col-md-9 col-sm-9 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Review Jawaban</b></h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
			<form name="form_soal" id="form_soal">	
			<table width="100%" border="0">
	
	<?php
	$query=mysqli_query($connect, "SELECT NO_SOAL, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, JAWABAN, KUNCI_JAWABAN FROM CC_QOL_DETIL DETIL_CX INNER JOIN CC_QOL_MASTER_SOAL_CX SOAL ON DETIL.KODE_SOAL = SOAL.KODE_SOAL
    WHERE ID_TRANS = '".$id_trans."' AND NO_SOAL BETWEEN '".$awal."' AND '".$akhir."' ORDER BY NO_SOAL");
	/*$jumlah=mysqli_num_rows($query);*/
	
        while($row = mysqli_fetch_array($query))
        {
            $pertanyaan=$row["PERTANYAAN"];
			$no_soal=$row["NO_SOAL"];
            $pilihan_a=$row["OPSI_A"];
            $pilihan_b=$row["OPSI_B"];
            $pilihan_c=$row["OPSI_C"];
            $pilihan_d=$row["OPSI_D"];
			$jawaban = $row['JAWABAN'];
			$kunci = $row['KUNCI_JAWABAN'];
            
            ?>
            
			<tr>
				<td width="17" style="font-size: 1.2em; vertical-align: top;"><font color="#000000"><?php echo $no_soal; ?>.</font></td>
				<td width="430" style="font-size: 1.2em;"><font color="#000000"><?php echo $pertanyaan; ?></font></td>
            </tr>
            <tr>
				<td height="21"><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000" style="background-color: <?php if($kunci == "A") { echo "#3CB371"; }?>">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" style="background: #000" value="A<?php echo $no_soal; ?>" <?php if($jawaban == "A") { echo "checked"; }?> disabled >
					<?php echo "A. ".$pilihan_a;?></font></td>
            </tr>
            <tr>
				<td><font color="#000000">&nbsp;</font></td>
				<td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000" style="background-color: <?php if($kunci == "B") { echo "#3CB371"; }?>">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="B<?php echo $no_soal; ?>" <?php if($jawaban == "B") { echo "checked"; }?> disabled >
					<?php echo "B. ".$pilihan_b;?></font> </td>
            </tr>
            <tr>
				<td><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000" style="background-color: <?php if($kunci == "C") { echo "#3CB371"; }?>">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="C<?php echo $no_soal; ?>" <?php if($jawaban == "C") { echo "checked"; }?> disabled >
					<?php echo "C. ".$pilihan_c;?></font> </td>
            </tr>
            <tr style="margin-bottom: 10em;">
                <td><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000" style="background-color: <?php if($kunci == "D") { echo "#3CB371"; }?>">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="D<?php echo $no_soal; ?>" <?php if($jawaban == "D") { echo "checked"; }?> disabled > 
					<?php echo "D. ".$pilihan_d;?></font> </td>
            </tr>
			<tr>
				<td><font color="#000000">&nbsp;</font></td>
			</tr>
			
        <?php
        }
		/*
		$query2=mysqli_query($connect, "SELECT COUNT(*) AS JUMLAH FROM CC_QOL_DETIL WHERE ID_TRANS = '".$id_trans."'");
		$row2=mysqli_fetch_array($query2);
		$jumlah=$row2["JUMLAH"];
		*/
		$jumlah = 50;
        ?>
			
            </table>
			
				<!-- LINK FIRST AND PREV -->
        <?php
        if($awal == 1 && $akhir == 10){ // Jika page adalah page ke 1, maka disable link PREV
        ?>
          
        <?php
        }else{ // Jika page bukan page ke 1
          $prev_awal = ($awal > 10)? $awal - 10 : 1;
		  $prev_akhir = ($akhir >= 20)? $akhir - 10 : 1;
        ?>
          <a class="btn btn-prev btn-sm-modern" style="color: #fff; padding:7px 10px 7px 10px;" href="review_jawaban.php?id_trans=<?php echo $id_trans; ?>&awal=<?php echo $prev_awal; ?>&akhir=<?php echo $prev_akhir; ?>">PREVIOUS</a>
        <?php
        }
		?>
		
		<!-- LINK NEXT AND LAST -->
        <?php
        // Jika page sama dengan jumlah page, maka disable link NEXT nya
        // Artinya page tersebut adalah page terakhir 
        if($akhir == $jumlah){ // Jika page terakhir
        ?>
		</form>
          
        <?php
		
        }else{ // Jika Bukan page terakhir
          $next_awal = ($awal < $jumlah-10)? $awal + 10 : $jumlah;
		  $next_akhir = ($akhir < $jumlah)? $akhir + 10 : $jumlah;
        ?>
          <a class="btn btn-next btn-sm-modern" style="color:#fff; padding:7px 10px 7px 10px;" href="review_jawaban.php?id_trans=<?php echo $id_trans; ?>&awal=<?php echo $next_awal; ?>&akhir=<?php echo $next_akhir; ?>">NEXT</a>
        <?php
        }
        ?>
				
				</div>
			</div>
			
		</div>
		
		<div id="right-header">
		<div class="col-md-3 col-sm-3 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Sisa Waktu</b></h4>
				</div>
				<div id="countdown" class="countdown">00:00</div>
			</div>
		
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Indeks Soal</b></h4>
				</div>
				<table style="width:100%;">
					<?php
					echo "<table style='width:100%; text-align:center;' border='1'><br />";

					for ($row = 0; $row < 10; $row ++) {
						?>
						<tr>
						<?php

						for ($col = 1; $col <= 5; $col ++) {
							$nilai = $col + ($row * 5);
							$nilai_akhir = ceil($nilai / 10) * 10;
							?><td name="<?php echo $nilai; ?>"><a href= "review_jawaban.php?id_trans=<?php echo $id_trans; ?>&awal=<?php echo $nilai_akhir-9; ?>&akhir=<?php echo $nilai_akhir; ?>"><?php echo $nilai; ?></a></td> <?php
						}

						echo "</tr>";
					}

					echo "</table>";
					?>
				</table>
				<a href ="petunjuk_soal.php" class="btn btn-modern" style="color: #fff; margin-top:20px; width:100%;">KE PETUNJUK SOAL</a>
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

<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("right-header");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
	if( $(window).width() > 960 ) {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}}
</script>
</body>
</html>