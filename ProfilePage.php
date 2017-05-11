<?php
	include ("Session.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel = "stylesheet" href="style.css" />
	<script>
	  function printData()
	  {
	    var divToPrint=document.getElementById("profile");
		newWin = window.open("");
		newWin.document.write(divToPrint.outerHTML);
		newWin.print();
		newWin.close();
	  }
	  
	</script>
  </head>
  
  <body>

<?php 

function populateTable($appointments, $results, $tags)
{
$count = 0;
if (count($appointments) >= count($tags))
foreach($appointments as $row)
{
echo "<tr><td class ='records'>Date: {$row['Date']}<br>Advisor: {$row['advisor']}<br>Reason: {$row['Reason']}<br>Notes: {$row['Notes']}</td><td class ='tags'>{$tags[$count]['Tag']}</td></tr>";
$count++;
}
else
foreach($tags as $row)
{
echo "<tr><td class ='records'>Date: {$appointments[$count]['Date']}<br>Advisor: {$appointments[$count]['advisor']}<br>Reason: {$appointments[$count]['Reason']}<br>Notes: {$appointments[$count]['Notes']}</td><td class ='tags'>{$row['Tag']}</td></tr>";
$count++;
}
}

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

$smt = $db->prepare("Select * from MasterList where ID = :id");

$smt->execute(array(':id' => $_POST['id']));

$results = $smt->fetch();

$smt2 = $db->prepare("Select * from Appointments where ID = :id order by Date asc");
$smt2->execute(array(':id' => $_POST['id']));
$appointments = $smt2->fetchall();
$_smt = $db->prepare("Select * from Tags where ID = :id");
$_smt->execute(array(':id' => $_POST['id']));
$tags = $_smt->fetchall();
}

?>

    <header>
	  <div class = "nav">
        <ul>
	      <li> <a href="Home.php">Home</a> </li>
		  <li> <a href="Add.php">Add Student</a> </li>
		  <li> <a href="Search.php">Search Student</a> </li>
		  <li> <a href="CheckIn.php">Check-In</a> </li>
		  <li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		  <li> <a href="Help.php">Help</a> </li>
		  <li class="floatme"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		  <li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
	    </ul>
	  </div>
    </header>

    <div class="outline2">
	  <table id="profile2">
	    <tbody>
		  <tr>
		    <td><b>NAME:</b> <?php echo $results['FirstName'] . " " . $results['LastName'];?></br></td>
		<td><b>ACADEMIC STANDING: <?php echo $results['AcademicStanding'];?></b></br></td>
		  </tr>
		  <tr>
		    <td><b>CLASS:</b> <?php echo $results['ClassYear'];?></br></td>
			<td><b>ADMIN MENTOR: <?php echo $results['Admin'];?></b></br></td>
		  </tr>
		  <tr>
		    <td><b>PROJECT GRAD YR:</b> <?php echo $results['PER_PlannedGradSemester'];?></br></td>
			<td><b>SPECIAL PROGRAMS:</b> <?php if (strtoupper($results['PROMISE'][0]) === 'Y') echo "Promise "; if (strtoupper($results['COMPASS'][0]) === 'Y') echo "Compass "; if (strtoupper($results['HONORS'][0]) === 'Y') echo "Honors "; if (strtoupper($results['Athlete'][0]) === 'Y') echo "Athlete "; if (strtoupper($results['Int_l'][0]) === 'Y') echo "International "; if (strtoupper($results['AR300']) === 'Y') echo "AR300! ";?></br></td>
		  </tr>
		  <tr>
		    <td><b>MAJOR:</b> <?php echo $results['PER_Major1Text'] . "   " . $results['PER_Major2Text'];?></br></td>
			<td><b>FALL SEM REG STATUS: <?php if (empty($results['FallRegHours'])) echo "Not Registered"; else echo $results['FallRegHours'] . " Hours Registered";?></b></td>
		  </tr>
		  <tr>
		    <td><b>ACADEMIC ADVISOR:</b> <?php echo $results['PER_AdvisorFullname'];?></br></td>
			<td><b>SPRING SEM REG STATUS: <?php if (empty($results['SpringRegHours'])) echo "Not Registered"; else echo $results['SpringRegHours'] . " Hours Registered";?></b></br></td>
		  </tr>
		</tbody>
	  </table>
    </div>

	<!-- use col -->
	<div class="profilebuttons">
      <form id ="delete" method ="post" action ="DeleteStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Delete Student From Database </button>
      </form>


      <form id ="edit" method ="post" action ="EditStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Edit Student Information </button>
      </form>


      <form id ="print">
        <button type='submit' class="button" name = 'id' onclick="printData()"> Print </button>
      </form>


      <form id ="tags" method ="post" action ="AddTags.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Add Tags </button>
      </form>
    </div>

    </br>
	<div class="outline">
	  <table id="profile">
        <thead>
          <tr>
		    <th class="records">Student Records</th>
			<th class="tags">Tags</th>
	      </tr>
		</thead>
		<tbody>
		<?php populateTable($appointments, $results, $tags);?>
		</tbody>
	  </table>
	</div>

  </body>
</html>
