<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
require_once "connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["user"]))) {
        $username_err = "กรุณากรอกไอดีผู้ใช้(Username)";
    } else {

        $sql = "SELECT id FROM user WHERE user = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);


            $param_username = trim($_POST["user"]);


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "มีไอดีผู้ใช้งานนี้แล้วในระบบ";
                } else {
                    $username = trim($_POST["user"]);
                }
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }


            mysqli_stmt_close($stmt);
        }
    }


    if (empty(trim($_POST["pass"]))) {
        $password_err = "กรุณากรอกรหัสผ่าน";
    } elseif (strlen(trim($_POST["pass"])) < 6) {
        $password_err = "รหัสผ่านจำเป็นต้องมี 6 ตัว ขั้นไป";
    } else {
        $password = trim($_POST["pass"]);
    }

    if (empty(trim($_POST["confirm_pass"]))) {
        $confirm_password_err = "กรุณากรอกยืนยันรหัสผ่าน";
    } else {
        $confirm_password = trim($_POST["confirm_pass"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "รหัสผ่านไม่ตรงกัน";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $type = $_POST['type'];

        $sql = "INSERT INTO user (user, pass, name, email, tel,type) VALUES (?, ?,'$name','$email','$tel','$type')";

        if ($stmt = mysqli_prepare($con, $sql)) {

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);


            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {

                header("location: page_user.php");
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }


            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Registion</title>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
    <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
    <script src="dist/css/myCSS.css"></script>

</head>



<body>

    <?php
    include "menu.php";
    ?>

    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <div class="card-body">
                    <h2>สมัครสมาชิก</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <label>ไอดีผู้ใช้</label>
                                    <input type="text" name="user" class="form-control" value="<?php echo $username; ?>">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ชื่อ</label>
                                    <input type="text" name="name" class="form-control" value="" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>รหัสผ่าน</label>
                                    <input type="password" name="pass" class="form-control" value="<?php echo $password; ?>">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group col-md-4<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <label>ยืนยันรหัสผ่าน</label>
                                    <input type="password" name="confirm_pass" class="form-control" value="<?php echo $confirm_password; ?>">
                                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>อีเมล</label>
                                    <input type="email" name="email" class="form-control" value="" required="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input type="tel" name="tel" class="form-control" value="" maxlength="10" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>ประเภท</label><br>
                                    <label class="radio-inline"><input type="radio" value="member" name="type" checked>Member</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="submit" class="btn btn-primary" value="ยืนยัน">
                                    <input type="reset" class="btn btn-default" value="รีเซ็ต">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</body>


</html>