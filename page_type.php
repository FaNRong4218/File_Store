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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

    <div class="content-wrapper">
      <div style="margin-left:4%; padding-top :4%;">
        <div class="container my-6">
          <a href="insert_type.php" title='Insert Data'>เพิ่มข้อมูล
            <i class="fas fa-plus-circle"></i></a> <br>

          <?php
          include_once 'connect.php';
          $sql = "SELECT * FROM type ;";
          $result = mysqli_query($link, $sql);

          ?>
          <?php


          if (mysqli_num_rows($result) > 0) {
          ?>
            <table id="Table" class="display">
              <thead>
                <tr>
                  <th>Type ID</th>
                  <th>Type Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row["Type_ID"]; ?></td>
                    <td><?php echo $row["Type_Name"]; ?></td>
                    <td> <?php if ($row["Type_Status"] =='on'){
                     echo '<button class="btn btn-success btn-lg" ></button> ';
                  }else {
                    echo '<button class="btn btn-danger btn-lg" ></button>';
                  }
                   ?></td>
                    <td><a href="update_type.php?Type_ID=<?php echo $row["Type_ID"]; ?>" title='Update Record'>
                        <i class="fas fa-pencil-alt"></i></a>&nbsp;&nbsp;
                      <a title='detail'>
                        <a title='Detail'><i class="fas fa-sticky-note view" type="button" name="view" value="ข้อมูล" id="<?php echo $row["Type_ID"]; ?>"></i><a>
                    </td>

                  </tr>
                <?php
                }
                ?>
                <script>
                  //Ajax เพื่อ ดึงค่า Type_ID จาก ตาราง
                  //ฟังชั่น on บันทึกการเป็นแปลงเมื่อคลิ๊ก และกำหนด element ใน class ชื่อ viwe_data เพื่อ
                  //อิงการเปลี่ยนแปลงเมื่อคลิ๊กจุดนั้น
                  $(document).on('click', '.view', function() {
                    var Type_ID = $(this).attr("id"); //กำหนดตัวแปรเพื่อเก็บ ค่า Type_ID 
                    if (Type_ID != '') {
                      $.ajax({ //เขียน Ajex เพื่อส่งค่าไปยัง url ที่กำหนด
                        url: "showType.php", //กำหนด Url
                        method: "POST",
                        data: {
                          Type_ID: Type_ID //data ที่ได้ คือ Type_ID
                        },
                        success: function(data) {
                          $('#Type_detail').html(data); //นำข้อมูลจาก ไฟล์ "showType.php"มา ใส่ใน id ชื่อ Type_detail
                          $('#dataModal').modal('show'); // แสดง modal โดยมี id ชื่อ dataModal เป็นตัวอ้างอิง
                        }
                      });
                    }
                  });
                </script>
              </tbody>
            </table>
          <?php
          } else {
            echo "No result found";
          }
          ?>
          <!-- Modal content-->
          <div id="dataModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5>รายละเอียดของประเภทประกัน<h5>
                </div>
                <div class="modal-body" id="Type_detail">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

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

</html>