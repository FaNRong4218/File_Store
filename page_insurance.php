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

    <title>Insurance</title>

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
    <script src="dist/css/myCSS.css"></script>

    <style>
        img {
            border-radius: 50%;
        }
    </style>
</head>

<?php
include "menu.php";
?>


<div class="content-wrapper">
    <div style="margin-left:4%; padding-top :4%;">
        <div class="container my-6">
            <div class="card">
                <h2 class="card-header bg-danger">บริษัทประกัน</h2>
                <div class="card-body ">
                    <a href="page_insert.php?Insurance=1" title='เพิ่มข้อมูล'>
                        <button type=button class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a>
                    <?php
                    include_once 'connect.php';
                    $sql = "SELECT * FROM insurance ORDER BY Corp_ID desc;";
                    $result = mysqli_query($con, $sql);

                    ?>
                    <?php


                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table id="example1" class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>รูป Logo</th>
                                    <th>ลำดับ</th>
                                    <th hidden>Corp_ID</th>
                                    <th>ชื่อประกัน</th>
                                    <th>วันที่สร้าง</th>
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
                                        <td><?php if ($row["Corp_img"] != 'none.jpg') {
                                                $scr = 'myImg/insurance/';
                                            } else {
                                                $scr = 'myImg/insurance/default_img/';
                                            } ?>
                                            <img src="<?php echo $scr; ?><?php echo $row["Corp_img"]; ?>" width="100px">

                                        </td>
                                        <td><?php echo $i; ?></td>
                                        <td hidden><?php echo $row["Corp_ID"]; ?></td>
                                        <td><?php echo $row["Corp_Name"]; ?></td>
                                        <td><?php echo $row["Corp_Date"]; ?></td>
                                        <td> <?php if ($row["Corp_Status"] == 'on') {
                                                    $text = "checked";
                                                } else {
                                                    $text = "";
                                                }
                                                ?>
                                            <label class="switch">
                                                <input type="checkbox" <?php echo $text ?> class="change" name="change" id="<?php echo $row["Corp_ID"] ?>">
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td><a href="page_update.php?Corp_ID=<?php echo $row["Corp_ID"]; ?>" title='แก้ไขข้อมูล'>
                                                <button class="btn btn-warning btn-sm"> <i class="far fa-edit"></i>
                                                    แก้ไข</button></a>&nbsp;
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
                    <script>
                        $(document).on('click', '.change', function() {
                            var Corp_ID = $(this).attr("id");
                            if (Corp_ID != '') {
                                $.ajax({
                                    url: "Change_status.php",
                                    method: "POST",
                                    data: {
                                        Corp_ID: Corp_ID
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