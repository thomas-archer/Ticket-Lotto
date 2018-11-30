<?php session_start(); include('functions.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirmation</title>
<link href="css/createTemplate.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Main Container -->
<div class="container"> 
  <ul id = "menu">
      <li><a href="index.php">Home</a></li>
			<li><a href="create.php">Create Event</a></li>
			<li><a href="viewEvents.php">Manage My Events</a></li>
  </ul>
	
  <h2 align="center"> Event Confirmation</h2>
  <div class="copyright">
    <form action="" method="post">
      <div class="formHeading">Insert Email:</div><br><input type="text" name="buyer_email_input">
      <input type="submit" name="email_submit" value="View Tickets">
    </form>
    <br>
    <form action="" method="POST">
      <?php
        if(isset($_POST['email_submit'])) {
          $_SESSION['buyer_email'] = $_REQUEST['buyer_email_input'];
          $BuyerEvents = getBuyerEventsDist($_SESSION['buyer_email']);
          echo "<select name='events_dropdown' style='width:200px'>";
          foreach($BuyerEvents as $row) {
            echo "<option value = '" . $row[0] . "'>". $row[1] . "</option>";
          }
          echo "</select>";
        }
      ?>
        <!--<option value="volvo">Volvo</option>-->
      <br><br>
      <input type="radio" name="confirmation_status" value="Confirmed"> Going
      <input type="radio" name="confirmation_status" value="Removed"> Can't Go
      <br><br>

      <input type="submit" name="status_submit" value="Confirm">
      <?php
          if(isset($_POST['status_submit']) and $_REQUEST['events_dropdown']) {
            $selected_event_id = $_REQUEST['events_dropdown'];
            $selected_status = $_REQUEST['confirmation_status'];
            updateStatus($selected_event_id,$_SESSION['buyer_email'],$selected_status);
            if($selected_status=='Confirmed') {
              $selected_URL = getURL($selected_event_id)[0][0];
              echo "<script type='text/javascript' language='Javascript'> window.location.href='$selected_URL'; </script>";
            }
            else {
              echo '<script type="text/javascript">'; 
              echo 'alert("You have been succesfully removed from the lottery for this event.");'; 
              echo 'window.location.href = "index.php";';
              echo '</script>';
            }
          }
      ?>
    </form>
  </div>
</div>
</body>
</html>
