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
    $query = mysqli_query($link, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Show file</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="dist/css/myCSS.css">
    <script src="dist/css/myCSS.css"></script>

</head>

<body>


    <div class="form-row">
        <div class="form-group col-md-12">
            <a href="page_insert.php?id=<?php echo $ids  ?>" title='เพิ่มไฟล์'>
                <button type=button class="btn btn-info">เพิ่มไฟล์ <i class="fas fa-plus-circle"></i></button><br><br>
            </a>
            <table id="Table" class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อไฟล์</th>
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
                            <td>
                                <a href="download.php?id=<?php echo $row["File_ID"] ?>" title="ดาวน์โหลดไฟล์">
                                    <button type=button class="btn btn-dark btn-sm"><i class="fas fa-download"></i>
                                    </button></a>
                               
                                <a  href="delete_file.php?id=<?php echo $row["File_ID"]; ?>&submit=DEL" onclick="return confirm('ต้องการจะลบไฟล์นี้หรือไม่ ?')" title='ลบไฟล์'>
                                    <button type=button class="btn btn-dark btn-sm"><i class="fas fa-trash-alt"></i>
                                    </button></a>

                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>

            <?php
            ?>

        </div>
    </div>

</body>

</html>