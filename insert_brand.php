<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>
<?php
require_once "connect.php";
$sql1 = "SELECT * FROM insurance ";
$query1 = mysqli_query($link, $sql1);
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $Name = $_POST['Name'];
          $status = $_POST['Status'];
          $file = $_FILES['img']['name'];
        
        $sql = "INSERT INTO brand (Car_Name, Car_Status, Car_Img)
        VALUES ('$Name', '$status', '$file' )";

          $stmt = mysqli_query($link, $sql);

          if ($stmt) {

              echo "<script type='text/javascript'>";
              echo "alert('เพิ่มข้อมูลสำเร็จ');";
              echo "window.location = 'page_brand.php';";
              echo "</script>";
          } else {
              echo "มีบางอย่างผิดพลาด!! กรุณาลองใหม่อีกครั้ง";
          }
        }
          mysqli_close($link);
    ?>
    <div class="content-wrapper">
      <div style="margin-left:10%; padding-top :2%;">
        <div class="container my-6">
          <h2>เพิ่มข้อมูลยี่ห้อรถ</h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <div class="form-row">
              <div class="form-group col-md-4">
                  <label>ชื่อยี่ห้อรถ</label><br>
                  <input type="text"  class="form-control"name="Name" required>
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
                <img id="imgAvatar"  width="40%">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>ไฟล์ Logo</label><br>
                <input type="file" name="img" accept="image/*" required  OnChange="showPreview(this)" >
              </div>
            </div>
            <br>   
            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="submit" class="btn btn-primary" value="ยืนยัน"> &nbsp;&nbsp;
                <input type="reset" class="btn btn-default" value="ล้างข้อมูล" onclick="window.location.reload();"> &nbsp;&nbsp;
                <input type=button class="btn btn-danger" onclick="window.location='page_insurance.php'" value=ยกเลิก>
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