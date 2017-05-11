<?php include ("Session.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRMS</title>
  <meta charset="utf-8" />
  <link rel = "stylesheet" href="style.css" />
</head>

<body>
  <header>
    <div class = "nav">
      <ul>
	    <li> <a href="Home.php">Home</a> </li>
		<li> <a href="Add.php">Add Student</a> </li>
		<li> <a href="Search.php">Search Student</a> </li>
		<li> <a href="CheckIn.php">Check-In</a> </li>
		<li> <a href="ManageAccounts.php">Manage Accounts</a> </li>
		<li> <a class="active" href="Help.php">Help</a> </li>
		<li class="floatme"> <form method="post"><button class="navbutton" type ="submit" formaction = "LogOut.php">Log Out</button></form></li>
		<li class="floatme"><form method="post"><button class="navbutton2" type ="submit" formaction = "ChangePass.php">Change Password</button></form></li>
	  </ul>
	</div>
	<h1>Help</h1>
  </header>
  
  <div class="help">
    <h3>Adding a Student (Add Student Tab)</h3>
	The Add Student tab allows you to fill in a form for a new student you want to add to the database.
	</br>
	Fill in the required fields:  ID, Last Name, and First Name, and Class Year.
	</br>
	All other fields can be filled in at the same time or by editing the students information from their Profile Page which can be reached by searching.
	</br>
	</br>
    It is also possible to add multiple students via Excel file at the bottom of the Add Student page. 
	</br>In order to do this, the Excel file must contain student data in the same order as seen on 
	the add student page. This means the first column in the file must be only student IDs, the
	second column being student last names, the third being student first names, and so on. 
	</br>There should be no column names in the file so make sure to delete the first row if there are 
	pre-existing column names.
	</br>There also cannot exist any commas in any of the entries of the Excel file.
	</br>Once the file is in this format, save the file as a .csv file with any name and use the upload button at the bottom of the Add Student Page to add the .csv file to the database.
	</br></br>
	On the Add Student tab there are also buttons to perform yearly, la
rge scale operations on the database. To enable these buttons, you must che
ck the checkbox before clicking the button you wish to use.
        </br>
        The Zero Hours Button sets the Fall, Winter, and Spring hours for a
ll students in the database to 0.
        </br>
        The Move Up Button transitions class years of all students, meaning
 freshmen will become sophomores, sophomores to juniors, and juniors to sen
iors. WARNING! This will delete all seniors permanently from the database.
        </br>
        The Delete All Students Button clears all students from the databas
e. Be careful, as this is irreversible.
	</br>
	<h3>Search Tab </h3>
    The Search Student tab allows users to search for a student.
	</br>
	Type in the student's name or ID or Tag(such as athlete) and click the submit button.
	</br>
    Scroll down to the table to see all the results that match your search.
	</br>
	Click on the "Click" button under the Profile column to view the students profile.
	</br>
	<h3>How to Reset all Students' Hours</h3>
	Click the "Zero Hours" button at the bottom of the Add Student Page.
	</br>
	<h3>How to Change all Students' Class Years</h3>
	Click the "Move Up" button at the bottom of the Add Student Page.
	</br>  Please note this will remove all current seniors from the database.
	</br>
	<h3>How to Delete a Student from the database</h3>
	Search Student in the Search Tab.  Click to go to their profile.
	</br> Click Delete Student from Database
	</br>
	<h3>How to Edit a Student in the Database</h3>
	First you must be able to find the student by searching.
	</br>  If you originally added the student to the database, make sure you search with the incorrect information you entered. (such as if you meant to enter james but you entered "hames" so search "hames")
	</br>  Once you get to the Student's Profile Page, click the "Edit Student Information" button and fill in the fields you wish to change and click submit.
	</br>
	<h3>How to add Tags to a Student</h3>
	Go to the Student Profile and click "Add Tags" button
	</br>To enter multiple tags at once, separate each tag by a comma (such as Athlete, Class Clown)
	</br>
	<h3>How to Delete a Tag</h3>
	Click the Add Tag button in the Student Profile and then click on the "X" checkbox next to the desired tag to delete.
	</br>
	<h3>How to Print a Student's Records from the database</h3>
	Option 1)  Go to the Student's Profile and click the print button.
	</br> Option 2)  Right click and click print.
	</br> Option 3)  Click Ctrl P (windows users) or control P (apple users).
	</br> The second and third option may not print in the desired format.
	</br>
	<h3>Check-In Tab</h3>
	The Check-In tab will allow you to view up-coming appointments.
	</br>You can delete appointments which have been cancelled.
	</br>You can create new appointments.
	</br>You can also edit appointments to change the time or add a note.
	</br>
	<h3>How to Check in a Student</h3>
	Go to the Appointments tab "Check-In".
	</br>Only one student can be checked in at a time.
	</br>Click the circle button and then click the check-in button.
	</br>
	<h3>How to Add an Appointment with a Student</h3>
	Click on the "Add" button after going to the Check-In tab.
	<br>Enter the Students Name or ID Number followed by the Advisor Name, Date, and Reason for Appointment.
	</br>Then click Add to add the appointment.
	</br>
	<h3>How to Add a Note to an Appointment</h3>
	Select the desired appointment (small circle button next to name) in the Check-In page and then click the "Add Note" button.
	</br>
	Please note this removes the appointment from the database but a record of the meeting is kept in the Student's Profile.
	</br>
	<h3>How to Edit an Appointment</h3>
	Select the desired appointment (small circle button next to name) in the Check-In page and then click the "Edit Appointment button.
	</br>Fill in any of the desired fields you wish to change.
	</br>
	<h3>How to Remove an Appointment</h3>
	Select the desired appointment (small circle button next to name) in the Check-In page and then click the "Cancel" button.
	</br>Please note this removes the appointment from the database but a record of the meeting is kept in the Student's Profile.
	</br>
	<h3>Manage Accounts Tab</h3>
	The Manage Accounts Tab allows admins to either add or delete users that would like to use the Customer Relationship System (CRMS).
	</br>To add a user, look at the table of potential users. If there is a potential user that is recognized, you can add them by typing in their e-mail address and clicking Add User button.
	</br>To delete a potential user or an individual that is unrecognizable, type in their e-mail address and click delete.
	<br>
	<h3>How to Change Your Password</h3>
	Once you are logged in, click the yellow button that says change password in the top-right corner. Once clicked, type in your e-mail address and your desired new password and click submit.
	</br>Be advised, to ensure the security and safety of your account, it is recommended that you change your password around the same time when Merrimack College asks its users to change their passwords
	<br>for their e-mails.
	<br>
	<h3>How to Help a New User Sign Up to use the CRMS</h3>
	To Sign Up, have them go to the login screen, click the Login button, and click on "Not a member? Sign Up" at the bottom right par of the pop up login prompt.
	<br>Once clicked, the new potential user will be brought to the Sign Up page where he or she will type in their full name, e-mail address, username (what they would like to be called), and password. 
	<br>Once the new potential user clicks Submit, an admin that already has access to the website can add that user by going to the Manage Accounts tab.
	<br>
	<h3>How to Add a new User to the CRMS</h3>
	To add a user, go to the Manage Accounts tab, type in the user's e-mail that is shown in the table, and click on the Add User button.
	<br>
	<h3>How to Prevent a User from joining the CRMS</h3>
	To delete a user, go to the Manage Accounts tab, type in the user's e-mail you wish to delete from the waiting list, and click on the Delete User button.
	<br>
	<h3>Forgot Password? How to Retrieve it</h3>
	Go to the login screen and click on the Login button. At the bottom right, click on "Forgot Password?", and you will be brought to the Forgot Password page. Type in your e-mail and follow the instructions sent to you in the e-mail to proceed.
  </div>
  
</body>

</html>
