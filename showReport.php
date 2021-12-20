<?php
if (isset($_POST["Report_ID"])) {
  include_once 'connect.php';
  $id = $_POST['Report_ID'];
  $sql = "SELECT Report_ID,insurance.Corp_Img,brand.Car_Img, 
             type.Type_Name,Report_Detail,Date_Start,Date_Now, Date_Start,Date_Ext,
             File1, File2, File3  
           FROM report 
           INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
           INNER JOIN brand ON brand.Car_ID = report.Car_ID
           INNER JOIN type ON  type.Type_ID = report.Type_ID
           WHERE Report_ID='$id';";
  $result = mysqli_query($link, $sql);

  foreach ($result as $value) {
    $report_ID = $value['Report_ID'];
    $insurance_img = $value['Corp_Img'];
    $type = $value['Type_Name'];
    $brand_img = $value['Car_Img'];
    $date_now = $value['Date_Now'];
    $date_start = $value['Date_Start'];
    $date_ext = $value['Date_Ext'];
    $detail = $value['Report_Detail'];
    $file1 = $value['File1'];
    $file2 = $value['File2'];
    $file3 = $value['File3'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="content">
    <div class="container my-6">
          <div class="row">
            <div class="col-md-4">
              <img src="img/brand_insurance/<?php echo  $insurance_img ?>" width="60%"><br>
            </div>
            <div class="col-md-4">
              <img src="img/brand_car/<?php echo $brand_img ?>" width="60%"><br>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-10">
              <label>ประเภทประกันคือ :  <?php echo $type ?></label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <label>วันที่สร้าง :  <?php echo $date_start?></label>
            </div>
          </div>
          <div class="row">
            <div class=" col-md-10">
              <label>วันที่แก้ไข :  <?php echo $date_now ?></label>
            </div>
          </div>
          <div class="row">
            <div class=" col-md-10">
              <label>วันที่หมดอายุ :  <?php echo $date_ext ?></label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <label>รายละเอียด </label>
              <?php echo  $detail ?>
            </div>
          </div>
          <div class="row">
            <div class= "col-md-10">
              <label>ไฟล์ที่เกี่ยวข้อง </label>
              <p>ไฟล์ที่ 1</p><a href="download.php?file1=<?php echo $file1 ?>"><?php echo $file1 ?></a>
              <p>ไฟล์ที่ 2</p><a href="download.php?file2=<?php echo $file2 ?>"><?php echo $file2 ?></a>
              <p>ไฟล์ที่ 3</p><a href="download.php?file3=<?php echo $file3 ?>"><?php echo $file3 ?></a>
            </div>
          </div>
    </div>
  </div>

</body>

</html>