<?php
session_start();
include('db/connect.php');
?>
<?php
if(isset($_POST['btnmark'])){
  $form_id = $_POST['form_id'];
  

echo '<script>window.location.href = "new-feedback.php";</script>';
}
$branchid = $_SESSION['branch_id'];
$ulevel = $_SESSION['user_level'];

// if ($ulevel == '1'){
//   $disabled = '';
// } else if($ulevel == '2'){
//   $disabled = 'disabled';
// }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Visitors Report | Administrator</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <style>

    body{
      font-size:14px;
    }
    .card-text{
      font-size:14px;
    }

    .btn{
      font-size:14px;
      font-weight:bold;
    }

    .table td{
      padding:5px !important;
    }

    .btn-primary{
      background-color:#2b3445;
      color: #fed136;
      border: 0 ;
    }

    .btn-primary:hover{
      background-color:#fed136;
      color: #2b3445 ;
      border: 0 ;
    }

    .btn-success{
      font-size:12px;  
      text-transform:uppercase;
    }

    .result{
      text-transform:uppercase;
      font-weight:bold;
    }

    .resultheader th{
      text-transform:uppercase;
      background:#004d38;
      color: #fff;
    }

    .ln_solid {
  border-top: 0.5px solid #e5e5e5;
  color: #ffffff;
  background-color: #ffffff;
  height: 3px;
  margin: 10px 0; }

    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
  <?php require_once ('section/sidebar.php'); ?>

        <!-- top navigation -->
  <?php require_once ('section/header.php'); ?>
        <!-- /top navigation -->



        <!-- page content -->
        <div class="right_col" role="main">

	<!-- <div class="row"> -->
				<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
					<div class = "col-md-4 col-lg-4 col-xs-4">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Select Filter <i class = "fa fa-filter"></i></h2>
                    <ul class="nav navbar-right panel_toolbox"> 
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <form class="form-horizontal form-label-left" method = "POST" enctype = "multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Date From:</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="date" class="form-control" name = "datefrom" required value=<?php echo date('Y-m-d'); ?>>
                         
                          <div class="ln_solid"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Date To:</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="date" name = "dateto" class="form-control" required value=<?php echo date('Y-m-d'); ?>>
                          
                          <div class="ln_solid"></div>
                        </div>
                      </div>
                  
					  <input type = "hidden" name = "status" value = "active">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-3">Branch</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                         <select  name = "branch_id" class = "form-control">
						 	<?php	
									include 'dbcon.php';
                  if ($ulevel == '1'){
                    $query1=mysqli_query($con,"select * from branch ORDER BY branch_id ASC")or die(mysqli_error($con));
                  }
                  else if ($ulevel == '2'){
                    $query1=mysqli_query($con,"select * from branch where branch_id ='$branchid'")or die(mysqli_error($con));
                  }
										
										while ($row1=mysqli_fetch_array($query1)){
											$id=$row1['branch_id'];
											
											
							?>
			
								<option name="opt1" value = "<?php echo $row1['branch_id'];?>"><?php echo $row1['branch_name'];?></option>
							
		
					
							<?php } ?>	
          
																					 
						 </select>
                          
                          <div class="ln_solid"></div>
                        </div>
                      </div>
                      
            
                      <!-- <div class="ln_solid"></div> -->

                      <div class="form-group">
                        <div class="col-md-12">
                          <button type="submit" name = "display" class="btn btn-block btn-success"><i class = "fa fa-save"></i> Process</button>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                   
                    <?php
if(isset($_POST['display']))
{
	$datefrom = $_POST['datefrom'];
	$dateto = $_POST['dateto'];
	$branch = $_POST['branch_id']
	?>                
                      

          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">

          </div>
        </div>
        <section class="dining_section">
          <div class="card">
                <div class="card-header">
                Visitors Report

                </div>
              
                <div class="card-body">

                
              
                <div class="card-box">
                    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        <!-- <th> <?php echo $ulevel; ?></th> -->
                          
                          <th>Visitor ID</th>
                          <th>Name</th>
                          <th>Contact</th>
                          <th>Date Visited</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                      <tbody>
                      <?php
  
                        
                        if($ulevel == '1'){
                          $result = mysqli_query($con,"SELECT * FROM form as a 
                          LEFT JOIN branch as b on a.branch = b.branch_id where a.branch = '$branch' and  DATE(a.timestamp) between '$datefrom' and '$dateto'  "); 
                       
                        }
                        else if($ulevel == '2'){
                          $result = mysqli_query($con,"SELECT * FROM form as a 
                          LEFT JOIN branch as b on a.branch = b.branch_id where a.branch = '$branchid' and  DATE(a.timestamp) between '$datefrom' and '$dateto' "); 
                        }
                          
                       
                        while($row = mysqli_fetch_array($result)){
                          $old_date = date($row['timestamp']); 
                          $old_date_timestamp = strtotime($old_date);
                          $new_date = date(' F d, Y ', $old_date_timestamp);
                    


                        ?>
                        <tr>
                          <td><?php echo $row['form_id']; ?></td>
                          <td><?php echo $row['fullname']; ?></td>
                          <td><?php echo $row['mobile']; ?></td>
                          <td><?php echo $new_date; ?>
                          <td>
                          <button type="button" class="btn btn-success"  data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $row['form_id']; ?>"><i class="fa fa-eye"></i> View Details</button>

                          <div class="modal fade bd-example-modal-lg-<?php echo $row['form_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Feedback Information</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>



                      
                                <div class="modal-body">
                                  <table width="100%" >
                                    <tr class="resultheader">
                                    <th colspan="2" class="text-center">Visitor Details</th>
                                    </tr>
                                        <td>Name</td>
                                        <td><?php echo $row['fullname']; ?></td>
                                    </tr>
                             
                                    <tr>
                                        <td>Contact</td>
                                        <td><?php echo $row['mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Branch</td>
                                        <td><?php echo $row['branch_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Visit</td>
                                        <td><?php echo $new_date; ?></td>
                                    </tr>
                             
                                  </table>
                                </div>
                                
                                <div class="modal-footer">
                                <form method="POST">
                                <input type="hidden" name="form_id" value="<?php echo $row['form_id']; ?>">
                                  <!-- <button type="submit" class="btn btn-success" name="btnmark">Mark as read</button> -->
                                </form>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </td>
                        </td>
                        </tr>
                        <?php } ?>
                        <?php }?>

                      </tbody>
                    </table>
                  
					
                  </div>

          
                </div>

                <div class="card-footer">
                  
                </div>
          </div>
        </section>

    </div> 
  </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Dining Area</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label>Area Name</label>
            <input type="text" name="area_name" class="form-control">
          </div>

          <div class="form-group">
            <label>Area Code</label>
            <input type="text" name="area_code" class="form-control">
          </div>
        
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" name="btnadd">Add Dining</button>
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

        <!-- /page content -->

        <!-- footer content -->
        <?php include('section/footer.php'); ?>
        <!-- /footer content -->
      </div>
    </div>
    <div class="clearfix"></div>

    <script>
function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("card");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-body h5.card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
    </script>

<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
});
    })

    </script>
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]] // "0" means First column and "desc" is order type; 
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "order": [[ 0, "desc" ]] // "0" means First column and "desc" is order type; 
    });
  });
</script>
  </body>
</html>
