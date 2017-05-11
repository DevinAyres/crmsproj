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
$idDate = explode("|", $_POST['idButton']);
$smt = $db->prepare("Select * from Appointments where ID = :id and Date = :date");
$smt->execute(array(':id'=> $idDate[0], ':date'=> $idDate[1]));
$result = $smt->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style2.css">

        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        -->
	</head>
	<body>

 <form action ="AddAppointmentDB.php" method="POST">
      <p>
	<input type ="hidden" name ="id" value =<?php echo $result['ID'];?>>
        Advisor Name: <input type ="text" name ="advisor" value ="<?php echo $result['advisor'];?>"><br>
        Date: <input type ="text" name ="date" value ="<?php echo $result['Date'];?>"><br>
	Reason: <input type ="text" name ="reason" value ="<?php echo $result['Reason'];?>"> <br> 
	<input type ="hidden" name ="checked" value =<?php echo $result['checked'];?>>
	<input type ="hidden" name ="realDate" value =<?php echo $result['Date'];?>>
	<input type ='submit' name ='protocol' value ='edit'>
	</p>
</form>
</body>
</html>
 
