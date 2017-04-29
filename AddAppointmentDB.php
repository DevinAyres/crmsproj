<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Appointment</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
</head>
<body>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']))
{

try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

if ($_POST['protocol'] === 'edit')
{
$delete = $db->prepare("delete from Appointments where ID = :id and Date = :date");
$delete->execute(array(':id'=> $_POST['id'], ':date'=> $_POST['date']));
}
$query = "Insert into Appointments values (?, ?, ?, ?, ?)"; 

$stmt = $db->prepare($query);
if($stmt->execute(array($_POST["date"], $_POST["id"], $_POST["reason"], $_POST["advisor"], $_POST["checked"])))
echo "Success";
else
echo "Failure";
}
else
echo "Please Select a Student!";
?>

<form id ="redirect" action ="CheckIn.php">
<input type="submit" name = "return" value = "Return To Check In Page">
</form>
<form id ="redirect2" method ="post" action ="AddAppointment.php">
<input type="submit" name = "return" value = "Add Another Appointment">
</form>
</body>
</html>
