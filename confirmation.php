<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirmation</title>
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
	
  <h2 align="center"> Event Confirmation</h2>
  <div class="copyright">
    <form action="" method="post"">
      <div class="formHeading">Insert Email:</div><br><input type="text" name="buyer_email_input">
      <input type="submit" value="View Tickets">
    </form>
    <br>
    <form action="/action_page.php">
      <select name="cars" style="width:200px">
        <!--<option value="volvo">Volvo</option>-->
      </select>
      <br><br>
      <input type="radio" name="gender" value="male"> Going
      <input type="radio" name="gender" value="female"> Can't Go
      <br><br>
      <input type="submit">
    </form>
  </div>
</div>
</body>
</html>
