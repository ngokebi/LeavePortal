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

    if (isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['emplogin'];
        $sql = "SELECT Password FROM employees WHERE Email=:username and Password=:password";
        $query = $database->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {

            $con = "UPDATE employees set Password=:newpassword where Email=:username";
            $chngpwd1 = $database->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            // $msg = "Your Password Has Been Updated.";
            $_SESSION["SuccessMessage"] = "Your Password Has Been Updated.";
            Redirect_to('dashboard.php');
        } else {
            // $error = "Sorry your current password is wrong!";
            $_SESSION["ErrorMessage"] = "Sorry, Your Current Password is Wrong!";
            Redirect_to('change-password-employee.php');
        }
    }
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
                        <a href="dashboard.php"><img src="../assets/images/icon/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                    <?php include '../includes/employee-sidebar.php' ?>
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
                                <h4 class="page-title pull-left">Change Current Password</h4>
                                <ul class="breadcrumbs pull-left">

                                    <!-- <li><span>Password Fields</span></li> -->
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
                                        <form name="chngpwd" method="POST">

                                            <div class="card-body">
                                                <h4 class="header-title">Change Password</h4>
                                                <p class="text-muted font-14 mb-4">Please fill up the form to change your current password.</p>

                                                <div class="form-group">
                                                    <label for="passwordt" class="col-form-label">Existing Password</label>
                                                    <input class="form-control" id="password" type="password" autocomplete="off" name="password" autocomplete="off" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="newpassword" class="col-form-label">New Password</label>
                                                    <input class="form-control" type="password" name="newpassword" id="newpassword" autocomplete="off" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="confirmpassword" class="col-form-label">Confirm Password</label>
                                                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required>
                                                </div>


                                                <button class="btn btn-primary" name="change" type="submit" onclick="return valid();">CHANGE PASSWORD</button>

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

<?php } ?>