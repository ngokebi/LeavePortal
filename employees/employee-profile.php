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
    $eid = $_SESSION['emplogin'];
    if (isset($_POST['update'])) {

        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $mobileno = $_POST['mobileno'];
        $sql = "UPDATE employees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department, Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where Email=:eid";
        $query = $database->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        // $msg = "Your record has been updated Successfully";
        $_SESSION["SuccessMessage"] = "Your Record has been Updated Successfully";
        Redirect_to('employee-profile.php');
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
                        $page = 'employee';
                        include '../includes/employee-sidebar.php'; ?>
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
                                <h4 class="page-title pull-left">My Profile</h4>
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
                                                <h4 class="header-title">Update My Profile</h4>
                                                <p class="text-muted font-14 mb-4">Please make changes on the form below in order to update your profile</p>

                                                <?php
                                                $eid = $_SESSION['emplogin'];
                                                $sql = "SELECT * from  employees where Email=:eid";
                                                $query = $database->prepare($sql);
                                                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {
                                                ?>


                                                        <div class="form-group">
                                                            <label for="firstName" class="col-form-label">First Name</label>
                                                            <input class="form-control" name="firstName" value="<?php echo htmlentities($result->FirstName); ?>" type="text" required id="firstName">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lastName" class="col-form-label">Last Name</label>
                                                            <input class="form-control" name="lastName" value="<?php echo htmlentities($result->LastName); ?>" type="text" autocomplete="off" required id="lastName">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input class="form-control" name="email" type="email" value="<?php echo htmlentities($result->Email); ?>" readonly autocomplete="off" required id="email">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label">Gender</label>
                                                            <select class="custom-select" name="gender" autocomplete="off">
                                                                <option value="<?php echo htmlentities($result->Gender); ?>"><?php echo htmlentities($result->Gender); ?></option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="dob" class="col-form-label">D.O.B</label>
                                                            <input class="form-control" type="date" name="dob" id="dob" value="<?php echo htmlentities($result->Dob); ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="mobileno" class="col-form-label">Contact Number</label>
                                                            <input class="form-control" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" maxlength="10" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="empcode" class="col-form-label">Employee ID</label>
                                                            <input class="form-control" name="empcode" type="text" autocomplete="off" readonly required value="<?php echo htmlentities($result->EmployeeId); ?>" id="empcode">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="country" class="col-form-label">Country</label>
                                                            <input class="form-control" name="country" type="text" value="<?php echo htmlentities($result->Country); ?>" autocomplete="off" required id="country">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address" class="col-form-label">Address</label>
                                                            <input class="form-control" name="address" type="text" value="<?php echo htmlentities($result->Address); ?>" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="city" class="col-form-label">City</label>
                                                            <input class="form-control" name="city" type="text" value="<?php echo htmlentities($result->City); ?>" autocomplete="off" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label">Selected Department</label>
                                                            <select class="custom-select" name="department" autocomplete="off">
                                                                <option value="<?php echo htmlentities($result->Department); ?>"><?php echo htmlentities($result->Department); ?></option>

                                                                <?php $sql = "SELECT DepartmentName from departments";
                                                                $query = $database->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $resultt) {
                                                                ?>
                                                                        <option value="<?php echo htmlentities($resultt->DepartmentName); ?>"><?php echo htmlentities($resultt->DepartmentName); ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>

                                                <?php }
                                                } ?>

                                                <button class="btn btn-primary" name="update" id="update" type="submit">MAKE CHANGES</button>

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