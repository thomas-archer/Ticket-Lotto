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
					<input name="Event" class="search-txt" type="text" placeholder="Search by Event Name">
				</div>
			</div>

			<form action='' method="POST">
				<table id='eventList'>
						<tr>
							<th>Event Name</th>
							<th>Event Date</th>
							<th>Price</th>
							<th>Distribution Date</th>
							<th>Select</th>
						</tr>

						<?php

							$result = getSearchedEvents($Event);

							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<tr>
							        		<td>". $row["EventName"]. "</td>
							        		<td>". $row["EventDate"]. "</td>
							        		<td>". $row["Price"]. "</td>
							        		<td>". $row["TicketDistDate"]. "</td>
							        		<td> <input type='radio' name='selection' value=". $row["EventID"]. "> Select </td>
							        	  </tr>";
							    }
							} else {
							    echo "0 results";
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

			?>		
		</div>
	</body>
</html>
