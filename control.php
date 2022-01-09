<?php
include_once 'connect.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$id = $_SESSION['id'];
if (empty($id)) {
    header('Location:login.php');
}
if ($_SESSION['type'] !== 'admin') {
    echo "<script type='text/javascript'>alert('You have no permission to access this page');
    window.location.href='logout.php';</script>";
}
$sql = "SELECT * FROM user WHERE id= $id ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);


$sqlp = "SELECT * FROM user_role  ";
$resultp = mysqli_query($link, $sqlp);

$order = 1;

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

    <title>Setting</title>

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

<?php
include "menu.php";
?>
<?php
if (isset($_POST['but_update'])) { //ถ้ามีการกดปุ่ม savedata
    if (isset($_POST['update'])) { //ถ้ามีการกด checkbox[]
        foreach ($_POST['update'] as $updateid) { //รันค่า id ที่เลือกมาจาก checkbox[] ของแต่ละตัว 

            $role = implode(",", $_POST['role']); //แยกค่าข้อมูลที่อยู่ใน array ของ role 

            $update = "UPDATE user_role SET 
                        role='" . $role . "'
                    WHERE id=" . $updateid;
            mysqli_query($link, $update);
            header('location:control.php');
        }
    }
}

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="text-transform: uppercase">Control Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="control.php" style="text-transform: uppercase">Control Setting</a></li>
                        <li class="breadcrumb-item active" style="text-transform: uppercase">Control Setting</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            <div class="row">
                <div class="offset-1 col-10">
                    <form action="" method="post">
                        <div class="card card-dark">
                            <div class=" card-header">
                                <h3 class="card-title ">Setting Roles</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover text-md-center">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='checkAll'> CheckAll</th>
                                            <th>No</th>
                                            <th>Page</th>
                                            <th>Admin</th>
                                            <th>Employee</th>
                                            <th>Member</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div class="form-group">
                                            <?php
                                            $sqlc = "SELECT * FROM user_role ";
                                            $resultc = mysqli_query($link, $sqlc);
                                            while ($rowc = mysqli_fetch_assoc($resultc)) {
                                                $idr = $rowc['id'];
                                                $role_arr = array("admin$idr", "employee$idr", "member$idr");
                                               
                                            ?>

                                                <tr>
                                                    <td><input type='checkbox' name='update[]' value='<?= $idr ?>'></td>
                                                    <td><?php echo $order++; ?></td>
                                                    <td><label for="page"><?php echo $rowc['page']; ?></label></td>
                                                    <?php
                                                    $role = explode(",", $rowc['role']); //array
                                                    foreach ($role_arr as $value) {
                                                        if (in_array($value, $role)) {
                                                            echo " <td><input  type='checkbox' name='role[]' value='$value' checked></td>";
                                                            echo " <input type='hidden' name='role[]' value='0'>";
                                                        } else {
                                                            echo " <td><input  type='checkbox' name='role[]' value='$value' ></td>";
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                            <?php  } ?>
                                        </div>
                                    </tbody>
                                    <input type="submit" name="but_update" class="btn btn-warning mb-3 d-block" value="Save Data">
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </section>

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



<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
<script>
    $(document).ready(function() {

        // Check/Uncheck ALl
        $('#checkAll').change(function() {
            if ($(this).is(':checked')) {
                $('input[name="update[]"]').prop('checked', true);
            } else {
                $('input[name="update[]"]').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });

        // Checkbox click
        $('input[name="update[]"]').click(function() {
            var total_checkboxes = $('input[name="update[]"]').length;
            var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

            if (total_checkboxes_checked == total_checkboxes) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    });
</script>
</body>

</html>