<!DOCTYPE HTML> 
<html>
<head>
</head>
<body>

<?php

// define variables
$eMail = "";

// validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
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

function email_exists($data) {
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:logins/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
    
  // test to see if email is in database
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

function send_email($data) {
  // connect to user database
  try {
	$db = new PDO('sqlite:logins/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
    
  // get password
  $passQry = 'SELECT password FROM Login WHERE email = ?';
  $passStmt = $db->prepare($passQry);
  $passStmt->bindValue('?', $data);
  $passStmt->execute();

  $result = $passStmt->fetchColumn();
  
  // the message
  $msg = "Hello,\nYour password on the Customer Relationship Management System is " + $result;

  // send email
  mail($data,"CRMS Password",$msg);
}

// Check if inputed e-mail is correct
if((substr_count($eMail,"@merrimack.edu")) === 0 || test_email($eMail) {
  echo "Invalid e-mail.";
} else {
  if(email_exists($eMail)
  {
	// send password to e-mail
	send_email($eMail);
	echo "An e-mail regarding your password has been sent to your e-mail address.";
  } else {
	echo "E-mail is not in use. Please register.";
  }
}
?>

<form id ="redirect" method ="post" action ="LogIn.html">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>