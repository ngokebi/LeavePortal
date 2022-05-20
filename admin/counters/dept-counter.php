<?php

    $sql = "SELECT id FROM departments";
    $query = $database -> prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $dptcount = $query->rowCount();

    echo htmlentities($dptcount);
?> 