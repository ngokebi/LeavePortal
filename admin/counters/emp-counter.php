<?php

    $sql = "SELECT id FROM employees";
    $query = $database -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $empcount = $query->rowCount();

    echo htmlentities($empcount);
?>