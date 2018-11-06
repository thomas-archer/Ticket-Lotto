<?php
//File that connects to MySQL database
$servername = "ticketdb.cadri9on7p25.us-east-1.rds.amazonaws.com";
$username = "username";
$password = "ticketlotto";
$dbname = "ticketlotto";

// Create connection
$dbcon = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
} 
