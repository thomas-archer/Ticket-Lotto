
<?php
    //for use on home page
    function getSearchedEvents($EventName){
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
            $result = $dbcon->query($query);
            $Events = array();
            while($row = $result->fetch_row())
            {
                $Events[] = $row;
            }
    $result->close();
    $mysqli->close();
    return $Events;
    }

    //for use on home page
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
            if ($dbcon->query($query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $dbcon->error;
            }
            $dbcon->close();
    }

    //for use on View My Events Page
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
                $query = "Select * from SellerEvents where SellerEmail = \"$SellerEmail\"";
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
    function distributeTickets($EventID)
    {

    }

    //For use on create event page
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
        $query = "INSERT INTO SellerEvents (EventName, EventOrganization, EventURL, EventDate, TicketDistDate, Price, NumTickets, EventDesc, SellerName, SellerEmail) 
        VALUES (\"$EventName\", \"$Organizer\", \"$URL\", \"$EventDate\", \"$TicketDistDate\", $Price, $NumTickets, \"$EventDesc\", \"$SellerEmail\")";
        if ($dbcon->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
        $dbcon->close();
    }

    
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
                (Select distinct EventID from TicketRequests where BuyerEmail = \"$BuyerEmail\" and TicketStatus = \"distributed\")";
        $result = $dbcon->query($query);
        $BuyerEvents = array();
        while($row = $result->fetch_row())
        {
            $BuyerEvents[] = $row;
        }
        $result->close();
        $mysqli->close();
        return $BuyerEvents;
    }

    //for use on ticket verification page
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
        $query = "Update TicketRequests Set status = $TicketStatus Where EventID = $EventID and BuyerEmail =\"$BuyerEmail\"";
        if ($dbcon->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $dbcon->error;
        }
        $dbcon->close();

    }

    //for use on ticket verification page
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