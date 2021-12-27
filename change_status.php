<?php //เปลี่ยน status ของแต่ละตาราง 
if (isset($_POST["Report_ID"])) {
    include_once 'connect.php';
    $idR = $_POST["Report_ID"];
    $sql1 = "SELECT Report_Status FROM report WHERE  Report_ID =  $idR ";
    $query1 = mysqli_query($link,$sql1);
    foreach ($query1 as $value ){
        $status = $value['Report_Status'];
    }

    if ($status == 'on') {
        $sql = "UPDATE report SET Report_Status = 'off' WHERE Report_ID ='$idR'";
        $result = mysqli_query($link, $sql);
    
    }    
    if ($status == 'off') {
        $sql = "UPDATE report SET Report_Status = 'on' WHERE Report_ID ='$idR'";
        $result = mysqli_query($link, $sql);
    }
}
if (isset($_POST["Corp_ID"])) {
    include_once 'connect.php';
    $idI = $_POST["Corp_ID"];
    $sql2 = "SELECT Corp_Status FROM insurance WHERE  Corp_ID =  $idI ";
    $query2 = mysqli_query($link,$sql2);
    foreach ($query2 as $value ){
        $status = $value['Corp_Status'];
    }

    if ($status == 'on') {
        $sql = "UPDATE insurance SET Corp_Status = 'off' WHERE Corp_ID ='$idI'";
        $result = mysqli_query($link, $sql);
    }    
    if ($status == 'off') {
        $sql = "UPDATE insurance  SET Corp_Status = 'on' WHERE Corp_ID ='$idI'";
        $result = mysqli_query($link, $sql);
    }
}

if (isset($_POST["Car_ID"])) {
    include_once 'connect.php';
    $idB = $_POST["Car_ID"];
    $sql3 = "SELECT Car_Status FROM brand WHERE  Car_ID =  $idB ";
    $query3 = mysqli_query($link,$sql3);
    foreach ($query3 as $value ){
        $status = $value['Car_Status'];
    }

    if ($status == 'on') {
        $sql = "UPDATE brand SET Car_Status = 'off' WHERE Car_ID ='$idB'";
        $result = mysqli_query($link, $sql);
     
    }    
    if ($status == 'off') {
        $sql = "UPDATE brand SET Car_Status = 'on' WHERE Car_ID ='$idB'";
        $result = mysqli_query($link, $sql);
    }
   
}
if (isset($_POST["Type_ID"])) {
    include_once 'connect.php';
    $idT = $_POST["Type_ID"];
    $sql4 = "SELECT Type_Status FROM type WHERE  Type_ID =  $idT ";
    $query4 = mysqli_query($link,$sql4);
    foreach ($query4 as $value ){
        $status = $value['Type_Status'];
    }
    

    if ($status == 'on') {
        $sql = "UPDATE type SET Type_Status = 'off' WHERE Type_ID ='$idT'";
        $result = mysqli_query($link, $sql);

    }    
    if ($status == 'off') {
        $sql = "UPDATE type SET Type_Status = 'on' WHERE Type_ID ='$idT'";
        $result = mysqli_query($link, $sql);
    }
}




    


