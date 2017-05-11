<?php

function populateTable($oldTags)
{
foreach($oldTags as $tag)
echo "<tr><td>{$tag['Tag']}</td><td><button type ='submit' name='delete' value ='{$tag['Tag']}'>X</button></tr>";
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
$_smt = $db->prepare("Select Tag from Tags where ID = :id");
$_smt->execute(array(':id'=>$_POST['id']));
$oldTags = $_smt->fetchall();
if ($_POST['submit'] =="Add Tags" && !($_POST['tags'] === "" ))
{
$smt = $db->prepare("Insert into Tags values(?, ?)");
$tags = explode(", ", $_POST['tags']);
foreach ($tags as $tag)
$smt->execute(array($_POST['id'], $tag));
$_smt = $db->prepare("Select Tag from Tags where ID = :id");
$_smt->execute(array(':id'=>$_POST['id']));
$oldTags = $_smt->fetchall();
}
if (isset($_POST['delete']))
{
$smt2 = $db->prepare("Delete from Tags where Tag = :tag and ID = :id");
$smt2->execute(array(':tag'=> $_POST['delete'], ':id'=> $_POST['id']));
$_smt = $db->prepare("Select Tag from Tags where ID = :id");
$_smt->execute(array(':id'=>$_POST['id']));
$oldTags = $_smt->fetchall();
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CRMS</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style2.css">

        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.c
om/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.
0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j
s/bootstrap.min.js"></script>
        -->
  </head>

  <body>
    <header>
<div class = "nav">
        <ul>
              <li> <a href="Index.html">Home</a> </li>
                  <li> <a href="AddStudent.html">Add Student</a> </li>
                  <li> <a href="Search.php">Search Student</a> </l
i>
                  <li> <a href="CheckIn.php">Check-In</a> </li>
                  <li> <a href="Help.html">Help</a> </li>
            </ul>
          </div>
        </header>
<form method = "post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onkeypress ="return event.keyCode !=13;">
<div class="outline">
          <table id="profile">
        <thead>
          <tr>
                        <th class="tags">Tags</th>
              </tr>
                </thead>
                <tbody>
                <?php populateTable($oldTags);?>
                </tbody>
          </table>
        </div>
<input type ="hidden" name ="id" value=<?php echo $_POST['id'];?>>
<input type ="text" name ="tags" placeholder ="tag1, tag2, tag3, ...">
<input type ="submit" name="submit" value ="Add Tags">
</form>
<br><br><br>
<form method ="post" action ="ProfilePage.php">
<button type ="submit" name ="id" value =<?php echo $_POST['id'];?>>Back To Student Profile</button>
</form>
</body>
</html>
