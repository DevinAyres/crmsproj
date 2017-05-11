<?php
	include ("Session.php");
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

function get_password($email){
	// connect to waitlist database
    try {
	$db = new PDO('sqlite:waitlist/WaitList.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // get password
    $passQry = 'SELECT Password FROM WaitLogin WHERE firstname = :fname AND lastname = :lname AND username = :uname AND Email = :email';
    $passStmt = $db->prepare($passQry);
	$passStmt->bindValue(':email', $email);
	
    $passStmt->execute();

    $result = $passStmt->fetchColumn();
	
	return $result;
  
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
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  $db = null;	
}

function add_user($uName, $email, $pWord){
  // add user to the wait list
  // connect to login database
  try {
	  $db = new PDO('sqlite:login/LoginInfo.db');
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  	    
      $qry = $db->prepare('INSERT INTO Login (username, email, password) VALUES (?, ?, ?)');
      $qry->execute(array($uName, $email, $pWord));
      echo "User is now allowed to access the Customer Relationship Management System (CRMS).";
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
	// get the user's password
    $passWord = get_password($eMail);
	
	// get the user's username
	$username = get_username($eMail);
	
	// add user to the user database
	add_user($userName, $eMail, $passWord);
	
	// delete user from waitlist
	delete_user($eMail);
	
	// send e-mail to the user
	// make message
	$msg = "Hello,\nYou have been accepted by an admin to use the Customer Relationship Management System (CRMS).";
    // send email
    mail($eMail,"CRMS Accepted",$msg);
}
?>

<form id ="redirect" method ="post" action ="ManageAccounts.php">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>