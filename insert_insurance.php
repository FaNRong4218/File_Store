<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<?php
require_once "connect.php";
$sql1 = "SELECT * FROM insurance ";
$query1 = mysqli_query($link, $sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Starter</title>

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
</head>

<body class="hold-transition sidebar-mini">
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $Name = $_POST['Name'];
      $date = $_POST['Date'];
      $status = $_POST['Status'];
      $file = $_FILES['img']['name'];

      $sql = "INSERT INTO insurance (Corp_Name, Corp_Date, Corp_Status, Corp_img) 
        VALUES ('$Name', '$date', '$status', '$file' )";

      $stmt = mysqli_query($link, $sql);

      if ($stmt) {

        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลสำเร็จ');";
        echo "window.location = 'page_insurance.php';";
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
          <h2>เพิ่มข้อมูลบริษัทประกัน</h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>ชื่อบริษัทประกัน</label><br>
                <input type="text" class="form-control" name="Name" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label>วันที่สร้าง</label><br>
                <input type="date" class="form-control" name="Date" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>สถานะ</label><br>
                <input type="radio" value="on" name="Status" required checked><label>On</label>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <script language="JavaScript">
                  function showPreview(ele) { //ฟังก์โชว์ภาพก่อน กด submit 
                    $('#imgAvatar').attr('src', ele.value);
                    if (ele.files && ele.files[0]) {

                      var reader = new FileReader();

                      reader.onload = function(e) {
                        $('#imgAvatar').attr('src', e.target.result);
                      }
                      reader.readAsDataURL(ele.files[0]);
                    }
                  }
                </script>
                <img id="imgAvatar"  width="40%">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>ไฟล์ Logo</label><br>
                <input type="file" name="img" accept="image/*" required  OnChange="showPreview(this)" >
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                <input type=button class="btn btn-danger" onclick="window.location='page_insurance.php'" value=ยกเลิก>
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