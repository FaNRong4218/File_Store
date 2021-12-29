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

  <title>AdminLTE 3 | Insert Brand</title>

  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
require_once "connect.php";
?>

<?php
if (isset($_GET['brand']) == 1) {
?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลยี่ห้อรถ</h2>
        <form action="insert.php?brand=1" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ชื่อยี่ห้อรถ</label><br>
              <input type="text" class="form-control" name="Name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="Status" required checked><label>On</label>
            </div>
          </div>
          <div class="form-row">
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
              <img id="imgAvatar" width="40%">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ไฟล์ Logo</label><br>
              <input type="file" name="img" accept="image/*" required OnChange="showPreview(this)">
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
<?php if (isset($_GET['Insurance']) == 1) { ?>
  <?php
  require_once "connect.php";
  ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลบริษัทประกัน</h2>
        <form action="insert.php?insurance=1" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ชื่อบริษัทประกัน</label><br>
              <input type="text" class="form-control" name="Name" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label>วันที่สร้าง</label><br>
              <input type="date" class="form-control" name="Date" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="Status" required checked><label>On</label>
            </div>
          </div>
          <div class="form-row">
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
              <img id="imgAvatar" width="40%">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ไฟล์ Logo</label><br>
              <input type="file" name="img" accept="image/*" required OnChange="showPreview(this)">
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
<?php if (isset($_GET['Report']) == 1) { ?>
  <?php
  require_once "connect.php";
  $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name FROM insurance WHERE Corp_Status= 'on';";
  $query1 = mysqli_query($link, $sql1);

  $sql2 = "SELECT Type_ID,Type_Name FROM type WHERE Type_Status= 'on';";
  $query2 = mysqli_query($link, $sql2);

  $sql3 = "SELECT Car_ID,Car_Name FROM brand WHERE Car_Status= 'on';";
  $query3 = mysqli_query($link, $sql3);
  ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลรายงานประกัน</h2>
        <form action="insert.php?Report=1" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>บริษัทประกัน</label>
              <select name="Corp_ID" id="Corp_ID" class="form-control" required>
                <option value="">เลือกบริษัทประกันที่ต้องการ</option>
                <?php while ($result1 = mysqli_fetch_assoc($query1)) : ?>
                  <option value="<?= $result1["Corp_ID"] ?>"><?= $result1["Corp_Name"] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>ประเภทประกัน</label>
              <select name="Type_ID" id="Type_ID" class="form-control" required>
                <option value="">เลือกประเภทประกันที่ต้องการ</option>
                <?php while ($result2 = mysqli_fetch_assoc($query2)) : ?>
                  <option value="<?= $result2["Type_ID"] ?>"><?= $result2["Type_Name"] ?></option>
                <?php endwhile; ?>
              </select>
            </div>

          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ยี่ห้อรถ</label><br>
              <?php while ($result3 = mysqli_fetch_assoc($query3)) : ?>
                <label><input type="radio" name="Car_ID" value="<?= $result3["Car_ID"] ?>" required><?= $result3["Car_Name"] ?></label>&nbsp;&nbsp;
              <?php endwhile; ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>วันที่สร้าง</label><br>
              <input name="date_start" type="date" value=<?php echo date('Y-m-d') ?>>
            </div>

            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="status" required="" checked><label>On</label>&nbsp;&nbsp;
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>วันที่แก้ไข</label><br>
              <input name="date_now" type="date" value=<?php echo  date('Y-m-d') ?>>
            </div>
            <div class="form-group col-md-4">
              <label>วันที่หมดอายุ</label><br>
              <input name="date_ext" type="date" value='' required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label>รายละเอียดของประกัน</label><br>
              <textarea name="detail" id="detail"></textarea>
              <script>
                CKEDITOR.replace('detail');

                function CKupdate() {
                  for (instance in CKEDITOR.instances)
                    CKEDITOR.instances[instance].updateElement();
                }
              </script>
            </div>
          </div>

      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
        <input type="reset" class="btn btn-info" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
        <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>
      </div>

      </form>
    </div>
  </div>

  </div>
<?php } ?>

<?php if (isset($_GET['Type']) == 1) { ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลประเภทประกัน</h2>
        <form action="insert.php?Type=1" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>ชื่อประเภทประกัน</label><br>
              <input type="text" class="form-control" name="Name" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="Status" required checked><label>On</label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-8">
              <label>รายละเอียดของประกัน</label><br>
              <textarea name="detail" id="detail"></textarea>
              <script>
                CKEDITOR.replace('detail');

                function CKupdate() {
                  for (instance in CKEDITOR.instances)
                    CKEDITOR.instances[instance].updateElement();
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
  $ids = $_GET["id"]; ?>

  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-8">
        <h2>เพิ่มไฟล์</h2>
        <form action="insert.php?File=1<?php ?>" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-12">
              <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
              <input name="btnCreate" type="button" class="btn btn-sm btn-success" value="เพิ่มไฟล์" onClick="JavaScript:fncCreateElement();">
              <input name="btnDelete" type="button" class="btn btn-sm btn-danger" value="ลบไฟล์" onClick="JavaScript:fncDeleteElement();"><br><br>
              <input name="hdnLine" id="hdnLine" type="hidden" value=0>

              <div class="card">
                <div class="card-body bg-dark">
                  <div id="mySpan" name="mySpan">(ไฟล์ต่างๆ) <br>
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
                      div.id = 'div' + myLine.value;
                      div.className = 'card-body bg-light';
                      div.innerHTML = 'ไฟล์ที่ ' + myLine.value;



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

                      var deleteSpan = document.getElementById('div' + myLine.value);
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
              </div>
              <div class="form-group">
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



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>

</html>