<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Insert Insurance</title>

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/MyStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <script src="dist/css/MyStyle.css"></script>
</head>

<?php
include "menu.php";
?>

<?php

require_once "connect.php";
if (isset($_GET["id"])) {
    $ids = $_GET["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['ids'];
    date_default_timezone_set('Asia/Bangkok');
    $nameDate = date('Ymd'); //เก็บวันที่
    $path = "myFile/"; //สร้างไฟล์สำหรับเก็บไฟล์ใหม่

    date_default_timezone_set('Asia/Bangkok');
    $numrand = (mt_rand(1000, 9999));

    if ($_FILES["file"]["name"][0] == "") {
        echo "<script type='text/javascript'>";
        echo "alert('กรุณาเลือกเพิ่มไฟล์');";
        echo "window.location = 'page_report.php';";
        echo "</script>";
    } else {
        for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
            if ($_FILES["file"]["name"][$i] != "") {


                $type[$i] = strrchr($_FILES['file']['name'][$i], "."); //ตัดชื่อไฟล์เหลือแต่นามสกุล
                $newname[$i] = $nameDate . $numrand . $type[$i]; //ประกอบเป็นชื่อใหม่
                $path_copy[$i] = $path . $newname[$i]; //กำหนด path ในการเก็บ
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copy[$i]);
                $sql = "INSERT INTO file (File_Name,Report_ID) 
                     VALUES ('$newname[$i]',$id )";
                $insert = mysqli_query($link, $sql);
            }
        }

        if ($insert) {

            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
            echo "window.location = 'page_report.php';";
            echo "</script>";
        } else {
            echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
        }
    }
}
mysqli_close($link);



?>

<div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
        <div class="container my-6">
            <h2>เพิ่มไฟล์</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
                        <input name="btnCreate" type="button" value="เพิ่มไฟล์" onClick="JavaScript:fncCreateElement();">
                        <input name="btnDelete" type="button" value="ลบไฟล์" onClick="JavaScript:fncDeleteElement();"><br><br>
                        <input name="hdnLine" id="hdnLine" type="hidden" value=0>

                        <div class="card">
                            
                            <div id="mySpan" name="mySpan" class="card-body bg-info">(ไฟล์ต่างๆ) <br>
                            </div>
                            <script language="javascript">
                                function fncCreateElement() {

                                    var mySpan = document.getElementById('mySpan');
                                    var myLine = document.getElementById('hdnLine');
                                    myLine.value++;

                                    var myElement4 = document.createElement('br');
                                    myElement4.setAttribute('name', "br" + myLine.value);
                                    myElement4.setAttribute('id', "br" + myLine.value);
                                    mySpan.appendChild(myElement4);
                                    
                                    var div = document.createElement('div');
                                    div.id = 'div'+myLine.value;
                                    div.className = 'card-body bg-light';
                                    div.innerHTML ='ไฟล์ที่ '+myLine.value;
                                    
                            

                                    var myElement4 = document.createElement('br');
                                    myElement4.setAttribute('name', "br" + myLine.value);
                                    myElement4.setAttribute('id', "br" + myLine.value);
                                    div.appendChild(myElement4);

                                    var myElement2 = document.createElement('input');
                                    myElement2.setAttribute('type', "file");
                                    myElement2.setAttribute('name', "file[]");
                                    myElement2.setAttribute('id', "file" + myLine.value);
                                    myElement2.setAttribute('required', 'true');
                                    div.appendChild(myElement2);

                                    var myElement4 = document.createElement('br');
                                    myElement4.setAttribute('name', "br" + myLine.value);
                                    myElement4.setAttribute('id', "br" + myLine.value);
                                    div.appendChild(myElement4);
                                    
                                    mySpan.appendChild(div);

                                   
                                }

                                function fncDeleteElement() {

                                    var mySpan = document.getElementById('mySpan');
                                    var myLine = document.getElementById('hdnLine');

                                    var deleteSpan = document.getElementById('div'+myLine.value);
                                    mySpan.removeChild(deleteSpan);
                                  
                                    var deleteBr = document.getElementById("br" + myLine.value);
                                    mySpan.removeChild(deleteBr);
                                    // var deleteFile = document.getElementById("file" + myLine.value);
                                    // mySpan.removeChild(deleteFile);
                                    // var deleteBr = document.getElementById("br" + myLine.value);
                                    // mySpan.removeChild(deleteBr);


                                    myLine.value--;

                                }
                            </script>

                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                            <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>
                        </div>
            </form>
        </div>
    </div>
</div>


</body>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</html>