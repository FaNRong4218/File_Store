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

    <title>AdminLTE 3 | Insurance</title>

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
            <a href="insert_insurance.php" title='เพิ่มข้อมูล'>
                <button type=button class="btn btn-info">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a>

            <?php
            include_once 'connect.php';
            $sql = "SELECT * FROM insurance ;";
            $result = mysqli_query($link, $sql);

            ?>
            <?php


            if (mysqli_num_rows($result) > 0) {
            ?>
                <table id="Table" class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>รูป Logo</th>
                            <th>ลำดับ</th>
                            <th>ชื่อประกัน</th>
                            <th>วันที่สร้าง</th>
                            <th>สถานะ</th>
                            <th>ฟังก์ชัน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td>

                                    <img src="img/brand_insurance/<?php echo $row["Corp_img"]; ?>" width="80">

                                </td>
                                <td><?php echo $row["Corp_ID"]; ?></td>
                                <td><?php echo $row["Corp_Name"]; ?></td>
                                <td><?php echo $row["Corp_Date"]; ?></td>
                                <td> <?php if ($row["Corp_Status"] == 'on') {
                                            $color = "btn btn-success btn-sm";
                                            $text = "on";
                                        } else {
                                            $color = "btn btn-danger btn-sm";
                                            $text = "off";
                                        }
                                        ?>
                                    <a href="change_status.php?statusI=<?php echo $row["Corp_Status"] ?>&idI=<?php echo $row["Corp_ID"] ?>">
                                        <button type=button class="<?php echo $color ?>"><?php echo $text ?></button></a>
                                </td>
                                <td><a href="update_insurance.php?Corp_ID=<?php echo $row["Corp_ID"]; ?>" title='แก้ไขข้อมูล'>
                                        <button type=button class="btn btn-dark btn-sm"> <i class="far fa-edit"></i>
                                        </button></a>&nbsp;
                                </td>
                            </tr>
                        <?php
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