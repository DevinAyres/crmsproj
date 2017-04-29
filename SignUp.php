<!DOCTYPE HTML> 
<html>
<head>
</head>
<body>

<?php

// define variables
$firstName = $eMail = $lastName = $userName = $passWord = "";

// validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = test_input($_POST["firstname"]);
  $eMail = test_input($_POST["email"]);
  $lastName = test_input($_POST["lastname"]);
  $userName = test_input($_POST["username"]);
  $password = test_input($_POST["psw"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_email($data) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     return true;
  } else {
     return false;	
  }	
}

function email_allowed($data) {
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:logins/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
    
  // test to see if email is already in use
  $emailQry = 'SELECT COUNT(*) FROM Login WHERE email = ? LIMIT 1';
  $emailStmt = $db->prepare($emailQuery);
  $emailStmt->bindParam(1, $data, PDO::PARAM_INT);
  $emailStmt->execute();

  if($emailStmt->fetchColumn()) {
	db = null;
	return true;
  } else {
        db = null
        return false;
  }
}

function username_allowed($data) {
  // check for pre-existing username
  // connect to user database
  try {
	$db = new PDO('sqlite:logins/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
    
  // test to see if username is already in use
  $userNameQry = 'SELECT COUNT(*) FROM Login WHERE username = ? LIMIT 1';
  $uNameStmt = $db->prepare($userNameQuery);
  $uNameStmt->bindParam(1, $data, PDO::PARAM_INT);
  $uNameStmt->execute();

  if($uNameStmt->fetchColumn()){
  	db = null
        return true;
  } else {
	db = null
        return false;
  } 
}

// test user's email if it is valid
if((substr_count($eMail,"@merrimack.edu")) === 0 || test_email($eMail) {
  echo "Sorry, you do not meet the necessary requirements to sign up.";
} else {
  // check for pre-existing email and username
  if(email_allowed($eMail)){
  	echo "This e-mail is already registered. Please use a different e-mail.";
  } 
  else if(username_allowed($userName) {
	echo "This username is already in use. Please choose a different username.";
  }
  else {
  	// add potential user to the wait list
  	// connect to waitlist database
  	try {
		$db = new PDO('sqlite:waitlist/WaitList.db');
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  	}
  	catch (PDOException $e) {
		print($e->getMessage());
 	 }	
    
  	$qry = $db->prepare('INSERT INTO WaitLogin (firstname, lastname, username, Email,
			Password) VALUES (?, ?, ?, ?, ?)');
        $qry->execute(array($firstName, $lastName, $userName, $eMail, $passWord));

        $db = null;

        echo "You have been added to the wait list. An e-mail will be sent confirming your registration once an admin approves.";
  }
}
?>

<form id ="redirect" method ="post" action ="LogIn.html">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>