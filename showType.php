<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php  
 if(isset($_POST["Type_ID"]))  //รับค่า Type_ID
 {  
    include_once 'connect.php';
    $id = $_POST['Type_ID'];
    $sql = "SELECT * FROM type WHERE Type_ID= $id";
    $result = mysqli_query($link, $sql);

    foreach ($result as $value) {
        $detail = $value['Type_detail'];
    }
    echo $detail ;
 }