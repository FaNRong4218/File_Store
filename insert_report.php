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

    <title>AdminLTE 3 | Insert Report</title>

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
    <script src="dist/css/MyStyle.css"></script>
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
        $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name FROM insurance WHERE Corp_Status= 'on';";
        $query1 = mysqli_query($link, $sql1);

        $sql2 = "SELECT Type_ID,Type_Name FROM type WHERE Type_Status= 'on';";
        $query2 = mysqli_query($link, $sql2);

        $sql3 = "SELECT Car_ID,Car_Name FROM brand WHERE Car_Status= 'on';";
        $query3 = mysqli_query($link, $sql3);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Corp_ID = $_POST['Corp_ID'];
            $Type_ID = $_POST['Type_ID'];
            $Car_ID = $_POST['Car_ID'];
            $detail = $_POST['detail'];
            $date_start = $_POST['date_start'];
            $date_now = $_POST['date_now'];
            $date_ext = $_POST['date_ext'];
            $status = $_POST['status'];

            $sql1 = "INSERT INTO report (Corp_ID, Type_ID, Car_ID, Report_detail, Date_Start, Date_Now, Date_Ext, Report_Status ) 
            VALUES ('$Corp_ID', '$Type_ID', '$Car_ID','$detail','$date_start','$date_now','$date_ext','$status' )";
             

             $insert = mysqli_query($link, $sql1);

              if ($insert){
                echo "<script type='text/javascript'>";
                echo "alert('เพิ่มข้อมูลสำเร็จ');";
                echo "window.location = 'page_report.php';";
                echo "</script>";
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }
            mysqli_close($link);


                
            

            // $upload2 = $_FILES['file2'];
            // $upload3 = $_FILES['file3'];


            // if ($upload1 != '') { //ไฟล์มีการอัพโหลด
                // $numrand1 = (mt_rand(0, 1000));
                // $type1 = strrchr($_FILES['file1']['name'], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                // $newname1 = $nameDate . $numrand1 . $type1; //ประกอบเป็นชื่อใหม่
                // $path_copy1 = $path . $newname1; //กำหนด path ในการเก็บ
                // move_uploaded_file($_FILES['file1']['tmp_name'], $path_copy1);
            // }

            // if ($upload2 != '') { //ไฟล์มีการอัพโหลด
            //     $numrand2 = (mt_rand(1001, 2000));
            //     $type2 = strrchr($_FILES['file2']['name'], ".");
            //     $newname2 = $nameDate . $numrand2 . $type2;
            //     $path_copy2 = $path . $newname2;
            //     move_uploaded_file($_FILES['file2']['tmp_name'], $path_copy2);
            // }

            // if ($upload3 != '') { //ไฟล์มีการอัพโหลด
            //     $numrand3 = (mt_rand(2001, 3000));
            //     $type3 = strrchr($_FILES['file3']['name'], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
            //     $newname3 = $nameDate . $numrand3 . $type3; //ประกอบเป็นชื่อใหม่ 
            //     $path_copy3 = $path . $newname3; //กำหนด path ในการเก็บ
            //     move_uploaded_file($_FILES['file3']['tmp_name'], $path_copy3);
            // }

           
        }

        ?>
        <?php
        require_once "connect.php";
        ?>

        <div class="content-wrapper">
            <div style="margin-left:10%; padding-top :2%;">
                <div class="container my-6">
                    <h2>เพิ่มข้อมูลรายงานประกัน</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>บริษัทประกัน</label>
                                <select name="Corp_ID" id="Corp_ID" class="form-control" required>
                                    <option value="">เลือกบริษัทประกันที่ต้องการ</option>
                                    <?php while ($result1 = mysqli_fetch_assoc($query1)) : ?>
                                        <option value="<?= $result1["Corp_ID"] ?>"><?= $result1["Corp_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ประเภทประกัน</label>
                                <select name="Type_ID" id="Type_ID" class="form-control" required>
                                    <option value="">เลือกประเภทประกันที่ต้องการ</option>
                                    <?php while ($result2 = mysqli_fetch_assoc($query2)) : ?>
                                        <option value="<?= $result2["Type_ID"] ?>"><?= $result2["Type_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>ยี่ห้อรถ</label><br>
                                <?php while ($result3 = mysqli_fetch_assoc($query3)) : ?>
                                    <label><input type="radio" name="Car_ID" value="<?= $result3["Car_ID"] ?>" required><?= $result3["Car_Name"] ?></label>&nbsp;&nbsp;
                                <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>วันที่สร้าง</label><br>
                                <input name="date_start" type="date" value=<?php echo date('Y-m-d') ?>>
                            </div>

                            <div class="form-group col-md-4">
                                <label>สถานะ</label><br>
                                <input type="radio" value="on" name="status" required="" checked><label>On</label>&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>วันที่แก้ไข</label><br>
                                <input name="date_now" type="date" value=<?php echo  date('Y-m-d') ?>>
                            </div>
                            <div class="form-group col-md-4">
                                <label>วันที่หมดอายุ</label><br>
                                <input name="date_ext" type="date" value='' required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>รายละเอียดของประกัน</label><br>
                                <textarea name="detail" id="detail"></textarea>
                                <script>
                                    CKEDITOR.replace('detail');

                                    function CKupdate() {
                                        for (instance in CKEDITOR.instances)
                                            CKEDITOR.instances[instance].updateElement();
                                    }
                                </script>
                            </div>
                        </div>
                       
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="ยืนยัน" > &nbsp;&nbsp;
                    <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                    <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>
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
<script>
    $(document).ready(function() {
        $('#Table').DataTable();
    });
</script>