<?php
    $employeeid=$_SESSION['alogin'];
    $sql = "SELECT Fullname,UserName, Email from  admin where id = :alogin";
    $query = $database->prepare($sql);
    $query->bindParam(':alogin', $employeeid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0){ 
        foreach($results as $result)
    {    ?>
        <p style="color:white;"><?php echo htmlentities($result->Fullname);?></p>
        <span><?php echo htmlentities($result->Email)?></span>
<?php }
    } 
?>