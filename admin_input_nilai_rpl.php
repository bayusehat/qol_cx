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

$getNama = mysqli_query($connect, "SELECT A.ID_TRANS, B.NAMA, A.NILAI, A.NILAI_WW, B.PRIVILEGE, (SELECT LOCATION FROM CC_CSR_GALLERY WHERE PERNER=A.ID_USER LIMIT 1) FROM CC_QOL_TRANSAKSI A, CC_USER_LOGIN B WHERE A.ID_USER = B.NIK ORDER BY A.ID_TRANS");
$getRPLNilai = mysqli_query($connect, "SELECT * FROM CC_RPL_DETIL WHERE ID_PENILAI = '$usr' ORDER BY ID_TRANS");
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
					<h4><b>Form Nilai Role Play</b></h4>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
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
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<br>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 csr">
					  
					<?php 
					if(isset($_POST['submit'])){
						$id_trans_raw = explode(" - ",$_POST['id_trans']);
						$id_trans = $id_trans_raw[1];
						$nilai_1 = $_POST['nilai_1'];
						$nilai_2 = $_POST['nilai_2'];
						$nilai_3 = $_POST['nilai_3'];
						$nilai_4 = $_POST['nilai_4'];
						$nilai_5 = $_POST['nilai_5'];
						$nilai_6 = $_POST['nilai_6'];
						$nilai_7 = $_POST['nilai_7'];
						$nilai_8 = $_POST['nilai_8'];
						$nilai_9 = $_POST['nilai_9'];
						$nilai_10 = $_POST['nilai_10'];
						$nilai_11 = $_POST['nilai_11'];
						$keterangan = $_POST['keterangan'];


						$result = mysqli_query($connect, "SELECT COUNT(ID_TRANS) FROM CC_RPL_DETIL WHERE ID_TRANS = '$id_trans' AND ID_PENILAI = $usr");
						$row = mysqli_fetch_array($result);
						if($row[0]==0){
							if($_POST['priv'] == '5'){
							  	$nil_8 = ",N8 ,N9, N10, N11";
								$val_8 =", ".$_POST['nilai_8'].", ".$_POST['nilai_9'].", ".$_POST['nilai_10'].", ".$_POST['nilai_11'];
							}
							$sql = "INSERT INTO CC_RPL_DETIL (ID_TRANS, ID_PENILAI, KETERANGAN, N1, N2, N3, N4, N5, N6, N7".$nil_8.") VALUES('".$id_trans."',".$usr.", '".$keterangan."', ".$nilai_1.",".$nilai_2.", ".$nilai_3.", ".$nilai_4.", ".$nilai_5.", ".$nilai_6.", ".$nilai_7.$val_8.")";
						} else {
							if($_POST['priv'] == '5'){
							  	$nil_8 = ",N8 = ".$_POST['nilai_8'].",N9 = ".$_POST['nilai_9'].",N10 = ".$_POST['nilai_10'].",N11 = ".$_POST['nilai_11'];
							}
							$sql = "UPDATE CC_RPL_DETIL SET KETERANGAN='$keterangan', N1=$nilai_1,N2=$nilai_2,N3=$nilai_3,N4=$nilai_4,N5=$nilai_5,N6=$nilai_6,N7=$nilai_7".$nil_8." WHERE ID_TRANS = '$id_trans' AND ID_PENILAI = $usr";
						}
							$stmt = mysqli_query($connect, $sql);
						  
						  	echo "<script language=javascript>
								parent.location.href='admin_input_nilai_rpl.php';
								</script>";
						  	echo "<p><div class=\"alert alert-dismissable alert-success\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								Soal berhasil ditambahkan.
						  	</div></p>"; 
	                    }

	                    $coc = [
	                    	"",
	                    	"Menghampiri pelanggan dengan mengucapkan salam yang standar",
	                    	"Mengutamakan mendengar saat menggali kebutuhan dan keinginan pelanggan",
	                    	"Meminta maaf jika harus meninggalkan pelanggan, menyampaikan untuk keperluan apa, dan mengucapkan terima kasih saat kembali",
	                    	"Memberi penjelasan yang menenangkan atas keluhan yang disampaikan pelanggan",
	                    	"Jika memungkinkan, memberi jalan keluar permasalahan dengan menawarkan produk yang relevan",
	                    	"Selalu memberi informasi mengenai <i>Function, Advantage, Benerfit</i> dan kewajiban pelanggan",
	                    	"Menutup layanan dengan salam dan terima kasih serta meminta feedback, menyampaikan myIndihome, twitter, facebook, email, dan 147",
	                    	"Morning Briefing",
	                    	"Interrupt/ekskalasi", 
	                    	"Evening briefing",
	                    	"Closing/CoC"
	                    ]; 

	                    ?>
						<?php for($i=1;$i<5;$i++){ ?>
						<div class="form-group" >
							<label class="control-label" for="nilai_<?php echo $i;?>"><?php echo $i.". ".$coc[$i];?>.  </label>
							<input type="number" min="0" max="100" class="form-control nlrpl" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
						</div> 
					<?php } ?>
              		</div>
              		<div class="col-md-6 col-sm-12 col-xs-12 csr">
					<?php for($i=5;$i<8;$i++){ ?>
					  	<div class="form-group" >
							<label class="control-label" for="nilai_<?php echo $i;?>"><?php echo $i.". ".$coc[$i];?>. </label>
							<input type="number" min="0" max="100" class="form-control nlrpl" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
						</div> 
					<?php } ?>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 tl">
					<?php for($i=8;$i<12;$i++){ ?>
					  	<div class="form-group" >
							<label class="control-label" for="nilai_<?php echo $i;?>"><?php echo $i.". ".$coc[$i];?>. </label>
							<input type="number" min="0" max="100" class="form-control nlrpl" value="0" id="nilai_<?php echo $i;?>" name="nilai_<?php echo $i;?>" required>
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
		var nrpl = {
		<?php
			$rpl = "";
			while ($row = mysqli_fetch_array($getRPLNilai)){
				$rpl .= "$row[0]:[$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],'$row[13]'],";
			}
			substr_replace($rpl ,"", -1);
			echo $rpl;
		?>
		};

		var peserta = [
		<?php
			$dat = "";
			$qol = "";
			$wwc = "";
			$priv = "";
			$img = "";
			while ($row = mysqli_fetch_array($getNama)){
				$dat .= "{'nama':'$row[1] - $row[0]','quiz':'$row[2]','wwc':'$row[3]','priv':'$row[4]','img':'$row[5]'},";
			}
			substr_replace($dat ,"", -1);
			echo $dat;
		?>
		];

		function set(arr,n){
		  var kons = 7;
          if(arr['priv']=='5'){
              $(".csr").hide();
	          $(".tl").show();
	          $("#priv").val(arr['priv']);
	          kons = 4;
          } else if(arr['priv']=='4' || arr['priv']=='6'){
              $(".tl").hide();
	          $(".csr").show();
	          $("#priv").val(arr['priv']);
	          kons = 7;
          }
		  setnlrpl();
          $("#image").append("<img class='imgpp' src='"+arr['img']+"' height='150px'>");
          $("#keterangan").val(n[11]);
          $("#nilai_qol").val(arr['quiz']);
          $("#nilai_wwc").val(arr['wwc']);
          $("#nilai_wwc_avg").val(arr['wwc']/kons);
          $("#nilai_1").val(n[0]);
          $("#nilai_2").val(n[1]);
          $("#nilai_3").val(n[2]);
          $("#nilai_4").val(n[3]);
          $("#nilai_5").val(n[4]);
          $("#nilai_6").val(n[5]);
          $("#nilai_7").val(n[6]);
          $("#nilai_8").val(n[7]);
          $("#nilai_9").val(n[8]);
          $("#nilai_10").val(n[9]);
          $("#nilai_11").val(n[10]);
		}

		function reset(){
          $(".imgpp").detach();
          $(".tl").hide();
	      $("#priv").val('0');
          $("#nilai_qol").val('0');
          $("#nilai_wwc").val('0');
          $("#nilai_wwc_avg").val('0');
          $("#keterangan").val('');
          $("#nilai_1").val('0');
          $("#nilai_2").val('0');
          $("#nilai_3").val('0');
          $("#nilai_4").val('0');
          $("#nilai_5").val('0');
          $("#nilai_6").val('0');
          $("#nilai_7").val('0');
          $("#nilai_8").val('0');
          $("#nilai_9").val('0');
          $("#nilai_10").val('0');
          $("#nilai_11").val('0');
		  $("#nilai_rpl").val('0');
		}

		function autocomplete(inp, arr, rpl) {
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
		          b.myParam2 = rpl[res[1]];
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
		autocomplete(document.getElementById("id_trans"), peserta, nrpl);
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

		function setnlrpl(){
			var tot = 0
		    $(".nlrpl").each(function(i, obj) {
		    	tot = tot + parseInt($(obj).val())
			});
			var priv = $("#priv").val();
			var kons = 7;
			if(priv=='5'){
	          kons = 4;
            } else if(priv=='4' || priv=='6'){
	          kons = 7;
            }

		  	$("#nilai_rpl").val(tot)
		  	$("#nilai_rpl_avg").val(tot/kons);
		}
		
		$(".nlrpl").change(function() {
			setnlrpl();
		});
	</script>
	
			<!-- footer content -->
			<?php include "structure/footer.php"; ?>
			<!-- /footer content -->
		</div>
	</body>
</html>
