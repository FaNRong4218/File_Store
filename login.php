<?php

require_once "connect.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["user"]))) {
        $username_err = "กรุณากรอกไอดีผู้ใช้งาน(Username)";
    } else {
        $username = trim($_POST["user"]);
    }


    if (empty(trim($_POST["pass"]))) {
        $password_err = "กรุณากรอกรหัสผ่าน(Password)";
    } else {
        $password = trim($_POST["pass"]);
    }


    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, user, pass, type, name, email,tel FROM user WHERE user = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;


            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $type, $name, $email, $tel);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {

                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["user"] = $username;
                            $_SESSION["type"] = $type;
                            $_SESSION["name"] = $name;
                            $_SESSION["tel"] = $tel;
                            $_SESSION["email"] = $email;

                            if ($_SESSION["type"] == "admin") {

                                Header("location:page_dashboard.php");
                            }
                            if ($_SESSION["type"] == "employee") {

                                Header("location: page_dashboard.php");
                            }


                            if ($_SESSION["type"] == "member") {

                                Header("location: page_dashboard.php");
                            }
                        } else {

                            $password_err = "รหัสผ่านไม่ถูกต้อง";
                        }
                    }
                } else {

                    $username_err = "ไม่มีไอดีผู้ใช้ในระบบ";
                }
            } else {
                echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($con);
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <style>
        <?php include 'dist/css/MyStyle.css' ?>
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>เข้าสู่ระบบ</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-line"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend ">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="user" class="form-control" placeholder="username">
                            <span class="help-block"><?php echo $username_err; ?></span>

                        </div>
                        <div class="input-group form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="pass" class="form-control" placeholder="password">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?<a href="register.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>