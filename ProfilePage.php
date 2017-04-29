<!DOCTYPE html>
<html>
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel = "stylesheet" href="style.css" />
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

$smt = $db->prepare("Select ID, FirstName, LastName, ClassYear, PER_PlannedGradSemester, PER_Major1Text, PER_Major2Text, PER_AdvisorFullname, CTRforSemester, AllSetRegfor12Cr, SemesterStuAcadRegHrs from MasterList where ID = :id");

$smt->execute(array(':id' => $_POST['id']));

$results = $smt->fetch();

}

?>

    <header>
	  <div class = "nav">
        <ul>
	      <li> <a href="Index.html">Home</a> </li>
		  <li> <a href="Student.html">Add Student</a> </li>
		  <li> <a href="Search.html">Search Student</a> </li>
		  <li> <a href="CheckIn.html">Check-In</a> </li>
		  <li> <a href="Help.html">Help</a> </li>
	    </ul>
	  </div>
    </header>

    <div class="col">
      <b>NAME:</b> <?php echo $results['FirstName'] . " " . $results['LastName'];?></br>
      <b>CLASS:</b> <?php echo $results['ClassYear'];?></br>
      <b>PROJECT GRAD YR:</b> <?php echo $results['PER_PlannedGradSemester'];?></br>
      <b>MAJOR:</b> <?php echo $results['PER_Major1Text'] . "   " . $results['PER_Major2Text'];?></br>
      <b>ACADEMIC ADVISOR:</b> <?php echo $results['PER_AdvisorFullname'];?></br>
	  </br>
	  <b>ACADEMIC STANDING:</b></br>
	  <b>ADMIN MENTOR:</b></br>
	  <b>SPECIAL PROGRAMS:</b></br>
	  <b>CURRENT REG STATUS:</b></br>
	  <b>NEXT SEM REG STATUS:</b>
    </div>

	<!-- use col -->
	<div class="col2">
	<div class="buttons">
      <form id ="delete" method ="post" action ="DeleteStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Delete Student From Database </button>
      </form>


      <form id ="edit" method ="post" action ="EditStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Edit Student Information </button>
      </form>


      <form id ="print" method ="post" action ="EditStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Print </button>
      </form>


      <form id ="save" method ="post" action ="EditStudent.php">
        <button type='submit' class="button" name = 'id' value = <?php echo $_POST['id'];?>> Save Changes </button>
      </form>
    </div>
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
		    <tr>
			  <td class="records">No Appointments</td>
			  <td class="tags">President of Chest Club</td>
			</tr>
			<tr>
			  <td class="records"></br></td>
			  <td class="tags"></td>
			</tr>
			<tr>
			  <td class="records"></br></td>
			  <td class="tags"></td>
			</tr>
			<tr>
			  <td class="records"></br></td>
			  <td class="tags"></td>
			</tr>
		  </tbody>
		</table>
	</div>

  </body>
</html>
