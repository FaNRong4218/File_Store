<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include_once 'connect.php';

if (isset($_GET['brand']) == 1) {
    $id = $_POST['ids'];
    $Name = $_POST['Name'];
    $file = $_FILES['img']['name'];
    if ($file == "") {
        $sql = "UPDATE brand set  Car_Name=' $Name''
        WHERE Car_ID = $id";

        $stmt = mysqli_query($con, $sql);

        if ($stmt) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_brand.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    } else {
        $files_v = strrev($file);
        $files_r = strrchr($files_v, ".");
        $files = strrev($files_r);
      
        $nameDate = date('Ymd'); //เก็บวันที่
        $path = "myImg/brand/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
        date_default_timezone_set('Asia/Bangkok');
        $numrand = (mt_rand(1000, 9999));
      
        if($file !=''){
        $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
        $newname = $nameDate . $numrand. $files . $type; //ประกอบเป็นชื่อใหม่
        $path_copy = $path . $newname; //กำหนด path ในการเก็บ
        move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

        $sql2 = "UPDATE brand set  Car_Name=' $Name', Car_Img='$newname'
                 WHERE Car_ID = $id";

        $update = mysqli_query($con, $sql2);
        }
        if ($update) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_brand.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    }
}
if (isset($_GET['insurance']) == 1) {
    $id = $_POST['ids'];
    $Name = $_POST['Name'];
    $file = $_FILES['img']['name'];
    if ($file == "") {
        $sql = "UPDATE insurance set  Corp_Name='$Name'
        WHERE Corp_ID = $id";

     $update  = mysqli_query($con, $sql);

        if ($update) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_insurance.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    } else {

        $files_v = strrev($file);
        $files_r = strrchr($files_v, ".");
        $files = strrev($files_r);
      
        $nameDate = date('Ymd'); //เก็บวันที่
        $path = "myImg/insurance/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
        date_default_timezone_set('Asia/Bangkok');
        $numrand = (mt_rand(1000, 9999));
      
        if($file !=''){
        $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
        $newname = $nameDate . $numrand. $files . $type; //ประกอบเป็นชื่อใหม่
        $path_copy = $path . $newname; //กำหนด path ในการเก็บ
      
        move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);
        
        $sql2 = "UPDATE insurance set  Corp_Name='$Name', Corp_img='$newname'
        WHERE Corp_ID = $id";

$update = mysqli_query($con, $sql2);
        }
        if ($update) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_insurance.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    }
}
if (isset($_GET['report']) == 1) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['ids'];
        $corp_id = $_POST['Corp_ID'];
        $type_id = $_POST['Type_ID'];
        for ($i = 0; $i < count($_POST['Car_ID']); $i++) {
            $brand_id = implode(",", $_POST['Car_ID']);
          }
        $detail = $_POST['detail'];
        $date_now = $_POST['date_now'];
        $date_ext = $_POST['date_ext'];

        $sqls = "UPDATE report SET Corp_ID=' $corp_id', Type_ID=' $type_id', Car_ID='$brand_id',Report_Detail='$detail',
         Date_Now='$date_now',Date_ext='$date_ext'
         WHERE Report_ID = $id";
        $stmt = mysqli_query($con, $sqls);
        if ($stmt) {
            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
            echo "window.location = 'page_report.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    }
}
if (isset($_GET['type']) == 1) {
    $id = $_POST['ids'];
    $Name = $_POST['Name'];
    $status = $_POST['Status'];
    $detail = $_POST['detail'];

    $sql = "UPDATE type set  Type_Name=' $Name', Type_Status='$status',Type_detail='$detail'
        WHERE Type_ID = $id";

$update = mysqli_query($con, $sql);

    if ($update) {

        echo "<script type='text/javascript'>";
        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        echo "window.location = 'page_type.php';";
        echo "</script>";
    } else {
        echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
}
if (isset($_GET['user']) == 1) {
    if ($_SESSION["type"] == "Admin") {
        if ($_POST['id'] == $_SESSION["id"]) {

            echo "<script type='text/javascript'>";
            echo "alert('คุณไม่สามารถแก้ไขข้อมูลของ admin คนอื่นได้');";
            echo "window.location = 'logout.php';";
            echo "</script>";
        } else {
            mysqli_query($con, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                             tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_user.php';";
            echo "</script>";
        }
    }
    if ($_SESSION["type"] == "User") {
        if ($_POST['id'] == $_SESSION["id"] || $_POST['type'] == "Admin" || $_POST['type'] == "Stuff" ||  $_SESSION['type'] == $_POST['type']) {
            echo "<script type='text/javascript'>";
            echo "alert('คุณไม่สามารถแก้ไขข้อมูลสถานะของ admin stuff หรือ user คนอื่นได้');";
            echo "window.location = 'logout.php';";
            echo "</script>";
        } else {
            mysqli_query($con, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                     tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_user.php';";
            echo "</script>";
        }
    }
    if ($_SESSION["type"] == "Stuff") {
        if ($_POST['id'] == $_SESSION["id"] || $_POST['type'] == "Admin" || $_SESSION['type'] == $_POST['type']) {

            echo "<script type='text/javascript'>";
            echo "alert('คุณไม่สามารถแก้ไขข้อมูลสถานะของ admin หรือ stuff คนอื่นได้');";
            echo "window.location = 'logout.php';";
            echo "</script>";
        } else {
            mysqli_query($con, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                     tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_user.php';";
            echo "</script>";
        }
    }

    
}
if (isset($_GET['page']) == 1) {
    $ids = $_POST['ids'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
   

    $sql2 = "UPDATE user_role
    SET page = '$name', link= '$link',icon = '$icon'
     WHERE id = '$ids' ";
    $update = mysqli_query($con, $sql2);

    if ($update) {

        echo "<script type='text/javascript'>";
        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        echo "window.location = 'control.php';";
        echo "</script>";
    }
    else
    {
        echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
}
