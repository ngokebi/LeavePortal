<?php
session_start();
// ini_set('display_errors', '1');

// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
error_reporting(0);
include "../sessions.php";
require "../includes/Database.php";
$database = new Database();
$database = $database->getConnection();
if (strlen($_SESSION['emplogin']) == 0) {
    // header('location:../index.php');
    Redirect_to('../index.php');
} else {
    if (isset($_POST['apply'])) {
        $empid = $_SESSION['eid'];
        $email = $_SESSION['email'];
        $leavetype = $_POST['leavetype'];
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $description = $_POST['description'];
        $status = 0;
        $isread = 0;

        if ($fromdate > $todate) {
            $error = " Please enter correct details: End Data should be ahead of Starting Date in order to be valid! ";
        }

        $sql = "INSERT INTO leaves(LeaveType,StartDate,EndDate,Description,Status,IsRead,EmpID) VALUES(:leavetype,:fromdate,:todate,:description,:status,:isread,:empid)";
        $query = $database->prepare($sql);
        $query->bindParam(':leavetype', $leavetype, PDO::PARAM_STR);
        $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $query->bindParam(':todate', $todate, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $database->lastInsertId();

        if ($lastInsertId) {
            // $msg = "Your leave application has been applied, Thank You.";
            // echo "<script type='text/javascript'> document.location = 'leave-history.php'; </script>";
            $_SESSION["SuccessMessage"] = "Your leave application has been applied, Thank You.";
            Redirect_to('leave-history.php');
        } else {
            $_SESSION["ErrorMessage"] = "Sorry, could not process this time. Please try again later.";
            Redirect_to('leave-history.php');
        }

    } ?>

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
                                <?php include '../includes/admin-notification.php' ?>

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
                                <h4 class="page-title pull-left">Apply For Leave Days</h4>
                                <ul class="breadcrumbs pull-left">

                                    <li><span>Leave Form</span></li>
                                </ul>
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
                        <div class="col-lg-6 col-ml-12">
                            <div class="row">
                                <!-- Textual inputs start -->
                                <div class="col-12 mt-5">
                                    <?php
                                    echo ErrorMessage();
                                    echo SuccessMessage();
                                    ?>
                                    <div class="card">
                                        <form name="addemp" method="POST">

                                            <div class="card-body">
                                                <h4 class="header-title">Employee Leave Form</h4>
                                                <p class="text-muted font-14 mb-4">Please fill up the form below.</p>

                                                <div class="form-group">
                                                    <label for="fromdate" class="col-form-label">Starting Date</label>
                                                    <input class="form-control" type="date" data-inputmask="'alias': 'date'" required id="fromdate" name="fromdate">
                                                </div>

                                                <div class="form-group">
                                                    <label for="todate" class="col-form-label">End Date</label>
                                                    <input class="form-control" type="date" data-inputmask="'alias': 'date'" required id="todate" name="todate">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label">Your Leave Type</label>
                                                    <select class="custom-select" name="leavetype" autocomplete="off">
                                                        <option value="">Click here to select any ...</option>

                                                        <?php $sql = "SELECT LeaveType from leavetype";
                                                        $query = $database->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {   ?>
                                                                <option value="<?php echo htmlentities($result->LeaveType); ?>"><?php echo htmlentities($result->LeaveType); ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="col-form-label">Describe Your Conditions</label>
                                                    <textarea class="form-control" name="description" type="text" name="description" length="400" id="description" rows="5"></textarea>
                                                </div>

                                                <button class="btn btn-primary" name="apply" id="apply" type="submit">SUBMIT</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
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

        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
    </body>

    </html>

<?php
} ?>