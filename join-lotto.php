<?php
//File that takes form info on event page and inserts info into database
if(isset($_POST['submitted'])) {
  include('connect-mysql.php');
  $name = $_POST['name_input'];
  $email = $_POST['email_input'];
  $sql = "INSERT INTO TicketRequests (BuyerName, BuyerEmail) VALUES ('name', 'email')";
  if ($dbcon->query($sql) === TRUE) {
    echo "Submission Successful!";
  } else {
    echo "Error: " . $sql . "<br>" . $dbcon->error;
  }
}
?>

<!-- account craetion not yet implemented <?php 
//
// File that takes form info on buyer account creation page and inserts info into database
// if(isset($_POST['submitted'])) {
//   include('connect-mysql.php');
//   $name = $_POST['name'];
//   $email = $_POST['email'];
//   $psword = $_POST['psword'];
//   $sql = "INSERT INTO Buyers (BuyerName, Email, Hpasswrod) VALUES ('name', 'email', 'psword')";
// }

// if ($dbcon->query($sql) === TRUE) {
//   echo "Submission Successful!";
// } else {
//   echo "Error: " . $sql . "<br>" . $dbcon->error;
// }
?> -->