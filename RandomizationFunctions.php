<?php
//File that defines functions for Randomization
//Input:EventID for desired event
//Output:Array of all Ticket Requets for the given EventID, with email and ticket status
function getTicketRequests($EventID){
    $servername = "ticketdb.cadri9on7p25.us-east-1.rds.amazonaws.com";
    $username = "ticketlotto";
    $password = "ticketlotto";
    $dbname = "ticketlotto";
    // Create connection
    $dbcon = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }
    $query = "Select BuyerEmail, TicketStatus from TicketRequests where EventID = $EventID";
    $result = $dbcon->query($query);
    $Requests = array();
    while($row = $result->fetch_row())
    {
        $Requests[] = $row;
    }
    $result->close();
    $dbcon->close();
    return $Requests;
}
//Input:Array of Ticket Requets with email and ticket status
//Output: Array of Ticket Requets with only email, only including those with the 'waiting' ticket status
function getOnlyWaitingEmails($TicketRequests){
    $WaitingEmails = array();
    foreach($TicketRequests as $inner_array) {
        if($inner_array[1] == 'waiting'){
            $WaitingEmails[] = $inner_array;
        }
    }
    unset($inner_array);    
    return $WaitingEmails;
}

//Input:Array of Ticket Requets with email and ticket status
//Output: Array of Ticket Requets with only email, only including those with the 'waiting' ticket status
function getOnlyDistributedEmails($TicketRequests){
    $DisEmails = array();
    foreach($TicketRequests as $inner_array) {
        if($inner_array[1] == 'distribute'){
            $DisEmails[] = $inner_array;
        }
    }
    unset($inner_array);    
    return $DisEmails;
}

//Inputs: Number of Tickets to be distributed, EventID for desired event, Array of Emails for those waiting on a Ticket Request
//Outputs: Array of emails for those distibuted tickets
//Actions; Updates the ticket status of those chosen as "distributed"
function randomlyDistributeTickets($numTickets,$EventID,$WaitingEmails){
    $arrlength= count($WaitingEmails);
    $numDistributed = int;
    if($arrlength<$numTickets){
        $numDistributed = $arrlength;
    }
    else{
        $numDistributed = $numTickets;
    }
    shuffle($WaitingEmails);
    $servername = "ticketdb.cadri9on7p25.us-east-1.rds.amazonaws.com";
    $username = "ticketlotto";
    $password = "ticketlotto";
    $dbname = "ticketlotto";
    // Create connection
    $dbcon = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($dbcon->connect_error) {
        die("Connection failed: " . $dbcon->connect_error);
    }
    $i = int;
    for($i = 0; $i < $numDistributed; $i++) {
        $sql = "UPDATE TicketRequests SET TicketStatus= 'distribute' WHERE EventId = $EventID and BuyerEmail = \"".$WaitingEmails[$i][0]."\"";
        if ($dbcon->query($sql) === TRUE) {
           
        } 
        else {
            echo "Error updating record: " . $dbcon->error;
        }
    }
}
//Email selected notifications to those who received a ticket (Call with getOnlyDistributedEmails)
function email_distributed_tickets($distributed,$url) {
    $email_subject = "You've been selected!"; 
    $email_message = "Congragulations! You've been randomly selected to participate in an event on ticketlotto. Please use this link to let the event know if you can still attend and purchase your ticket: (".$url.")";
    foreach($distributed as $item) {
        mail($item[0], $email_subject, $email_message);
    }
    unset($item);
}
//Email waitlist notifications to those who did not receive a ticket (Call with getOnlyWaitingEmails)
function email_waiting_list($waiting_emails) {
    $email_subject = "You're on the waitlist!"; 
    $email_message = "Hey! You've been added to a waitlist for an event on ticketlotto. The event organizer will inform you if another spot on the event opens up!";
    foreach($waiting_emails as $item) {
        mail($item[0], $email_subject, $email_message);
    }
    unset($item);
}
//Email reminder notifications to those who have not confirmed their attendance (Call with getOnlyDistributedEmails)
function email_reminder_list($distributed_emails) { 
    $email_subject = "Confirm event ticket"; 
    $email_message = "Looks like you haven't confirmed your ticket yet on ticketlotto! Please let your event organizer know if you plan on attending through this link:(Ticket registration link)";
    mail($email_to, $email_subject, $email_message);
    foreach($distributed_emails as $item) {
        mail($item[0], $email_subject, $email_message);
    }
    unset($item);
}
?>