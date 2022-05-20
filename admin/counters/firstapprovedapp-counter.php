<?php

    $sql = "SELECT id FROM leaves WHERE Status = '1'";
    $query = $database -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $leavtypcount = $query->rowCount();

    echo htmlentities($leavtypcount);

?>   