<?php
	include("Session.php");
?>
<!DOCTYPE HTML> 
<html>
<head>
<meta charset="utf-8" />
<link rel = "stylesheet" href="style.css" />
</head>
<body>

<?php
include ('merrimack/debug.php');
// define variables
$valid_user_flag = "";										   // test if user exists
$eMail = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function user_exists($email){
  // define global
  global $valid_user_flag;
  // check for pre-existing user
  // connect to waitlist database
  try {
	$db = new PDO('sqlite:waitlist/WaitList.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // test to see if user is in database
    $userQry = 'SELECT COUNT(*) FROM WaitLogin WHERE Email = :email LIMIT 1';
    $userStmt = $db->prepare($userQry);
	$userStmt->bindValue(':email', $email);
    $userStmt->execute();

    if($userStmt->fetchColumn()) {
	  $valid_user_flag = 1;
    } else {
      $valid_user_flag = 0;
    }
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null;
}

function delete_user($email){
  // connect to waitlist database
  try {
	$db = new PDO('sqlite:waitlist/WaitList.db');
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  	    
    $userStmt = $db->prepare('DELETE FROM WaitLogin WHERE Email = :email');
	$userStmt->bindValue(':email', $email);
	$userStmt->execute();
    echo "User is deleted from the waitlist.";		
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null;	
}

// validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $eMail = test_input($_POST["email"]);
}  
// check if the user exists
user_exists($eMail);
if ($valid_user_flag == 0) {
	echo "Invalid user information. Please make sure you correctly typed in a potential user's information.";
} else {
	// delete user from waitlist database
	delete_user($eMail);
}
?>

<form id ="redirect" method ="post" action ="ManageAccounts.php">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>