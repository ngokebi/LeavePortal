<?php

session_start();
error_reporting(0);
include "../sessions.php";
include "../includes/Database.php";
$database = new Database();
$database = $database->getConnection();

if (strlen($_SESSION['emplogin']) == 0) {
    // header('location:../index.php');
    Redirect_to('../index.php');
} else {

?>

    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Employee Leave Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/themify-icons.css">
        <link rel="stylesheet" href="../assets/css/metisMenu.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/slicknav.min.css">
        <!-- amchart css -->
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <!-- Start datatable css -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
        <!-- others css -->
        <link rel="stylesheet" href="../assets/css/typography.css">
        <link rel="stylesheet" href="../assets/css/default-css.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/responsive.css">
        <!-- modernizr css -->
        <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <!-- preloader area start -->
        <div id="preloader">
            <div class="loader"></div>
        </div>
        <!-- preloader area end -->
        <!-- page container area start -->
        <div class="page-container">
            <!-- sidebar menu area start -->
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <div class="logo">
                        <a href="leave.php"><img src="../assets/images/icon/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <?php
                        $page = 'leave';
                        include '../includes/employee-sidebar.php';
                        ?>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <!-- main content area start -->
            <div class="main-content">
                <!-- header area start -->
                <div class="header-area">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-6 col-sm-4 clearfix">
                            <ul class="notification-area pull-right">
                                <li id="full-view"><i class="ti-fullscreen"></i></li>
                                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                                <!-- Notification bell -->
                                <?php include '../includes/employee-notification.php' ?>



                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">My Leave History</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <?php include '../includes/employee-profile-section.php' ?>
                        </div>
                    </div>
                </div>
                <!-- page title area end -->
                <div class="main-content-inner">
                    <div class="row">
                        <!-- data table start -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Leave History Table</h4>
                                    <?php
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                    ?>
                                    <div class="data-tables">
                                        <table id="dataTable" class="table table-hover progress-table text-center">
                                            <thead class="bg-light text-capitalize">
                                                <tr>
                                                    <th>#</th>
                                                    <th width="100">Type</th>
                                                    <th>Conditions</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th width="100">Date Created</th>
                                                    <th width="100">Dept. Head Remark</th>
                                                    <th width="100">Admin's Remark</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $eid = $_SESSION['eid'];
                                                $sql = "SELECT LeaveType, StartDate, EndDate, Description, DateCreated, AdminRemarkDate, AdminRemark, DeptHeadRemark, DeptHeadRemarkDate, Status from leaves where EmpID=:eid ORDER BY id DESC";
                                                $query = $database->prepare($sql);
                                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {  ?>

                                                        <tr>
                                                            <td> <?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->LeaveType); ?></td>
                                                            <td><?php echo htmlentities($result->Description); ?></td>
                                                            <td><?php echo htmlentities($result->StartDate); ?></td>
                                                            <td><?php echo htmlentities($result->EndDate); ?></td>
                                                            <td><?php echo htmlentities($result->DateCreated); ?></td>
                                                            <td><?php if ($result->DeptHeadRemark == "") {
                                                                    echo htmlentities('Pending');
                                                                } else {

                                                                    echo htmlentities(($result->DeptHeadRemark));
                                                                }

                                                                ?>
                                                            </td>
                                                            <td><?php if ($result->AdminRemark == "") {
                                                                    echo htmlentities('Pending');
                                                                } else {

                                                                    echo htmlentities(($result->AdminRemark));
                                                                }

                                                                ?>
                                                            </td>

                                                            <td>
                                                                <?php
                                                                $stats = $result->Status;

                                                                if ($stats == 1) { ?>
                                                                    <span style="color: green">Dept. Head Approved<i class="fa fa-check-square-o"></i></span>
                                                                <?php }
                                                                if ($stats == 2) { ?>
                                                                    <span style="color: green">CEO Approved <i class="fa fa-cross"></i></span>
                                                                <?php }
                                                                if ($stats == 3) { ?>
                                                                    <span style="color: red">Declined <i class="fa fa-cross"></i></span>
                                                                <?php }
                                                                if ($stats == 0) { ?>
                                                                    <span style="color: blue">Pending Dept Head Approval<i class="fa fa-spinner"></i></span>
                                                                <?php } ?>
                                                            </td>

                                                        </tr>

                                                <?php $cnt++;
                                                    }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- data table end -->
                    </div>
                </div>
            </div>
            <!-- main content area end -->
            <!-- footer area start-->
            <?php include '../includes/footer.php' ?>
            <!-- footer area end-->
        </div>
        <!-- page container area end -->
        <!-- offset area start -->
        <div class="offset-area">
            <div class="offset-close"><i class="ti-close"></i></div>


        </div>
        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>

        <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
    </body>

    </html>

<?php } ?>