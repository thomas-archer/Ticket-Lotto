<!DOCTYPE html>
<html>
<body>

<?php
	$servername = "ticketdb.cadri9on7p25.us-east-1.rds.amazonaws.com";
        $username = "ticketlotto";
        $password = "ticketlotto";
        $dbname = "ticketlotto";

	function g($SellerEmail){
        	// Create connection
                $dbcon = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($dbcon->connect_error) {
                        die("Connection failed: " . $dbcon->connect_error);
                }
                $query = "Select * from SellerEvents where SellerEmail = \"$SellerEmail\"";
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

?>

</body>
</html>
