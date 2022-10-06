<?php
session_start();
$tload = microtime(true); 
include "conf/connect.php";

$usr = $_SESSION['uname'];

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$getNama = mysqli_query($connect, "SELECT A.ID_TRANS, B.NAMA, A.NILAI, A.NILAI_RP, B.PRIVILEGE, (SELECT LOCATION FROM CC_CSR_GALLERY WHERE PERNER=A.ID_USER LIMIT 1) AS LOCATION FROM CC_QOL_TRANSAKSI A, CC_USER_LOGIN B WHERE A.ID_USER = B.NIK ORDER BY A.ID_TRANS");
$getWWCNilai = mysqli_query($connect, "SELECT * FROM CC_WWC_DETIL WHERE ID_PENILAI = '$usr' ORDER BY ID_TRANS");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "structure/head.php"; ?>
		
		<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
		
		<script>
			$(document).ready(function(){
			  // Sembunyikan alert validasi kosong
			  $("#kosong").hide();
			});
			</script>
		
		<style type="text/css">
			#hasil {
				width: 150px;
			}
			
			input {
			  border: 1px solid transparent;
			  background-color: #f1f1f1;
			  padding: 10px;
			  font-size: 16px;
			}
			
			.autocomplete-items {
			  position: absolute;
			  border: 1px solid #d4d4d4;
			  border-bottom: none;
			  border-top: none;
			  z-index: 99;
			  /*position the autocomplete items to be the same width as the container:*/
			  top: 100%;
			  left: 0;
			  right: 0;
			}
			.autocomplete-items div {
			  padding: 10px;
			  cursor: pointer;
			  background-color: #fff; 
			  border-bottom: 1px solid #d4d4d4; 
			}
			.autocomplete-items div:hover {
			  /*when hovering an item:*/
			  background-color: #e9e9e9; 
			}
			.autocomplete-active {
			  /*when navigating through the items using the arrow keys:*/
			  background-color: DodgerBlue !important; 
			  color: #ffffff; 
			}
		</style>
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
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><b>Form Nilai Wawancara</b></h4>
					<div class="clearfix"></div>
				</div>
				
				<!-- form edit profile -->
	            <form name="form1" id="form1" method="post" action="" autocomplete="off">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div id="image">
							
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="col-md-12 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="id_trans">NAMA PESERTA</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" id="id_trans" type="text" name="id_trans" placeholder="PESERTA">
										<input class="form-control" id="priv" type="hidden" name="priv" value="">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							</br>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-6">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_wwc">WAWANCARA</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" value="0" id="nilai_wwc" type="text" name="nilai_wwc" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-6">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_wwc_avg">WAWANCARA AVG</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" value="0" id="nilai_wwc_avg" type="text" name="nilai_wwc_avg" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-12 col-xs-12">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_qol">QUIZ</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" value="0" id="nilai_qol" type="text" name="nilai_qol"  disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-6">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_rpl">ROLE PLAY</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" value="0" id="nilai_rpl" type="text" name="nilai_rpl" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-6">
			            	<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<label class="control-label" for="nilai_rpl">ROLE PLAY AVG</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:0; padding-right:10px;">
									<div class="autocomplete">
										<input class="form-control" value="0" id="nilai_rpl_avg" type="text" name="nilai_rpl_avg" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
					  
					<?php 
					if(isset($_POST['submit'])){
						$id_trans_raw = explode(" - ",$_POST['id_trans']);
						$id_trans = $id_trans_raw[1];
						$keterangan = $_POST['keterangan'];
						$nilai_1 = $_POST['nilai_1'];
						$nilai_2 = $_POST['nilai_2'];
						$nilai_3 = $_POST['nilai_3'];
						$nilai_4 = $_POST['nilai_4'];
						$nilai_5 = $_POST['nilai_5'];

						$result = mysqli_query($connect, "SELECT COUNT(ID_TRANS) FROM CC_WWC_DETIL WHERE ID_TRANS = '$id_trans' AND ID_PENILAI = $usr");
						$row = mysqli_fetch_array($result);
						if($row[0]==0){
							if($_POST['priv'] == '5'){
							  	$nil_TL = ",N5, N6, N7";
								$val_TL =", ".$_POST['nilai_6'].", ".$_POST['nilai_7'];
							}
							$sql = "INSERT INTO CC_WWC_DETIL (ID_TRANS, ID_PENILAI, KETERANGAN, N1, N2, N3, N4, N5".$nil_TL.") VALUES('".$id_trans."',".$usr.", '".$keterangan."', ".$nilai_1.", ".$nilai_2.", ".$nilai_3.", ".$nilai_4.", ".$nilai_5.$val_TL.")";
						} else {
							if($_POST['priv'] == '5'){
							  	$nil_TL = ",N6 = ".$_POST['nilai_6'].",N7 = ".$_POST['nilai_7'];
							}
							$sql = "UPDATE CC_WWC_DETIL SET KETERANGAN='$keterangan', N1=$nilai_1,N2=$nilai_2,N3=$nilai_3,N4=$nilai_4,N5=$nilai_5".$nil_TL." WHERE ID_TRANS = '$id_trans' AND ID_PENILAI = $usr";
						}
							$stmt = mysqli_query($connect, $sql);
						  
						  	echo "<script language=javascript>
								parent.location.href='admin_input_nilai_wwc.php';
								</script>";
						  	echo "<p><div class=\"alert alert-dismissable alert-success\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								Soal berhasil ditambahkan.
						  	</div></p>"; 
	                    }

	                    $coc = [
	                    	"",
	                    	"Penampilan (Skala 100)",
	                    	"Komunikasi (Skala 100)",
							"Ide / Inovasi (Skala 100)",
	                    	"Semangat / Motivasi (Skala 100)",
	                    	"Tantangan / Hambatan (Skala 100)",
	                    	"Target Tim (Skala 100)",
	                    	"Konten (Skala 100)"
	                    ]; ?>
						<?php for($i=1;$i<5;$i++){ ?>
						<div class="form-group" >
							<label class="control-label" for="nilai_<?php echo $i;?>"><?php echo $i.". ".$coc[$i];?>.  </label>
							<input type="number" min="0" max="100" class="form-control nlwwc" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
						</div> 
					<?php } ?>
              		</div>
              		<div class="col-md-6 col-sm-12 col-xs-12">
              			<div class="form-group" >
							<label class="control-label" for="nilai_5">5. <?php echo $coc[5];?>. </label>
							<input type="number" min="0" max="100" class="form-control nlwwc" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
						</div> 
					<?php for($i=6;$i<8;$i++){ ?>
					  	<div class="form-group tl" >
							<label class="control-label" for="nilai_<?php echo $i;?>"><?php echo $i.". ".$coc[$i];?>. </label>
							<input type="number" min="0" max="100" class="form-control nlwwc" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
						</div> 
					<?php } ?>
              		</div>	
              		<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label">Keterangan: </label>
							<textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Input Nilai" name="submit" class="btn-next btn-sm-modern" style="margin-top: 20px; margin-bottom: 20px;">
						</div>
              		</div>	
				</form>
			<!-- /form edit profil -->
			
			</div>
		</div>

		<!-- HITUNG TOTAL NILAI SEMENTARA -->
		<!-- PAS FOTO PROFILE -->

			<!-- footer content -->
			<?php include "structure/footer.php"; ?>
			<!-- /footer content -->
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
	
	<script src="js/jquery.dataTables.js?123"></script>
	
	<script>
		var nwwc = {
		<?php
			$wwc = "";
			while ($row = mysqli_fetch_array($getWWCNilai)){
				$wwc .= "$row[0]:[$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],'$row[9]'],";
			}
			substr_replace($wwc ,"", -1);
			echo $wwc;
		?>
		};

		var peserta = [
		<?php
			$dat = "";
			$qol = "";
			$rpl = "";
			$priv = "";
			$img = "";
			while ($row = mysqli_fetch_array($getNama)){
				$dat .= "{'nama':'$row[1] - $row[0]','quiz':'$row[2]','rpl':'$row[3]','priv':'$row[4]','img':'$row[5]'},";
			}
			substr_replace($dat ,"", -1);
			echo $dat;
		?>
		];

		function set(arr,n){
          var kons = 5;
          if(arr['priv']=='5'){
	          $(".tl").show();
	          $("#priv").val(arr['priv']);
	          kons = 7;
          }
		  setnlwwc();
          $("#image").append("<img class='imgpp' src='"+arr['img']+"' height='150px'>");
          $("#keterangan").val(n[7]);
          $("#nilai_qol").val(arr['quiz']);
          $("#nilai_rpl").val(arr['rpl']);
          $("#nilai_rpl_avg").val(arr['rpl']/kons);
          $("#nilai_1").val(n[0]);
          $("#nilai_2").val(n[1]);
          $("#nilai_3").val(n[2]);
          $("#nilai_4").val(n[3]);
          $("#nilai_5").val(n[4]);
          $("#nilai_6").val(n[5]);
          $("#nilai_7").val(n[6]);
		}

		function reset(){
          $(".imgpp").detach();
          $(".tl").hide();
	      $("#priv").val('0');
          $("#nilai_qol").val('0');
          $("#nilai_rpl").val('0');
          $("#nilai_rpl_avg").val('0');
          $("#nilai_1").val('0');
          $("#nilai_2").val('0');
          $("#nilai_3").val('0');
          $("#nilai_4").val('0');
          $("#nilai_5").val('0');
          $("#nilai_6").val('0');
          $("#nilai_7").val('0');
          $("#keterangan").val('');
		}

		function autocomplete(inp, arr, wwc) {
		  var currentFocus;
		  inp.addEventListener("input", function(e) {
		  	  console.log("a");
		      var a, b, i, val = this.value;
		      closeAllLists();
		      if (!val) { return false;}
		      currentFocus = -1;
		      a = document.createElement("DIV");
		      a.setAttribute("id", this.id + "autocomplete-list");
		      a.setAttribute("class", "autocomplete-items");
		      this.parentNode.appendChild(a);
		      for (i = 0; i < arr.length; i++) {
		        if (arr[i]['nama'].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
		          b = document.createElement("DIV");
		          b.innerHTML = "<strong>" + arr[i]['nama'].substr(0, val.length) + "</strong>";
		          b.innerHTML += arr[i]['nama'].substr(val.length);
		          b.innerHTML += "<input type='hidden' value='" + arr[i]['nama'] + "'>";
		          b.myParam1 = arr[i];
				  res = arr[i]['nama'].split(" - ");
		          b.myParam2 = wwc[res[1]];
	              b.addEventListener("click", function(e) {
		              inp.value = this.getElementsByTagName("input")[0].value;
		              set(e.target.myParam1,e.target.myParam2);
		              closeAllLists();
		          });
		          a.appendChild(b);

		        }
		      }
		  });
		  inp.addEventListener("keydown", function(e) {
		  	  console.log("b");
		      var x = document.getElementById(this.id + "autocomplete-list");
		      if (x) x = x.getElementsByTagName("div");
		      if (e.keyCode == 40) {
		        currentFocus++;
		        addActive(x);
		      } else if (e.keyCode == 38) { //up
		        currentFocus--;
		        addActive(x);
		      } else if (e.keyCode == 13) {
		        e.preventDefault();
		        if (currentFocus > -1) {
		          if (x) x[currentFocus].click();
		        }
		      }
		  });
		  function addActive(x) {
		  	  console.log("c");
		    if (!x) return false;
		    removeActive(x);
		    if (currentFocus >= x.length) currentFocus = 0;
		    if (currentFocus < 0) currentFocus = (x.length - 1);
		    x[currentFocus].classList.add("autocomplete-active");
		  }
		  function removeActive(x) {
		  	  console.log("d");
		    for (var i = 0; i < x.length; i++) {
		      x[i].classList.remove("autocomplete-active");
		    }
		  }
		  function closeAllLists(elmnt) {
		    var x = document.getElementsByClassName("autocomplete-items");
		    for (var i = 0; i < x.length; i++) {
		      if (elmnt != x[i] && elmnt != inp) {
		      x[i].parentNode.removeChild(x[i]);
			    }
			}
		  }
		  document.addEventListener("click", function (e) {
		    closeAllLists(e.target);
		  });
		}
		autocomplete(document.getElementById("id_trans"), peserta, nwwc);
		$("#id_trans").change(function() {
		  for (x in peserta){
			if ($("#id_trans").val()!=peserta[x]){
			  reset();
			}
		  }
		  if ($("#id_trans").val()==""){
	          reset();
		  }
		});

		function setnlwwc(){
			var tot = 0
		    $(".nlwwc").each(function(i, obj) {
		    	tot = tot + parseInt($(obj).val())
			});
		  	var priv = $("#priv").val();
			var kons = 5;
			if (priv == '5'){
				kons = 7;
			}

		  	$("#nilai_wwc").val(tot)
		  	$("#nilai_wwc_avg").val(tot/kons);
		}
		
		$(".nlwwc").change(function() {
			setnlwwc();
		});
	</script>
	
	</body>
</html>

