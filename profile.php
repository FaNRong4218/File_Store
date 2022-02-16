<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<?php

require_once('connect.php');

$id = $_SESSION['id'];

// if (empty($id)) {
//   header('Location:login.php');
// }
$sql = "SELECT * FROM user WHERE id= $id ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


// $sqlp = "SELECT * FROM member_role  ";
// $resultp = mysqli_query($con, $sqlp);





?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Profile</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
  <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/css/myCSS.css"></script>
  <script src="dist/js/adminlte.min.js"></script>
</head>

<body>
  <?php require('menu.php') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 style="text-transform: uppercase"><?php echo $row['type']; ?> โปรไฟล์</h1> -->
          </div>
          <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item" style="text-transform: uppercase"><a href="profile.php"><?php echo $row['member_type']; ?> โปรไฟล์</a></li>
                            <li class="breadcrumb-item active" style="text-transform: uppercase"><?php echo $row['member_type']; ?> โปรไฟล์</li>
                        </ol>
                    </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-sm-3 col-md-6">

            <!-- Profile Image -->
            <div class="card card-pink card-outline">
              <div class="card-body box-profile">
                <div class="text-center">

                  <?php
                  // if ($_SESSION['level'] == 'member') {
                  ?>

                  <!-- <img class="d-block m-auto" style="border-radius:50%" id="pictureUrl" width="100" alt="img"> -->

                  <?php
                  // }
                  ?>
                  <?php
                  // if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'employee') {  
                  ?>
                  <img class="d-block m-auto" style="border-radius:50%" src="myImg/etc/user_ic.png" width="100" alt="img">

                  <?php
                  // } 
                  ?>
                </div>

                <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>

                <!-- <p class="text-muted text-center">ID = <?php echo $row['member_id']; ?></p> -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">เกี่ยวกับฉัน</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user"></i> ชื่อ</strong>

                <p class="text-muted">
                  <?php echo $row['name']; ?>
                </p>

                <strong><i class="fas fa-phone"></i> โทรศัพท์</strong>

                <p class="text-muted">
                  <?php echo $row['tel']; ?>
                </p>
                <hr>
                <strong><i class="fas fa-address-card"></i> email</strong>

                <p class="text-muted">
                  <?php echo $row['email']; ?>
                </p>

                <hr>
                <div class='row'>
                  <div class="col-12">
                    <a href="page_update.php?profile=<?php echo $_SESSION['id']; ?>"><button class="btn btn-success  m-auto " type="submit"><i class="fas fa-user-edit"></i> แก้ไข</button></a>
                    <a href="reset-password.php"><button class="btn btn-info m-auto" type="submit"><i class="fas fa-key"></i> รีเซ็ตรหัสผ่าน</button></a>

                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>

  <?php //require('../env.php') 
  ?>

  <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
  <!-- <script>
    function logOut() {
      liff.logout();
      window.location.reload();
    }

    function logIn() {
      liff.login({
        redirectUri: window.location.href
      });

    }


    async function getUserProfile() {
      const profile = await liff.getProfile();
      document.getElementById("img").style.display = "block";
      document.getElementById("img").src = profile.pictureUrl;
      document.getElementById("pictureUrl").style.display = "block";
      document.getElementById("pictureUrl").src = profile.pictureUrl;

    }

    async function main() {
      await liff.init({
        liffId: "1656690602-3lqQwdRX"
      });
      if (liff.isInClient()) {
        getUserProfile();

      } else {
        if (liff.isLoggedIn()) {
          getUserProfile();

          const profile = await liff.getProfile();

          /*  document.getElementById("name").value = profile.displayName;
                document.getElementById("status").value = profile.statusMessage;
                document.getElementById("access").value = (liff.getAccessToken());
                document.getElementById("email").value = (liff.getDecodedIDToken().email);
                document.getElementById("useos").value = (liff.getOS());
                document.getElementById("uselanguage").value = (liff.getLanguage());
                document.getElementById("useversion").value = (liff.getVersion());
                document.getElementById("useisInClient").value = (liff.isInClient());
                document.getElementById("usetype").value = (liff.getContext().type);
                document.getElementById("useviewType").value = (liff.getContext().viewType);
 */


          document.getElementById("btnLogIn").style.display = "none";
          document.getElementById("btnLogOut").style.display = "block";


        } else {
          liff.login(


            {
              redirectUri: window.location.href = "
              <?php
              // echo$path_line 
              ?>
              admin_nav.php"

            }

          )
          document.getElementById("btnLogIn").style.display = "block";
          document.getElementById("btnLogOut").style.display = "none";


        }
      }
    }


    main();
  </script> -->
</body>

</html>