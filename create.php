<?php
//Creates new event with form info presented on create event page
if(isset($_POST['create_new_event'])) {
	include('connect-mysql.php');
	$event_name = $_POST['event_name_input'];
	$event_date = $_POST['event_date_input'];
	$event_organization = $_POST['event_organization_input'];
	$event_dist_date = $_POST['event_dist_date_input'];
	$event_seller_email = $_POST['event_seller_email_input'];
	$event_price = $_POST['event_price_input'];
	$event_tickets = $_POST['event_tickets_input'];
	$event_description = $_POST['event_description_input'];
	$event_url = $_POST['event_url_input'];
	$sql = "INSERT INTO SellerEvents (EventName, EventOrganization, EventURL, EventDate, TicketDistDate, Price, NumTickets, EventDesc, SellerName, SellerEmail) VALUES ('event_name', 'event_organization', 'event_url', 'event_date', 'event_dist_date' 'event_price', 'event_tickets', 'event_description', 'event_seller_email";

	if ($dbcon->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create Event</title>
		<link href="css/createTemplate.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<div class="container">
			<ul id = "menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="create.php">Create Event</a></li>
				<li><a href="viewEvents.php">View My Events</a></li>
			</ul>
			<div align="center">
			<h2>Create Event</h2>

			<div class="gallery">
				<form action="create-event.php" method="POST" class="copyright" id="createForm">

					<div class="formHeading">Event Name:</div><input type="text" name="event_name_input">
					<!-- <div class="formHeading">Thumbnail:</div><input type="text" name="event_thumbnail_input"> -->
					<div class="formHeading">Event Date:</div><input type="date" name="event_date_input">
					<div class="formHeading">Organization:</div><input type="text" name="event_organization_input">
					<div class="formHeading">Distribution Date:</div><input type="Date" name="event_dist_date_input">
					<div class="formHeading">Email Address:</div><input type="Email" name="event_seller_email_input">
					<div class="formHeading">Ticket Price:</div><input type="number" name="event_price_input">
					<div class="formHeading">Number of Tickets:</div><input type="text" name="event_tickets_input">
					<!-- <div class="formHeading">Event Caption:</div><input type="text" name="event_caption_input"> -->
					<div class="formHeading">Event Description:</div><input id="descriptionBox" type="text" name="event_discription_input">
					<div class="formHeading">Event URL:</div><input type="url" name="event_url_input">
					<br>
					<input type="submit" value="Submit" class="button">

				</form>

				</div>
			</div>
		</div>
	</body>
</html>