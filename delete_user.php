<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include_once 'connect.php';
$id = $_GET["id"];
$submit = $_GET["submit"];


if ($submit =="1" && $id != $_SESSION["id"] ) {
   $sql = "DELETE FROM user WHERE id=$id";
    mysqli_query($con, $sql);
    header("location: page_user.php");
    exit();
   
}
 else if($submit =="1" && $id == $_SESSION["id"] ) {
   echo "<script type='text/javascript'>";
   echo "alert('คุณไม่สามารถลบไอดีตัวเองได้ กลับสู่หน้า เข้าสู่ระบบ')";
   echo "window.location = 'page_user.php';";
   echo "</script>";
    // header("location:");
   exit();
}
else{
echo "Error deleting record: " . mysqli_error($con);
}

?>