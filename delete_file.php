<?php
include_once 'connect.php';
$submit = $_GET['submit'];

if ($submit=="DEL") {
   $sql = "DELETE FROM file WHERE File_ID='" . $_GET["id"] . "'";
   mysqli_query($link, $sql);
   header("location: page_report.php");
   exit();
} else {
    echo "Error deleting record: " . mysqli_error($link);
}
mysqli_close($link);
?>