<?php
require_once "connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["user"]))) {
        $username_err = "กรุณากรอกไอดีผู้ใช้(Username)";
    } else {

        $sql = "SELECT id FROM user WHERE user = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

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

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);


            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {

                header("location: login.php");
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }

    
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style type="text/css">
      
    </style>
</head>

<body>
<div class="content-wrapper">
    <div style="margin-left:10%; padding-top :4%;">
      <div class="container my-6">
      <h2>สมัครสมาชิก</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>ไอดีผู้ใช้</label>
                    <input type="text" name="user" class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>รหัสผ่าน</label>
                    <input type="password" name="pass" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirm_pass" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>

                <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="name" class="form-control" value=""  required="">
                </div>
                <div class="form-group ">
                    <label>อีเมล</label>
                    <input type="email" name="email" class="form-control" value=""  required="">
                </div>
                <div class="form-group">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="tel" name="tel" class="form-control" value="" maxlength="10" required="">
                </div>
                <div class="form-group">
                    <label>ประเภท</label><br>
                    <label class="radio-inline"><input type="radio" value="User" name="type" checked>User</label>

                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
                <p>คุณมีรหัสแล้วหรือไม่? <a href="login.php">เข้าสู่ระบบที่นี่</a>.</p>
            </form>
      </div>
    </div>
    </div>
     
           
</body>


</html>