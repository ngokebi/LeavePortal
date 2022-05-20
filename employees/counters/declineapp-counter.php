<?php

$eid = $_SESSION['eid'];
$sql = "SELECT id, EmpID FROM leaves WHERE Status = '3' AND EmpID = '$eid'";
$query = $database->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$leavtypcount = $query->rowCount();

echo htmlentities($leavtypcount);
