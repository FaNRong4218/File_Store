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

  <title>AdminLTE 3 | Report</title>

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
<?php
include "menu.php";
?>
<?php
include_once 'connect.php';
$sql1 = "SELECT * FROM insurance WHERE Corp_Status = 'on'";
$query1 = mysqli_query($con, $sql1);
$sql2 = "SELECT * FROM brand WHERE Car_Status = 'on'";
$query2 = mysqli_query($con, $sql2);
$sql3 = "SELECT * FROM type WHERE Type_Status = 'on'";
$query3 = mysqli_query($con, $sql3);
?>

<div class="content-wrapper">
  <div style="padding:px; padding-top :4%;">
    <div class="container my-6">
        <div class="card" style="width: 105%; ">
            <h2 class="card-header bg-dark">ค้นหารายงาน</h2>
          <div class="card-body ">
            <form action="search.php" method="post">
              <div class="form-row justify-content-center">
                <div class="form-group col-md-3">
                  <label>เลือกวันที่ต้องการ</label><br>
                  <select name="date" id="date" class="form-control">
                    <option value="">เลือกวันที่ต้องการ</option>
                    <option value="date_Start">วันแก้ไขรายงาน</option>
                    <option value="date_Now">วันเริ่มสร้าง</option>
                    <option value="date_Ext">วันหมดอายุ</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="insurance">วันที่</label>
                  <input name="date_start" type="date" value="" class="form-control">
                </div>

                <div class="form-group col-md-3">
                  <label for="insurance">ถึงวันที่</label>
                  <input name="date_end" type="date" value="" class="form-control">
                </div>
              </div>
              <div class="form-row justify-content-center">
                <div class="form-group col-md-9">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title">ค้นหาเพิ่มเติม</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="form-row justify-content-center">
                        <div class="form-group col-md-4">
                          <label>เลือกบริษัทประกันภัย</label><br>
                          <select name="insurance" id="insurance" class="form-control">
                            <option value="">เลือกบริษัทประกันภัยนที่ต้องการ</option>
                            <?php while ($results = mysqli_fetch_assoc($query1)) : ?>
                                    <option value="<?= $results["Corp_ID"] ?>"><?= $results["Corp_Name"] ?></option>
                                <?php endwhile; ?>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>เลือกยี่ห้อรถ</label><br>
                          <select name="brand" id="brand" class="form-control">
                            <option value="">เลือกยี่ห้อรถที่ต้องการ</option>
                            <?php while ($results = mysqli_fetch_assoc($query2)) : ?>
                                    <option value="<?= $results["Car_ID"] ?>"><?= $results["Car_Name"] ?></option>
                                <?php endwhile; ?>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label>เลือกประเภท</label><br>
                          <select name="type" id="type" class="form-control">
                            <option value="">เลือกประเภทประกันที่ต้องการ</option>
                            <?php while ($results = mysqli_fetch_assoc($query3)) : ?>
                                    <option value="<?= $results["Type_ID"] ?>"><?= $results["Type_Name"] ?></option>
                                <?php endwhile; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>

                </div>
              </div>
              <div class="form-row justify-content-center">
                <div class="form-group col-md-5">
                  <button class="btn btn-success" type="submit" name="submit" id="submit"><i class="fas fa-search" value="submit"></i></a>&nbsp;
                    ค้นหารายละเอียด
                  </button>
                  <button class="btn btn-warning" type="button" name="restart" id="submit" onclick="window.location='page_report.php'"><i class="fas fa-retweet"></i></i>
                    รีเซ็ตการค้นหา
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      <div class="card" style="width: 105%;">
        <div class="card-body">
          <a href="page_insert.php?Report=1" title='Insert Data'>
            <button type=button class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a>
          <?php
          include_once 'connect.php';
          $sql = "SELECT Report_ID, insurance.Corp_Name, brand.Car_Name, type.Type_Name, Report_Status,Report.Car_ID,
                  Date_Now,  Date_Ext, Date_Start
          FROM report 
          INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
          INNER JOIN brand ON brand.Car_ID = report.Car_ID
          INNER JOIN type ON  type.Type_ID = report.Type_ID
          ";

          $result = mysqli_query($con, $sql);


          ?>
          <table id="Table" class="table table-striped" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อบริษัท</th>
                <th>ชื่อยี่ห้อรถ</th>
                <th>ประเภทประกัน</th>
                <th>วันเริ่มสร้าง</th>
                <th>วันแก้ไข</th>
                <th>วันหมดอายุ</th>
                <th>สถานะ</th>
                <th>ฟังก์ชัน</th>
              </tr>
            </thead>
            <tbody>
              <?php

              while ($row = mysqli_fetch_array($result)) {
                $car_id = array($row["Car_ID"]);
                $carids = implode(",", $car_id);
                $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
                $resultc = mysqli_query($con, $sqlc);

              ?>

                <tr>
                  <td><?php echo $row["Report_ID"]; ?></td>
                  <td><?php echo $row["Corp_Name"]; ?></td>
                  <td><?php foreach ($resultc as $value) {
                        echo $value["Car_Name"] . "  ";
                      } ?></td>
                  <td><?php echo $row["Type_Name"]; ?></td>
                  <td><?php echo $row["Date_Start"]; ?></td>
                  <td><?php echo $row["Date_Now"]; ?></td>
                  <td><?php echo $row["Date_Ext"]; ?></td>
                  <td>
                    <?php if ($_SESSION['type'] == 'member') {
                      $text_dis = "disabled";
                    } else {
                      $text_dis = "";
                    }
                    ?>
                    <?php if ($row["Report_Status"] == 'on') {
                      $text = "checked";
                    } else {
                      $text = "";
                    }
                    ?>
                    <label class="switch">
                      <input type="checkbox" <?php echo $text ?> <?php echo $text_dis ?> class="change" name="change" id="<?php echo $row["Report_ID"] ?>">
                      <span class="slider"></span>
                    </label>

                  </td>
                  <td>
                    <a href="page_update.php?Report_ID=<?php echo $row["Report_ID"]; ?>" title='แก้ไขข้อมูล'>
                      <button type=button class="btn btn-dark btn-sm"><i class="far fa-edit"></i>
                      </button></a>

                    <a title='รายละเอียด'>
                      <button type=button class="btn btn-dark btn-sm view" name="view" value="ข้อมูล" id="<?php echo $row["Report_ID"]; ?>">
                        <i class="fas fa-sticky-note"></i>
                      </button>
                      <a>

                        <a title='ไฟล์'>
                          <button type=button class="btn btn-dark btn-sm file" name="file" value="ไฟล์" id="<?php echo $row["Report_ID"]; ?>">
                            <i class="fas fa-folder"></i>
                          </button>
                          <a>
                  </td>

                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

          <?php

          ?>
          <script>
            $(document).on('click', '.view', function() {
              var Report_ID = $(this).attr("id");
              if (Report_ID != '') {
                $.ajax({
                  url: "showReport.php",
                  method: "POST",
                  data: {
                    Report_ID: Report_ID
                  },
                  success: function(data) {
                    $('#Report_detail').html(data);
                    $('#dataModal1').modal('show');
                  }
                });
              }
            });
            $(document).on('click', '.file', function() {
              var Report_ID = $(this).attr("id");
              if (Report_ID != '') {
                $.ajax({
                  url: "showfile.php",
                  method: "POST",
                  data: {
                    Report_ID: Report_ID
                  },
                  success: function(data) {
                    $('#File_detail').html(data);
                    $('#dataModal2').modal('show');
                  }
                });
              }
            });
            $(document).on('click', '.change', function() {
              var Report_ID = $(this).attr("id");
              if (Report_ID != '') {
                $.ajax({
                  url: "Change_status.php",
                  method: "POST",
                  data: {
                    Report_ID: Report_ID
                  },
                  success: function(data) {
                    console.log(data);
                  }
                });
              }
            });
          </script>
        </div>
      </div>

      <!-- Modal content-->
      <div id="dataModal1" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5>รายละเอียดของประกัน<h5>
            </div>
            <div class="modal-body" id="Report_detail">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <div id="dataModal2" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5>ไฟล์ต่างๆ<h5>
            </div>
            <div class="modal-body" id="File_detail">
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>




<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
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