<?php
try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$smt = $db->prepare("Select * from Appointments order by Date asc");

$smt->execute();

$results = $smt->fetchall();

if ($_POST['protocol'] === 'delete')
{
$smt4 = $db->prepare("Delete from Appointments where ID = :id");
$smt4->execute(array(':id'=> $_POST['idNumber']));
header("Refresh:0");
}
else if($_POST['protocol'] === 'checkIn')
{
$smt3 = $db->prepare("Update Appointments set checked = 'yes' where ID = :id");
if (!$smt3->execute(array(':id'=> $_POST['idNumber'])))
print_r($smt3->errorInfo());
else
header("Refresh:0");
}
else if($_POST['protocol'] === 'add')
{
header("Refresh:0; url=AddAppointment.php");
}

function populateAppointments($results, $db)
{
$smt2 = $db->prepare("Select FirstName, LastName from MasterList where ID = :id");
foreach ($results as $row)
{
$smt2->execute(array(':id'=> $row['ID']));
$names = $smt2->fetch();
echo "<tr><td><label><input type ='radio' name ='idNumber' id = 'idNumber' value = {$row['ID']} onclick='setID()'>{$row['Date']}</label></td><td>{$names['FirstName']} {$names['LastName']}</td><td>{$row['advisor']}</td><td>{$row['Reason']}</td>";
if ($row['checked'] === 'yes')
echo "<td><input type ='checkbox' disabled readonly checked></td></tr>";
else
echo "<td><input type ='checkbox' disabled readonly></td></tr>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
  
  <!--<link rel = "stylesheet" href="bootstrap.css" /> -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</head>

<script>
function setID()
{
document.getElementById('idButton').value = document.querySelector('input[name="idNumber"]:checked').value;
}
</script>
<body>
  <header>
    <div class = "nav">
      <ul>	
	    <li> <a href="Index.html">Home</a> </li>
		<li> <a href="AddStudent.html">Add Student</a> </li>
		<li> <a href="Search.php">Search Student</a> </li>
		<li> <a class="active" href="CheckIn.html">Check-In</a> </li>
		<li> <a href="Help.html">Help</a> </li>
	  </ul>
	</div>
	<h1>Appointments</h1>
  </header>
    
  <div class="app">
    <form method ="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <table id="appointments">
        <thead>
          <tr>
            <th>Date</th>
            <th>Student Name</th>
	        <th>Advisor Name</th>
	        <th>Reason</th>
	        <th>Checked In</th>	 
          </tr>
        </thead>
        <tbody>
	      <?php populateAppointments($results, $db);?>
        </tbody>
      </table>
  </div>
  </br>
  <div class="col2">
	<button class ="button" name ="protocol" value="checkIn">Check in</button>
	<button class="button" name ="protocol" value="delete">Delete</button>
    <button class="button" name ="protocol" value="add">Add</button>
	</form>
	<form id ="edit" method ="post" action ="EditAppointment.php">  
	  <button type ="submit" class="button" id ="idButton" name ="idButton" value="">Edit Appointment</button>
    </form>
  </div>
  
</body>
</html>
