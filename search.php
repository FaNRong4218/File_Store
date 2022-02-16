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

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/css/myCSS.css"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <style>
        img {
            border-radius: 50%;
        }
    </style>
</head>

<?php
include_once "menu.php";
include_once 'connect.php';

?>
<?php


//รับค่าจากตัวเลือกค้นหา
$date = $_POST['date'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
$insurance = $_POST['insurance'];
$brand = $_POST['brand'];
$type = $_POST['type'];


//แสดงตัวเลือกต่างๆ
$sql1 = "SELECT * FROM insurance WHERE Corp_Status = 'on'";
$query1 = mysqli_query($con, $sql1);
$sql2 = "SELECT * FROM brand WHERE Car_Status = 'on'";
$query2 = mysqli_query($con, $sql2);
$sql3 = "SELECT * FROM type WHERE Type_Status = 'on'";
$query3 = mysqli_query($con, $sql3);


if ($date == '' && $date_start == '' && $date_end == '' && $insurance == '' && $brand == '' && $type == '') {
    echo "<script type='text/javascript'>";
    echo "window.location = 'page_report_search.php';";
    echo "</script>";
} else {


    date_default_timezone_set("Asia/Bangkok");
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

    $utype = $_SESSION['type'];
    $uid = $_SESSION['id'];

    
    //กำหนด sql เริ่มต้น
    $sqls = "SELECT Report_ID, insurance.Corp_Name, brand.Car_Name, type.Type_Name, Report_Status,
                            Date_Now,  Date_Ext, Date_Start,report.Car_ID , user.name,insurance.Corp_img
                            FROM report 
                            LEFT JOIN user ON  user.id = report.User_ID
                            LEFT JOIN insurance ON insurance.Corp_ID = report.Corp_ID
                            LEFT JOIN brand ON brand.Car_ID = report.Car_ID
                            LEFT JOIN type ON  type.Type_ID = report.Type_ID";
    $sql = $sqls;

    if (count($conditions) > 0) { //มีค่าค้นหามากกว่า 1

        if ($utype == 'employee') {
            $wtype = "AND user.type != 'admin'";
        } else if ($utype == 'member') {
            $wtype  = "AND  user.type = 'member' AND user.id = $uid";
        } else {
            $wtype  = "";
        }

        $sql .= " WHERE " . implode(' AND ', $conditions) . $wtype;
        $sql = $sql . ' ORDER BY report.Date_Now DESC';
    } else { 

        if ($utype == 'employee') {
            $wtype_s = " WHERE user.type != 'admin'";
        } else if ($utype == 'member') {
            $wtype_s  = " WHERE user.type = 'member' AND user.id = $uid";
        } else {
            $wtype  = "";
        }

        $sql = $sqls . $wtype_s . ' ORDER BY report.Date_Now DESC';
    }

    $result = mysqli_query($con, $sql);
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card " style="width: auto;">
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
                            <input name="date_start" type="datetime-local" value="<?php echo $date_start ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="insurance">ถึงวันที่</label>
                            <input name="date_end" type="datetime-local" value="<?php echo $date_end ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-9">
                            <div class="card collapsed-card">
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
                                                <option value=''>ไม่เลือกบริษัทประกันภัย</option>
                                                <?php foreach ($query1 as $value) {  ?>
                                                    <option value="<?php echo $value['Corp_ID'] ?>" <?php if ($value['Corp_ID'] == $insurance) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $value['Corp_Name']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>เลือกยี่ห้อรถ</label><br>
                                            <select name="brand" id="brand" class="form-control">
                                                <option value=''>ไม่เลือกยี่ห้อรถ</option>
                                                <?php foreach ($query2 as $value) {  ?>
                                                    <option value="<?php echo $value['Car_ID'] ?>" <?php if ($value['Car_ID'] == $brand) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $value['Car_Name']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>เลือกประเภท</label><br>
                                            <select name="type" id="type" class="form-control">
                                                <option value=''>ไม่เลือกประเภท</option>
                                                <?php foreach ($query3 as $value) {  ?>
                                                    <option value="<?php echo $value['Type_ID'] ?>" <?php if ($value['Type_ID'] == $type) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $value['Type_Name']; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                    </div>
                    <div class="form-row justify-content-center">

                        <button class="btn btn-success" type="submit" name="submit" id="submit"><i class="fas fa-search" value="submit"></i></a>
                            ค้นหารายละเอียด
                        </button>&nbsp;&nbsp;


                        <button class="btn btn-warning" type="button" name="restart" id="submit" onclick="window.location='page_report_search.php'"><i class="fas fa-retweet"></i></i>
                            รีเซ็ตการค้นหา
                        </button>

                    </div>
                </form>
            </div>
        </div>
        <div class="card" style="width: auto;">
            <div class="card-body">
                <!-- <a href="insert_report.php" title='Insert Data'>
                        <button type='button' class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a> -->



                <table id="example2" class="table table-striped">
                    <thead class='bg-dark'>
                        <tr>
                            <th>No</th>
                            <th>ชื่อบริษัท</th>
                            <th>ชื่อยี่ห้อรถ</th>
                            <th>ประเภทประกัน</th>
                            <th>วันเริ่มสร้าง</th>
                            <th>วันแก้ไข</th>
                            <th>วันหมดอายุ</th>
                            <th>ผู้ลงเอกสาร</th>
                            <th>สถานะ</th>
                            <th>ฟังก์ชัน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = mysqli_fetch_array($result)) {
                            //นับจำนวนไฟล์
                            $r_id = $row['Report_ID'];
                            $sql_s = "SELECT * FROM file WHERE Report_ID =  $r_id";
                            $result_s = mysqli_query($con, $sql_s);
                            $numfile = mysqli_num_rows($result_s);

                            //เลือกข้อมูลของยี่ห้อรถ
                            $car_id = array($row["Car_ID"]);
                            $carids = implode(",", $car_id);
                            $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
                            $resultc = mysqli_query($con, $sqlc);

                        ?>

                            <tr>
                                <td><?php echo $row["Report_ID"]; ?></td>
                                <td>
                                    <?php if ($row["Corp_img"] != 'none.jpg') {
                                        $scr = 'myImg/insurance/';
                                    } else {
                                        $scr = 'myImg/insurance/default_img/';
                                    } ?>
                                    <img src="<?php echo $scr; ?><?php echo $row["Corp_img"]; ?>" width="70px"> <br>
                                    <?php echo $row["Corp_Name"]; ?>
                                </td>
                                <td><?php foreach ($resultc as $value) {
                                        echo $value["Car_Name"] . "  ";
                                    } ?></td>
                                <td><?php echo $row["Type_Name"]; ?></td>
                                <td><?php echo $row["Date_Start"]; ?></td>
                                <td><?php echo $row["Date_Now"]; ?></td>
                                <td><?php echo $row["Date_Ext"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td>
                                    <?php
                                    //member ไม่สามารถเปลี่ยน สเตตัส ได้ 
                                    // if ($_SESSION['type'] == 'member') {
                                    //     $text_dis = "disabled";
                                    // } else {
                                    //     $text_dis = "";
                                    // }
                                    ?>
                                    <?php if ($row["Report_Status"] == 'on') {
                                        $text = "checked";
                                    } else {
                                        $text = "";
                                    }
                                    ?>
                                    <label class="switch">
                                        <input type="checkbox" <?php echo $text ?> <?php //สำหรับ member //echo $text_dis 
                                                                                    ?> class="change" name="change" id="<?php echo $row["Report_ID"] ?>">
                                        <span class="slider round"></span>
                                    </label>

                                </td>
                                <td>
                                    <div class='form-row'>
                                        <div class='col-auto col-sm-auto'>
                                            <a type=button class="btn btn-warning btn-sm rounded-pill" href="page_update.php?Report_ID_s=<?php echo $row["Report_ID"]; ?>" title='แก้ไขข้อมูล'>
                                                <i class="far fa-edit"></i>
                                                แก้ไข</a>
                                        </div>
                                        <div class='col-auto col-sm-auto'>
                                            <button title='รายละเอียด' type=button class="btn btn-primary btn-sm rounded-pill view " name="view" value="ข้อมูล" id="<?php echo $row["Report_ID"]; ?>">
                                                <i class="fas fa-eye"></i>
                                                ดู</button>
                                        </div>
                                        <div class='col-auto col-sm-auto'>
                                            <button title='ไฟล์' type="button" class="btn btn-info btn-sm rounded-pill file" name="file" value="ไฟล์" id="<?php echo $row["Report_ID"]; ?>">
                                                <span class="badge badge-pill badge-light"><?php echo $numfile ?></span> ไฟล์</button>
                                        </div>
                                        <div class='col-auto col-sm-auto'>
                                            <a type=button class="btn btn-danger btn-sm rounded-pill" href="delete.php?Report_ID_s=<?php echo $row["Report_ID"]; ?>&submit=3" onclick="return confirm('ต้องการจะลบเอกสารนี้หรือไม่ ?')" title='แก้ไขข้อมูล'>
                                                <i class="fas fa-trash-alt"></i>
                                                ลบ</a>
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
                                url: "change_status.php",
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
        <div id="dataModal1" class="modal fade">
            <div class="modal-dialog">

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
        <div id="dataModal2" class="modal fade">
            <div class="modal-dialog modal-lg">

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
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>