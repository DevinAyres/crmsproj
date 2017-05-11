<?php
   include ("Session.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Change Password</title>
<meta charset="utf-8" />
<link rel = "stylesheet" href="style.css" />
</head>

<body>

<img src="https://media.licdn.com/mpr/mpr/shrink_200_200/AAEAAQAAAAAAAAezAAAAJDIxMGUzZTQyLTM3ZDItNDYwNy05MmNjLTE3YWNiNThmYTUxYw.png" alt="https://media.licdn.com.com" width="200" height="200">
<center><h1>Change Password?</h1></center>

<p id ="changepass"></p>

<!-- Get User's input -->
<form action="ChangePassword.php" method="post">
<center>E-mail: <input type="text" name="email" required>
<br><br>
New Password: <input type="password" name="newpsw1" required>
<br><br>
Confirm New Password <input type="password" name="newpsw2" required>
<br><br>
<input type ="submit" value="Submit">
</center>
</form>

</body>
</html>