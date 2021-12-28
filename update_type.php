<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Update Type</title>

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
        <?php
        require_once "connect.php";
        $sqls = "SELECT * FROM type WHERE Type_ID='" . $_GET['Type_ID'] . "'";
        $querys = mysqli_query($link, $sqls);

        foreach ($querys as $value) {
            $id_s = $value['Type_ID'];
            $Name_s = $value['Type_Name'];
            $status_s = $value['Type_Status'];
            $detail_s = $value['Type_detail'];
        }
        ?>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['ids'];
            $Name = $_POST['Name'];
            $status = $_POST['Status'];
            $detail = $_POST['detail'];

            $sql = "UPDATE type set  Type_Name=' $Name', Type_Status='$status',Type_detail='$detail'
                WHERE Type_ID = $id";

            $stmt = mysqli_query($link, $sql);

            if ($stmt) {

                echo "<script type='text/javascript'>";
                echo "alert('แก้ไขข้อมูลสำเร็จ');";
                echo "window.location = 'page_type.php';";
                echo "</script>";
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }
        }
        mysqli_close($link);
        ?>
        <div class="content-wrapper">
            <div style="margin-left:10%; padding-top :2%;">
                <div class="container my-6">
                    <h2>แก้ไขข้อมูลประเภทประกัน</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-row">
                            <input type="number" class="form-control" name="ids" value="<?php echo $id_s ?>" hidden required>
                            <div class="form-group col-md-4">
                                <label>ชื่อประเภทประกัน</label><br>
                                <input type="text" class="form-control" name="Name" value="<?php echo $Name_s ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>สถานะ</label><br>
                                <input type="radio" value="on" name="Status" required checked><label>On</label>
                                <input type="radio" value="off" name="Status" required><label>Off</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>รายละเอียดของประเภทประกัน</label><br>
                                <textarea name="detail" id="detail"><?php echo $detail_s ?></textarea>

                                <script>
                                    CKEDITOR.replace('detail');

                                    function CKupdate() {
                                        for (instance in CKEDITOR.instances)
                                            CKEDITOR.instances[instance].updateElement()
                                    }
                                </script>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                                <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                                <input type=button class="btn btn-danger" onclick="window.location='page_type.php'" value=ยกเลิก>
                            </div>
                        </div>
                    </form>
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