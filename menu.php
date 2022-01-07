<?php
include_once 'connect.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
$id = $_SESSION['id'];
if (empty($id)) {
  header('Location:login.php');
}
$sql = "SELECT * FROM user WHERE id= $id ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);


$sqlp = "SELECT * FROM user_role  ";
$resultp = mysqli_query($link, $sqlp);


?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <h5 class="brand-link">
        <img src="img/etc/user_ic.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <?php echo ($_SESSION["name"]); ?> (<?php echo ($_SESSION["type"]); ?>)
      </h5>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            while ($rowp = mysqli_fetch_assoc($resultp)) {
              $idp = $rowp['id'];
              if ($_SESSION['type'] == 'admin') {
                $role = explode(",", $rowp['role']); //array
                $result_array = array_search("admin$idp", $role); //array
                if ($result_array !== false) {
                  echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                <i class='$rowp[icon]'></i>
                <p>
                $rowp[page]
                </p>
                </a>
              </li> ";
                }
              }
              if ($_SESSION['type'] == 'member') {
                $role = explode(",", $rowp['role']); //array
                $result_array = array_search("member$idp", $role); //array
                if ($result_array !== false) {
                  echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                  <i class='$rowp[icon]'></i>
                  <p>
                  $rowp[page]
                  </p>
                  </a>
                </li> ";
                }
              }
              if ($_SESSION['type'] == 'employee') {
                $role = explode(",", $rowp['role']); //array
                $result_array = array_search("employee$idp", $role); //array
                if ($result_array !== false) {
                  echo " <li class='nav-item'><a href='$rowp[link]' class='nav-link '>
                <i class='$rowp[icon]'></i>
                <p>
                $rowp[page]
                </p>
                </a>
              </li> ";
                }
              }
            }

            ?>
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
  </div>
  </aside>
