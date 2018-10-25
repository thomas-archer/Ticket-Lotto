<?php
//File that connects to MySQL database
DEFINE ('DB_USER', 'user');
DEFINE ('DB_PSWD', 'pswd');
DEFINE ('DB_HOST', 'host');
DEFINE ('DB_NAME', 'name'); 
  
$dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);


if($dbcon->connect_error){
  die("Connection DNW" . $dbcon ->connect_error);
}
?>
  
<?php
  //File that takes form info on event page and inserts info into database
  if(isset($_POST['submitted'])) {
    include('connect-mysql.php');
    $name = $_POST['name'];
		$email = $_POST['email'];
  	$sql = "INSERT INTO TicketRequests (BuyerName, Email) VALUES ('name', 'email')";
  }
	
	if ($dbcon->query($sql) === TRUE) {
    echo "Submission Successful!";
	} else {
    echo "Error: " . $sql . "<br>" . $dbcon->error;
	}
?>
  
<?php
  //File that takes form info on event page and inserts info into database
  if(isset($_POST['submitted'])) {
    include('connect-mysql.php');
    $name = $_POST['name'];
		$email = $_POST['email'];
    $psword = $_POST['psword'];
  	$sql = "INSERT INTO Buyers (BuyerName, Email, Hpasswrod) VALUES ('name', 'email', 'psword')";
  }
	
	if ($dbcon->query($sql) === TRUE) {
    echo "Submission Successful!";
	} else {
    echo "Error: " . $sql . "<br>" . $dbcon->error;
	}
	
  
?>