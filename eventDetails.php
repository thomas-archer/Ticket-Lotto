<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Light Theme</title>
<link href="css/createTemplate.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Main Container -->
<div class="container"> 
  <ul id = "menu">
      <li><a href="index.php">Home</a></li>
			<li><a href="create.php">Create Event</a></li>
			<li><a href="viewEvents.php">View My Events</a></li>
  </ul>
	
  <h2 align="center"> Event Details</h2>
  <section class="intro">
    <div class="column">
      <h3>JOHN DOE</h3>
      <img src="images/profile.png" alt="" class="profile"> </div>
    <div class="column">
      <p>Date: </p>
	  <p>Location: </p>
      <p>Information: <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla</p>
    </div>
  </section>
    <div align="center" class="copyright">
		<form class="joinLottery" action="/join-lotto.php" method = "_POST">
      <input type="email" placeholder="Enter email to join Lottery!" name="buyer_email_input">
      <input type="text" placeholder="Enter email to join Lottery!" name="buyer_name_input">
			<br>
			<input type="submit" class="button">
		</form>
	</div>
  </div>
</body>
</html>
