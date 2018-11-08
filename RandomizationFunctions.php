<?php
//File that defines functions for Randomization

//Input:EventID for desired event
//Output:Array of all Ticket Requets for the given EventID, with email and ticket status
function getTicketRequests($EventID){
    $sql = mysql_query("Select BuyerEmail, Status from TicketRequests where EventID = $EventID");
    $TicketRequests = array();
    while ($row_request = mysql_fetch_assoc($sql))
    $TicketRequest[] = $row_request;
    return $TicketRequest;
}

//Input:Array of Ticket Requets with email and ticket status
//Output: Array of Ticket Requets with only email, only including those with the 'waiting' ticket status
function getOnlyWaitingEmails($TicketRequests){
    $arrlength= count($TicketRequests);
    $WaitingEmails = array();
    for($i = 0; $i < $arrlength; $i++) {
        if($TicketRequest[$i][1] == 'Waiting'){
            $WaitingEmails[] = str_replace(" Waiting", "", $TicketRequests[i]);
        }
    }
    return $WaitingEmails;
}

//Input:Array of Ticket Requets with email and ticket status
//Output: Array of Ticket Requets with only email, only including those with the 'waiting' ticket status
function getOnlyDistributedEmails($TicketRequests) {
    $arrlength= count($TicketRequests);
    $DistributedEmails = array();
    for($i = 0; $i < $arrlength; $i++) {
        if($TicketRequest[$i][1] == 'Distributed'){
            $DistributedEmails[] = $WaitingEmails[] = str_replace(", Distributed", "", $TicketRequests[i]);
        }
    }
    return $DistributedEmails;
}


//Inputs: Number of Tickets to be distributed, EventID for desired event, Array of Emails for those waiting on a Ticket Request
//Outputs: Array of emails for those distibuted tickets
//Actions; Updates the ticket status of those chosen as "distributed"
function randomlyDistributeTickets($numTickets,$EventID,$WaitingEmails){
    $arrlength= count($TicketRequests);
    if($arrlength<$numTickets){
        $numDistributed = $arrlength;
    }
    else{
        $numDistributed = $numTickets;
    }
    shuffle($WaitingEmails);
    $DistributedEmails = array();
    for($i = 0; $i < $numDistributed; $i++) {
        $sql = "UPDATE TicketRequests SET status='Distributed' WHERE EventId = $EventID and BuyerEmail = $WaitingEmails[i]";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        $DistributedEmails[] = $WaitingEmails[i];
    }
    return $DistributedEmails;
}

//Email selected notifications to those who received a ticket (Call with getOnlyDistributedEmails)
function email_distributed_tickets($distributed) {
    $email_to = implode(',', $distributed); //
    $email_subject = "You've been selected!"; 
    $email_message = "Congragulations! You've been randomly selected to participate in an event on ticketlotto. Please use this link to let the event know if you can still attend and purchase your ticket: (confirmation ticket link)";
    mail($email_to, $email_subject, $email_message);
}

//Email waitlist notifications to those who did not receive a ticket (Call with getOnlyWaitingEmails)
function email_waiting_list($waiting_emails) {
    $email_to = implode(',', $waiting_emails); 
    $email_subject = "You're on the waitlist!"; 
    $email_message = "Hey! You've been added to a waitlist for an event on ticketlotto. The event organizer will inform you if another spot on the event opens up!";
    mail($email_to, $email_subject, $email_message);
}

//Email reminder notifications to those who have not confirmed their attendance (Call with getOnlyDistributedEmails)
function email_reminder_list($distributed_emails) {
    $email_to = implode(',', $distributed_emails); 
    $email_subject = "Confirm event ticket"; 
    $email_message = "Looks like you haven't confirmed your ticket yet on ticketlotto! Please let your event organizer know if you plan on attending through this link:(Ticket registration link)";
    mail($email_to, $email_subject, $email_message);
}


?>