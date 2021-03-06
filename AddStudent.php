<!DOCTYPE html>
<html>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

if ($_POST['submit'] === 'Edit')
{
$smt = $db->prepare("Delete from MasterList where ID = :id");

if ($smt->execute(array(':id' => $_POST['realID'])))
echo "Old Student Entry Deleted<br>";

}

$query = "insert into MasterList(ID, LastName, FirstName, ClassYear, PER_PlannedGradSemester, School, PER_Major1Text, PER_Major2Text, Concentration, CTRforSemester, AllSetRegfor12Cr, SemesterStuAcadRegHrs, BursarFinAidInvolvement, Holds, Returning, SchoolContactPerson, SchoolContactMade, OtherRITContactMade, Notes, CARE_IndicateWantToTransferWD, WithdrawnWD_Date, FallRegHours, WinterRegHours, CummulativeCreditHours, Int_l, Athlete, HONORS, PROMISE, COMPASS, AR300, FinancialHold, PaymentPlanHold, HealthServiceHold, PER_AdvisorFullname, AdvisorEmail, StudentEmail, PermanentAddressPhone, CellPhoneNumber, Housing, Dorm, RoomNumber, LLC, SpringRegHours, AcademicStanding, Admin) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$idNum = 123456;

$smt = $db->prepare($query);

if ($smt->execute(array($_POST["id"], $_POST["lastName"], $_POST["firstName"], $_POST["year"], $_POST["grad"], $_POST["school"], $_POST["major1"], $_POST["major2"], $_POST["concentration"], $_POST["ctr"], $_POST["allSet"], $_POST["regHours"], $_POST["finAid"], $_POST["holds"], $_POST["returning"], $_POST["contact"], $_POST["contactMade"], $_POST["ritContact"], $_POST["notes"], $_POST["transfer"], $_POST["withdrawn"], $_POST["fallHours"], $_POST["winterHours"], $_POST["creditHours"], $_POST["int1"], $_POST["athlete"], $_POST["honors"], $_POST["promise"], $_POST["compass"], $_POST["ar300"], $_POST["financialHold"], $_POST["paymentHold"], $_POST["healthHold"], $_POST["advisor"], $_POST["advisorEmail"], $_POST["studentEmail"], $_POST["homePhone"], $_POST["cellPhone"], $_POST["housing"], $_POST["dorm"], $_POST["roomNumber"], $_POST["llc"], $_POST["spring"], $_POST["standing"], $_POST["admin"])))
echo "New Student Entry Added Successfully";
else
print_r($smt->errorInfo());
}

$db = null;

?>

<form id ="redirect" method ="post" action ="ProfilePage.php">
<input type="hidden" name="id" value=<?php echo $_POST['id'];?>>
<input type="submit" name = "return" value = "To Student Profile">
</form>

</body>
</html>
