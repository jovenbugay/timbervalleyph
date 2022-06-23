<?php



// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_DATABASE', 'timber');

// $phdb = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// if(!$phdb){
// 	die("Connection error: " . mysqli_connect_error());	
// }

$con = mysqli_connect("localhost","root","","timber");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  date_default_timezone_set("Asia/Manila"); 
?>