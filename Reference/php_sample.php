<html>
<style>
		body {background-color: grey;}
		h1	{text-align: center;
	         background-color: LightGray;
			 border: 1px solid black;}
		p	{style=font-color: black;
			background-color: LightGray;
			border: 1px solid black;}
		table{text-align: center;}
		th,td {padding: 15px;
				test-align: left;
				border: 1px solid black;}
</style>
<body>
<?php

if (isset($_POST['branchno1'])) {
	$branchno1 = $_POST['branchno1'];
    transaction1($branchno1);
}
if (isset($_POST['Go2'])) {
    transaction2();
}
if (isset($_POST['branchno3']) and isset($_POST['ownerno3']) ) {
	$branchno3 = $_POST['branchno3'];
	$ownerno3 = $_POST['ownerno3'];
    transaction3($branchno3,$ownerno3);
}
if (isset($_POST['City4']) and isset($_POST['Rent4']) and isset($_POST['NumRooms4']) ) {
	$City4 = $_POST['City4'];
	$Rent4 = $_POST['Rent4'];
	$NumRooms4 = $_POST['NumRooms4'];
    transaction4($City4,$Rent4,$NumRooms4);
}

if (isset($_POST['Go5'])) {
    transaction5();
}

if (isset($_POST['Propertyno6']) and isset($_POST['RenterSSN6']) and isset($_POST['StartDate6']) and isset($_POST['EndDate6']) ) {
	$Propertyno6 = $_POST['Propertyno6'];
	$RenterSSN6 = $_POST['RenterSSN6'];
	$StartDate6 = $_POST['StartDate6'];
	$EndDate6 = $_POST['EndDate6'];
    transaction6($Propertyno6,$RenterSSN6,$StartDate6,$EndDate6);
}

if (isset($_POST['RenterSSN7'])) {
	$RenterSSN7 = $_POST['RenterSSN7'];
    transaction7($RenterSSN7);
}
if (isset($_POST['Go8'])) {
    transaction8();
}
if (isset($_POST['Name9'])) {
	$Name9 = $_POST['Name9'];
    transaction9($Name9);
}
if (isset($_POST['Go10'])) {
    transaction10();
}
if (isset($_POST['Propertyno11']) and isset($_POST['RenterSSN11']) and isset($_POST['RenterName11']) and isset($_POST['Work11']) and isset($_POST['Home11']) and isset($_POST['StartDate11']) and isset($_POST['EndDate11']) ) {
	$Propertyno11 = $_POST['Propertyno11'];
	$RenterSSN11 = $_POST['RenterSSN11'];
	$RenterName11 = $_POST['RenterName11'];
	$Work11 = $_POST['Work11'];
	$Home11 = $_POST['Home11'];
	$StartDate11 = $_POST['StartDate11'];
	$EndDate11 = $_POST['EndDate11'];
    transaction11($Propertyno11,$RenterSSN11,$RenterName11,$Work11,$Home11,$StartDate11,$EndDate11);
}

function transaction1($branchno1){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select PropertyNo, Name
								From Property 
								Left Join 
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Left Join 
								Manager On Supervisor.BranchNo = Manager.BranchNo
								Left Join
								Employee On Manager.EmployeeID = Employee.EmployeeID
								Where Manager.Branchno = (:branchno)");
	oci_bind_by_name($query, ':branchno', $branchno1);
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
				<tr>
				<th>Property Number:</th>
				<th>Manager Name:</th>
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

function transaction2(){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select SupID, Name, PropertyNo, City, Street, Zip
								From Property 
								Left Join 
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Left Join Employee On Supervisor.EmployeeID = Employee.EmployeeID
								Order by SupID");
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
						<tr>
						<th>SupervisorID:</th>
						<th>Supervisor Name:</th>
						<th>Property Number:</th>
						<th>Address:</th>
						</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
					<td>$row[0]</td>
					<td>$row[1]</td> 
					<td>$row[2]</td>
					<td>$row[4] Street, $row[3], $row[5]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction3($branchno3,$ownerno3){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select PropertyNo
								From Property
								Left Join 
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Where OwnerID = :ownerno3 and Branchno = :branchno3");
	oci_bind_by_name($query, ':branchno3', $branchno3);
	oci_bind_by_name($query, ':ownerno3', $ownerno3);
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
				<tr>
				<th>Property Number:</th>
				</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction4($City4,$Rent4,$NumRooms4){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select PropertyNo
								From Property
								Where upper(City) = upper(:City4) and NumRooms = :NumRooms4 and Rent < :Rent4");
	oci_bind_by_name($query, ':City4', $City4);
	oci_bind_by_name($query, ':Rent4', $Rent4);
	oci_bind_by_name($query, ':NumRooms4', $NumRooms4);
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
				<tr>
				<th>Property Number:</th>
				</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction5(){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		

	$query = oci_parse($conn, "Select Count(*)
								From Property
								Where Status = 'Available'");
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
						<tr>
						<th>Number of Available Properties:</th>
						</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
					<td>$row[0]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction6($Propertyno6,$RenterSSN6,$StartDate6,$EndDate6){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		

	$query = oci_parse($conn, "Insert into Lease values(:Propertyno6,:RenterSSN6,:StartDate6,:EndDate6)");
	oci_bind_by_name($query, ':Propertyno6', $Propertyno6);
	oci_bind_by_name($query, ':RenterSSN6', $RenterSSN6);
	oci_bind_by_name($query, ':StartDate6', $StartDate6);
	oci_bind_by_name($query, ':EndDate6', $EndDate6);
	oci_execute($query);
	$query3 = oci_parse($conn, "Select RenterName, Homephone, Workphone, StartDate, EndDate, Rent, 									Employee.Name
								From Renter
								left Join
								Lease on Renter.RenterSSN = Lease.RenterSSN
								left Join
								Property on Lease.PropertyNo = Property.PropertyNo
								Left Join
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Left Join
								Employee On Supervisor.EmployeeID = Employee.EmployeeID
								Where Renter.RenterSSN = :RenterSSN6");
	oci_bind_by_name($query3, ':RenterSSN6', $RenterSSN6);
	oci_execute($query3);
	echo	"<h1>
				Lease Created:<br>
			</h1>
			<p><table>
				<tr>
				<th>Renter Name:</th>
				<th>Home Phone:</th>
				<th>Work Phone:</th>
				<th>Start of Lease:</th>
				<th>End of Lease:</th>
				<th>Deposit Amount:</th>
				<th>Rent Amount:</th>
				<th>Supervisor Name:</th>
				</tr>";
	while (($row = oci_fetch_array($query3, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  <td>$row[1]</td>
              <td>$row[2]</td>
			  <td>$row[3]</td>
			  <td>$row[4]</td>
			  <td>$row[5]</td>
			  <td>$row[5]</td>
			  <td>$row[6]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);		
}

function transaction7($RenterSSN7){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select RenterName, Homephone, Workphone, StartDate, EndDate, Rent, 									Employee.Name
								From Renter
								left Join
								Lease on Renter.RenterSSN = Lease.RenterSSN
								left Join
								Property on Lease.PropertyNo = Property.PropertyNo
								Left Join
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Left Join
								Employee On Supervisor.EmployeeID = Employee.EmployeeID
								Where Renter.RenterSSN = :RenterSSN7");
	oci_bind_by_name($query, ':RenterSSN7', $RenterSSN7);
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
				<tr>
				<th>Renter Name:</th>
				<th>Home Phone:</th>
				<th>Work Phone:</th>
				<th>Start of Lease:</th>
				<th>End of Lease:</th>
				<th>Deposit Amount:</th>
				<th>Rent Amount:</th>
				<th>Supervisor Name:</th>
				</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  <td>$row[1]</td>
              <td>$row[2]</td>
			  <td>$row[3]</td>
			  <td>$row[4]</td>
			  <td>$row[5]</td>
			  <td>$row[5]</td>
			  <td>$row[6]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction8(){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		

	$query = oci_parse($conn, "Select Renter.RenterSSN, RenterName
								From
								Renter
								Where
								RenterSSN in
									(Select RenterSSN
									From Lease
									Group by RenterSSN
									Having count(*) > 1)");
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
						<tr>
						<th>Renter SSN:</th>
						<th>Renter Name</th>
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

function transaction9($Name9){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select Avg(Rent)
								From Property
							Where upper(City) = upper(:Name9)");
	oci_bind_by_name($query, ':Name9', $Name9);
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
				<tr>
				<th>Average Rent:</th>
				</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction10(){
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}		
	$query = oci_parse($conn, "Select Lease.PropertyNo, City, Street, Zip
								From Lease Left Join Property on Lease.PropertyNo = Property.Propertyno
								Where EndDate < ADD_MONTHS(SysDate,2)");
	oci_execute($query);
	echo	"<h1>
				Results:<br>
			</h1>
			<p><table>
						<tr>
						<th>Property Number:</th>
						<th>Property Address:</th>
						</tr>";
	while (($row = oci_fetch_array($query, OCI_BOTH)) != false) {			
		echo "<tr>
					<td>$row[0]</td>
					<td>$row[2] Street, $row[1], $row[3]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	
}

function transaction11($Propertyno11,$RenterSSN11,$RenterName11,$Work11,$Home11,$StartDate11,$EndDate11)
{
	$conn=oci_connect('hamestoy','V0lleyball!', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     print "<br> connection failed:";       
        exit;
	}	
	$query1 = oci_parse($conn, "Insert into Renter values(:RenterSSN11,:RenterName11,:Home11,:Work11)");
	oci_bind_by_name($query1, ':RenterSSN11', $RenterSSN11);
	oci_bind_by_name($query1, ':RenterName11', $RenterName11);
	oci_bind_by_name($query1, ':Home11', $Home11);
	oci_bind_by_name($query1, ':Work11', $Work11);
	oci_execute($query1);
	$query2 = oci_parse($conn, "Insert into Lease values(:Propertyno11,:RenterSSN11,:StartDate11,:EndDate11)");
	oci_bind_by_name($query2, ':Propertyno11', $Propertyno11);
	oci_bind_by_name($query2, ':RenterSSN11', $RenterSSN11);
	oci_bind_by_name($query2, ':StartDate11', $StartDate11);
	oci_bind_by_name($query2, ':EndDate11', $EndDate11);
	oci_execute($query2);
	$query3 = oci_parse($conn, "Select RenterName, Homephone, Workphone, StartDate, EndDate, Rent, 									Employee.Name
								From Renter
								left Join
								Lease on Renter.RenterSSN = Lease.RenterSSN
								left Join
								Property on Lease.PropertyNo = Property.PropertyNo
								Left Join
								Supervisor on Property.SupID = Supervisor.EmployeeID
								Left Join
								Employee On Supervisor.EmployeeID = Employee.EmployeeID
								Where Renter.RenterSSN = :RenterSSN11");
	oci_bind_by_name($query3, ':RenterSSN11', $RenterSSN11);
	oci_execute($query3);
	echo	"<h1>
				Lease Created:<br>
			</h1>
			<p><table>
				<tr>
				<th>Renter Name:</th>
				<th>Home Phone:</th>
				<th>Work Phone:</th>
				<th>Start of Lease:</th>
				<th>End of Lease:</th>
				<th>Deposit Amount:</th>
				<th>Rent Amount:</th>
				<th>Supervisor Name:</th>
				</tr>";
	while (($row = oci_fetch_array($query3, OCI_BOTH)) != false) {			
		echo "<tr>
			  <td>$row[0]</td>
			  <td>$row[1]</td>
              <td>$row[2]</td>
			  <td>$row[3]</td>
			  <td>$row[4]</td>
			  <td>$row[5]</td>
			  <td>$row[5]</td>
			  <td>$row[6]</td>
			  </tr>";	
	}
	echo "</table></p><br>;";
	OCILogoff($conn);	

}

?>
</body>
</html>

