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
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">


    <link rel="stylesheet" href="dist/css/myCSS.css">
    <script src="dist/css/myCSS.css"></script>

</head>
<?php
include "menu.php";
?>


<?php
$sql1 = "SELECT File_ID FROM file ";
$result1 = mysqli_query($con, $sql1);
$num1 = mysqli_num_rows($result1);

$sql2 = "SELECT id FROM user ";
$result2 = mysqli_query($con, $sql2);
$num2 = mysqli_num_rows($result2);

$sql3 = "SELECT Report_ID FROM report ";
$result3 = mysqli_query($con, $sql3);
$num3 = mysqli_num_rows($result3);

$sql4 = "SELECT Corp_ID FROM insurance ";
$result4 = mysqli_query($con, $sql4);
$num4 = mysqli_num_rows($result4);


$sql5 = "SELECT Report_ID, insurance.Corp_Name, brand.Car_Name, type.Type_Name, Report_Status,Report.Car_ID,
        Date_Now,  Date_Ext, Date_Start
FROM report 
INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
INNER JOIN brand ON brand.Car_ID = report.Car_ID
INNER JOIN type ON  type.Type_ID = report.Type_ID
ORDER BY  Date_Now desc ;
";
$result5 = mysqli_query($con, $sql5);

$sql6 = "SELECT insurance.Corp_Name, COUNT(report.Corp_ID ) as num_corp  FROM report 
INNER JOIN insurance ON  insurance.Corp_ID = report.Corp_ID
GROUP BY insurance.Corp_Name
ORDER BY num_corp DESC  LIMIT 0,5
";
$result6 = mysqli_query($con, $sql6);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $num3 ?></h3>

                                <p>รายการเอกสาร</p>
                            </div>
                            <div class="icon ">
                                <i class="fas fa-table"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $num4 ?></h3>

                                <p>จำนวนบริษัท</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $num1 ?> </h3>

                                <p>จำนวนไฟล์</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $num2 ?></h3>

                                <p>จำนวนผู้ใช้งาน</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card ">
                            <h2 class="card-header bg-info">เอกสารล่าสุด</h2>
                            <div class="card-body ">
                                <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th hidden>Report_ID</th>
                                            <th>ชื่อบริษัท</th>
                                            <th>ชื่อยี่ห้อรถ</th>
                                            <th>ประเภทประกัน</th>
                                            <th>วันเริ่มสร้าง</th>
                                            <th>วันแก้ไข</th>
                                            <th>วันหมดอายุ</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($result5)) {
                                            $car_id = array($row["Car_ID"]);
                                            $car_arr = array($car_id);
                                            $carid = explode(",", $row["Car_ID"]);
                                            $carids = implode(",", $carid);
                                            // echo "$carids <br>";
                                            // print_r($carid);
                                            // echo "<br>";
                                            $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
                                            $resultc = mysqli_query($con, $sqlc);

                                        ?>

                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td hidden><?php echo $row["Report_ID"]; ?></td>
                                                <td><?php echo $row["Corp_Name"]; ?></td>
                                                <td><?php foreach ($resultc as $value) {
                                                        echo $value["Car_Name"] . "  ";
                                                    } ?></td>
                                                <td><?php echo $row["Type_Name"]; ?></td>
                                                <td><?php echo $row["Date_Start"]; ?></td>
                                                <td><?php echo $row["Date_Now"]; ?></td>
                                                <td><?php echo $row["Date_Ext"]; ?></td>
                                                <td>
                                                    <?php if ($_SESSION['type'] == 'member') {
                                                        $text_dis = "disabled";
                                                    } else {
                                                        $text_dis = "";
                                                    }
                                                    ?>
                                                    <?php if ($row["Report_Status"] == 'on') {
                                                        $text = "checked";
                                                    } else {
                                                        $text = "";
                                                    }
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" <?php echo $text ?> <?php echo $text_dis ?> class="change" name="change" id="<?php echo $row["Report_ID"] ?>">
                                                        <span class="slider round"></span>
                                                    </label>

                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="card ">
                            <h2 class="card-header bg-danger">5 อันดับเอกสารยอดนิยม</h2>
                            <div class="card-body ">
                                <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อบริษัทประกัน</th>
                                            <th>จำนวนรายงาน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($result6)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $row["Corp_Name"]; ?></td>
                                                <td><?php echo $row["num_corp"]; ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


</body>

</html>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $(document).on('click', '.change', function() {
              var Report_ID = $(this).attr("id");
              if (Report_ID != '') {
                $.ajax({
                  url: "Change_status.php",
                  method: "POST",
                  data: {
                    Report_ID: Report_ID
                  },
                  success: function(data) {
                    console.log(data);
                  }
                });
              }
            });
</script>