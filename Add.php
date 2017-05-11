<?php
include ("Session.php");
if ($_POST['box'] === '1')
if ($_POST['protocol'] === 'Zero Hours')
include('ZeroHours.php');
else if ($_POST['protocol'] === 'Move Up')
include('MoveUp.php');
else if ($_POST['protocol'] === 'Delete All')
include('DeleteAll.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style2.css">
  </head>
  
  <body>
    <header>
	  <div class = "nav">
        <ul>
	      <li> <a href="Home.php">Home</a> </li>
		  <li> <a class="active" href="Add.php">Add Student</a> </li>
		  <li> <a href="Search.php">Search Student</a> </li>
		  <li> <a href="CheckIn.php">Check-In</a> </li>
		  <li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		  <li> <a href="Help.php">Help</a> </li>
		  <li class="floatme"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		  <li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
	    </ul>
	  </div>
	</header>
        
    <form onkeypress ="return event.keyCode != 13;" action ="AddStudent.php" method="POST">
      <p>
	  <div class="col">
        ID: <input type ="text" name ="id" placeholder="id.."><br>
        Last Name: <input type ="text" name ="lastName" placeholder="last name.."><br>
        First Name: <input type ="text" name ="firstName" placeholder="first name.."><br>
        Class Year: <input type ="text" name ="year" placeholder="FR/SO/JR/SR.."><br>
        Planned Grad Semester: <input type ="text" name ="grad" placeholder="semester.."><br>
        School: <input type="text" name ="school" placeholder="school.."><br>
        PER Major 1 Text: <input type ="text" name ="major1" placeholder="major.."><br>
        PER Major 2 Text: <input type ="text" name ="major2" placeholder="major.."><br>
        Concentration: <input type ="text" name ="concentration" placeholder="concentration.."><br>
        CTR for Semester: <input type ="text" name ="ctr" placeholder="Y/N.."><br>
        All Set Reg for 12 Cr: <input type ="text" name ="allSet" placeholder="Y/N.."><br>
        Semester Acad Reg Hours: <input type ="text" name ="regHours" placeholder="hours.."><br>
        Bursar FinAid Involv: <input type ="text" name ="finAid" placeholder="Y/N/M.."><br>
        Holds: <input type ="text" name ="holds" placeholder="Y/N.."><br>
        Returning: <input type ="text" name="returning" placeholder="Y/N/M.."><br>
        School Contact Person: <input type ="text" name ="contact" placeholder="name.."><br>            
        School Contact Made: <input type ="text" name ="contactMade" placeholder="Y/N.."><br>
        Other RIT Contact Made: <input type ="text" name ="ritContact" placeholder="Y/N.."><br>
        Notes: <input type ="text" name = "notes" placeholder="notes.."><br>
        Indicate Want to Transfer: <input type ="text" name ="transfer" placeholder="Y/N.."><br>
        Withdrawn WD Date: <input type ="text" name ="withdrawn" placeholder="date/N.."><br>                                          
        Fall Registered Hours: <input type ="text" name ="fallHours" placeholder="hours.."><br>
        Winter Registered Hours: <input type ="text" name ="winterHours" placeholder="hours.."><br>
        Total Credit Hours: <input type ="text" name ="creditHours" placeholder="hours.."><br>
        Int'1: <input type ="text" name ="int1" placeholder="Y/N.."><br>
        Athlete: <input type ="text" name ="athlete" placeholder="Y/N.."><br>
        Honors: <input type ="text" name ="honors" placeholder="Y/N.."><br>
        Promise: <input type ="text" name ="promise" placeholder="Y/N.."><br>
        Compass: <input type ="text" name ="compass" placeholder="Y/N.."><br>
        AR300: <input type ="text" name ="ar300" placeholder="Y/N.."><br>
        Financial Hold: <input type ="text" name ="financialHold" placeholder="Y/N.."><br>
        Payment Plan Hold: <input type ="text" name ="paymentHold" placeholder="Y/N.."><br>
        Health Service Hold: <input type ="text" name ="healthHold" placeholder="Y/N.."><br>
        PER Advisor Full Name: <input type ="text" name ="advisor" placeholder="name.."><br>
        Advisor Email: <input type ="text" name ="advisorEmail" placeholder="email.."><br>
        Student Email: <input type ="text" name ="studentEmail" placeholder="email.."><br>
        Perm Address Phone: <input type ="text" name ="homePhone" placeholder="number.."><br>
        Cell Phone Number: <input type ="text" name ="cellPhone" placeholder="number.."><br>
        Housing: <input type ="text" name ="housing" placeholder="Y/N.."><br>
        Dorm: <input type ="text" name ="dorm" placeholder="dorm name.."><br>
        Room Number: <input type ="text" name ="roomNumber" placeholder="room number.."><br>
        LLC: <input type ="text" name ="llc" placeholder="Y/N.."><br>
        Spring Registered Hours: <input type ="text" name ="spring" placeholder="hours.."><br>
        Academic Standing: <input type ="text" name ="standing" placeholder="standing"><br>
	Admin Mentor: <input type ="text" name ="admin" placeholder="admin name..." value ="<?php echo $results['Admin'];?>"><br>
        <input type ="submit" name="submitfile" value ="Add Student">
	  </div>
      </p>
    </form>
<br><br><br>
<form action ="Upload.php" method ="post" enctype ="multipart/form-data" onkeypress ="return event.keyCode != 13;">
Upload Master List Here: <input type ="file" name ="csv" id ="csv"accept =".csv">        
<input type ="submit" value="Upload" name ="submit">
</form>
<form method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_
SELF"]);?>">
<br><br><br>
Check This Box To Enable Irreversible Operations On Database: <input type="checkbox" value="1" name="box">
<br> 
Zero All Students' Hours Here: <input type ="submit" value="Zero Hours" name="protocol">
<br>
Move Up All Students' Class Years (WARNING!!! ALL SENIORS WILL BE DELETED!): <input type ="submit" value="Move Up" name="protocol">
<br><br><br>
Delete All Students(ALL STUDENTS WILL BE DELETED!): <input type ="submit" value="Delete All" name="protocol">
</form>
</body>
</html>
