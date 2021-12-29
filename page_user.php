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

  <title>AdminLTE 3 | Type</title>


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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



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

    </aside>


    <div class="content-wrapper">
      <div style="margin-left:4%; padding-top :4%;">
        <div class="container my-6">
          <?php
          include_once 'connect.php';
          $result = mysqli_query($link, "SELECT * FROM user");
          ?>
          <?php
          if (mysqli_num_rows($result) > 0) {
          ?>

            <table id="Table" class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th hidden></th>
                  <th>ลำดับ</th>
                  <th>ผู้ใช้</th>
                  <th>ชื่อผู้ใช้</th>
                  <th>อีเมล</th>
                  <th>เบอร์โทรศัพท์</th>
                  <th>สถานะ</th>
                  <th>ฟังก์ชัน</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td hidden><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["user"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["tel"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>
                    <td>
                      <a href="page_update.php?id=<?php echo $row["id"]; ?>" title='Update Record'>
                      <button type=button class="btn btn-dark btn-sm"><i class="far fa-edit"></i>
                    </button></a>
                      <a href="delete_user.php?id=<?php echo $row["id"]; ?>&submit=DEL" onclick="return confirm('ต้องการจะลบผู้ใช้งานนี้หรือไม่ ?')" title='ลบผู้ใช้งาน'>
                      <button type=button class="btn btn-dark btn-sm"> <i class="fas fa-trash-alt"></i></button></a>
                    </td>
                  </tr>
                <?php
                  $i++;
                }
                ?>
              </tbody>
            </table>

          <?php
          } else {
            echo "No result found";
          }
          ?>
        </div>
      </div>
    </div>




    <!-- jQuery -->
    <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
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