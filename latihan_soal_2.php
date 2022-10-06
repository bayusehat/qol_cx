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
$priv = $_SESSION['priv'];

$thismonth = date('Ym');

$stmt = "SELECT * FROM CC_QOL_TRANSAKSI_CX WHERE ID_USER = '".$usr."' AND TGL_MULAI = '".$thismonth."'";
$sql = mysqli_query($connect,$stmt);

$rows = mysqli_fetch_array($sql);

if(!empty($rows[3]))
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
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
</head>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<!-- sidebar-menu -->
<?php //include "structure/sidebar-menu.php"; ?> 
<!-- sidebar-menu -->

<!-- top navigation -->
<?php //include "structure/top-nav.php"; ?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-9 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<div class="col-md-8 col-sm-8 col-xs-8">
						<h5><b>Soal Quiz</b></h5>
						<h3><b>Indihome Frontliner Contest</b></h3>
						<h4><b>Regional 5 2019</b></h4>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<h5><b>Nama:</b></h5>
						<h5><b>Perner:</b></h5>
						<h5><b>Witel:</b></h5>
						<h5><b>Plasa:</b></h5>
					
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
			<form name="form_soal" id="form_soal" method="post" action="generate_hasil.php">	
			<table width="100%" border="0">
	
	<?php
	$query=mysqli_query($connect, "SELECT NO_SOAL, PERTANYAAN, OPSI_A, OPSI_B, OPSI_C, OPSI_D, JAWABAN FROM CC_QOL_DETIL DETIL_CX INNER JOIN CC_QOL_MASTER_SOAL_CX SOAL ON DETIL.KODE_SOAL = SOAL.KODE_SOAL
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
            ?>
            
			<tr>
				<td width="17" style="font-size: 1.2em; vertical-align: top;"><font color="#000000"><?php echo $no_soal; ?>.</font></td>
				<td width="430" style="font-size: 1.2em;"><font color="#000000"><?php echo $pertanyaan; ?></font></td>
            </tr>
            <tr>
				<td height="21"><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000000">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="A<?php echo $no_soal; ?>" <?php if($jawaban == "A") { echo "checked"; }?> >
					<?php echo "A. ".$pilihan_a;?></font></td>
            </tr>
            <tr>
				<td><font color="#000000">&nbsp;</font></td>
				<td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000000">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="B<?php echo $no_soal; ?>" <?php if($jawaban == "B") { echo "checked"; }?>>
					<?php echo "B. ".$pilihan_b;?></font> </td>
            </tr>
            <tr>
				<td><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000000">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="C<?php echo $no_soal; ?>" <?php if($jawaban == "C") { echo "checked"; }?>>
					<?php echo "C. ".$pilihan_c;?></font> </td>
            </tr>
            <tr style="margin-bottom: 10em;">
                <td><font color="#000000">&nbsp;</font></td>
                <td style="font-size: 1.1em; text-indent: -17px; padding-left: 17px;"><font color="#000000">
					<input name="pilihan[<?php echo $no_soal; ?>]" type="radio" value="D<?php echo $no_soal; ?>" <?php if($jawaban == "D") { echo "checked"; }?>> 
					<?php echo "D. ".$pilihan_d;?></font> </td>
            </tr>
			<tr>
				<td><font color="#000000">&nbsp;</font></td>
			</tr>
			<script>
				$('input[name="pilihan[<?php echo $no_soal; ?>]"]').click(function(){
					$('td[name="<?php echo $id_trans; echo $no_soal; ?>"').addClass("on");
					localStorage.setItem('mySmallTokenState["<?php echo $id_trans; echo $no_soal; ?>"]', 'open');
					
					var id_trans = "<?php echo $id_trans; ?>";
					var pilihan = $(this).val();
					var jawaban = pilihan.substr(0,1);
					var nosoal = pilihan.substr(1,2);
					$.ajax({
						url:"insert_jawaban.php",
						method:"POST",
						data:{xjawaban:jawaban, xnomor:nosoal, xid_trans:id_trans}
					});
				});
			</script>
			
        <?php
        }
		/*
		$query2=mysqli_query($connect, "SELECT COUNT(*) AS JUMLAH FROM CC_QOL_DETIL WHERE ID_TRANS = '".$id_trans."'");
		$row2=mysqli_fetch_array($query2);
		$jumlah=$row2["JUMLAH"];
		*/
		if($priv == "4" || $priv == "5"){
			$jumlah = 50;
		} else if($priv == "6"){
			$jumlah = 25;
		}
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
          <!-- <a class="btn btn-prev btn-sm-modern" style="color: #fff; padding: 7px 10px 7px 10px;" href="latihan_soal.php?id_trans=<?php echo $id_trans; ?>&awal=<?php echo $prev_awal; ?>&akhir=<?php echo $prev_akhir; ?>">PREVIOUS</a> -->
        <?php
        }
		?>
		
		<!-- LINK NEXT AND SUBMIT -->
        <?php
        // Jika page sama dengan jumlah page, maka disable link NEXT nya
        // Artinya page tersebut adalah page terakhir 
        if($akhir == $jumlah){ // Jika page terakhir
        ?>
		
			<input type="hidden" name="id_trans" value="<?php echo $id_trans; ?>">
			<!--<input type="button" name="submit" value=" SUBMIT " class="btn-next btn-sm-modern" onclick="return confirm('Yakin ingin menyelesaikan latihan hari ini?');">-->
			
        <?php
		
        }else{ // Jika Bukan page terakhir
          $next_awal = ($awal < $jumlah-10)? $awal + 10 : $jumlah;
		  $next_akhir = ($akhir < $jumlah)? $akhir + 10 : $jumlah;
        ?>
          <!-- <a class="btn btn-next btn-sm-modern" style="color:#fff; padding: 7px 10px 7px 10px;" href="latihan_soal.php?id_trans=<?php echo $id_trans; ?>&awal=<?php echo $next_awal; ?>&akhir=<?php echo $next_akhir; ?>">NEXT</a> -->
        <?php
        }
        ?>
		</form>
				
				</div>
			</div>
			
		</div>
		
		
</div>
<!-- /page content -->

<!-- footer content -->
<?php //include "structure/footer.php"; ?>
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
  //   $(function() {
		// var form_soal = document.getElementById('form_soal');
  //       var timer2 = localStorage.getItem('timer<?php echo $id_trans; ?>');
  //       if(timer2 === null) timer2 = "59:59";
  //       $('.countdown<?php echo $id_trans; ?>').html(timer2);

		// var interval = setInterval(function() {
  //           var timer = timer2.split(':');
  //           var minutes = parseInt(timer[0], 10);
  //           var seconds = parseInt(timer[1], 10);
  //           --seconds;
  //           minutes = (seconds < 0) ? --minutes : minutes;
  //           if (minutes < 0){
  //               clearInterval(interval);
  //               localStorage.removeItem('timer<?php echo $id_trans; ?>');
  //               form_soal.submit()
  //           } else {
  //               seconds = (seconds < 0) ? 59 : seconds;
  //               seconds = (seconds < 10) ? '0' + seconds : seconds;
		// 		minutes = (minutes < 10) ? '0' + minutes : minutes;
  //               $('.countdown<?php echo $id_trans; ?>').html(minutes + ':' + seconds);
  //               timer2 = minutes + ':' + seconds;
  //               localStorage.setItem('timer<?php echo $id_trans; ?>',timer2);
  //           }
  //       }, 1000);
  //   });

    $(function() {
		// Set the date we're counting down to
		var countDownDate = new Date("Jan 27, 2019 17:00:00").getTime();

		// Update the count down every 1 second
		var interval = setInterval(function() {

		  // Get todays date and time
		  var now = new Date().getTime();
		    
		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;
		    
		  // Time calculations for days, hours, minutes and seconds
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		  if (minutes < 0){
                clearInterval(interval);
                localStorage.removeItem('timer<?php echo $id_trans; ?>');
                form_soal.submit()
          } else {
		  // Output the result in an element with id="demo"
			$('.countdown<?php echo $id_trans; ?>').html(minutes + ':' + seconds);
			timer2 = minutes + ':' + seconds;
			localStorage.setItem('timer<?php echo $id_trans; ?>',timer2);
		  }
		}, 1000);
    });


$(function() {
	<?php if($priv == "4" || $priv == "5"){ ?>
		kons = 50;
	<?php } else if($priv == "6"){ ?>
		kons = 25;
	<?php } ?>
	for (var i = 1; i <= kons; i++) {
		if(localStorage.getItem('mySmallTokenState["<?php echo $id_trans; ?>' + i +'"]') == 'open') {
			//add class with completed token
			$('td[name="<?php echo $id_trans ?>' + i + '"').addClass("on");
			//console.log('td[name="<?php echo $id_trans; echo $no_soal; ?>"');
		}
		if ($('input[name="pilihan[' + i + ']"]').is(":checked")){
			localStorage.setItem('mySmallTokenState["<?php echo $id_trans; ?>'+i+'"]', 'open');
			$('td[name="<?php echo $id_trans ?>' + i + '"').addClass("on");
		}
	}
});

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

function click_submit() {
	var form_soal = document.getElementById('form_soal');
	if(confirm( "Yakin ingin menyelesaikan latihan hari ini?" ) ) {
		localStorage.clear();	
		form_soal.submit();
	}
}
</script>
</body>
</html>

