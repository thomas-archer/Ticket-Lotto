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
            $WaitingEmails[] = $TicketRequests[i];
        }
    }
    return $WaitingEmails;
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



?>