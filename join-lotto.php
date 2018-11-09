<?php
//File that takes form info on event page and inserts info into database
if(isset($_POST['submitted'])) {
  include('connect-mysql.php');
  $name = $_POST['buyer_name_input'];
  $email = $_POST['buyer_email_input'];
  $sql = "INSERT INTO TicketRequests (BuyerName, BuyerEmail) VALUES ('name', 'email')";
  if ($dbcon->query($sql) === TRUE) {
    echo "Submission Successful!";
  } else {
    echo "Error: " . $sql . "<br>" . $dbcon->error;
  }
}
?>
