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

  <title>Insert</title>

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
              <input type="file" name="img" accept="image/*" OnChange="showPreview(this)">
            </div>
          </div>
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
              <input type="file" name="img" accept="image/*" OnChange="showPreview(this)">
            </div>
          </div>
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
<?php if (isset($_GET['Report']) == 1) { ?>
  <?php
  require_once "connect.php";
  date_default_timezone_set("Asia/Bangkok");

  $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name FROM insurance WHERE Corp_Status= 'on';";
  $query1 = mysqli_query($con, $sql1);

  $sql2 = "SELECT Type_ID,Type_Name FROM type WHERE Type_Status= 'on';";
  $query2 = mysqli_query($con, $sql2);

  $sql3 = "SELECT Car_ID,Car_Name FROM brand WHERE Car_Status= 'on' AND Car_ID !=1";
  $query3 = mysqli_query($con, $sql3);
  ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลเอกสารประกัน</h2>
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
            <div class="form-group col-md-8">
              <label>ยี่ห้อรถ</label><br>
              <input onclick="check()" id="myCheck" type="checkbox" name="Car_ID[]" value='1'>ไม่เลือกยี่ห้อรถยนต์
            </div>
            <div class="form-group col-md-8">

              <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">

                <?php while ($result = mysqli_fetch_assoc($query3)) : ?>
                  <option id="check" name="Car_ID[]" value="<?= $result["Car_ID"] ?>"><?= $result["Car_Name"] ?></option>
                <?php endwhile; ?>
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
              </select>

            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>วันที่หมดอายุ</label><br>
              <input name="date_ext" type="date" value='' required>
            </div>
            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="status" required="" checked><label>On</label>&nbsp;&nbsp;
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
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
            <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>
          </div>
          <input hidden name="date_start" type="datetime" value=<?php echo date("Y-m-d\TH:i:s"); ?>>
          <input hidden name="date_now" type="datetime" value=<?php echo  date("Y-m-d\TH:i:s"); ?>>
        </form>
      </div>
    </div>

  </div>
<?php } ?>
<?php if (isset($_GET['Reports']) == 1) { ?>
  <?php

  date_default_timezone_set("Asia/Bangkok");

  require_once "connect.php";
  $sql1 = "SELECT Corp_img, Corp_ID,Corp_Name FROM insurance WHERE Corp_Status= 'on';";
  $query1 = mysqli_query($con, $sql1);

  $sql2 = "SELECT Type_ID,Type_Name FROM type WHERE Type_Status= 'on';";
  $query2 = mysqli_query($con, $sql2);

  $sql3 = "SELECT Car_ID,Car_Name FROM brand WHERE Car_Status= 'on' AND Car_ID !=1";
  $query3 = mysqli_query($con, $sql3);
  ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-6">
        <h2>เพิ่มข้อมูลเอกสารประกัน</h2>
        <form action="insert.php?Reports=1" method="post" enctype="multipart/form-data">
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
            <div class="form-group col-md-8">
              <label>ยี่ห้อรถ</label><br>
              <input onclick="check()" id="myCheck" type="checkbox" name="Car_ID[]" value='1'>ไม่เลือกยี่ห้อรถยนต์
            </div>
            <div class="form-group col-md-8">

              <select id="Ck" name="Car_ID[]" class="duallistbox" multiple="multiple">

                <?php while ($result2 = mysqli_fetch_assoc($query3)) : ?>
                  <option id="check" name="Car_ID[]" value="<?= $result2["Car_ID"] ?>"><?= $result2["Car_Name"] ?></option>
                <?php endwhile; ?>
                <script>
                  $(function() {
                    $('.duallistbox').bootstrapDualListbox()
                  });

                  myCheck.onclick = function() {
                    if (this.checked == true) {
                      document.querySelector("#check").closest('.form-group').style.display = "none";
                    }
                    if (this.checked == false) {
                      document.querySelector("#check").closest('.form-group').style.display = "";
                    }
                  }
                  $(function() {
                    $("#myCheck").on("click", function() {
                      $("#Ck")[0].selectedIndex = -1;
                      $(".duallistbox").bootstrapDualListbox('refresh', true);
                    });
                  });
                </script>
              </select>

            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label>วันที่หมดอายุ</label><br>
              <input name="date_ext" type="date" value='' required>
            </div>
            <div class="form-group col-md-4">
              <label>สถานะ</label><br>
              <input type="radio" value="on" name="status" required="" checked><label>On</label>&nbsp;&nbsp;
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
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
            <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
            <input type=button class="btn btn-danger" onclick="window.location='page_report_search.php'" value=ยกเลิก>
          </div>
          <input name="date_start" type="datetime" value=<?php echo date("Y-m-d\TH:i:s"); ?>>
          <input name="date_now" type="datetime" value=<?php echo  date("Y-m-d\TH:i:s"); ?>>
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
              <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
              <input type=button class="btn btn-danger" onclick="window.location='page_type.php'" value=ยกเลิก>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
<?php } ?>
<?php if (isset($_GET['id'])) { //หน้าเพิ่มไฟล์ สำหรับหน้าเอกสาร
  $ids = $_GET["id"]; ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-8">
        <h2>เพิ่มไฟล์</h2>
        <form action="insert.php?File=1<?php ?>" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-12">
              <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
              <input hidden name="date" type="datetime" value=<?php date_default_timezone_set("Asia/Bangkok");
                                                              echo date("Y-m-d\TH:i:s"); ?>>
              <input name="btnCreate" type="button" class="btn btn-sm btn-success" value="เพิ่มไฟล์" onClick="JavaScript:fncCreateElement();">
              <input name="btnDelete" type="button" class="btn btn-sm btn-danger" value="ลบไฟล์" onClick="JavaScript:fncDeleteElement();"><br><br>
              <input name="hdnLine" id="hdnLine" type="hidden" value=0>

              <div class="card">
                <div class="card-body ">
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
                <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                <input type=button class="btn btn-danger" onclick="window.location='page_report.php'" value=ยกเลิก>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>


<?php } ?>
<?php if (isset($_GET['ids'])) { //หน้าเพิ่มไฟล์ สำหรับหน้าค้นหาเอกสาร
  $ids = $_GET["ids"]; ?>
  <div class="content-wrapper">
    <div style="margin-left:10%; padding-top :2%;">
      <div class="container my-8">
        <h2>เพิ่มไฟล์</h2>
        <form action="insert.php?Files=1<?php ?>" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-12">
              <input type="text" name="ids" value="<?php echo $ids ?>" hidden>
              <input hidden name="date" type="datetime" value=<?php date_default_timezone_set("Asia/Bangkok");
                                                              echo date("Y-m-d\TH:i:s"); ?>>
              <input name="btnCreate" type="button" class="btn btn-sm btn-success" value="เพิ่มไฟล์" onClick="JavaScript:fncCreateElement();">
              <input name="btnDelete" type="button" class="btn btn-sm btn-danger" value="ลบไฟล์" onClick="JavaScript:fncDeleteElement();"><br><br>
              <input name="hdnLine" id="hdnLine" type="hidden" value=0>

              <div class="card">
                <div class="card-body ">
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
                <input type="reset" class="btn btn-info" value="รีเซ็ตข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                <input type=button class="btn btn-danger" onclick="window.location='page_report_search.php'" value=ยกเลิก>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>


<?php } ?>

<?php if (isset($_GET['page']) == 1) {
?>
  <div class="content-wrapper">
    <div class="row">
      <div class="offset-3 col-md-6">
        <!-- general form elements -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">อัพเดทข้อมูล</h3>
          </div>

          <form action="insert.php?page=1" method="POST">
            <div class="card-body">
              <div class="form-group">

                <label for="exampleInputEmail1">ชื่อรายการ</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="" placeholder="ชื่อรายการ" required>

              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">หน้ารายการ (.php)</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="file" value="" placeholder="XXXX.php" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">ไอคอน ( <a href="https://fontawesome.com/" target="_blank">fontawesome</a>)</label>

                <input type="text" class="form-control" id="exampleInputPassword1" name="icon" value="" placeholder="fa fa-XXXX" required>
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
</body>

</html>