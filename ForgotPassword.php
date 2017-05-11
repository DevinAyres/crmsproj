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
$valid_email_flag = "";												// test forget password process
$eMail = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function email_exists($data) {
  // define global
  global $valid_email_flag;
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // test to see if email is in database
    $emailQry = 'SELECT COUNT(*) FROM Login WHERE email = :email LIMIT 1';
    $emailStmt = $db->prepare($emailQry);
    $emailStmt->bindValue(':email', $data);
    $emailStmt->execute();

    if($emailStmt->fetchColumn()) {
	  $valid_email_flag = 1;
    } else {
      $valid_email_flag = 0;
    }
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null;
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_email($data) {
  // create a random password
  $randomPassword = generateRandomString();
  
  // password sent by e-mail
  $emailPassword = $randomPassword;
  
  // encrypt the password
  $hash = password_hash($randomPassword, PASSWORD_DEFAULT);
   
  // connect to user database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // get password
    $passQry = 'UPDATE Login SET password = :password WHERE email = :email';;
    $passStmt = $db->prepare($passQry);
	$passStmt->bindValue(':password', $hash);
    $passStmt->bindValue(':email', $data);
    $passStmt->execute();
  
    // the message
    $msg = "Hello,\n\nYour temporary password on the Customer Relationship Management System is " . $randomPassword . ".\n\n Please go change your password once you are logged in to ensure the safey of your account.\n\n CRMS";

    // send email
    mail($data,"CRMS Password",$msg);
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

// Check if inputed e-mail is correct
if(substr_count($eMail,"@merrimack.edu") == 0) {
  echo "Invalid e-mail.";
} else {
  // check if the e-mail exists
  email_exists($eMail);
  
  if($valid_email_flag == 1) {
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