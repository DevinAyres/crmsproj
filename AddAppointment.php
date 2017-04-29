<?php
include(merrimack/debug.php);

function makeButton($result)
{
$button = $result['FirstName'] . " " . $result['LastName'] . " | " . $result['ID'] . " | " . $result['ClassYear'] . "<br>";

echo "<input type='radio' name = 'id' value = {$result['ID']}> {$button}";
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

$query = "Select ID, FirstName, LastName, ClassYear from MasterList";

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

if (!empty($_POST['id']))
$idNum = $_POST['id'];  

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


 <form action ="AddAppointmentDB.php" method="POST">
      <p>
        <?php  foreach($result as $row) { makeButton($row); } ?>
        Advisor Name: <input type ="text" name ="advisor"><br>
        Date: <input type ="text" name ="date"><br>
	Reason: <input type ="text" name ="reason"> <br> 
	<input type ='submit' name = 'protocol' value = 'add'>
	</p>
</form>
</body>
</html>
 
