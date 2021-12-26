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


if ($submit =="DEL" && $id != $_SESSION["id"] ) {
   $sql = "DELETE FROM user WHERE id='" . $_GET["id"] . "'";
   mysqli_query($link, $sql);
   echo "<script type='text/javascript'>";
   echo "alert('ลบผู้ใช้สำเร็จ')";
   echo "window.location = 'page_user.php';";
   echo "</script>";
}
 else if($submit =="DEL" && $id == $_SESSION["id"] ) {
    echo "<SCRIPT> //not showing me this
        alert('คุณไม่สามารถลบไอดีตัวเองได้ กลับสู่หน้า เข้าสู่ระบบ')
        window.location.replace(' logout.php');
    </SCRIPT>";
    // header("location:");
   exit();
}
else{
echo "Error deleting record: " . mysqli_error($link);
}

?>