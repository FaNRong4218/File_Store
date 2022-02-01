<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include_once 'connect.php';
$submit = $_GET['submit'];

if ($submit=="DEL") {
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
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

if ($submit=="DEL_s") {
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
 } else {
     echo "Error deleting record: " . mysqli_error($con);
 }
mysqli_close($con);
?>