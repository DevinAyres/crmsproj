<?php
	include ("Session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class = "nav">
      <ul>
	    <li> <a class="active" href="Home.php">Home</a> </li>
		<li> <a href="Add.php">Add Student</a> </li>
		<li> <a href="Search.php">Search Student</a> </li>
		<li> <a href="CheckIn.php">Check-In</a> </li>
		<li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		<li> <a href="Help.php">Help</a> </li>
		<li style="float:right;"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		<li style="float:right;"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
	  </ul>
	</div>
	<h1>Welcome to the Academic Success Center CRMS</h1>
  </header>

</body>

</html>