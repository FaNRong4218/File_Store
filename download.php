<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
if(isset($_GET['id']) ){
    $id = $_GET['id'];
    require_once "connect.php";
    $sql = "SELECT File_Name FROM file WHERE File_ID=$id";
    $query = mysqli_query($con,$sql);
    
    foreach ($query as $value){
        $No = $value["File_Name"];
    }
    
}

    $download = 'myFile/'.$No;

    if(file_exists($download)){
        $path_parts = pathinfo($No);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) 
    {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "pptx": $ctype="application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "tif": $ctype="image/tif";break;
      case "tiff": $ctype="image/tiff";break;
      case "jpg": $ctype="image/jpg"; break;
      case "rar": $ctype="application/vnd.rar"; break;
      case "zip": $ctype="application/zip"; break;
      case "mp3": $ctype="audio/mpeg"; break;
      case "mp4": $ctype="video/mp4"; break;
      case "txt": $ctype="text/plain"; break;
      default: $ctype="application/force-download";
    }
        header("Pragma: public"); //ทำให้ brower สามารถลองรับไฟล์ได้โดยปรับเป็น public 
        header("Expires: 0"); //ระยะเวลาหมดอายุ
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype"); //ระบุชนิดของไฟล์
        header("Content-Disposition: attachment; filename=\"".basename($download)."\";" ); //ตั้งชื่อไฟล์ตอนดาวน์โหลด
        header("Content-Transfer-Encoding: binary"); //แปลงไฟล์เป็น Binary เพื่อสามารถอ่านไฟลืได้
        header('Content-Length '. filesize($download)); //ระบุขนาดไฟล์
        ob_clean();
        flush();
        readfile($download); //อ่านไฟล์
        exit;
    }
