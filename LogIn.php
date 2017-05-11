<!DOCTYPE HTML> 
<html>
<head>
</head>
<body>

<?php
session_start();

function get_password($email){
  // connect to waitlist database
  try {
	$db = new PDO('sqlite:login/LoginInfo.db');
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  
    // get password
    $passQry = 'SELECT password FROM Login WHERE email = :email';
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

if(isset($_POST['submit'], $_POST['username'], $_POST['password'])) {
  try {

	$email = $_POST['username'];
	$password = $_POST['password'];
	$existing = get_password($email);
    
    if (password_verify($password, $existing)){
      $conn = new PDO('sqlite:login/LoginInfo.db');
	  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      // test for successful login
      $loginQry = 'SELECT COUNT(*) FROM Login WHERE email = :email AND password = :pass';
      $loginStmt = $conn->prepare($loginQry);
      $loginStmt->bindValue(':email', $email);
      $loginStmt->bindValue(':pass', $existing);
      $loginStmt->execute();
	    
      if($loginStmt->fetchColumn()) {
		$_SESSION['login_user'] = $email;  
	    header("location:Home.php");
      } else {
        header("location:LogIn.html");
      }
	} else{
	    header("location:LogIn.html");
    }
  }
  catch (Exception $e) {
	print($e->getMessage());
  }	
  
  $db = null;
}
?>
</body>
</html>