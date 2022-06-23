<?php
  
  $guest = $_SESSION['guest_id'];
  $querycount = "SELECT COUNT(*) FROM t_cart where guest_id = '$guest' ";
  $resultcount = mysqli_query($con,$querycount);
  $rowcount = mysqli_fetch_array($resultcount);
  $totalcount = $rowcount[0];
  //echo $totalcount;


?>