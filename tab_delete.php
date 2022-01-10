<?php
 include_once 'connect.php';

$id = $_GET['id'];

echo $id;

$sql ="DELETE FROM user_role WHERE id = $id";
$result = mysqli_query($con,$sql);

if($result){
    echo '<script> window.location.href = "control.php";</script>';
} 

?>
