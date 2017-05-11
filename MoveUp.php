<?php

try
{
$db = new PDO('sqlite:db/CRMS.db');
}
catch (PDOException $e)
{
print($e->getMessage());
}
$_smt = $db->prepare("Delete from MasterList where ClassYear LIKE 'SR'");
$_smt->execute();


$smt = $db->prepare("Update MasterList set ClassYear = :newyear where ClassYear LIKE :oldyear");
$smt->execute(array(':newyear' => 'SR', ':oldyear' => "JR%"));
$smt->execute(array(':newyear' => 'JR', ':oldyear' => 'SO%'));
$smt->execute(array(':newyear' => 'SO', ':oldyear' => 'FR%'));
echo "All Students Moved Up One Year! Seniors Were Deleted!";
?>
