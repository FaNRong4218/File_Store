<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

?>
<?php
if (isset($_POST["Report_ID"])) {
  include_once 'connect.php';
  $id = $_POST['Report_ID'];
  $sql = "SELECT Report_ID,insurance.Corp_Img,brand.Car_Img,Report.Car_ID, 
             type.Type_Name,Report_Detail,Date_Start,Date_Now, Date_Start,Date_Ext
           FROM report 
           INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
           INNER JOIN brand ON brand.Car_ID = report.Car_ID
           INNER JOIN type ON  type.Type_ID = report.Type_ID
           WHERE Report_ID='$id';";
  $result = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_array($result)) {
    $carid = explode(",", $row["Car_ID"]);
    $carids = implode(",", $carid);
    $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
    $resultc = mysqli_query($con, $sqlc);
  }
  foreach ($result as $value) {
    $report_ID = $value['Report_ID'];
    $insurance_img = $value['Corp_Img'];
    $type = $value['Type_Name'];
    $date_now = $value['Date_Now'];
    $date_start = $value['Date_Start'];
    $date_ext = $value['Date_Ext'];
    $detail = $value['Report_Detail'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Show Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="dist/css/myCSS.css">
  <script src="dist/css/myCSS.css"></script>

</head>

<body>

  <div class="content">
    <div class="container my-6">
      <div class="row">
        <div class="col-md-4">
          <label> บริษัทประกันภัย</label>
          <img src="myImg/insurance/<?php echo  $insurance_img ?>" width="60%"><br>
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-4">
          <label>ยี่ห้อรถ</label>
        </div>
      </div>
      <div class="row">
        <?php while ($result = mysqli_fetch_array($resultc)) { ?>
          <div class="col-md-4">
            <img src="myImg/brand/<?php echo $result['Car_Img'] ?>" width="60%">
          </div>
        <?php } ?>
      </div>
      <div class="row">
        <div class="col-md-10">
          <label>ประเภทประกันคือ : <?php echo $type ?></label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <label>วันที่สร้าง : <?php echo $date_start ?></label>
        </div>
      </div>
      <div class="row">
        <div class=" col-md-10">
          <label>วันที่แก้ไข : <?php echo $date_now ?></label>
        </div>
      </div>
      <div class="row">
        <div class=" col-md-10">
          <label>วันที่หมดอายุ : <?php echo $date_ext ?></label>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <label>รายละเอียด </label>
          <?php echo  $detail ?>
        </div>
      </div>
    </div>
  </div>

</body>

</html>