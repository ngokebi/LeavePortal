<?php

    $sql = "SELECT id from  leavetype";
    $query = $database -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $leavtypcount = $query->rowCount();

    echo htmlentities($leavtypcount);

?>   