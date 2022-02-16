<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
require_once "connect.php";
?>
<?php

if (isset($_GET['brand']) == 1) {
  $Name = $_POST['Name'];
  $status = $_POST['Status'];
  $file = $_FILES['img']['name'];

  $files = pathinfo($file, PATHINFO_FILENAME);

  $nameDate = date('Ymd'); //เก็บวันที่
  $path = "myImg/brand/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
  date_default_timezone_set('Asia/Bangkok');
  $numrand = (mt_rand(1000, 9999));

  if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $nameDate . $numrand . $files . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ
    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    $sql = "INSERT INTO brand (Car_Name, Car_Status, Car_Img)
        VALUES ('$Name', '$status', '$newname' )";

    $insert = mysqli_query($con, $sql);
  } else {
    $sql = "INSERT INTO brand (Car_Name, Car_Status, Car_Img)
    VALUES ('$Name', 'off', 'none.png' )";

    $insert = mysqli_query($con, $sql);
  }
  if ($insert) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'page_brand.php';";
    echo "</script>";
  } else {
    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
  }
}
if (isset($_GET['insurance']) == 1) {
  $Name = $_POST['Name'];
  $date = $_POST['Date'];
  $status = $_POST['Status'];
  $file = $_FILES['img']['name'];

  $files = pathinfo($file, PATHINFO_FILENAME);

  $nameDate = date('Ymd'); //เก็บวันที่
  $path = "myImg/insurance/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่
  date_default_timezone_set('Asia/Bangkok');
  $numrand = (mt_rand(1000, 9999));

  if ($file != '') {
    $type = strrchr($file, "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
    $newname = $nameDate . $numrand . $files . $type; //ประกอบเป็นชื่อใหม่
    $path_copy = $path . $newname; //กำหนด path ในการเก็บ

    echo $path_copy;
    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

    $sql = "INSERT INTO insurance (Corp_Name, Corp_Date, Corp_Status, Corp_img) 
      VALUES ('$Name', '$date', '$status', '$newname' )";

    $insert = mysqli_query($con, $sql);
  } else {
    $sql = "INSERT INTO insurance (Corp_Name, Corp_Date, Corp_Status, Corp_img) 
    VALUES ('$Name', '$date', 'off', 'none.jpg' )";

    $insert = mysqli_query($con, $sql);
  }

  if ($insert) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'page_insurance.php';";
    echo "</script>";
  } else {
    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
  }
}
if (isset($_GET['Report']) == 1) { //สำหรับ report ที่มีแถบค้นหา
  $Corp_ID = $_POST['Corp_ID'];
  $Type_ID = $_POST['Type_ID'];
  $detail = $_POST['detail'];
  $date_start = $_POST['date_start'];
  $date_now = $_POST['date_now'];
  $date_ext = $_POST['date_ext'];
  $status = $_POST['status'];
  $user_id = $_SESSION['id'];
  
  if ($_POST['Car_ID'] == '') {
    echo "<script type='text/javascript'>";
    echo "alert('กรุณาเลือกยี่ห้อรถ');";
    echo "window.location = 'page_report.php';";
    echo "</script>";
  } else {
    for ($i = 0; $i < count($_POST['Car_ID']); $i++) {
      $Car_ID = implode(",", $_POST['Car_ID']);
    }
    $sql1 = "INSERT INTO report (User_ID,Corp_ID, Type_ID, Car_ID, Report_detail, Date_Start, Date_Now, Date_Ext, Report_Status ) 
    VALUES ('$user_id','$Corp_ID', '$Type_ID', '$Car_ID','$detail','$date_start','$date_now','$date_ext','$status' )";


    $insert = mysqli_query($con, $sql1);

    if ($insert) {
      echo "<script type='text/javascript'>";
      echo "alert('เพิ่มข้อมูลสำเร็จ');";
      echo "window.location = 'page_report.php';";
      echo "</script>";
    } else {
      echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
    mysqli_close($con);
  }
}
if (isset($_GET['Reports']) == 1) {
  $Corp_ID = $_POST['Corp_ID'];
  $Type_ID = $_POST['Type_ID'];
  for ($i = 0; $i < count($_POST['Car_ID']); $i++) {
    $Car_ID = implode(",", $_POST['Car_ID']);
  }
  $detail = $_POST['detail'];
  $date_start = $_POST['date_start'];
  $date_now = $_POST['date_now'];
  $date_ext = $_POST['date_ext'];
  $status = $_POST['status'];

  $sql1 = " INSERT INTO report (Corp_ID, Type_ID, Car_ID, Report_detail, Date_Start, Date_Now, Date_Ext, Report_Status ) 
    VALUES ('$Corp_ID', '$Type_ID', '$Car_ID','$detail','$date_start','$date_now','$date_ext','$status' )";


  $insert = mysqli_query($con, $sql1);

  if ($insert) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'page_report_search.php';";
    echo "</script>";
  } else {
    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
  }
  mysqli_close($con);
}
if (isset($_GET['Type']) == 1) {
  $Name = $_POST['Name'];
  $status = $_POST['Status'];
  $detail = $_POST['detail'];
  $sql = "INSERT INTO type (Type_Name, Type_Status, Type_detail) 
  VALUES ('$Name', '$status', '$detail' )";

  $insert = mysqli_query($con, $sql);

  if ($insert) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'page_type.php';";
    echo "</script>";
  } else {
    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
  }
}
if (isset($_GET['File']) == 1) { //เพิ่มไฟล์สำหรับหน้าเอกสาร

  $id = $_POST['ids'];
  $date = $_POST['date'];
  date_default_timezone_set('Asia/Bangkok');
  $nameDate = date('Ymd'); //เก็บวันที่
  $path = "myFile/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่

  date_default_timezone_set('Asia/Bangkok');
  $numrand = (mt_rand(1000, 9999));

  if ($_FILES["file"]["name"][0] == "") {
    echo "<script type='text/javascript'>";
    echo "alert('กรุณาเลือกเพิ่มไฟล์');";
    echo "window.location = 'page_report.php';";
    echo "</script>";
  } else {
    for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
      if ($_FILES["file"]["name"][$i] != "") {
        $file[$i] = $_FILES["file"]["name"][$i];
        $files[$i] = pathinfo($file[$i], PATHINFO_FILENAME);

        $type[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
        $newname[$i] = $nameDate . $numrand . $files[$i] . $type[$i]; //ประกอบเป็นชื่อใหม่
        $path_copy[$i] = $path . $newname[$i]; //กำหนด path ในการเก็บ
        move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copy[$i]);
        $sql = "INSERT INTO file (File_Name,File_Date,Report_ID) 
                     VALUES ('$newname[$i]','$date','$id' )";
        $insert = mysqli_query($con, $sql);
      }
    }

    if ($insert) {

      echo "<script type='text/javascript'>";
      echo "alert('เพิ่มข้อมูลสำเร็จ');";
      echo "window.location = 'page_report.php';";
      echo "</script>";
    } else {
      echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
  }
}
if (isset($_GET['Files']) == 1) { //เพิ่มไฟล์สำหรับหน้าค้นหาเอกสาร

  $id = $_POST['ids'];
  $date = $_POST['date'];
  date_default_timezone_set('Asia/Bangkok');
  $nameDate = date('Ymd'); //เก็บวันที่
  $path = "myFile/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่

  date_default_timezone_set('Asia/Bangkok');
  $numrand = (mt_rand(1000, 9999));

  if ($_FILES["file"]["name"][0] == "") {
    echo "<script type='text/javascript'>";
    echo "alert('กรุณาเลือกเพิ่มไฟล์');";
    echo "window.location = 'page_report.php';";
    echo "</script>";
  } else {
    for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
      if ($_FILES["file"]["name"][$i] != "") {
        $file[$i] = $_FILES["file"]["name"][$i];
        $files[$i] = pathinfo($file[$i], PATHINFO_FILENAME);

        $type[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
        $newname[$i] = $nameDate . $numrand . $files[$i] . $type[$i]; //ประกอบเป็นชื่อใหม่
        $path_copy[$i] = $path . $newname[$i]; //กำหนด path ในการเก็บ
        move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copy[$i]);
        $sql = "INSERT INTO file (File_Name,File_Date,Report_ID) 
                     VALUES ('$newname[$i]','$date','$id' )";
        $insert = mysqli_query($con, $sql);
      }
    }

    if ($insert) {

      echo "<script type='text/javascript'>";
      echo "alert('เพิ่มข้อมูลสำเร็จ');";
      echo "window.location = 'page_report_search.php';";
      echo "</script>";
    } else {
      echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
  }
}
if (isset($_GET['page']) == 1) {
  $name = $_POST['name'];
  $file = $_POST['file'];
  $icon = 'nav-icon' . " " . $_POST['icon'];

  $sql = "INSERT INTO user_role (page, link, icon)
VALUES ('$name', '$file', '$icon')";

  $insert = mysqli_query($con, $sql) or die;

  if ($insert) {
    echo '<script> window.location.href = "control.php";alert("Insert success")</script>';
  }
}
