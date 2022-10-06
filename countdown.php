<!DOCTYPE html>

<html lang="en">

<head>


	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- Meta, title, CSS, favicons, etc. -->

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Indihome Frontliner Contest CSR Plasa Telkom Regional V 2021</title>

	<!-- Bootstrap -->

	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->

	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- NProgress -->

	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">

	<!-- iCheck -->

	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

	<!-- Datatables -->

	<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

	<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

	<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">

	<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

	<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">



	<!-- jQuery custom content scroller -->

	<link href="css/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

	<!-- Animate.css -->

	<link href="css/animate.css" rel="stylesheet">

	<!-- Custom Theme Style -->

	<link href="css/custom.css" rel="stylesheet">

	<!-- Dropzone.js -->

	<link href="css/dropzone.min.css" rel="stylesheet">

	<!-- jQuery -->

	<script src="js/jquery.min.js"></script>


	<style type="text/css">
		#btnStop{
			display: none;
		}
		body {

		  -webkit-user-select: none;

		     -moz-user-select: -moz-none;

		      -ms-user-select: none;

		          user-select: none;

		}
		#countdown{
			font-size:300px;
			color:white;
		}

	</style>

</head>

<body class="nav-md">

<div class="container body">

<div class="main_container">



<!-- page content -->

<div class="" role="main">

	<div class="row">

		<div id="right-header">

		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="x_panel" style="float:right;height: 500px">

				<div class="x_title">

					<h4><b>COUNT DOWN</b></h4>

				</div>

				<div id="countdown" class="countdown1"></div>

				<br>

				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-warning btn-block" id="btnReset" onclick="resetTime();" disabled><i class="fa fa-refresh"></i> Reset</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-primary btn-block" id="btnStart" onclick="startTime();"><i class="fa fa-tasks"></i> Start</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-danger btn-block" id="btnStop" onclick="stopTime();"><i class="fa fa-stop"></i> Stop</button>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>

<!-- /page content -->



<!-- footer content -->


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
	$('.countdown1').html('00:00').css('background-color','green');

  	var interval;

    function startTime() {
    	$("#btnStop").show();
    	$("#btnStart").hide();

    	<?php
		    date_default_timezone_set('Asia/Jakarta'); 
		    $endtime = date('F d, Y H:i:s',strtotime("+29 minutes"));
		?>
    	// $(function() {

		// Set the date we're counting down to

		var countDownDate = new Date("<?php echo $endtime; ?>").getTime();

		// Update the count down every 1 second

		interval = setInterval(function() {



		  // Get todays date and time

		  var now = new Date().getTime();

		  // Find the distance between now and the count down date

		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds

		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  if (minutes < 0){

                clearInterval(interval);

                localStorage.removeItem('timer1');

                stopTime();

          } else {

		  // Output the result in an element with id="demo"

		  	sc = seconds;

		  	mn = minutes;

		  	if (sc < 10){

		  		sc = "0"+sc;

		  	}

		  	ma = mn;

		  	if (mn < 10){

		  		mn = "0"+mn;

		  	}

			if(ma > 9){
				$('.countdown1').html(mn + ':' + sc).css('background-color','green');
				$('.countdown1').css('color','white');
			}else if(ma <= 9 && ma >= 1){
				$('.countdown1').html(mn + ':' + sc).css('background-color','yellow');
				$('.countdown1').css('color','black');
			}else{
				$('.countdown1').html(mn + ':' + sc).css('background-color','red');
				$('.countdown1').css('color','white');
			}

			sn = mn+':'+sc;
			
			if(sn == '10:00'){
				play();
			}else if(sn == '01:00'){
				play();
			}else if(sn == '00:00'){
				play();
			}


			timer2 = minutes + ':' + seconds;

			localStorage.setItem('timer1',timer2);

		  }

		}, 1000);

		console.log(interval);
    // });
		play()
    }

    function stopTime() {
    	console.log(interval);
    	clearInterval(interval);
    	console.log(interval);
    	localStorage.removeItem('timer1');
    	$("#btnReset").attr('disabled',false);
    	$("#btnStart").show().attr('disabled',true);
    	$("#btnStop").hide();
    }

    function resetTime() {
    	location.reload();
    }

    function play() { 
		var beepsound = new Audio( 
		'https://www.soundjay.com/button/sounds/beep-01a.mp3'); 
		beepsound.play(); 
	} 


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



