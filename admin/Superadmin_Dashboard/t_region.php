<title>Region/City</title>
<?php include 'header/head.php'; ?>
<?php include 'sidebar/sidebar_menu.php'; ?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h4><i class="nav-icon fa fa-map"></i> Region
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addregion">Add Region</button>
            </h4>

          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <th>ID</th>
                <th class="text-center">Region</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $getregion = mysqli_query($con, "SELECT * from t_region");
                while ($rowregion = mysqli_fetch_array($getregion)) {


                ?>
                  <tr>
                    <td><?php echo $rowregion['region_id']; ?></td>
                    <td><?php echo $rowregion['region_name']; ?></td>
                    <td>
                      <button class="btn btn-success" data-toggle="modal" data-target="#editregion-<?php echo $rowregion['region_id'] ?>">Edit</button> | <button class="btn btn-danger" data-toggle="modal" data-target="#deleteregion-<?php echo $rowregion['region_id']; ?>">Delete</button>
                    </td>


                    <!-- Modal edit -->
                    <div class="modal fade" id="editregion-<?php echo $rowregion['region_id'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" for="name">Edit Region</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="process/process_region.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="regionid" value="<?php echo $rowregion['region_id'] ?>" id="">
                              <input type="text" class="form-control" name="newregionname" id="" value="<?php echo $rowregion['region_name'] ?>">
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success" name="savenewregion">Save</button>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                    <!-- End of modal edit -->

                    <!-- Delete Region Modal -->
                    <div class="modal fade" id="deleteregion-<?php echo $rowregion['region_id'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" for="name">Delete Region</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="process/process_region.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="regiondeleteid" value="<?php echo $rowregion['region_id'] ?>" id="">
                              <span>
                                <h4><?php echo $rowregion['region_name'] ?>?</h4>
                              </span>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-danger" name="deleteregion">Delete</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Region Modal -->


                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>



      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">

            <h4><i class="nav-icon fa fa-map"></i> City
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addcity">Add City</button>
            </h4>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <th>ID</th>
                <th>City</th>
                <th>Region</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $getcity = mysqli_query($con, "SELECT * from t_city as a
                  LEFT join t_region as b on a.city_region_id = b.region_id");
                while ($cityrow = mysqli_fetch_array($getcity)) {
                  $lastregionid = $cityrow['city_region_id'];
                  $regionname = $cityrow['region_name']


                ?>
                  <tr>
                    <td><?php echo $cityrow['city_id']; ?></td>
                    <td><?php echo $cityrow['city_name']; ?></td>
                    <td><?php echo $cityrow['region_name']; ?></td>
                    <td><button class="btn btn-success" data-toggle="modal" data-target="#editcity-<?php echo $cityrow['city_id']; ?>">Edit</button> | <button class="btn btn-danger" data-toggle="modal" data-target="#deletecity-<?php echo $cityrow['city_id']; ?>">Delete</button> </td>

                    <div class="modal fade" id="editcity-<?php echo $cityrow['city_id']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" for="name">Edit City</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="process/process_city.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="cityeditid" id="" value="<?php echo $cityrow['city_id']; ?>">
                              <input type="hidden" name="lastregionid" value="<?php echo $cityrow['city_region_id']?>">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-12">
                                    <input type="text" name="editcityname" class="form-control" value="<?php echo $cityrow['city_name']; ?>" id="">
                                    <hr>
                                  </div>

                                  <div class="col-12">
                                    <select name="editregionid" id="" class="form-control select2bs4">
                                      <?php
                                      $lastregion = mysqli_query($con, "SELECT * from t_region where region_id = '$lastregionid'");
                                      $regiondetails = mysqli_fetch_array($lastregion);
                                      ?>
                                      <!-- <option selected disabled value="<?php //echo $regiondetails['region_id'];?>"><?php //echo $regiondetails['region_name'];?></option> -->
                                      <option selected value="<?php echo $lastregionid;?>"><?php echo $regionname;?></option>
                                      <?php
                                      $getregionlist = mysqli_query($con,"SELECT * from t_region where region_id != '$lastregionid'");
                                      while($regionlist = mysqli_fetch_array($getregionlist)){

                      
                                      ?>
                                      <option value="<?php echo $regionlist['region_id'];?>"><?php echo $regionlist['region_name'];?></option>
                                      <?php }?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button class="btn btn-success" name="savenewcityname">Save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="deletecity-<?php echo $cityrow['city_id']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          <h4 class="modal-title" for="name">Delete City</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="process/process_city.php" method="post">
                            <div class="modal-body">
                              <input type="hidden" name="citydeleteid" value="<?php echo $cityrow['city_id']; ?>">
                              <span>
                                <h4>Delete<?php echo $cityrow['city_name']?>?</h4>
                              </span>

                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" data-dismiss="modal">Close</button>
                              <button class="btn btn-danger" name="deletecity">Delete</button>
                            </div>
                          </form>
                        </div>
                      </div>

                    </div>


                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>




  </div>







</section>
<!-- /.content -->
</div>


<div class="modal fade" id="addcity">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" for="name">Add City</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="process/process_city.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-12">
                <input type="text" class="form-control" name="cityname" id="" placeholder="City">
                <hr>
              </div>

              <div class="col-12">

                <select name="regionname" class="form-control select2bs4" id="">
                  <?php
                  $getregionid = mysqli_query($con, "SELECT * from t_region");
                  while ($regionforcity = mysqli_fetch_array($getregionid)) {
                  ?>
                    <option value="<?php echo $regionforcity['region_id']; ?>"><?php echo $regionforcity['region_name']; ?></option>

                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal">Close</button>
          <button class="btn btn-success" name="savecity">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="addregion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" for="name">Add Region</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="process/process_region.php" method="post">
        <div class="modal-body">

          <div class="form-group">
            <input type="text" class="form-control" name="regionname" id="" placeholder="Region">
          </div>


        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="saveregion">Save</button>
        </div>
      </form>
    </div>
  </div>

</div>





<footer class="main-footer">
  <strong>Copyright &copy; 2021 <a href="#">Timber Valley PH</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 0.1
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script src="../Employee/plugins/select2/js/select2.full.min.js"></script>

<!-- <script src="../Employee/plugins/jquery/jquery.min.js"></script> -->
<script src="../Employee/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Employee/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Employee/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Employee/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Employee/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });




    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
</body>

</html>