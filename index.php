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
			<h1 align="center">The Ticket Lottery</h1>
			<div align="center" class="homeSearch">
				<div class="searchBar">
					<form action='' method="POST">
						<input name="Event" class="search-txt" type="text" placeholder="Search by Event Name">
					</form>
				</div>
			</div>

			<form action='' method="POST" onsubmit="submitAlert()">
				<table id='eventList'>
						<tr>
							<th>Event Name</th>
							<th>Event Date</th>
							<th>Price</th>
							<th>Distribution Date</th>
							<th>Select</th>
						</tr>

						<?php

							if(isset($_POST['Event'])){
								$Event = $_POST['Event'];
								$result = getSearchedEvents($Event);

								//if ($result->num_rows > 0) {
								    // output data of each row
								    foreach($result as $row) {
								        echo "<tr>
								        		<td>". $row[1]. "</td>
								        		<td>". $row[2]. "</td>
								        		<td>". $row[4]. "</td>
								        		<td>". $row[3]. "</td>
								        		<td> <input type='radio' name='selection' value=". $row[0]. "> Select </td>
								        	  </tr>";
								    }
								/*}else {
								    echo "0 results";
								}*/
						}
						?>
				</table>
				<br>
				<div class="eventSubmit">
					Name:
					<input type="text" name="name">
					Email:
					<input type="text" name="email">
					<br><br>
					<input type="submit" value="Submit">
				</div>
			</form>

			<?php
				if(isset($_POST)){
					$selection = $_POST['selection'];
					$name = $_POST['name'];
					$email = $_POST['email'];
					insertTicketRequest($selection, $name, $email);
				}
			
			?>		
		</div>
	</body>

	<script>
		function submitAlert(){
			alert("Submission successful!");
		}
	</script>


	
</html>
