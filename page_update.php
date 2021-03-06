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

    <title>Update</title>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/css/myCSS.css"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
</head>

<?php
require_once "menu.php";
require_once "connect.php";
?>


<?php if (isset($_GET['Car_ID'])) {
?>
    <?php
    $sqls = "SELECT * FROM brand WHERE Car_ID='" . $_GET['Car_ID'] . "'";
    $querys = mysqli_query($con, $sqls);
    foreach ($querys as $value) {
        $id_s = $value['Car_ID'];
        $Name_s = $value['Car_Name'];
        $file_s = $value['Car_Img'];
    }
    ?>

    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไขยี่ห้อของรถยนต์</h2>
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
                            <label>ไฟล์ Logo(เดิม)</label><br>
                            <?php if ($file_s != 'none.png') {
                                $scr = 'myImg/brand/';
                            } else {
                                $scr = 'myImg/brand/default_img/';
                            } ?>
                            <img src="<?php echo $scr; ?><?php echo $file_s ?>" width="200px" height="200px"><br><br>
                            <div class="form-row">
                                <input type="text" name="imgs" value="<?php echo $file_s ?>" accept="image/*" required disabled>
                            </div>
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
                            <img id="imgAvatar" width="200px" height="200px"><br><br>
                            <div class="form-row">
                                <input type="file" name="img" accept="image/* " OnChange="showPreview(this)">
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" name="imgs" value="<?php echo $file_s ?>" accept="image/*" required disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img" accept="image/* " OnChange="showPreview(this)">
                        </div>
                    </div> -->
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
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
    $querys = mysqli_query($con, $sqls);
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
                <h2>แก้ไขข้อมูลบริษัทประกัน</h2>
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
                            <label>ไฟล์ Logo(เดิม)</label><br>
                            <?php if ($file_s != 'none.jpg') {
                                $scr = 'myImg/insurance/';
                            } else {
                                $scr = 'myImg/insurance/default_img/';
                            } ?>
                            <img src="<?php echo $scr; ?><?php echo $file_s; ?>" width="200px" height="200px"><br><br>
                            <div class="form-row">
                                <input type="text" name="imgs" value="<?php echo $file_s ?>" accept="image/*" required disabled>
                            </div>
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
                            <img id="imgAvatar" width="200px" height="200px"><br><br>
                            <div class="form-row"><br><br>
                                <input type="file" name="img" accept="image/* " OnChange="showPreview(this)">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" name="imgs" value="<?php echo $file_s ?>" accept="image/*" required disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" name="img" accept="image/* " OnChange="showPreview(this)">
                        </div>
                    </div> -->
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_insurance.php'" value=ยกเลิก>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
<?php } ?>
<?php if (isset($_GET['Report_ID'])) { ?>

    <?php
    date_default_timezone_set("Asia/Bangkok");
    //โชว์ ข้อมูลเดิมที่จะแก้ไข
    $sql4 = "SELECT Report_ID, report.Corp_ID, report.Type_ID, report.Car_ID, insurance.Corp_Name,
                brand.Car_Name, type.Type_Name, Report_Detail, Date_Now, Date_Ext,
                Report_Status
         FROM report 
         LEFT JOIN insurance ON insurance.Corp_ID = report.Corp_ID
         LEFT JOIN brand ON brand.Car_ID = report.Car_ID
         LEFT JOIN type ON  type.Type_ID = report.Type_ID
         WHERE Report_ID='" . $_GET['Report_ID'] . "'";

    $query4 = mysqli_query($con, $sql4);
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
    //โชว์ id/ชื่อ บริษัทที่ไม่ได้เลือก
    $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name 
        FROM insurance 
        WHERE Corp_Status= 'on' AND Corp_ID != '$Corp_id_s' ";
    $query1 = mysqli_query($con, $sql1);

    //โชว์ id/ชื่อ ประเภทที่ไม่ได้เลือก
    $sql2 = "SELECT Type_ID,Type_Name 
         FROM type 
         WHERE Type_Status= 'on'AND Type_ID !='$Type_id_s'";
    $query2 = mysqli_query($con, $sql2);

    //โชว์ id/ชื่อ รถที่เลือก
    $sql3 = "SELECT Car_ID,Car_Name 
             FROM brand 
             WHERE Car_Status= 'on' AND Car_ID IN($Brand_id_s)";
    $query3 = mysqli_query($con, $sql3);

    //โชว์ id/ชื่อ รถที่ไม่ได้เลือก
    $sqlc = "SELECT Car_ID,Car_Name 
         FROM brand 
         WHERE Car_Status= 'on' AND Car_ID NOT IN($Brand_id_s) AND Car_ID!=1";
    $queryc = mysqli_query($con, $sqlc);
    ?>
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไขเอกสารประกัน</h2><br>
                <form action="update.php?report=1" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" name="ids" value="<?php echo $Report_id_s ?>" hidden>
                            <label>บริษัทประกันภัย</label>
                            <select name="Corp_ID" id="Corp_ID" class="form-control">
                                <option value="<?php echo $Corp_id_s ?>">เลือกบริษัทเดิม(<?php echo $Corp_name_s ?>)</option>
                                <?php while ($result = mysqli_fetch_assoc($query1)) : ?>
                                    <option value="<?= $result["Corp_ID"] ?>"><?= $result["Corp_Name"] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ประเภทประกัน</label>
                            <select name="Type_ID" id="Type_ID" class="form-control">
                                <option value="<?php echo  $Type_id_s ?>">เลือกประเภทประกันเดิม (<?php echo $Type_name_s ?>)</option>
                                <?php while ($result = mysqli_fetch_assoc($query2)) : ?>
                                    <option value="<?= $result["Type_ID"] ?>"><?= $result["Type_Name"] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <?php if ($Brand_id_s == 1) { ?>
                            <div class="form-group col-md-8">
                                <label>ยี่ห้อรถ</label><br>
                                <input onclick="check()" checked id="myCheck" type="checkbox" name="Car_ID[]" value=<?php echo $Brand_id_s ?>>ไม่เลือกยี่ห้อรถยนต์
                            </div>
                            <div class="form-group col-md-8" id='f1' style="display:none">
                                <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">
                                    <?php while ($result = mysqli_fetch_assoc($queryc)) : ?>
                                        <option id="check" value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        <?php } else { ?>
                            <div class="form-group col-md-8">
                                <label>ยี่ห้อรถ</label><br>
                                <input onclick="check()" id="myCheck" type="checkbox" name="Car_ID[]" value=<?php echo $Brand_id_s ?>>ไม่เลือกยี่ห้อรถยนต์
                            </div>
                            <div class="form-group col-md-8">
                                <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">
                                    <?php while ($result = mysqli_fetch_assoc($query3)) : ?>
                                        <option id="check" selected value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                    <?php while ($result = mysqli_fetch_assoc($queryc)) : ?>
                                        <option id="check" value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        <?php } ?>
                    </div>


                    <script>
                        $(function() {
                            $('.duallistbox').bootstrapDualListbox()
                        });

                        myCheck.onchange = function() {
                            var text = document.getElementById("f1");
                            if (this.checked == true) {
                                document.querySelector("#check").closest('.form-group').style.display = "none";
                                text.style.display = "none";
                            }
                            if (this.checked == false) {
                                document.querySelector("#check").closest('.form-group').style.display = "";
                                text.style.display = "";
                            }
                        }
                        $(function() {
                            $("#myCheck").on("click", function() {
                                $("#Ck")[0].selectedIndex = -1;
                                $(".duallistbox").bootstrapDualListbox('refresh', true);
                            });
                        });
                    </script>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>วันที่หมดอายุ</label><br>
                            <input hidden name="date_now" type="datetime" value=<?php echo date("Y-m-d\TH:i:s"); ?>>
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
                            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


<?php } ?>

<?php if (isset($_GET['Report_ID_s'])) { //สำหรับ report ที่มีแถบค้นหา
?>

    <?php
    date_default_timezone_set("Asia/Bangkok");

    //โชว์ ข้อมูลเดิมที่จะแก้ไข
    $sql4 = "SELECT Report_ID, report.Corp_ID, report.Type_ID, report.Car_ID, insurance.Corp_Name,
            brand.Car_Name, type.Type_Name, Report_Detail, Date_Now, Date_Ext,
            Report_Status
     FROM report 
     LEFT JOIN insurance ON insurance.Corp_ID = report.Corp_ID
     LEFT JOIN brand ON brand.Car_ID = report.Car_ID
     LEFT JOIN type ON  type.Type_ID = report.Type_ID
     WHERE Report_ID='" . $_GET['Report_ID_s'] . "'";

    $query4 = mysqli_query($con, $sql4);
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
    //โชว์ id/ชื่อ บริษัทที่ไม่ได้เลือก
    $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name 
    FROM insurance 
    WHERE Corp_Status= 'on' AND Corp_ID != '$Corp_id_s' ";
    $query1 = mysqli_query($con, $sql1);

    //โชว์ id/ชื่อ ประเภทที่ไม่ได้เลือก
    $sql2 = "SELECT Type_ID,Type_Name 
     FROM type 
     WHERE Type_Status= 'on'AND Type_ID !='$Type_id_s'";
    $query2 = mysqli_query($con, $sql2);

    //โชว์ id/ชื่อ รถที่เลือก
    $sql3 = "SELECT Car_ID,Car_Name 
         FROM brand 
         WHERE Car_Status= 'on' AND Car_ID IN($Brand_id_s)";
    $query3 = mysqli_query($con, $sql3);

    //โชว์ id/ชื่อ รถที่ไม่ได้เลือก
    $sqlc = "SELECT Car_ID,Car_Name 
     FROM brand 
     WHERE Car_Status= 'on' AND Car_ID NOT IN($Brand_id_s) AND Car_ID!=1";
    $queryc = mysqli_query($con, $sqlc);
    ?>
    <div class="content-wrapper">
        <div style="margin-left:10%; padding-top :2%;">
            <div class="container my-6">
                <h2>แก้ไขเอกสารประกัน</h2><br>
                <form action="update.php?reports=1" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" name="ids" value="<?php echo $Report_id_s ?>" hidden>
                            <label>บริษัทประกันภัย</label>
                            <select name="Corp_ID" id="Corp_ID" class="form-control">
                                <option value="<?php echo $Corp_id_s ?>">เลือกบริษัทเดิม(<?php echo $Corp_name_s ?>)</option>
                                <?php while ($result = mysqli_fetch_assoc($query1)) : ?>
                                    <option value="<?= $result["Corp_ID"] ?>"><?= $result["Corp_Name"] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>ประเภทประกัน</label>
                            <select name="Type_ID" id="Type_ID" class="form-control">
                                <option value="<?php echo  $Type_id_s ?>">เลือกประเภทประกันเดิม (<?php echo $Type_name_s ?>)</option>
                                <?php while ($result = mysqli_fetch_assoc($query2)) : ?>
                                    <option value="<?= $result["Type_ID"] ?>"><?= $result["Type_Name"] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <?php if ($Brand_id_s == 1) { ?>
                            <div class="form-group col-md-8">
                                <label>ยี่ห้อรถ</label><br>
                                <input onclick="check()" checked id="myCheck" type="checkbox" name="Car_ID[]" value=<?php echo $Brand_id_s ?>>ไม่เลือกยี่ห้อรถยนต์
                            </div>
                            <div class="form-group col-md-8" id='f1' style="display:none">
                                <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">
                                    <?php while ($result = mysqli_fetch_assoc($queryc)) : ?>
                                        <option id="check" value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        <?php } else { ?>
                            <div class="form-group col-md-8">
                                <label>ยี่ห้อรถ</label><br>
                                <input onclick="check()" id="myCheck" type="checkbox" name="Car_ID[]" value=<?php echo $Brand_id_s ?>>ไม่เลือกยี่ห้อรถยนต์
                            </div>
                            <div class="form-group col-md-8">
                                <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">
                                    <?php while ($result = mysqli_fetch_assoc($query3)) : ?>
                                        <option id="check" selected value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                    <?php while ($result = mysqli_fetch_assoc($queryc)) : ?>
                                        <option id="check" value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        <?php } ?>
                    </div>


                    <script>
                        $(function() {
                            $('.duallistbox').bootstrapDualListbox()
                        });

                        myCheck.onchange = function() {
                            var text = document.getElementById("f1");
                            if (this.checked == true) {
                                document.querySelector("#check").closest('.form-group').style.display = "none";
                                text.style.display = "none";
                            }
                            if (this.checked == false) {
                                document.querySelector("#check").closest('.form-group').style.display = "";
                                text.style.display = "";
                            }
                        }
                        $(function() {
                            $("#myCheck").on("click", function() {
                                $("#Ck")[0].selectedIndex = -1;
                                $(".duallistbox").bootstrapDualListbox('refresh', true);
                            });
                        });
                    </script>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>วันที่หมดอายุ</label><br>
                            <input hidden name="date_now" type="datetime" value=<?php echo date("Y-m-d\TH:i:s"); ?>>
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
                            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                            <input type=button class="btn btn-danger" onclick="window.location='page_report_search.php'" value=ยกเลิก>

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
    $querys = mysqli_query($con, $sqls);

    foreach ($querys as $value) {
        $id_s = $value['Type_ID'];
        $Name_s = $value['Type_Name'];
        $status_s = $value['Type_Status'];
        $detail_s = $value['Type_detail'];
    }
    if ($_SESSION['type'] == 'User') {
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
                        <div class="form-group col-md-8">
                            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
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
    require_once "connect.php";
    $ids = $_GET['id'];
    $sqls =  "SELECT * FROM user WHERE id= $ids ";
    $querys = mysqli_query($con, $sqls);
    foreach ($querys as $value); {

        $user = $value['user'];
        $name = $value['name'];
        $email = $value['email'];
        $tel = $value['tel'];
        $type = $value['type'];
    }
    if ($_SESSION['type'] == 'User') {
        echo "<script type='text/javascript'>";
        echo "alert('คุณอยู่สถานะ User ไม่สามารถแก้ไขข้อมูลของผู้ใช้อื่นได้');";
        echo "window.location = 'page_user.php';";
        echo "</script>";
    }
    if ($_SESSION['type'] == 'Stuff') {
        if ($type == 'Admin' || $type == 'Stuff') {
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
                        if ($_SESSION["type"] == "member") {
                            $check = "page_dashboard.php";
                        }
                        if ($_SESSION["type"] == "admin") {
                            $check = "page_user.php";
                        }
                        if ($_SESSION["type"] == "employee") {
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

<?php if (isset($_GET['page_id'])) {
    $ids = $_SESSION['id'];

    $sql = "SELECT * FROM user WHERE id= $ids ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $sqlp = "SELECT * FROM user_role  ";
    $resultp = mysqli_query($con, $sqlp);

    $id = $_GET['page_id'];
    $sql = "SELECT * FROM user_role WHERE id = $id ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="offset-3 col-md-6">
                <!-- general form elements -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">อัพเดทข้อมูล</h3>
                    </div>
                    <form action="update.php?page=1" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" name="id">ลำดับที่ <?php echo $row['id']; ?> </label><br>

                                <label for="exampleInputEmail1">ชื่อรายการ</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $row['page']; ?>" placeholder="Insurance Name" required>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="ids" value="<?php echo $row['id']; ?>" hidden placeholder="Insurance Name">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">หน้ารายการ (.php)</label>
                                <input type="phone" class="form-control" id="exampleInputPassword1" name="link" value="<?php echo $row['link']; ?>" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ไอคอน ( <a href="https://fontawesome.com/" target="_blank">fontawesome</a>)</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="icon" value="<?php echo $row['icon']; ?>" placeholder="Type" required>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary d-block m-auto">บันทึก</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (isset($_GET['profile'])) { ?>
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id= $id ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);


    // $sqlp = "SELECT * FROM member_role  ";
    // $resultp = mysqli_query($con, $sqlp);

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- <div class="col-sm-6">
                        <h1 style="text-transform: uppercase">แก้ไขสมาชิก</h1>
                    </div> -->

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="offset-sm-3 col-md-6">
                        <div class="card card-dark">
                            <div class="card-header ">
                                <h3 class="card-title">แก้ไขสมาชิก</li>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <form class="form-horizontal" action="update.php?profile=<?php echo $row['id'] ?>" method="post">
                                            <div class="tab-pane" id="settings">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label"> ชื่อ</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPhone" class="col-sm-2 col-form-label">เบอร์โทร</label>
                                                    <div class="col-sm-10">
                                                        <input type="tel" maxlength="10" pattern="\d*" class="form-control" name="tel" id="tel" value="<?php echo $row['tel']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">อีเมล</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-5 col-6">
                                                        <button type="submit" name="submit" class="btn btn-danger">บันทึก</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- <script>
        $('.custom-file-input').on('change', function() { //selecter class custom และ ดักจับ event(change)
            var fileName = $(this).val().split('\\').pop(); //ดึงค่าข้อมูลของตัว path และแยกข้อมูลด้วย split และใช้ pop ในการแยกข้อมูลด้านหลังสุดของ array
            $(this).siblings('.custom-file-label').html(fileName) //siblings(เลือกทุกอย่างยกเว้นตัวเอง แต่จะเลือกตัวlabel) html(แสดงในส่วนของข้อความออกมา)
            if (this.files[0]) { //ถ้ามีการรับค่าจาก array ของ file
                var reader = new FileReader() //สร้างฟังก์ชันขึ้นใหม่
                $('.figure').addClass('d-block') //selecter ไปที่ class figure , add class 'd-block' เพื่อโชว์รูปภาพ
                reader.onload = function(e) { //เรียกค่าข้อมูลของ file
                    $('#imageUpload').attr('src', e.target.result).width(240) //selecter id ของ img และเซ็ต attr ของข้อมูล
                    $('#imageUpload2').attr('src', e.target.result).width(100) //selecter id ของ img และเซ็ต attr ของข้อมูล

                }
                reader.readAsDataURL(this.files[0]) //อ่านค่าของ array file
            }
        })
    </script> -->

    </body>

</html>
<?php  } ?>
</body>

</html>
<!-- <script>
    $(document).ready(function() {
        $('#Table').DataTable();
    });
</script> -->