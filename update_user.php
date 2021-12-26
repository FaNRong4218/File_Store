<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
require_once "connect.php";

if (count($_POST) > 0) {
    if ($_SESSION["type"] == "Admin") {
        if ($_POST['id'] == $_SESSION["id"]) {
            Header("location: logout.php");
        } else{
        mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                             tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");
            Header("location: page_user.php");
        }
    }
    if ($_SESSION["type"] == "User") {
        if ($_POST['id'] == $_SESSION["id"] ){
            Header("location: logout.php");
        } else{
        mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                     tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");
            Header("location: page_user.php");
        }
    }
    if ($_SESSION["type"] == "Stuff") {
        if ($_POST['id'] == $_SESSION["id"]) {
            Header("location: logout.php");
        } else{
        mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                     tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");
            Header("location: page_user.php");
        }
    }
}
$result = mysqli_query($link, "SELECT * FROM user WHERE id='" . $_GET['id'] . "'");
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Update User</title>

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/MyStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </ul>



            <!-- Right navbar links -->


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <h5 class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                AdminLTE 3
            </h5>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <a href="page_dashboard.php" class="d-block"><i class="fas fa-user-circle"></i> Dashboard</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="page_user.php" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    User
                                </p>
                            </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page_report.php" class="nav-link">
                                <i class="fas fa-table"></i>
                                <p>
                                    Report
                                </p>
                            </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page_insurance.php" class="nav-link">
                            <i class="fas fa-building"></i>
                                <p>
                                    Insurance
                                </p>
                            </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page_brand.php" class="nav-link">
                            <i class="fas fa-copyright"></i>
                                <p>
                                    Brand
                                </p>
                            </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page_type.php" class="nav-link">
                                <i class="fas fa-table"></i>
                                <p>
                                    type
                                </p>
                            </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>
                                    Log out
                                </p>
                            </a>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            >
        </aside>


        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="h2">
                            <div class="page-header">
                                <h2>Update User</h2>
                            </div>
                            
                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" name="user" class="form-control" value="<?php echo $row["user"]; ?>" maxlength="50" required="">

                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $row["name"]; ?>" maxlength="50" required="">
                                </div>
                                <div class="form-group ">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $row["email"]; ?>" maxlength="30" required="">
                                </div>
                                <div class="form-group">
                                    <label>Tel</label>
                                    <input type="mobile" name="tel" class="form-control" value="<?php echo $row["tel"]; ?>" maxlength="10">

                                </div>
                               
                                <div class="form-group">
                                    <label>Type</label><br>
                                    <label class="radio-inline"><input type="radio" value="Admin" name="type" required="" checked>Admin</label>
                                    <label class="radio-inline"><input type="radio" value="Stuff" name="type" required="" >Stuff</label>
                                    <label class="radio-inline"><input type="radio" value="User" name="type"  required="" >User</label>
                                    

                                </div>
                                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <?php
                                if ($_SESSION["type"] == "User") {
                                    $check = "page_user.php";
                                }
                                if ($_SESSION["type"] == "Admin") {
                                    $check = "page_user.php";
                                }
                                if ($_SESSION["type"] == "Stuff") {
                                    $check = "page_user.php";
                                }

                                ?>
                                <a href="<?php echo $check ?>" class="btn btn-primary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
</body>

</html>