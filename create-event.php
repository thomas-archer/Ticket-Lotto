<?php
//Creates new event with form info presented on create event page
include('connect-mysql.php');

$servername = "ticketdb.cadri9on7p25.us-east-1.rds.amazonaws.com";
$username = "ticketlotto";
$password = "ticketlotto";
$dbname = "ticketlotto";

#Now runs the function, but error in insert into
if(isset($_POST['event_name_input'])) {
	// $event_name = $_POST['event_name_input'];
	// $event_date = $_POST['event_date_input'];
	// $event_organization = $_POST['event_organization_input'];
	// $event_dist_date = $_POST['event_dist_date_input'];
	// $event_seller_email = $_POST['event_seller_email_input'];
	// $event_price = $_POST['event_price_input'];
	// $event_tickets = $_POST['event_tickets_input'];
	// $event_description = $_POST['event_description_input'];
	// $event_url = $_POST['event_url_input'];
	#Test info (so you don't have to keep filling out form)
	$test_id='000';
	$event_name = 'this event';
	$event_date = '2019/01/01';
	$event_organization = 'this organization';
	$event_dist_date = '2019/02/01';
	$event_seller_email = 'myemail@gmail.com';
	$event_price = '4.1';
	$event_tickets = '5';
	$event_description = 'this is a description';
	$event_url = 'https://www.google.com';
	
	$sql = "INSERT INTO SellerEvents (EventID, EventName, EventDate, EventOrganization, TicketDistDate, Price, NumTickets, EventDesc, SellerEmail, EventURL) VALUES ($test_id,$event_name,$event_date,$event_organization,$event_dist_date,$event_price, $event_tickets,$event_description,$event_seller_email,$event_url)";

	if ($dbcon->query($sql) === TRUE) {
		echo "<script type='text/javascript'>alert('Event Created!');window.location.href='/';</script>";
	} else {
		echo "Error: " . $sql . "<br>" . $dbcon->error . "\n";
		#echo "<script type='text/javascript'>alert('Submission error');window.location.href='/';</script>";
	}
}
?>

