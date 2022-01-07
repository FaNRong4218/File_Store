<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Update</title>

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

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<?php
include "menu.php";
?>
<?php if (isset($_GET['Car_ID'])) { ?>
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
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไข ยี่ห้อของรถยนต์</h2>
                <form action="update.php?brand=1" method="post" enctype="multipart/form-data">
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
                            <img id="imgAvatar" width="40%">
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
                    <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                    <input type=button class="btn btn-danger" onclick="window.location='page_brand.php'" value=ยกเลิก>
                </div>
            </div>
            </form>
        </div>
    </div>

    </div>

<?php } ?>

<?php if (isset($_GET['Corp_ID'])) { ?>
    <?php
    require_once "connect.php";
    $sqls = "SELECT * FROM insurance WHERE Corp_ID='" . $_GET['Corp_ID'] . "'";
    $querys = mysqli_query($link, $sqls);
    foreach ($querys as $value) {
        $id_s = $value['Corp_ID'];
        $Name_s = $value['Corp_Name'];
        $date_s = $value['Corp_Date'];
        $file_s = $value['Corp_img'];
    }
    ?>
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>เพิ่มข้อมูลบริษัทประกัน</h2>
                <form action="update.php?insurance=1" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="number" class="form-control" name="ids" value="<?php echo $id_s ?>" hidden require>
                        <div class="form-group col-md-4">
                            <label>ชื่อบริษัทประกัน</label><br>
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
                            <img src="img/brand_insurance/<?php echo $file_s; ?>" width="40%"> &nbsp;&nbsp;
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
                            <img id="imgAvatar" width="40%">
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
                    <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                    <input type=button class="btn btn-danger" onclick="window.location='page_insurance.php'" value=ยกเลิก>
                </div>
            </div>
            </form>
        </div>
    </div>

    </div>
<?php } ?>
<?php ?>
<?php if (isset($_GET['Report_ID'])) { ?>
    
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
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไขรายงาน</h2><br>
                <form action="update.php?report=1" method="post" enctype="multipart/form-data">

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
                            <label><input type="radio" name="Car_ID" value="<?php echo $Brand_id_s ?> " checked> <?php echo $Brand_name_s ?> (เดิม)</label>
                            <?php while ($result3 = mysqli_fetch_assoc($query3)) : ?>
                                <label><input type="radio" name="Car_ID" value="<?= $result3["Car_ID"] ?>"><?= $result3["Car_Name"] ?></label>
                            <?php endwhile; ?>

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
                            <input name="date_ext" type="date" value=<?php echo  $Date_Ext_s ?>>
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
                            <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


<?php } ?>

<?php if (isset($_GET['Type_ID'])) { ?>
    <?php
    require_once "connect.php";
    $sqls = "SELECT * FROM type WHERE Type_ID='" . $_GET['Type_ID'] . "'";
    $querys = mysqli_query($link, $sqls);

    foreach ($querys as $value) {
        $id_s = $value['Type_ID'];
        $Name_s = $value['Type_Name'];
        $status_s = $value['Type_Status'];
        $detail_s = $value['Type_detail'];
    }
    if($_SESSION['type'] == 'User'){
        echo "<script type='text/javascript'>";
        echo "alert('คุณอยู่สถานะ User ไม่สามารถแก้ไขข้อมูลได้');";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    }
    ?>
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไขข้อมูลประเภทประกัน</h2>
                <form action="update.php?type=1" method="post">
                    <div class="form-row">
                        <input type="number" class="form-control" name="ids" value="<?php echo $id_s ?>" hidden required>
                        <div class="form-group col-md-4">
                            <label>ชื่อประเภทประกัน</label><br>
                            <input type="text" class="form-control" name="Name" value="<?php echo $Name_s ?>" required>
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
                        <div class="form-group col-md-8">
                            <label>รายละเอียดของประเภทประกัน</label><br>
                            <textarea name="detail" id="detail"><?php echo $detail_s ?></textarea>

                            <script>
                                CKEDITOR.replace('detail');

                                function CKupdate() {
                                    for (instance in CKEDITOR.instances)
                                        CKEDITOR.instances[instance].updateElement()
                                }
                            </script>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                            <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_type.php'" value=ยกเลิก>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
<?php } ?>

<?php if (isset($_GET['id'])) {
?>
    <?php
    $ids = $_GET['id'];
    require_once "connect.php";
    $sqls =  "SELECT * FROM user WHERE id= $ids ";
    $querys = mysqli_query($link, $sqls);
    foreach ($querys as $value); {

        $user = $value['user'];
        $name = $value['name'];
        $email = $value['email'];
        $tel = $value['tel'];
        $type = $value['type'];
    }
    if($_SESSION['type'] == 'User'){
        echo "<script type='text/javascript'>";
        echo "alert('คุณอยู่สถานะ User ไม่สามารถแก้ไขข้อมูลของผู้ใช้อื่นได้');";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    }
    if($_SESSION['type'] == 'Stuff'){
        if( $type == 'Admin' || $type == 'Stuff'){
        echo "<script type='text/javascript'>";
        echo "alert('คุณอยู่สถานะ Stuff ไม่สามารถแก้ไขข้อมูลของผู้ใช้สถานะ Admin หรือ Stuff คนอื่นได้');";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    }
    }
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
        
                        <div class="page-header">
                            <h2>แก้ไขข้อมูล ของ user</h2>
                        </div>

                        <form action="update.php?user=1" method="post">
                            <div class="form-group">
                                <input hidden type="text" name="id" class="form-control" value="<?php echo $ids ?>" maxlength="50" required="">
                                <label>User</label>
                                <input type="text" name="user" class="form-control" value="<?php echo $user ?>" maxlength="50" required="">

                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo  $name ?>" maxlength="50" required="">
                            </div>
                            <div class="form-group ">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo  $email ?>" maxlength="30" required="">
                            </div>
                            <div class="form-group">
                                <label>Tel</label>
                                <input type="mobile" name="tel" class="form-control" value="<?php echo  $tel ?>" maxlength="10">

                            </div>

                            <div class="form-group">
                                <label>Type</label><br>
                                <p>(type เดิม คือ <?php echo $type ?>)</p>
                                <label><input type="radio" name="type" value="<?php echo $type ?>" hidden></label>
                                <label><input type="radio" name="type" value="admin"> Admin</label>
                                <label><input type="radio" name="type" value="employee">Employee </label>
                                <label><input type="radio" name="type" value="member">member</label>
                            </div>
                            <input type="submit" class="btn btn-primary" value="ยืนยัน">
                            <?php
                            if ($_SESSION["type"] == "User") {
                                $check = "page_user.php";
                            }
                            if ($_SESSION["type"] == "Admin") {
                                $check = "page_user.php";
                            }
                            if ($_SESSION["type"] == "Stuff") {
                                $check = "page_user.php";
                            }

                            ?>
                            <a href="<?php echo $check ?>" class="btn btn-danger">ยกเลิก</a>
                        </form>
                 
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#Table').DataTable();
    });
</script>