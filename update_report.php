<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<?php
require_once "connect.php";

$sql4 = "SELECT Report_ID, report.Corp_ID, report.Type_ID, report.Car_ID, insurance.Corp_Name,
                brand.Car_Name, type.Type_Name, Report_Detail, Date_Now, Date_Ext,
                Report_Status
         FROM report 
         INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
         INNER JOIN brand ON brand.Car_ID = report.Car_ID
         INNER JOIN type ON  type.Type_ID = report.Type_ID
         WHERE Report_ID='" . $_GET['Report_ID'] . "'";

$query4 = mysqli_query($link, $sql4);
foreach ($query4 as $value) {
    $Report_id_s = $value['Report_ID'];
    $Corp_id_s = $value['Corp_ID'];
    $Type_id_s = $value['Type_ID'];
    $Brand_id_s = $value['Car_ID'];
    $Corp_name_s = $value['Corp_Name'];
    $Type_name_s = $value['Type_Name'];
    $Brand_name_s = $value['Car_Name'];
    $Date_Ext_s = $value['Date_Ext'];
    $status_s = $value['Report_Status'];
    $detail_s = $value['Report_Detail'];

}
$sql1 = "SELECT Corp_img, Corp_ID,Corp_Name 
        FROM insurance 
        WHERE Corp_Status= 'on' AND Corp_ID != '$Corp_id_s' ";
$query1 = mysqli_query($link, $sql1);


$sql2 = "SELECT Type_ID,Type_Name 
         FROM type 
         WHERE Type_Status= 'on'AND Type_ID !='$Type_id_s'";
$query2 = mysqli_query($link, $sql2);


$sql3 = "SELECT Car_ID,Car_Name 
         FROM brand 
         WHERE Car_Status= 'on' AND Car_ID !='$Brand_id_s'";
$query3 = mysqli_query($link, $sql3);



?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ids'];
    $corp_id = $_POST['Corp_ID'];
    $type_id = $_POST['Type_ID'];
    $brand_id = $_POST['Car_ID'];
    $status = $_POST['status'];
    $detail = $_POST['detail'];
    $date_now = $_POST['date_now'];
    $date_ext = $_POST['date_ext'];
    $status = $_POST['status'];


   
  


    $sqls = "UPDATE report SET Corp_ID=' $corp_id', Type_ID=' $type_id', Car_ID=' $brand_id', Report_Status='$status',Report_Detail='$detail',
     Date_Now='$date_now',Date_ext='$date_ext',Report_Status = '$status'
     WHERE Report_ID = $id";
    $stmt = mysqli_query($link, $sqls);
    if ($stmt) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลสำเร็จ');";
        echo "window.location = 'page_report.php';";
        echo "</script>";
    } else {
        echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Update Report</title>

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

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<?php 
include "menu.php";
?>


        <div class="content-wrapper">
            <div style="margin-left:10%; padding-top :2%;">
                <div class="container my-6">
                    <h2>แก้ไขรายงาน</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" name="ids" value="<?php echo $Report_id_s ?>" hidden>
                                <label>บริษัทประกันภัย</label>
                                <select name="Corp_ID" id="Corp_ID" class="form-control">
                                    <option value="<?php echo $Corp_id_s ?>">เลือกบริษัทเดิม(<?php echo $Corp_name_s ?>)</option>
                                    <?php while ($result1 = mysqli_fetch_assoc($query1)) : ?>
                                        <option value="<?= $result1["Corp_ID"] ?>"><?= $result1["Corp_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ประเภทประกัน</label>
                                <select name="Type_ID" id="Type_ID" class="form-control">
                                    <option value="<?php echo  $Type_id_s ?>">เลือกประเภทประกันเดิม (<?php echo $Type_name_s ?>)</option>
                                    <?php while ($result2 = mysqli_fetch_assoc($query2)) : ?>
                                        <option value="<?= $result2["Type_ID"] ?>"><?= $result2["Type_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>ยี่ห้อรถ</label><br>
                                <label><input type="radio" name="Car_ID" value="<?php echo $Brand_id_s ?> " checked > <?php echo $Brand_name_s ?> (เดิม)</label>
                                <?php while ($result3 = mysqli_fetch_assoc($query3)) : ?>
                                    <label><input type="radio" name="Car_ID" value="<?= $result3["Car_ID"] ?>"><?= $result3["Car_Name"] ?></label>
                                <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>วันที่แก้ไข</label><br>
                                <input name="date_nows" type="date" value=<?php echo  date('Y-m-d') ?> disabled>
                                <input name="date_now" type="date" value=<?php echo  date('Y-m-d') ?> hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <label>สถานะ</label><br>
                                <input type="radio" value="on" name="status" checked><label>On</label>&nbsp;&nbsp;
                                <input type="radio" value="off" name="status"><label>Off</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>วันที่หมดอายุ</label><br>
                                <input name="date_ext" type="date" value=<?php echo  $Date_Ext_s?>>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>รายละเอียดของรายงาน</label><br>
                                <textarea name="detail" id="detail"><?php echo  $detail_s ?></textarea>
                                <script>
                                    CKEDITOR.replace('detail');

                                    function CKupdate() {
                                        for (instance in CKEDITOR.instances)
                                            CKEDITOR.instances[instance].updateElement();
                                    }
                                </script>
                            </div>
                        </div>
                     
                        

                        <div class="form-row">
                            <div class="form-group-md-4">
                                <br><br>
                                <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                                <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                                <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>

                            </div>
                        </div>
                    </form>

                </div>




                <!-- jQuery -->
                <script src="plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap 4 -->
                <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE App -->
                <script src="dist/js/adminlte.min.js"></script>
</body>

</html>