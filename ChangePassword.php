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
$valid_chgpass_flag = "";									// tests change password process
$eMail = $newpass1 = $newpass2 = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function email_exists($data) {
  // define gobal
  global $valid_chgpass_flag;
  // check for pre-existing email 
  // connect to user database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // test to see if email is already in use
    $emailQry = 'SELECT COUNT(*) FROM Login WHERE email = :email LIMIT 1';
    $emailStmt = $db->prepare($emailQry);
    $emailStmt->bindValue(':email', $data);
    $emailStmt->execute();

    if($emailStmt->fetchColumn()) {
	  $valid_chgpass_flag = 1;
    } else {
      $valid_chgpass_flag = 0;
    }
  }
  catch (PDOException $e) {
	print($e->getMessage());
  }	
  
  $db = null;
}

function change_password($email, $newpass){
  // hash password
  $hash = password_hash($newpass, PASSWORD_DEFAULT);
  // change user's password
  // connect to login database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
	// update the user's password
    $passQry = 'UPDATE Login SET password = :newpass WHERE email = :email';	
    $stmt = $db->prepare($passQry);
	$stmt->bindValue(':newpass', $hash);
	$stmt->bindValue(':email', $email);
    $stmt->execute();   							
  }
  catch (PDOException $e) {
	 print($e->getMessage()); 
  }
  
  $db = null; 
}          

// validate data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eMail = test_input($_POST["email"]);
	$newpass1 = test_input($_POST["newpsw1"]);
	$newpass2 = test_input($_POST["newpsw2"]);	
}
 
// test user's email if it is valid
if(substr_count($eMail,"@merrimack.edu") == 0) {
  echo "Please retype a valid e-mail.";
} else {
  // check for pre-existing email
  email_exists($eMail);
  if($valid_chgpass_flag == 0){
    echo "Please retype a valid e-mail.";
  } else {	
    // test new pass entries
    if($newpass1 != $newpass2) {
	  echo "Your new password and confirmation of your new password do not match.";	
	} else {
      change_password($eMail, $newpass1);
	  echo "Success. Your password has been changed. Please use your new password the next time you login.";          
	}
  }
}                              
?>

<form id ="redirect" method ="post" action ="Home.php">
<input type="submit" name = "return" value = "Return">
</form>
</body>
</html>