<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$idDate = explode('|', $_POST['idButton2']);
try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}
if ($_POST['noteCheck'] == 1)
{
$smt = $db->prepare("Update Appointments set Notes = :note, Show = 'no' where ID = :id and Date = :date");
if ($smt->execute(array(':note'=>$_POST['note'], ':id'=> $idDate[0], ':date'=> $idDate[1])))
echo "Note Added";
else echo "Error";
header("Refresh:2 url=CheckIn.php");
}
}
?>

<!DOCTYPE html>
<html lang ="en">
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />

  <!--<link rel = "stylesheet" href="bootstrap.css" /> -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstra
p/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquer
y.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap
.min.js"></script>-->
</head>
<body>
Attention: Adding a note for an appointment automatically removes the appointment from the check-in list, however the appointment is still able to be viewed from a student's profile page.<br><br><br>
<form method ="post" id ="noteInput" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<input type ="hidden" name ="idButton2" value ="<?php echo $_POST['idButton2'];?>">
<textarea rows="4" cols="50" name="note">Enter Appointment Notes Here</textarea>
<button class ="button" type="submit" name ="noteCheck" value ="1">Submit Note</button>
</form>
</body>

</html>
