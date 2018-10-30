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
        if($TicketRequest[$i][1] == 'waiting'){
            $WaitingEmails[] = $TicketRequests[i];
        }
    }
    return $WaitingEmails;
  }


  //Inputs: Number of Tickets to be distributed, EventID for desired event, Array of Emails for those waiting on a Ticket Request
  //Outputs: None
  //Actions; Updates the ticket status of those chosen as "distributed" and send them an email to confirm and recieve purchase link
  function randomlyDistributeTickets($numTickets,$EventID,$WaitingEmails){
    $arrlength= count($TicketRequests);
    if($arrlength<$numTickets){
        $numDistributed = $arrlength;
    }
    else{
        $numDistributed = $numTickets;
    }
    shuffle($WaitingEmails);
    for($i = 0; $i < $numDistributed; $i++) {
        //Update ticket status to distributed for i using email, eventID
        //Send email to i with link to confirm purchase
    }
    return;
  }
  
?>