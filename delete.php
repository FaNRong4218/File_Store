<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include_once 'connect.php';

//delete user
if ($_GET["submit"] == "1" && $_GET["id"] != $_SESSION["id"]) {
    $id = $_GET["id"];
    $submit = $_GET["submit"];
    $sql = "DELETE FROM user WHERE id=$id";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ')";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    }
}
//หากลบไอดีของตนเอง
if ($submit == "1" && $id == $_SESSION["id"]) {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่สามารถลบไอดีตัวเองได้ กลับสู่หน้า เข้าสู่ระบบ')";
    echo "window.location = 'page_user.php';";
    echo "</script>";
    // header("location:");

}

//ลบ report หน้าเพิ่มเอกสาร
if ($_GET["submit"] == "2") {
    $id = $_GET["Report_ID"];
    $sql = "DELETE FROM report WHERE Report_ID= $id;";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location = 'page_report.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_report.php';";
        echo "</script>";
    }
}

//ลบไฟล์ ของ เพิ่มเอกสาร
if ($_GET["submit"] == "3") {
    $id = $_GET["Report_ID_s"];
    $sql = "DELETE FROM report WHERE Report_ID= $id;";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location = 'page_report_search.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_report_search.php';";
        echo "</script>";
    }
}



//ลบไฟล์ ของ เพิ่มเอกสาร
if ($_GET["submit"] == "4") {
    //เลือกไฟล์เก่าจากฐานข้อมูล
    $sqlD = "SELECT File_Name FROM file WHERE File_ID='" . $_GET["id"] . "'";
    $queryD = mysqli_query($con, $sqlD);
    foreach ($queryD as $value) {
        $fileD = $value['Car_Img'];
    }
    //ลบรูปไฟล์เก่าในโฟเดอร์
    chmod('brand', 0777);
    $del_file = "myFile/$fileD";
    @unlink($del_file);

    $sql = "DELETE FROM file WHERE File_ID='" . $_GET["id"] . "'";
    mysqli_query($con, $sql);
    header("location: page_report.php");
    exit();
}
// else {
//     echo "Error deleting record: " . mysqli_error($con);
// }
//ลบไฟล์ หน้า ค้นหาเอกสาร
if ($_GET["submit"] == "5") {
    //เลือกไฟล์เก่าจากฐานข้อมูล
    $sqlD = "SELECT File_Name FROM file WHERE File_ID='" . $_GET["id"] . "'";
    $queryD = mysqli_query($con, $sqlD);
    foreach ($queryD as $value) {
        $fileD = $value['Car_Img'];
    }
    //ลบรูปไฟล์เก่าในโฟเดอร์
    chmod('brand', 0777);
    $del_file = "myFile/$fileD";
    @unlink($del_file);

    $sql = "DELETE FROM file WHERE File_ID='" . $_GET["id"] . "'";
    mysqli_query($con, $sql);
    header("location: page_report_search.php");
    exit();
}

//ลบยี่ห้อรถยนต์
if ($_GET["submit"] == "6") {
    $id = $_GET["Car_ID"];
    $submit = $_GET["submit"];
    $sql = "DELETE FROM brand WHERE Car_ID=$id";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location = 'page_brand.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_brand.php';";
        echo "</script>";
    }
}
//ลบบริษัทประกันภัย
if ($_GET["submit"] == "7") {
    $id = $_GET["Corp_ID"];
    $submit = $_GET["submit"];
    $sql = "DELETE FROM insurance WHERE Corp_ID=$id";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location = 'page_insurance.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_insurance.php';";
        echo "</script>";
    }
}
//ลบประเภทบริษัทประกันภัย
if ($_GET["submit"] == "8") {
    $id = $_GET["Type_ID"];
    $submit = $_GET["submit"];
    $sql = "DELETE FROM type WHERE Type_ID=$id";
    $delete = mysqli_query($con, $sql);
    if ($delete) {
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location = 'page_type.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด')";
        echo "window.location = 'page_type.php';";
        echo "</script>";
    }
}


?>