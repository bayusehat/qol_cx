<?php
session_start();
include "conf/connect.php"; 

if(empty($_SESSION['uname']))
{
	echo "<script language=javascript>
			parent.location.href='login.php';
		  </script>";
}

$usr = $_SESSION['uname'];
$nm = $_SESSION['nama'];
$priv = $_SESSION['priv'];

	//"SELECT ID_USER, B.NAMA, PLASA, WITEL, DATE_FORMAT(TGL_MULAI,'%Y-%b') BULAN, TGL_MULAI, NILAI, A.STATUS FROM CC_QOL_TRANSAKSI A JOIN CC_USER_LOGIN B ON A.ID_USER = B.NIK WHERE NILAI IS NOT NULL ORDER BY TGL_SELESAI DESC";
// SELECT ID_USER, B.NAMA, PLASA, WITEL, DATE_FORMAT(TGL_MULAI,'%Y-%b') BULAN, TGL_MULAI, NILAI, A.STATUS, (SELECT GROUP_CONCAT(CONCAT(ID_PENILAI, ' - ', N1+N2+N3+N4+N5+N6+N7+N8+N9+N10) SEPARATOR ' | ') FROM CC_RPL_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NRPL, (SELECT GROUP_CONCAT(CONCAT(ID_PENILAI, ' - ', N1+N2+N3+N4+N5+N6+N7) SEPARATOR ' | ') FROM CC_WWC_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NWWC, B.PRIVILEGE FROM CC_QOL_TRANSAKSI A JOIN CC_USER_LOGIN B ON A.ID_USER = B.NIK WHERE NILAI IS NOT NULL ORDER BY TGL_SELESAI DESC
$sql_select =
	"SELECT ID_USER, B.NAMA, PLASA, WITEL, DATE_FORMAT(TGL_MULAI,'%Y-%b') BULAN, TGL_MULAI, NILAI, A.STATUS, (SELECT GROUP_CONCAT(N1+N2+N3+N4+N5+N6+N7+N8+N9+N10 SEPARATOR ' | ') FROM CC_RPL_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NRPL, (SELECT GROUP_CONCAT(N1+N2+N3+N4+N5+N6+N7 SEPARATOR ' | ') FROM CC_WWC_DETIL WHERE ID_TRANS = A.ID_TRANS) AS NWWC, B.PRIVILEGE FROM CC_QOL_TRANSAKSI A JOIN CC_USER_LOGIN B ON A.ID_USER = B.NIK WHERE NILAI IS NOT NULL AND PRIVILEGE = '7' ORDER BY TGL_SELESAI DESC";
$stmt_select = mysqli_query($connect, $sql_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "structure/head.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css?123">
	<link rel="stylesheet" type="text/css" href="css/ColumnFilterWidgets.css?123">
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
					<h4><b>Rekap Nilai</b></h4>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; margin-bottom: 30px; border-style: solid; border-width: 1.5px; padding-top: 10px; padding-bottom: 15px;">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<label>POSISI</label>
						<div id="filterPosisi" style="width:100%">
						</div>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<label>WITEL</label>
						<div id="filterWitel" style="width:100%">
						</div>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<label>PLASA</label>
						<div id="filterPlasa" style="width:100%">
						</div>
					</div>
					<!-- <div class="col-md-3 col-sm-12 col-xs-12">
						<label>STATUS</label>
						<div id="filterStatus" style="width:100%">
						</div>
					</div> -->
				</div>
	
				<table id="table" class="table table-bordered" style="border-width: 2px;">
					<thead>
						<!-- <th>ID USER</th> -->
						<th>NAMA</th>
						<th>AS</th>
						<th>PLASA</th>
						<th>WITEL</th>
						<th>RP 1</th>
						<th>RP 2</th>
						<th>SUM RP</th>
						<th>WW 1</th>
						<th>WW 2</th>
						<th>SUM WW</th>
						<th>QUIZ ONLINE</th>
						<th>TOTAL NILAI</th>
					</thead>
					<tbody>	
						<?php
						while($col = mysqli_fetch_array($stmt_select)){
							$id_user	=$col["ID_USER"];
							$namacsr	=$col["NAMA"];
							$plasa		=$col["PLASA"];
							$witel		=$col["WITEL"];
							$bulan		=$col["BULAN"];
							$waktu_mulai=$col["TGL_MULAI"];
							$total_rpl	=explode(" | ",$col["NRPL"]);
							$total_wwc	=explode(" | ",$col["NWWC"]);
							$total_nilai=$col["NILAI"];
							$privilege	= $col["PRIVILEGE"];
						?>
						<tr>		
							<!-- <td><?php echo $id_user; ?></td> -->
							<td><?php echo $namacsr; ?></td>
							<td><?php echo $privilege; ?></td>
							<td><?php echo $plasa; ?></td>
							<td><?php echo $witel; ?></td>
							<td><?php echo $total_rpl[0]; ?></td>
							<td><?php echo $total_rpl[1]; ?></td>
							<td><?php echo $total_rpl[0]+$total_rpl[1]; ?></td>
							<td><?php echo $total_wwc[0]; ?></td>
							<td><?php echo $total_wwc[1]; ?></td>
							<td><?php echo $total_wwc[0]+$total_wwc[1]; ?></td>
							<td><?php echo $total_nilai; ?></td>
							<td><?php echo (0.45*($total_rpl[0]+$total_rpl[1]))+(0.35*($total_wwc[0]+$total_wwc[1]))+(0.20*$total_nilai); ?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<!-- <th>ID USER</th> -->
							<th>NAMA</th>
							<th>AS</th>
							<th>PLASA</th>
							<th>WITEL</th>
							<th>RP 1</th>
							<th>RP 2</th>
							<th>SUM RP</th>
							<th>WW 1</th>
							<th>WW 2</th>
							<th>SUM WW</th>
							<th>QUIZ ONLINE</th>
							<th>TOTAL NILAI</th>
						</tr>
					</tfoot>
				</table>
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

<script type="text/javascript" src="js/jquery.dataTables.js?123"></script>
<!-- Custom Theme Scripts -->
<script src="js/custom.min.js?123"></script>

<!-- <script src="http://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script> -->

<script src="js/ColumnFilterWidgets.js?123"></script>

<script>
$(document).ready(function() {
	$('#table').dataTable( {
		"order": [[ 2, "desc" ]], //or asc 
		// "columnDefs": [{
		// 	"targets":5,
		// 	"type":"date-eu"
		// },
		// {
		// 	"targets": [ 4 ],
		// 	"visible": false
		// }],
		
		/*sDom: 'Wlfriptip',
		oColumnFilterWidgets: {
			aiExclude: [ 0, 1, 5, 6 ]
		},*/
		
		initComplete: function () {
            this.api().columns([3]).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm"><option value="">ALL</option></select>')
                    .appendTo( $('#filterWitel').empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    if(column.search() === '^'+d+'$'){
						select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
					} else {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					}
                } );
            });
			
			this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm"><option value="">ALL</option></select>')
                    .appendTo( $('#filterPlasa').empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    if(column.search() === '^'+d+'$'){
						select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
					} else {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					}
                } );
            });
			
			// this.api().columns([4]).every( function () {
   //              var column = this;
   //              var select = $('<select class="form-control input-sm"><option value="">ALL</option></select>')
   //                  .appendTo( $('#filterBulan').empty() )
   //                  .on( 'change', function () {
   //                      var val = $.fn.dataTable.util.escapeRegex(
   //                          $(this).val()
   //                      );
 
   //                      column
   //                          .search( val ? '^'+val+'$' : '', true, false )
   //                          .draw();
   //                  } );
 
   //              column.data().unique().sort().each( function ( d, j ) {
   //                  if(column.search() === '^'+d+'$'){
			// 			select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
			// 		} else {
			// 			select.append( '<option value="'+d+'">'+d+'</option>' )
			// 		}
   //              } );
   //          });
			
			this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select class="form-control input-sm"><option value="">ALL</option></select>')
                    .appendTo( $('#filterPosisi').empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    if(column.search() === '^'+d+'$'){
						select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
					} else {
						select.append( '<option value="'+d+'">'+d+'</option>' )
					}
                } );
            });
        }
	});
});
</script>
</body>
</html>