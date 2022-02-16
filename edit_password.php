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

    <title>Reset-user-password</title>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
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
</head>

<?php
require_once "menu.php";
require_once "connect.php";
?>
<?php
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$ids =  $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "กรุณากรอกพาสเวิร์ดใหม่";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "รหัสผ่านต้องมีอักษรมากกว่า 6 ตัว";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "กรุณากรอกยืนยันพาสเวิร์ด";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "พาสเวิร์ดไม่ตรงกัน";
        }
    }

    if (empty($new_password_err) && empty($confirm_password_err)) {

        $sql = "UPDATE user SET pass = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {

            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_POST["ids"];

            if (mysqli_stmt_execute($stmt)) {

                echo "<script type='text/javascript'>";
                echo "alert('แก้ไขรหัสผ่านสำเร็จ');";
                echo "window.location = 'page_user.php';";
                echo "</script>";
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }
        }
    }
}
?>

<div class="content-wrapper">
    <div class="row">
        <div class="offset-3 col-md-6">
            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">เปลี่ยนพาสเวิร์ดของผู้ใช้ : <?php echo $_GET["name"]; ?></h3>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                        <input hidden type="text" name="ids" class="form-control" value="<?php echo  $_GET["id"]; ?>">
                            <label for="exampleInputEmail1">พาสเวิร์ดใหม่</label>
                            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                            <span style='color: red;' class="help-block"><?php echo $new_password_err; ?></span>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">ยืนยันพาสเวิร์ด</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <span style='color: red;' class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary d-block m-auto">บันทึก</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->


            </form>
        </div>
    </div>
</div>
</body>

</html>