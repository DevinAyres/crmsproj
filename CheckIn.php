<?php
	include ("Session.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php
try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$smt = $db->prepare("Select * from Appointments where Show is null order by Date asc");

$smt->execute();

$results = $smt->fetchall();

if ($_POST['protocol'] === 'delete')
{
$idDate = explode('|', $_POST['idNumber']);
$smt4 = $db->prepare("delete from Appointments where ID = :id and Date = :date");
$smt4->execute(array(':id'=> $idDate[0], ':date'=> $idDate[1]));
header("Refresh:0");
}
else if($_POST['protocol'] === 'checkIn')
{
$idDate = explode('|', $_POST['idNumber']);
$smt3 = $db->prepare("Update Appointments set checked = 'yes' where ID = :id and Date = :date");
if (!$smt3->execute(array(':id'=> $idDate[0], ':date' => $idDate[1])))
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
$idName = "";
foreach ($results as $row)
{
$smt2->execute(array(':id'=> $row['ID']));
$names = $smt2->fetch();
$idName = $row['ID'] . "|" . $row['Date'];
echo "<tr><td><label><input type ='radio' name ='idNumber' id = 'idNumber' value = '{$idName}' onclick='setID()'>{$row['Date']}</label></td><td>{$names['FirstName']} {$names['LastName']}</td><td>{$row['advisor']}</td><td>{$row['Reason']}</td>";
if ($row['checked'] === 'yes')
echo "<td><input type ='checkbox' disabled readonly checked></td></tr>";
else
echo "<td><input type ='checkbox' disabled readonly></td></tr>";
}
}

?>
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
</head>

<script>
function setID()
{
document.getElementById('idButton').value = document.querySelector('input[name="idNumber"]:checked').value;
document.getElementById('idButton2').value = document.querySelector('input[name="idNumber"]:checked').value;
}
</script>

<body>
  <header>
    <div class = "nav">
      <ul>	
	    <li> <a href="Home.php">Home</a> </li>
		<li> <a href="Add.php">Add Student</a> </li>
		<li> <a href="Search.php">Search Student</a> </li>
		<li> <a class="active" href="CheckIn.php">Check-In</a> </li>
		<li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		<li> <a href="Help.php">Help</a> </li>
		<li class="floatme"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		  <li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
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
	<button class="button" name ="protocol" value="delete">Cancel</button>
    <button class="button" name ="protocol" value="add">Add</button>
	</form>
	<form id ="edit" method ="post" action ="EditAppointment.php">  
	  <button type ="submit" class="button" id ="idButton" name ="idButton" value="">Edit Appointment</button>
    </form>
<form id ="addnote" method ="post" action ="AddNote.php">
          <button type ="submit" class="button" id ="idButton2" name ="idButton2" value="">Add Note</button>
    </form>
  </div>
  
</body>
</html>
