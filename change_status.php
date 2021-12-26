<?php //เปลี่ยน status ของแต่ละตาราง 
if (isset($_GET["statusI"]) && isset($_GET["idI"])) {
    include_once 'connect.php';
    $sI = $_GET["statusI"];
    $idI = $_GET["idI"];

    if ($sI == 'on') {
        $sql = "UPDATE insurance SET Corp_Status = 'off' WHERE Corp_ID ='$idI'";
        $result = mysqli_query($link, $sql);
        header("location: page_insurance.php");
        exit();
    }    
    if ($sI == 'off') {
        $sql = "UPDATE insurance SET Corp_Status = 'on' WHERE Corp_ID ='$idI'";
        $result = mysqli_query($link, $sql);
        header("location: page_insurance.php");
        exit();
    }
}

if (isset($_GET["statusB"]) && isset($_GET["idB"])) {
    include_once 'connect.php';
    $sB = $_GET["statusB"];
    $idB = $_GET["idB"];

    if ($sB == 'on') {
        $sql = "UPDATE brand SET Car_Status = 'off' WHERE Car_ID ='$idB'";
        $result = mysqli_query($link, $sql);
        header("location: page_brand.php");
        exit();
    }    
    if ($sB == 'off') {
        $sql = "UPDATE brand SET Car_Status = 'on' WHERE Car_ID ='$idB'";
        $result = mysqli_query($link, $sql);
        header("location: page_brand.php");
        exit();
    }
   
}
if (isset($_GET["statusT"]) && isset($_GET["idT"])) {
    include_once 'connect.php';
    $sT = $_GET["statusT"];
    $idT = $_GET["idT"];

    if ($sT == 'on') {
        $sql = "UPDATE Type SET Type_Status = 'off' WHERE Type_ID ='$idT'";
        $result = mysqli_query($link, $sql);
        header("location: page_type.php");
        exit();
    }    
    if ($sT == 'off') {
        $sql = "UPDATE type SET Type_Status = 'on' WHERE Type_ID ='$idT'";
        $result = mysqli_query($link, $sql);
        header("location: page_type.php");
        exit();
    }
}
if (isset($_GET["statusR"]) && isset($_GET["idR"])) {
    include_once 'connect.php';
    $sR = $_GET["statusR"];
    $idR = $_GET["idR"];

    if ($sR == 'on') {
        $sql = "UPDATE Report SET Report_Status = 'off' WHERE Report_ID ='$idR'";
        $result = mysqli_query($link, $sql);
        header("location: page_report.php");
        exit();
    }    
    if ($sR == 'off') {
        $sql = "UPDATE Report  SET Report_Status = 'on' WHERE Report_ID ='$idR'";
        $result = mysqli_query($link, $sql);
        header("location: page_report.php");
        exit();
    }
}



    


