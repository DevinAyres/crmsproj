<?php
	include ("Session.php");
?>

<!DOCTYPE HTML> 
<html>
<?php
include(merrimack/debug.php);

function print_users() { 
  // connect to waitlist database
  try {
    $db = new PDO('sqlite:waitlist/WaitList.db');
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
	// get the potential users
    $stmt = $db->prepare("SELECT firstname, lastname, username, Email FROM WaitLogin"); 
    $stmt->execute();
	
	// display potential users
	foreach($stmt as $row){
		echo "<tr><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td><td>" . $row['username'] . "</td><td>" . $row['Email'] . "</td></tr>";
	}
  }
  catch (PDOException $e) {
    print($e->getMessage());
  }	

  $db = null;
}
?>
<head>
<title>ManageAccounts</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
</head>

<body>
<header>
<div class = "nav">
      <ul>	
	    <li> <a href="Home.php">Home</a> </li>
		<li> <a href="Add.php">Add Student</a> </li>
		<li> <a href="Search.php">Search Student</a> </li>
		<li> <a href="CheckIn.php">Check-In</a> </li>
		<li> <a class="active" href="ManageAccounts.php">Manage Accounts</a> </li>
		<li> <a href="Help.php">Help</a> </li>
		<li class="floatme"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		<li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>

	  </ul>
	</div>

<h1>Manage Accounts</h1>
</header>

<!-- Get Users Action -->
  <div class="accounts">
    <form method ="post"">
      <table id="manageaccounts">
        <thead>
          <tr>
            <th>Firstname</th>
	        <th>Lastname</th>
	        <th>Username</th>
	        <th>Email</th>	 
          </tr>
        </thead>
        <tbody>
	      <?php print_users();?>
        </tbody>
      </table>
  </div>
  </br>
    <div class="colaccounts">
	  E-mail: <input type ="text" name ="email">
      <button class="button" type ="submit" formaction="AddUser.php"> Add User</button>
      <button class="button" type ="submit" formaction="DeleteUser.php">Delete User</button>
	</div>
  </form>
</body>
</html>