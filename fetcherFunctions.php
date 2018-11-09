<!DOCTYPE html>
<html>
<body>

<?php

include(connect-mysql.php);
function getMyEvent($SellerEmail){
	$mysql_select_db($dbname) or die("Cannot Connect");
	}		
	$query = oci_parse($mysql_select_db, "SELECT EventName, EventDate 
                                          FROM SellerEvents 
                                          WHERE SellerEmail = :email";
							    
	oci_bind_by_name($query, ':email', $SellerEmail);
	oci_execute($query);
	echo	"<h1>
				Your Events:<br>
			</h1>
			<p><table>
				<tr>
				<th>Event Name:</th>
				<th>Event Date:</th>
				</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  <td>$row[1]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

?>

</body>
</html>
