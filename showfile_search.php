<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
if (isset($_POST["Report_ID"])) {
    include_once 'connect.php';
    $ids = $_POST["Report_ID"];

    $sql = "SELECT * FROM file WHERE Report_ID='$ids'";
    $query = mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Show file</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            font-size: 14px;
        }
    </style>
</head>

<body>


    <div class="form-row">
        <div class="form-group col-md-12">
            <a href="page_insert.php?ids=<?php echo $ids  ?>" title='เพิ่มไฟล์'>
                <button type=button class="btn btn-info">เพิ่มไฟล์ <i class="fas fa-plus-circle"></i></button><br><br>
            </a>
            <div class="control_tb" style ='overflow-y:scroll;'>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อไฟล์</th>
                        <th>วันที่เพิ่มไฟล์</th>
                        <th>ฟังก์ชัน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td hidden><?php echo $row["File_ID"]; ?></td>
                            <td><?php echo $row["File_Name"]; ?></td>
                            <td><?php echo $row["File_Date"]; ?></td>
                            <td>
                                <div class='row'>
                                    <div class='col-5'>
                                        <a href="download.php?id=<?php echo $row["File_ID"] ?>" title="ดาวน์โหลดไฟล์">
                                            <button type=button class="btn btn-success btn-sm"><i class="fas fa-download"></i>
                                            </button></a>
                                    </div>
                                    <div class='col-5'>
                                        <a href="delete_file.php?id=<?php echo $row["File_ID"]; ?>&submit=DEL_s" onclick="return confirm('ต้องการจะลบไฟล์นี้หรือไม่ ?')" title='ลบไฟล์'>
                                            <button type=button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                            </button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
                </div> 
            <?php
            ?>

        </div>
    </div>

</body>

</html>
<!-- <script>
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
</script> -->