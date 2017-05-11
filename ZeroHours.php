<?php
try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$smt = $db->prepare("Update MasterList set SpringRegHours = 0, WinterRegHours = 0, FallRegHours = 0");
$smt->execute();
echo "All Students' Hours Set To 0!";
?>
