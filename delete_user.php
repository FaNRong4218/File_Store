<?php
include_once 'connect.php';
$sql = "DELETE FROM user WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($link, $sql)) {
    
   header("location: page_user.php");
   exit();
} else {
    echo "Error deleting record: " . mysqli_error($link);
}
mysqli_close($link);
?>