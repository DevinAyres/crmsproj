<!DOCTYPE html>
<html>
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
 <style>
  .error {color: #FF0000;}
 </style>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$smt = $db->prepare("Delete from MasterList where ID = :id");

if ($smt->execute(array(':id' => $_POST['id'])))
echo "Student Deleted";

$smt = $db->prepare("Delete from Appointments where ID = :id");
$smt->execute(array(':id' => $_POST['id']));
}

?>

<form id ="redirect" method ="post" action ="Index.html">
<input type="submit" name = "return" value = "Return"> 
</form>

</body>
</html>
