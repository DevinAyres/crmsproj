<?php
try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}

$smt = $db->prepare("Delete from MasterList");
$smt->execute();
$smt = $db->prepare("Delete from Appointments");
$smt->execute();
echo "All Students' Deleted From Database!";
?>
