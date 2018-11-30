
<?php

    //for use on home page
    //returns events give the event name
    //returns all values in the database on null input
    function getSearchedEvents($EventName){
        $Events = array();
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
            $query = "Select EventID,EventName,EventDate,TicketDistDate,Price from SellerEvents where EventName = \"$EventName\"";
            if($EventName == NULL)
            {
                $query= 'Select EventID,EventName,EventDate,TicketDistDate,Price from SellerEvents';
            }
            $result = $dbcon->query($query);
            while($row = $result->fetch_row())
            {
                $Events[] = $row;
            }
    $result->close();
    $dbcon->close();
    return $Events;
    }

    //for use on home page
    //adds a new ticket request to the database given the neccessary info
    function insertTicketRequest($EventID,$BuyerName,$BuyerEmail){
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
            $query = "INSERT INTO TicketRequests VALUES ($EventID,\"waiting\",\"$BuyerName\",\"$BuyerEmail\")";
            if (!($dbcon->query($query) === TRUE)) {
                echo "Error: " . $sql . "<br>" . $dbcon->error;
            }
            $dbcon->close();
    }

    //for use on View My Events Page
	//gets all events for a seller given the seller's email
	function getSellerEvents($SellerEmail){
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
                $query = "Select EventName,EventDate,Price,TicketDistDate,NumTickets,EventID from SellerEvents where SellerEmail = \"$SellerEmail\"";
                $result = $dbcon->query($query);
                $Events = array();
                while($row = $result->fetch_row())
                {
                	$Events[] = $row;
                }
		$result->close();
		$dbcon->close();
        return $Events;
    }

    //for use on View My Events Page
    //distributes the stored number of tickets for an event given its eventID
    function distributeTickets($EventID)
    {
        if($EventID==NULL) {
            return;
        }
       include 'RandomizationFunctions.php';
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
            $query = "Select NumTickets from SellerEvents where EventID = \"$EventID\"";
            $result = $dbcon->query($query);
            $NumTickets = int;
            while($row = $result->fetch_row())
            {
                $NumTickets = $row[0];
            }
            $result->close();
            $dbcon->close();
            $Emails = getTicketRequests($EventID);;
            $WaitingEmails = getOnlyWaitingEmails($Emails);
            randomlyDistributeTickets($NumTickets,$EventID,$WaitingEmails);
            $Emails = getTicketRequests($EventID);
            $WaitingEmails = getOnlyWaitingEmails($Emails);
            $DistributedEmails = getOnlyDistributedEmails($Emails);
            email_distributed_tickets($DistributedEmails,"http://localhost:8000/confirmation.php");
            email_waiting_list($WaitingEmails);
    }

    //For use on create event page
    //Inserts new event given the required info
    function insertNewEvent($EventName,$Organizer,$URL,$EventDate,$TicketDistDate,$Price,$NumTickets,$EventDesc,$SellerEmail)
    {
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
        $query = "INSERT INTO SellerEvents (EventName, EventOrganization, EventURL, EventDate, TicketDistDate, Price, NumTickets, EventDesc, SellerEmail) 
        VALUES (\"$EventName\", \"$Organizer\", \"$URL\", \"$EventDate\", \"$TicketDistDate\", $Price, $NumTickets, \"$EventDesc\", \"$SellerEmail\")";
        if (!($dbcon->query($query) === TRUE)) {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
        $dbcon->close();
    }

    //Gets all ticket requests for an event given its eventid
    function getTicketRequestsEvent($EventID){
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
        $query = "Select * from TicketRequests where EventID = \"$EventID\"";
        $result = $dbcon->query($query);
        $TicketRequests = array();
        while($row = $result->fetch_row())
        {
            $TicketRequest[] = $row;
        }
        $result->close();
        $dbcon->close();
        return $TicketRequest;
    }

    //for use on ticket verification page
    //gets all events that a buyer has been distributed a ticket for, given the buyer's email
    function getBuyerEventsDist($BuyerEmail){
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
        $query = "Select EventID, EventName from SellerEvents where EventID in
                (Select distinct EventID from TicketRequests where BuyerEmail = \"$BuyerEmail\")"; #and TicketStatus = \"waiting\")";
        $result = $dbcon->query($query);
        $BuyerEvents = array();
        while($row = $result->fetch_row())
        {
            $BuyerEvents[] = $row;
        }
        $result->close();
        $dbcon->close();
        return $BuyerEvents;
    }

    //for use on ticket verification page
    //updates the ticket status given whether or not the buyer has confirmed
    function updateStatus($EventID,$BuyerEmail,$TicketStatus)
    {
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
        $query = "Update TicketRequests Set TicketStatus = \"$TicketStatus\" Where EventID = \"$EventID\" and BuyerEmail =\"$BuyerEmail\"";
        if ($dbcon->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
        $dbcon->close();

    }

    //for use on ticket verification page
    //gets purchase url for an event given eventid
    function getURL($EventID)
    {
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
        $query = "Select EventURL from SellerEvents where EventID = $EventID";
        $result = $dbcon->query($query);
        $URL = array();
        while($row = $result->fetch_row())
        {
            $URL[] = $row;
        }
        $result->close();
        $dbcon->close();
        return $URL;

    }
?>
