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

$smt = $db->prepare("Select * from MasterList where ID = :id");

$smt->execute(array(':id' => $_POST['id']));

$results = $smt->fetch();

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
<header>
  <div class = "nav">
<ul>
      <li> <a href="Index.html">Home</a> </li>
	  <li> <a class="active" href="AddStudent.html">Add Student</a> </li>
	  <li> <a href="Search.php">Search Student</a> </li>
	  <li> <a href="CheckIn.html">Check-In</a> </li>
	  <li> <a href="Help.html">Help</a> </li>
    </ul>
  </div>
</header>

<form action ="AddStudent.php" method="POST" onkeypress ="return event.keyCode !=13;">
      <p>
          <div class="col">
        ID: <input type ="text" name ="id" placeholder="id.." value=<?php echo $results['ID'];?>><br>
        Last Name: <input type ="text" name ="lastName" placeholder="last name.." value ="<?php echo $results['LastName'];?>"><br>
        First Name: <input type ="text" name ="firstName" placeholder="first name.." value ="<?php echo $results['FirstName'];?>"><br>
        Class Year: <input type ="text" name ="year" placeholder="FR/SO/JR/SR.." value =<?php echo $results['ClassYear'];?>><br>
        PER Planned Grad Semester: <input type ="text" name ="grad" placeholder="semester.." value =<?php echo $results['PER_PlannedGradSemester'];?>><br>
        School: <input type="text" name ="school" placeholder="school.." value =<?php echo $results['School'];?>><br>
        PER Major 1 Text: <input type ="text" name ="major1" placeholder="major.." value =<?php echo $results['PER_Major1Text'];?>><br>
        PER Major 2 Text: <input type ="text" name ="major2" placeholder="major.."  value =<?php echo $results['PER_Major2Text'];?>><br>
        Concentration: <input type ="text" name ="concentration" placeholder="concentration.."  value =<?php echo $results['Concentration'];?>><br>
        CTR for Semester: <input type ="text" name ="ctr" placeholder="Y/N.."  value =<?php echo $results['CTRforSemester'];?>><br>
        All Set Reg for 12 Cr: <input type ="text" name ="allSet" placeholder="Y/N.."  value =<?php echo $results['AllSetRegfor12Cr'];?>><br>
        Semester Acad Reg Hours: <input type ="text" name ="regHours" placeholder="hours.."  value =<?php echo $results['SemesterStuAcadRegHrs'];?>><br>
        Bursar FinAid Involvement: <input type ="text" name ="finAid" placeholder="Y/N/M.."  value =<?php echo $results['BursarFinAidInvolvement'];?>><br>
        Holds: <input type ="text" name ="holds" placeholder="Y/N.."  value =<?php echo $results['Holds'];?>><br>
        Returning: <input type ="text" name="returning" placeholder="Y/N/M.."  value =<?php echo $results['Returning'];?>><br>
        School Contact Person: <input type ="text" name ="contact" placeholder="name.."  value ="<?php echo $results['SchoolContactPerson'];?>"><br>
        School Contact Made: <input type ="text" name ="contactMade" placeholder="Y/N.."  value =<?php echo $results['SchoolContactMade'];?>><br>
        Other RIT Contact Made: <input type ="text" name ="ritContact" placeholder="Y/N.."  value =<?php echo $results['OtherRITContactMade'];?>><br>
        Notes: <input type ="text" name = "notes" placeholder="notes.."  value ="<?php echo $results['Notes'];?>"><br>
        CARE Indicate Want to Transfer WD: <input type ="text" name ="transfer" placeholder="Y/N.."  value =<?php echo $results['CARE_IndicateWantToTransferWD'];?>><br>
        Withdrawn WD Date: <input type ="text" name ="withdrawn" placeholder="date/N.."  value =<?php echo $results['WithdrawnWD_Date'];?>><br>
        Fall Registered Hours: <input type ="text" name ="fallHours" placeholder="hours.."  value =<?php echo $results['FallRegHours'];?>><br>
        Winter Registered Hours: <input type ="text" name ="winterHours" placeholder="hours.."  value =<?php echo $results['WinterRegHours'];?>><br>
        Cummulative Credit Hours: <input type ="text" name ="creditHours" placeholder="hours.."  value =<?php echo $results['CummulativeCreditHours'];?>><br>
        Int'1: <input type ="text" name ="int1" placeholder="Y/N.."  value =<?php echo $results['Int_l'];?>><br>
        Athlete: <input type ="text" name ="athlete" placeholder="Y/N.."  value =<?php echo $results['Athlete'];?>><br>
        Honors: <input type ="text" name ="honors" placeholder="Y/N.."  value =<?php echo $results['HONORS'];?>><br>
        Promise: <input type ="text" name ="promise" placeholder="Y/N.."  value =<?php echo $results['PROMISE'];?>><br>
        Compass: <input type ="text" name ="compass" placeholder="Y/N.."  value =<?php echo $results['COMPASS'];?>><br>
        AR300: <input type ="text" name ="ar300" placeholder="Y/N.."  value =<?php echo $results['AR300'];?>><br>
        Financial Hold: <input type ="text" name ="financialHold" placeholder="Y/N.."  value =<?php echo $results['FinancialHold'];?>><br>
        Payment Plan Hold: <input type ="text" name ="paymentHold" placeholder="Y/N.."  value =<?php echo $results['PaymentPlanHold'];?>><br>
        Health Service Hold: <input type ="text" name ="healthHold" placeholder="Y/N.."  value =<?php echo $results['HealthServiceHold'];?>><br>
        PER Advisor Full Name: <input type ="text" name ="advisor" placeholder="name.."  value ="<?php echo $results['PER_AdvisorFullname'];?>"><br>
        Advisor Email: <input type ="text" name ="advisorEmail" placeholder="email.." value =<?php echo $results['AdvisorEmail'];?>><br>
        Student Email: <input type ="text" name ="studentEmail" placeholder="email.." value =<?php echo $results['StudentEmail'];?>><br>
        Permanent Address Phone: <input type ="text" name ="homePhone" placeholder="number.." value =<?php echo $results['PermanentAddressPhone'];?>><br>
        Cell Phone Number: <input type ="text" name ="cellPhone" placeholder="number.." value =<?php echo $results['CellPhoneNumber'];?>><br>
        Housing: <input type ="text" name ="housing" placeholder="Y/N.." value =<?php echo $results['Housing'];?>><br>
        Dorm: <input type ="text" name ="dorm" placeholder="dorm name.." value =<?php echo $results['Dorm'];?>><br>
        Room Number: <input type ="text" name ="roomNumber" placeholder="room number.." value =<?php echo $results['RoomNumber'];?>><br>
        LLC: <input type ="text" name ="llc" placeholder="Y/N.." value =<?php echo $results['LLC'];?>><br>
	Spring Registered Hours: <input type ="text" name ="spring" placeholder="hours.." value =<?php echo $results['SpringRegHours'];?>><br>
        Academic Standing: <input type ="text" name ="standing" placeholder="standing" value ="<?php echo $results['AcademicStanding'];?>"><br>
        Admin Mentor: <input type ="text" name ="admin" placeholder="admin name..." value ="<?php echo $results['Admin'];?>"><br>
	<input type ="hidden" name ="realID" value = <?php echo 
$_POST['id'];?>>
<button type='submit' name = 'id' value = <?php echo $result['ID'];?>> </button>
        <input type ="submit" name ="submit" value ="Edit">
          </div>
      </p>
</body>
</html>

