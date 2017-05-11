<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style2.css">

        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootst
rap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.
min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstr
ap.min.js"></script>
        -->
  </head>
  <body>
<header>
    <div class = "nav">
      <ul>
            <li> <a href="Index.html">Home</a> </li>
                <li> <a href="AddStudent.html">Add Student</a> </l
i>
                <li> <a href="Search.php">Search Student</a> </li>
                <li> <a href="CheckIn.html">Check-In</a> </li>
                <li> <a href="Help.html">Help</a> </li>
          </ul>
        </div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$target = "db/List.csv";
if (!move_uploaded_file($_FILES['csv']['tmp_name'], $target))
echo "Error uploading file";

exec('sqlite3 db/CRMS.db < Upload.sql');

if (unlink("db/List.csv"))
echo "Done.";
}

?>

</body>
</html>
