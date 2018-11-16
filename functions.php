
<?php

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
		$mysqli->close();
        return $Events;
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
        $mysqli->close();
        return $TicketRequest;
    }

    function getBuyerEvents($BuyerEmail){
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
        $query = "Select * from SellerEvents where EventID in
                (Select distinct EventID from TicketRequests where BuyerEmail = \"$BuyerEmail\")";
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
?>