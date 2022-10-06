<?php
session_start();
$tload = microtime(true); 
include "conf/connect.php";

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$nama = $_SESSION['nama'];
$uname = $_SESSION['uname'];

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "structure/head.php"; ?>
		
		<style type="text/css">
			#hasil {
				width: 150px;
			}
		</style>
		
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
			
			<!-- page content -->
			<div class="col" role="main">
				<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Ganti Password</b></h4>
					<div class="clearfix"></div>
				</div>
				
				<!-- form edit profile -->
				<div class="col-md-12 col-sm-12 col-xs-12">
	            <form name="form1" method="post" action="">
                <div class="col-md-6 col-sm-12 col-xs-12"> 
				  
				  <?php 
                  if(isset($_POST['submit']))
                   {
				    $pass1 = $_POST['newpass1'];
				    $pass2 = $_POST['newpass2'];
				    if($pass1 == $pass2)
						{
						  mysqli_query($connect,"UPDATE CC_USER_LOGIN SET PASSWORD = '".$_POST['newpass1']."' 
								WHERE NIK = '".$_SESSION['uname']."'");

						  echo "<p><div class=\"alert alert-dismissable alert-success\">
						  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
						  Password berhasil diubah.
						  </div></p>"; 
						} else
						{
						echo "<p><div class=\"alert alert-dismissable alert-danger\">
						  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
						  Password tidak sama!
						  </div></p>"; 
						}
                    } 
                  ?>
				  
              <div class="form-group">
                <label class="control-label" for="nama">NAMA</label>
                <input class="form-control" id="nama" name="nama" type="text" value="<?php echo $nama; ?>" readonly>
              </div> 
				  
              <div class="form-group">
                <label class="control-label" for="uname">USERNAME</label>
                <input class="form-control" id="uname" name="uname" type="text" value="<?php echo $uname; ?>" readonly>
              </div> 

              <div class="form-group">
                <label class="control-label" for="newpass1">PASSWORD BARU</label>
                <input class="form-control" id="newpass1" name="newpass1" type="password" required>
              </div>  
           
              <div class="form-group">
                <label class="control-label" for="newpass2">KONFIRMASI PASSWORD</label>
                <input class="form-control" id="newpass2" name="newpass2" type="password" required>
              </div> 

              <div class="form-group">
              <input type="submit" value="Ubah Password" name="submit" class="btn-next btn-sm-modern" style="margin-top: 20px; margin-bottom: 20px;">
              </div>

              </div>
			  </form>
              </div>				
			<!-- /form edit profil -->
				
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

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="js/fastclick.js"></script>
	<!-- NProgress -->
	<script src="js/nprogress.js"></script>
	<!-- jQuery custom content scroller -->
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="js/custom.min.js"></script>
	
	<script src="js/jquery.dataTables.js"></script>
	</body>
</html>