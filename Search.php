<?php
	include ("Session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="Search.css" />
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>

<?php
include(merrimack/debug.php);

function makeButton($result)
{
$button = "<tr><td>{$result['FirstName']}</td><td>{$result['LastName']}</td><td>{$result['ID']}</td><td>{$result['ClassYear']}</td>";

echo $button . "<td><button type='submit' name = 'id' value = {$result['ID']}>Click</button></td></tr>"; 
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

// For generating searching error
$searchErr = "";

$query = "Select ID, FirstName, LastName, ClassYear, PER_PlannedGradSemester, PER_Major1Text, PER_Major2Text, PER_AdvisorFullname, CTRforSemester, AllSetRegfor12Cr, SemesterStuAcadRegHrs from MasterList";

// Ideally search by id
if (!empty($_POST["idnumber"]))
{
$stmt = $db->prepare($query . " where id = :id");
$stmt->execute(array(':id' => $_POST["idnumber"]));
}
else if (!empty($_POST["firstname"]))
{
// Split up first and last name
$firstLast = explode(" ", $_POST["firstname"]);

// Different operations to handle one or two names input
if (count($firstLast) == 1)
{
$stmt = $db->prepare($query . " where FirstName LIKE :name or LastName LIKE :name order by LastName asc");
$stmt->execute(array(':name' => $firstLast[0] . "%"));
}
else if (count($firstLast) == 2)
{
$stmt = $db->prepare($query . " where FirstName LIKE :fname and LastName LIKE :lname order by LastName asc");
$stmt->execute(array(':fname' => $firstLast[0] . "%", ':lname' => $firstLast[1] . "%"));
}
}
else if (!empty($_POST['tag']))
{
$stmt = $db->prepare($query . " Natural join Tags where Tag like :tag order by LastName asc");
$stmt->execute(array(':tag' => $_POST['tag']));
}
if (empty($_POST["firstname"]) && empty($_POST["idnumber"]) && empty($_POST["tag"]))
$searchErr = "Please enter either name or ID!";
else
$result = $stmt->fetchall();

}

?>

  <header>
    <div class = "nav">
      <ul>
	    <li> <a href="Home.php">Home</a> </li>
		<li> <a href="Add.php">Add Student</a> </li>
		<li> <a class="active" href="Search.php">Search Student</a> </li>
		<li> <a href="CheckIn.php">Check-In</a> </li>
		<li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		<li> <a href="Help.php">Help</a> </li>
		<li class="floatme">  <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		<li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
	  </ul>
	</div>
	<h1>Search By</h1>
  </header>
  
  <div id="form">
    <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="fname"><span class="title">Student's Name</span></label>
      <input type="text" id="fname" name="firstname" placeholder="Name.."> </input>

	  
	  <span class="or">or</span>
	  
	  <label for="idnum"><span class="title">ID Number</span></label>
	  <input type="text" id="idnum" name="idnumber" placeholder="ID number.."></input>
	  <span class="or">or</span>
      <label for="fname"><span class="title">Tag</span></label>
      <input type="text" id="tag" name="tag" placeholder="Tag.."></input>
	  </br>
      <input type="submit" value="Submit"></input>
    
	</form>
  </div>
  
  <span class ="error"><?php echo $searchErr;?></span>
  
  <div class="tabless">
  <form id ="results" method ="post" action ="ProfilePage.php">
    <table id="appointments">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>ID</th>
          <th>Year</th>
          <th>Profile</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach($result as $row) { makeButton($row); } ?>
      </tbody>
    </table>
  </form>
  </div>

</body>

</html>
