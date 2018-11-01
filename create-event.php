<?php
//Creates new event with form info presented on create event page
if(isset($_POST['create_new_event'])) {
	include('connect-mysql.php');
	$event_name = $_POST['event_name_input'];
	$event_date = $_POST['event_date_input'];
	$event_dist_date = $_POST['event_dist_date_input'];
	$event_price = $_POST['event_price_input'];
	$event_tickets = $_POST['event_tickets_input'];
	$event_description = $_POST['event_description_input'];
	$event_price = $_POST['event_price_input'];
	$event_seller_email = $_POST['event_seller_email_input'];
	$event_seller_email = $_POST['event_url_input'];
	$sql = "INSERT INTO SellerEvents (EventName, EventURL, EventDate, TicketDistDate, Price, NumTickets, EventDesc, SellerName, SellerEmail) VALUES ('event_name', 'event_url', 'event_date', 'event_dist_date' 'event_price', 'event_tickets', 'event_description', 'event_seller_email";
}
?>

