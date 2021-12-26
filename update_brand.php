
<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Update Brand</title>

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
</head>

<?php 
include "menu.php";
?>
        <?php
        require_once "connect.php";
        $sqls = "SELECT * FROM brand WHERE Car_ID='" . $_GET['Car_ID'] . "'";
        $querys = mysqli_query($link, $sqls);
        foreach ($querys as $value) {
            $id_s = $value['Car_ID'];
            $Name_s = $value['Car_Name'];
            $file_s = $value['Car_Img'];
        }
        ?>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['ids'];
            $Name = $_POST['Name'];
            $status = $_POST['Status'];
            $file = $_FILES['img']['name'];
            if ($file == "") {
                $sql = "UPDATE brand set  Car_Name=' $Name', Car_Status='$status'
                WHERE Car_ID = $id";

                $stmt = mysqli_query($link, $sql);

                if ($stmt) {

                    echo "<script type='text/javascript'>";
                    echo "alert('แก้ไขข้อมูลสำเร็จ');";
                    echo "window.location = 'page_brand.php';";
                    echo "</script>";
                } else {
                    echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
                }
            } else {

                $sql2 = "UPDATE brand set  Car_Name=' $Name', Car_Img='$file', Car_Status='$status'
                         WHERE Car_ID = $id";

                $stmt2 = mysqli_query($link, $sql2);

                if ($stmt2) {

                    echo "<script type='text/javascript'>";
                    echo "alert('แก้ไขข้อมูลสำเร็จ');";
                    echo "window.location = 'page_brand.php';";
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
                    <h2>แก้ไข ยี่ห้อของรถยนต์</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <input type="number" class="form-control" name="ids" value="<?php echo $id_s ?>" hidden require>
                            <div class="form-group col-md-4">
                                <label>ชื่อ ยี่ห้อรถยนต์</label><br>
                                <input type="text" class="form-control" name="Name" value="<?php echo $Name_s ?>" require>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>สถานะ</label><br>
                                <input type="radio" value="on" name="Status" required checked><label>On</label>
                                <input type="radio" value="off" name="Status" required><label>Off</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>ไฟล์ Logo(เดิม)</label><br>
                                <img src="img/brand_car/<?php echo $file_s; ?>" width="40%"> &nbsp;&nbsp;
                            </div>
                            <div class="form-group col-md-4">

                                <script language="JavaScript">
                                    function showPreview(ele) { //ฟังก์โชว์ภาพก่อน กด submit 
                                        $('#imgAvatar').attr('src', ele.value); 
                                        if (ele.files && ele.files[0]) {

                                            var reader = new FileReader();

                                            reader.onload = function(e) {
                                                $('#imgAvatar').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(ele.files[0]);
                                        }
                                    }
                                </script>
                                <label>ไฟล์ Logo(สำหรับแก้ไข)</label><br>
                                <img id="imgAvatar"  width="40%">
                            </div>
                        </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" name="imgs" value="<?php echo $file_s ?>" accept="image/*" required disabled>
                    </div>
                    <div class="form-group col-md-4">

                        <input type="file" name="img" accept="image/* " OnChange="showPreview(this)">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                        <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                        <input type=button class="btn btn-danger" onclick="window.location='page_brand.php'" value=ยกเลิก>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>