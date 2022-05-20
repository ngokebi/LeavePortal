<?php

session_start();
error_reporting(0);
// include "../includes/Database.php";
// $database = new Database();
// $database = $database->getConnection();

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:../index.php');
} else {
    $username = $_SESSION['emplogin']; ?> 

<nav>
        <ul class="metismenu" id="menu">
        <li class="<?php if ($page=='dashboard') {
        echo 'active';
    } ?>"><a href="dashboard.php"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                            
        <li class="<?php if ($page=='employee') {
        echo 'active';
    } ?>"><a href="employee-profile.php"><i class="ti-id-badge"></i> <span>Employee Profile</span></a></li>

         <li class="<?php if ($page=='leave') {
        echo 'active';
    } ?>">
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-briefcase"></i><span> Leave</span></a>

            <ul class="collapse">
                <li ><a href="leave.php"><i class="fa fa-spinner"></i> Apply for Leave</a></li>
                <li ><a href="leave-history.php"><i class="fa fa-spinner"></i> Leave History</a></li>
            </ul>
            
        </li>
        <?php $sql = "SELECT DeptHead from employees";
    $query = $database -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $deptHead = $result->DeptHead;
            if ($deptHead === $username) {
                ?> 
        <li class="<?php if ($page=='manage-leave') {
                    echo 'active';
                } ?>">
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-briefcase"></i><span>Manage Leave</span></a>

            <ul class="collapse">
                <li ><a href="pending-history.php"><i class="fa fa-spinner"></i> Pending</a></li>
                <li ><a href="approved-history.php"><i class="fa fa-check"></i> Approved</a></li>
                <li ><a href="declined-history.php"><i class="fa fa-times-circle"></i> Declined</a></li>
                <li ><a href="dept-leave-history.php"><i class="fa fa-user"></i> Dept. Leave History</a></li>
            </ul>
            
        </li>
        <?php 
        break;
            }
        }
    } ?>
    </ul>
</nav>

<?php
} ?>