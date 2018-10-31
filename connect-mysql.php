<?php
//File that connects to MySQL database
DEFINE ('DB_USER', 'user');
DEFINE ('DB_PSWD', 'pswd');
DEFINE ('DB_HOST', 'host');
DEFINE ('DB_NAME', 'name'); 
  
$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

if($dbcon->connect_error){
  die("Connection DNW" . $dbcon ->connect_error);
}
?>