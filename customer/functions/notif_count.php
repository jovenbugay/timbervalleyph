<?php
  
  $customer = $_SESSION['customer_id'];
  $querycount2 = "SELECT COUNT(*) FROM t_notification as a
          LEFT JOIN t_order_details as b ON a.notif_order_id = b.order_id
          where b.order_customer_id = '$customer' order by notif_id desc ";
  $resultcount2 = mysqli_query($con,$querycount2);
  $rowcount2 = mysqli_fetch_array($resultcount2);
  $totalcount2 = $rowcount2[0];
  //echo $totalcount;


?>