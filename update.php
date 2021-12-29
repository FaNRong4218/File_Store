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
    $status = $_POST['Status'];
    $file = $_FILES['img']['name'];
    if ($file == "") {
        $sql = "UPDATE brand set  Car_Name=' $Name', Car_Status='$status'
        WHERE Car_ID = $id";

        $stmt = mysqli_query($link, $sql);

        if ($stmt) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_brand.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    } else {

        $sql2 = "UPDATE brand set  Car_Name=' $Name', Car_Img='$file', Car_Status='$status'
                 WHERE Car_ID = $id";

        $stmt2 = mysqli_query($link, $sql2);

        if ($stmt2) {

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
    $status = $_POST['Status'];
    $file = $_FILES['img']['name'];
    if ($file == "") {
        $sql = "UPDATE insurance set  Corp_Name=' $Name' , Corp_Status='$status'
        WHERE Corp_ID = $id";

        $insert1 = mysqli_query($link, $sql);

        if ($insert1) {

            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_insurance.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    } else {

        $sql2 = "UPDATE insurance set  Corp_Name=' $Name', Corp_Date='$date', Corp_img='$file', Corp_Status='$status'
        WHERE Corp_ID = $id";

        $insert2 = mysqli_query($link, $sql2);

        if ($insert2) {

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
        $brand_id = $_POST['Car_ID'];
        $status = $_POST['status'];
        $detail = $_POST['detail'];
        $date_now = $_POST['date_now'];
        $date_ext = $_POST['date_ext'];
        $status = $_POST['status'];

        $sqls = "UPDATE report SET Corp_ID=' $corp_id', Type_ID=' $type_id', Car_ID=' $brand_id', Report_Status='$status',Report_Detail='$detail',
         Date_Now='$date_now',Date_ext='$date_ext',Report_Status = '$status'
         WHERE Report_ID = $id";
        $stmt = mysqli_query($link, $sqls);
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

    $stmt = mysqli_query($link, $sql);

    if ($stmt) {

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
            mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
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
            mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
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
            mysqli_query($link, "UPDATE user set  user='" . $_POST['user'] . "', name='" . $_POST['name'] . "', email='" . $_POST['email'] . "' ,
                     tel='" . $_POST['tel'] . "',type='" . $_POST['type'] . "' WHERE id='" . $_POST['id'] . "'");
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "window.location = 'page_user.php';";
            echo "</script>";
        }
    }
}