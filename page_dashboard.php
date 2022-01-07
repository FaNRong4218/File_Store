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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->


</head>
<?php
include "menu.php";
?>


        <?php     
        $sql1 = "SELECT File_ID FROM file ";
        $result1 = mysqli_query($link, $sql1);
        $num1 = mysqli_num_rows($result1);

        $sql2 = "SELECT id FROM user ";
        $result2 = mysqli_query($link, $sql2);
        $num2 = mysqli_num_rows($result2);

        $sql3 = "SELECT Car_Status FROM brand WHERE Car_Status='on'";
        $result3 = mysqli_query($link, $sql3);
        $num3 = mysqli_num_rows($result3);

        $sql4 = "SELECT Car_Status FROM brand WHERE Car_Status='off'";
        $result4 = mysqli_query($link, $sql4);
        $num4 = mysqli_num_rows($result4);

        $sql5 = "SELECT Corp_Status FROM insurance WHERE Corp_Status='on'";
        $result5 = mysqli_query($link, $sql5);
        $num5 = mysqli_num_rows($result5);

        $sql6 = "SELECT Corp_Status FROM insurance WHERE Corp_Status='off'";
        $result6 = mysqli_query($link, $sql6);
        $num6 = mysqli_num_rows($result6);

        $sql7 = "SELECT Type_Status FROM type WHERE Type_Status='on'";
        $result7 = mysqli_query($link, $sql7);
        $num7 = mysqli_num_rows($result7);

        $sql8 = "SELECT Type_Status FROM type WHERE Type_Status='off'";
        $result8 = mysqli_query($link, $sql8);
        $num8 = mysqli_num_rows($result8);

        $sql9 = "SELECT Report_Status FROM report WHERE Report_Status='on'";
        $result9 = mysqli_query($link, $sql9);
        $num9 = mysqli_num_rows($result9);

        $sql10 = "SELECT Report_Status FROM report WHERE Report_Status='off'";
        $result10 = mysqli_query($link, $sql10);
        $num10 = mysqli_num_rows($result10);

        $numOn = $num3 + $num5 + $num7 + $num9;
        $numOff = $num4 + $num6 + $num8 + $num10;
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?php echo $numOn ?> point</h3>

                                        <p>Status ON</p>
                                    </div>
                                    <div class="icon ">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3><?php echo $numOff ?> point</h3>

                                        <p>Status OFF</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-power-off"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?php echo $num2 ?> user</h3>

                                        <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?php echo $num1 ?> file</h3>

                                        <p>File</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <div class="row">
                            <div class="col-lg-6 ">
                               

                            </div>
                        </div>
                     

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


</body>

</html>
