<link rel="stylesheet" href="../assets/css/styles.css">

<?php 
    require_once 'Database.php';
    $database = New Database();
    $database = $database->getConnection();
    $isread=1;
    $status = 1;
    $sql = "SELECT id FROM leaves WHERE IsRead = :isread AND Status = :status";
    $query = $database->prepare($sql);
    $query->bindParam(':isread', $isread, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $unreadcount=$query->rowCount();

?>
    
    <li class="dropdown">
        <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
            <span><?php echo htmlentities($unreadcount);?></span>
            </i>
            <div class="dropdown-menu bell-notify-box notify-box">
            <span class="notify-title">You have <?php echo htmlentities($unreadcount);?> <b>unread</b> notifications!</span>

            <div class="notify-list">
            <?php 
                $isread=1;
                $status = 1;
                $sql = "SELECT leaves.id AS leaveid, employees.FirstName, employees.LastName, employees.EmployeeId, leaves.DateCreated FROM leaves JOIN employees ON leaves.EmpID = employees.id WHERE leaves.IsRead = :isread AND leaves.Status = :status";
                $query = $database->prepare($sql);
                $query->bindParam(':isread', $isread, PDO::PARAM_STR);
                $query->bindParam(':status', $status, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                foreach($results as $result)
                {               ?>  
                    
                     
                     <a href="employeeLeave-details.php?leaveid=<?php echo htmlentities($result->leaveid);?>" class="notify-item">
                       <div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
                       <div class="notify-text">
                       <p><b><?php echo htmlentities($result->FirstName." ".$result->LastName);?>
                                            <br />(<?php echo htmlentities($result->EmployeeId);?>)
                                            </b> Leave has been approved by his/her Dept. Head.</p>
                            <span>at <?php echo htmlentities($result->DateCreated);?></b</span>
                        </div>
                      </a>
                                        
                      <?php }} ?> 
                     </div>
                            
                     
                     
                      </div>
                      
     </li>

     