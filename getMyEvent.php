<!DOCTYPE html>
<html>
<body>

<?php

include(connect-mysql.php);

$mysql_select_db($dbname) or die("Fuck you!");
$query2 = "SELECT EventName, EventDate FROM SellerEvents WHERE EventID in (SELECT EventID FROM TicketRequests WHERE BuyerEmail = 'bobbymac97@gmail.com')";

$result = $dbcon->query($query2);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> Event Name: ". $row["EventName"]. "<br>";
    }
} else {
    echo "0 results";
}

?>

</body>
</html>