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
$valid_signup_flag = "";										// tests signup process
$firstName = $eMail = $lastName = $userName = $passWord = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function email_pending($data) {
  // define global
  global $valid_signup_flag;
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:waitlist/WaitList.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
	// test to see if email is already signed up
    $emailQry = 'SELECT COUNT(*) FROM WaitLogin WHERE Email = :email LIMIT 1';
    $emailStmt = $db->prepare($emailQry);
    $emailStmt->bindValue(':email', $data);
    $emailStmt->execute();

    if($emailStmt->fetchColumn()) {
	  $valid_signup_flag = 1;
    } else {
      $valid_signup_flag = 0;
    }
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	   
  
  $db = null; 
}

function email_allowed($data) {
  // define global
  global $valid_signup_flag;
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
	// test to see if email is already in use
    $emailQry = 'SELECT COUNT(*) FROM Login WHERE email = :email LIMIT 1';
    $emailStmt = $db->prepare($emailQry);
    $emailStmt->bindValue(':email', $data);
    $emailStmt->execute();

    if($emailStmt->fetchColumn()) {
	  $valid_signup_flag = 1;
    } else {
      $valid_signup_flag = 0;
    }
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	   
  
  $db = null; 
}

function username_pending($data) {
  // define global
  global $valid_signup_flag;
  // check for pre-existing username
  // connect to user database
  try {
	$db = new PDO('sqlite:waitlist/WaitList.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // test to see if username is already in use
    $userNameQry = 'SELECT COUNT(*) FROM WaitLogin WHERE username = :uname LIMIT 1';
    $uNameStmt = $db->prepare($userNameQry);
    $uNameStmt->bindValue(':uname', $data);
    $uNameStmt->execute();

    if($uNameStmt->fetchColumn()){
      $valid_signup_flag = 1;
    } else {
      $valid_signup_flag = 0;
    } 
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null; 
}

function username_allowed($data) {
  // define global
  global $valid_signup_flag;
  // check for pre-existing username
  // connect to user database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // test to see if username is already in use
    $userNameQry = 'SELECT COUNT(*) FROM Login WHERE username = :uname LIMIT 1';
    $uNameStmt = $db->prepare($userNameQry);
    $uNameStmt->bindValue(':uname', $data);
    $uNameStmt->execute();

    if($uNameStmt->fetchColumn()){
      $valid_signup_flag = 1;
    } else {
      $valid_signup_flag = 0;
    } 
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null; 
}

// validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = test_input($_POST["firstname"]);
  $eMail = test_input($_POST["email"]);
  $lastName = test_input($_POST["lastname"]);
  $userName = test_input($_POST["username"]);
  $passWord = test_input($_POST["psw"]);
}

// test user's email if it is valid
if(substr_count($eMail,"@merrimack.edu") == 0) {
  echo "Sorry, you do not meet the necessary requirements to sign up.";
} else {
  // check for already pending email
  email_pending($eMail);
  if($valid_signup_flag == 1){
    echo "This e-mail is currently pending. Please use a different e-mail.";
  } else {
	// check for pre-existing email
    email_allowed($eMail);
    if($valid_signup_flag == 1){
  	  echo "This e-mail is already registered. Please use a different e-mail.";
    }  else {
	  // check for already pending username
	  username_pending($userName);
	  if($valid_signup_flag == 1) {
		echo "This username is currently pending. Please choose a different username.";
	  } else {
        // check for pre-existing username
	    username_allowed($userName);
	    if($valid_signup_flag == 1) {
	      echo "This username is already in use. Please choose a different username.";
        } else {
  	      // hash password
		  $hash = password_hash($passWord, PASSWORD_DEFAULT);
		  // add potential user to the wait list
  	      // connect to waitlist database
  	      try {
		    $db = new PDO('sqlite:waitlist/WaitList.db');
		    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  	    
			$qry = $db->prepare('INSERT INTO WaitLogin (firstname, lastname, username, Email, Password) VALUES (?, ?, ?, ?, ?)');
            $qry->execute(array($firstName, $lastName, $userName, $eMail, $hash));
            echo "You have been added to the wait list. An e-mail will be sent confirming your registration once an admin approves.";
		  }
  	      catch (PDOException $e) {
		      echo $e->getMessage();
 	   	  }
          $db = null; 		
        }  	  
	  }  
	}  
  }    
}
?>

<form id ="redirect" method ="post" action ="LogIn.html">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>