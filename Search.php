<!DOCTYPE html>
<html lang="en">
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
include(merrimack/debug.php);

function makeButton($result)
{
$button = $result['FirstName'] . " " . $result['LastName'] . " | " . $result['ID'] . " | " . $result['ClassYear'] . "<br>";

echo "<button type='submit' name = 'id' value = {$result['ID']}> {$button} </button>"; 
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

$result = $stmt->fetchall();
}
else if (!empty($_POST["firstname"]))
{
// Split up first and last name
$firstLast = explode(" ", $_POST["firstname"]);

// Different operations to handle one or two names input
if (count($firstLast) == 1)
{
$stmt = $db->prepare($query . " where FirstName LIKE :name or LastName LIKE :name");
$stmt->execute(array(':name' => $firstLast[0] . "%"));
}
else if (count($firstLast) == 2)
{
$stmt = $db->prepare($query . " where FirstName LIKE :fname and LastName LIKE :lname");
$stmt->execute(array(':fname' => $firstLast[0] . "%", ':lname' => $firstLast[1] . "%"));
}

// Fetch all results
$result = $stmt->fetchall();
}
 
if (empty($_POST["firstname"]) && empty($_POST["idnumber"]))
$searchErr = "Please enter either name or ID!";

}

?>

  <header>
    <div class = "nav">
      <ul>
	    <li> <a href="Index.html">Home</a> </li>
		<li> <a href="AddStudent.html">Add Student</a> </li>
		<li> <a class="active" href="Search.php">Search Student</a> </li>
		<li> <a href="CheckIn.html">Check-In</a> </li>
		<li> <a href="Help.html">Help</a> </li>
	  </ul>
	</div>
	<h1>Search By</h1>
  </header>
  
  <div id="form">
    <form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="fname"><h2>Student's Name</h2>
	  First, Last, or partial name accepted
	  </label>
      <input type="text" id="fname" name="firstname" placeholder="Name..">

	  </br>
	  <h3>and/or</h3>
	  
	  <label for="idnum"><h2>ID Number</h2>Please provide the whole number</label>
	  <input type="text" id="idnum" name="idnumber" placeholder="ID number..">
  
      <input type="submit" value="Submit">
    
	</form>
  </div>

<span class ="error"><?php echo $searchErr;?></span><br><br>    
<form id ="results" method ="post" action ="ProfilePage.php">


<?php  foreach($result as $row) { makeButton($row); } ?>


</form>

</body>

</html>
