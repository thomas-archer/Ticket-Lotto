<?php
	include 'functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home Base</title>
		<link href="css/createTemplate.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container">
			<ul id = "menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="create.php">Create Event</a></li>
				<li><a href="viewEvents.php">Manage My Events</a></li>
			</ul>

			<h2 align="center">My Events</h2>

			<div align="center" class="copyright">
			<form action="" method="post">
      			<div class="formHeading">Insert Email:</div><br><input type="text" name="seller_email_input">
      			<input type="submit" name="email_submit" value="View Events">
   			</form>
			</div>
			<br>
			<form action='' method="POST" onsubmit="submitAlert()">
			<table id='eventList'>
					<tr>
						<th>Event Name</th>
						<th>Event Date</th>
						<th>Price</th>
						<th>Distribution Date</th>
						<th>Tickets Still Available</th>
						<th>Select</th>
					</tr>
				<?php
        		if(isset($_POST['email_submit'])) {
				$SellerEvents = getSellerEvents($_POST['seller_email_input']);
          		foreach($SellerEvents as $row) {
					echo "<tr>
					<td>". $row[1]. "</td>
					<td>". $row[2]. "</td>
					<td>". $row[4]. "</td>
					<td>". $row[3]. "</td>
					<td>". $row[5]. "</td>
					<td> <input type='radio' name='selection' value=". $row[0]. "> Select </td>
				  </tr>";
          		}
        		}
      			?>
			</table>
			<br>
			<div align="center">
				<input type="submit" value="Distribute Tickets">
			</div>
			<?php
				if(isset($_POST)){
					$selection = $_POST['selection'];
					distributeTickets($selection);
				}
			?>
		</div>
	</body>
</html>
