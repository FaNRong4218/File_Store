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

    <title>search</title>

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/MyStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="dist/css/myCSS.css">
    <script src="dist/css/myCSS.css"></script>

</head>

<?php
include "menu.php";
include_once 'connect.php';
?>
<?php
?>
<?php
$date = $_POST['date'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];

$insurance = $_POST['insurance'];
$brand = $_POST['brand'];
$type = $_POST['type'];

if ($insurance != '') {
    $sqls = "SELECT * FROM insurance WHERE Corp_Status = 'on' AND Corp_ID=$insurance";
    $querys = mysqli_query($con, $sqls);
    foreach ($querys as $value) {
        $ins_id = $value['Corp_ID'];
        $ins_name = $value['Corp_Name'];
    }
    $textsql1 = ' AND Corp_ID !=' . $insurance;
    $texts = '<option value="' . $ins_id . '">' . $ins_name . '</option>' .
        '<option value="">ไม่เลือกบริษัทประกันภัย</option>';
} else {
    $textsql1 = '';
    $texts = '<option value="">ไม่เลือกบริษัทประกันภัย</option>';
}

if ($brand != '') {
    $sqlx = "SELECT * FROM brand WHERE Car_Status = 'on' AND Car_ID=$brand";
    $queryx = mysqli_query($con, $sqlx);
    foreach ($queryx as $value) {
        $b_id = $value['Car_ID'];
        $b_name = $value['Car_Name'];
    }
    $textsql2 = ' AND Car_ID !=' . $brand;
    $textx = '<option value="' . $b_id . '">' . $b_name . '</option>' .
        '<option value="">ไม่เลือกยี่ห้อรถยนต์</option>';
} else {
    $textsql2 = '';
    $textx = '<option value="">ไม่เลือกยี่ห้อรถยนต์</option>';
}

if ($type != '') {
    $sqlz = "SELECT * FROM type WHERE Type_Status = 'on' AND Type_ID=$type";
    $queryz = mysqli_query($con, $sqlz);
    foreach ($queryz as $value) {
        $t_id = $value['Type_ID'];
        $t_name = $value['Type_Name'];
    }
    $textsql3 = ' AND Type_ID !=' . $type;
    $textz = '<option value="' . $t_id . '">' . $t_name . '</option>' .
        '<option value="">ไม่เลือกประเภทประกันภัย</option>';
} else {
    $textsql3 = '';
    $textz = '<option value="">ไม่เลือกประเภทประกันภัย</option>';
}

//แสดงตัวเลือกที่เหลือ
$sql1 = "SELECT * FROM insurance WHERE Corp_Status = 'on' $textsql1";
$query1 = mysqli_query($con, $sql1);
$sql2 = "SELECT * FROM brand WHERE Car_Status = 'on'  $textsql2 ";
$query2 = mysqli_query($con, $sql2);
$sql3 = "SELECT * FROM type WHERE Type_Status = 'on' $textsql3";
$query3 = mysqli_query($con, $sql3);




if ($date == '' && $date_start == '' && $date_end == '' && $insurance == '' && $brand == '' && $type == '') {
    echo "<script type='text/javascript'>";
    echo "window.location = 'page_report.php';";
    echo "</script>";
} else {

    if ($date != '') {
        if ($date_start == '' || $date_end == '') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกข้อมูลให้ถูกต้อง');";
            echo "window.location = 'page_report.php';";
            echo "</script>";
        } else {
            // $where1 = "$date BETWEEN '$date_start' AND '$date_end'";
        }
    } else {
        if ($date_start != '' || $date_end != '') {
            echo "<script type='text/javascript'>";
            echo "alert('กรุณาเลือกข้อมูลให้ถูกต้อง');";
            echo "window.location = 'page_report_search.php';";
            echo "</script>";
        }
    }


    //ทำเงื่อนไขในการค้นหา
    $conditions = array();
    if (!empty($date)) {
        $conditions[] = "$date BETWEEN '$date_start' AND '$date_end'";
    }
    if (!empty($insurance)) {
        $conditions[] = "report.Corp_ID='$insurance'";
    }
    if (!empty($brand)) {

        $conditions[] = "report.Car_ID LIKE('%$brand%')";
    }
    if (!empty($type)) {
        $conditions[] = "report.Type_ID='$type'";
    }



    $sqls = "SELECT Report_ID, insurance.Corp_Name, brand.Car_Name, type.Type_Name, Report_Status,
                            Date_Now,  Date_Ext, Date_Start,report.Car_ID
                            FROM report 
                            INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
                            INNER JOIN brand ON brand.Car_ID = report.Car_ID
                            INNER JOIN type ON  type.Type_ID = report.Type_ID";
    $sql = $sqls;
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    $result = mysqli_query($con, $sql);
}
?>
<div class="content-wrapper">
    <div style=" padding-top :4%;">
        <div class="container my-6">

            <div class="card " style="width: 105%;">
                <h2 class="card-header bg-info">ค้นหารายงาน</h2>
                <div class="card-body">
                    <form action="search.php" method="post">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3">
                                <label>เลือกวันที่ต้องการ</label><br>
                                <select name="date" id="date" class="form-control">
                                    <?php if ($date == 'date_Start') {
                                        $text1 = 'selected';
                                        $text2 = '';
                                        $text3 = '';
                                    } ?>
                                    <?php if ($date == 'date_Now') {
                                        $text1 = '';
                                        $text2 = 'selected';
                                        $text3 = '';
                                    } ?>
                                    <?php if ($date == 'date_Ext') {
                                        $text1 = '';
                                        $text2 = '';
                                        $text3 = 'selected';
                                    } ?>
                                    <?php if ($date == '') {
                                        $text1 = '';
                                        $text2 = '';
                                        $text3 = '';
                                    } ?>
                                    <option value="">เลือกวันที่ต้องการ</option>
                                    <option <?php echo $text1 ?> value="date_Start">วันแก้ไขรายงาน</option>
                                    <option <?php echo $text2 ?> value="date_Now">วันเริ่มสร้าง</option>
                                    <option <?php echo $text3 ?> value="date_Ext">วันหมดอายุ</option>

                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="insurance">วันที่</label>
                                <input name="date_start" type="date" value="<?php echo $date_start ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="insurance">ถึงวันที่</label>
                                <input name="date_end" type="date" value="<?php echo $date_end ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-9">
                                <div class="card ">
                                    <div class="card-header">
                                        <h3 class="card-title">ค้นหาเพิ่มเติม</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-row justify-content-center">
                                            <div class="form-group col-md-4">
                                                <label>เลือกบริษัทประกันภัย</label><br>
                                                <select name="insurance" id="insurance" class="form-control">
                                                    <?php echo $texts ?>

                                                    <?php while ($results = mysqli_fetch_assoc($query1)) : ?>
                                                        <option value="<?= $results["Corp_ID"] ?>"><?= $results["Corp_Name"] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>เลือกยี่ห้อรถ</label><br>
                                                <select name="brand" id="brand" class="form-control">
                                                    <?php echo $textx ?>
                                                    <?php while ($results = mysqli_fetch_assoc($query2)) : ?>
                                                        <option value="<?= $results["Car_ID"] ?>"><?= $results["Car_Name"] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>เลือกประเภท</label><br>
                                                <select name="type" id="type" class="form-control">
                                                    <?php echo $textz ?>
                                                    <?php while ($results = mysqli_fetch_assoc($query3)) : ?>
                                                        <option value="<?= $results["Type_ID"] ?>"><?= $results["Type_Name"] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-5">
                                <button class="btn btn-success" type="submit" name="submit" id="submit"><i class="fas fa-search" value="submit"></i></a>&nbsp;
                                    ค้นหารายละเอียด
                                </button>
                                <button class="btn btn-warning" type="button" name="restart" id="submit" onclick="window.location='page_report_search.php'"><i class="fas fa-retweet"></i></i>
                                    รีเซ็ตการค้นหา
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card" style="width: 105%;">
                <div class="card-body">
                    <a href="insert_report.php" title='Insert Data'>
                        <button type='button' class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a>



                    <table id="example1" class="table table-striped">
                        <thead class='bg-dark'>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อบริษัท</th>
                                <th>ชื่อยี่ห้อรถ</th>
                                <th>ประเภทประกัน</th>
                                <th>วันเริ่มสร้าง</th>
                                <th>วันแก้ไข</th>
                                <th>วันหมดอายุ</th>
                                <th>สถานะ</th>
                                <th>ฟังก์ชัน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = mysqli_fetch_array($result)) {
                                $car_id = array($row["Car_ID"]);
                                $carids = implode(",", $car_id);
                                $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
                                $resultc = mysqli_query($con, $sqlc);

                            ?>

                                <tr>
                                    <td><?php echo $row["Report_ID"]; ?></td>
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
                                            <span class="slider"></span>
                                        </label>

                                    </td>
                                    <td>
                                        <div class='row'>
                                            <div class="col-3">
                                                <a href="page_update.php?Report_ID_s=<?php echo $row["Report_ID"]; ?>" title='แก้ไขข้อมูล'>
                                                    <button type=button class="btn btn-warning btn-sm"><i class="far fa-edit"></i>
                                                        แก้ไข </button></a>
                                            </div>
                                            <div class="col-3">
                                                <button title='รายละเอียด' type=button class="btn btn-primary btn-sm view" name="view" value="ข้อมูล" id="<?php echo $row["Report_ID"]; ?>">
                                                    <i class="fas fa-eye"></i>
                                                    ข้อมูล</button>
                                            </div>
                                            <div class="col-3">
                                                <button title='ไฟล์' type=button class="btn btn-info btn-sm file" name="file" value="ไฟล์" id="<?php echo $row["Report_ID"]; ?>">
                                                    <i class="fas fa-folder"></i>
                                                    ไฟล์</button>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php

                    ?>
                    <script>
                        $(document).on('click', '.view', function() {
                            var Report_ID = $(this).attr("id");
                            if (Report_ID != '') {
                                $.ajax({
                                    url: "showReport.php",
                                    method: "POST",
                                    data: {
                                        Report_ID: Report_ID
                                    },
                                    success: function(data) {
                                        $('#Report_detail').html(data);
                                        $('#dataModal1').modal('show');
                                    }
                                });
                            }
                        });
                        $(document).on('click', '.file', function() {
                            var Report_ID = $(this).attr("id");
                            if (Report_ID != '') {
                                $.ajax({
                                    url: "showfile.php",
                                    method: "POST",
                                    data: {
                                        Report_ID: Report_ID
                                    },
                                    success: function(data) {
                                        $('#File_detail').html(data);
                                        $('#dataModal2').modal('show');
                                    }
                                });
                            }
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
                </div>
            </div>

            <!-- Modal content-->
            <div id="dataModal1" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>รายละเอียดของประกัน<h5>
                        </div>
                        <div class="modal-body" id="Report_detail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <div id="dataModal2" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>ไฟล์ต่างๆ<h5>
                        </div>
                        <div class="modal-body" id="File_detail">
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
</script>