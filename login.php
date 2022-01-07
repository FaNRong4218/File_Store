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

        if ($stmt = mysqli_prepare($link, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $type, $name, $email,$tel);
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
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-size: 20px;
        }

        h1 {
            font-family: 'Kanit', sans-serif;
            font-size: 30px;
            color: #FFFFFF;
        }
        h2 {
            font-family: 'Kanit', sans-serif;
            font-size: 25px;
            color: #FFFFFF;
        }
        input{
            font-family: 'Kanit', sans-serif;
            font-size: 25px;
        }
    </style>

</head>

<body class="hold-transition login-page">

    <div class="card" style="width: 25%;">
        <div class="card-body login-card-body" style="background:  #519CFE;">
            <div class="text-center">
                <h1>Log in</h1>
            </div>
        </div>

        <div class="card-body login-card-body">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="text-left">
                    <div class="row">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>User</label>
                            <input type="text" name="user" class="form-control" value="<?php echo $username; ?> ">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" style="width: 25%;" value="Login">
                        </div>
                    </div>
                    
                    </div>

                    <p>&nbsp;</p>
                </div>
                <div class="card-body login-card-body" style="background:  #519CFE;">
                        <div class="text-center">
                            <h2>ไม่มี Account <a style="color: #FEE651;" href="register.php">สมัครที่นี่</a>.</h2>
                        </div>
        </div>
        </form>


    </div>
    </div>

</body>

</html>