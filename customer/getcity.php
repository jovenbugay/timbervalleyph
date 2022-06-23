<?php
session_start();
include ('../db/connect.php');


$regiontype = $_GET['regiontype'];
$result = mysqli_query($con,"SELECT * from t_city where city_region_id = '$regiontype'");

$city_arr = array();

while($row = mysqli_fetch_array($result)){
    $city_arr[] = array("city_id" => $row['city_id'],"city_name" => $row['city_name']);
}
echo json_encode($city_arr);
?>