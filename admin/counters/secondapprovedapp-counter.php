<?php

    $sql = "SELECT id FROM leaves WHERE Status = '2'";
    $query = $database -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $leavtypcount = $query->rowCount();

    echo htmlentities($leavtypcount);

?>   