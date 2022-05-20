<?php
    $employeeid=$_SESSION['eid'];
    $sql = "SELECT FirstName,LastName,EmployeeId, Email from  employees where id = :eid";
    $query = $database->prepare($sql);
    $query->bindParam(':eid', $employeeid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0){ 
        foreach($results as $result)
    {    ?>
        <p style="color:white;"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
        <span><?php echo htmlentities($result->Email)?></span>
<?php }
    } 
?>