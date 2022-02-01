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

  <title>Report</title>

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
</head>
<?php
include "menu.php";
include_once 'connect.php';
?>
<?php
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
      <div class="card">
        <h2 class="card-header bg-info">เอกสาร</h2>
        <div class="card-body ">
          <a href="page_insert.php?Report=1" title='Insert Data'>
            <button type=button class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br></a>
          <?php
          $sql = "SELECT Report_ID, insurance.Corp_Name, brand.Car_Name, type.Type_Name, Report_Status, report.Car_ID,
                  Date_Now,  Date_Ext, Date_Start
          FROM report 
          INNER JOIN insurance ON insurance.Corp_ID = report.Corp_ID
          INNER JOIN brand ON brand.Car_ID = report.Car_ID
          INNER JOIN type ON  type.Type_ID = report.Type_ID
          ORDER BY  Date_Now desc ;
          ";

          $results = mysqli_query($con, $sql);


          ?>
          <table id="example1" class="table table-striped" style="width: 100%;">
            <thead class="bg-dark">
              <tr>
                <th>ลำดับ</th>
                <th hidden>ไอดีเอกสาร</th>
                <th>ชื่อบริษัท</th>
                <th>ชื่อยี่ห้อรถ</th>
                <th>ประเภทประกัน</th>
                <th>วันเริ่มสร้างรายงาน</th>
                <th>วันแก้ไขรายงาน</th>
                <th>วันหมดอายุ</th>
                <th>สถานะ</th>
                <th>ฟังก์ชัน</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $num = 1;
              while ($row = mysqli_fetch_array($results)) {
                $car_id = array($row["Car_ID"]);
                $carids = implode(",", $car_id);
                $sqlc = "SELECT * FROM brand WHERE Car_ID IN ($carids)";
                $resultc = mysqli_query($con, $sqlc);

              ?>

                <tr>
                  <td><?php echo $num ?></td>
                  <td hidden><?php echo $row["Report_ID"]; ?></td>
                  <td><?php echo $row["Corp_Name"]; ?></td>
                  <td><?php foreach ($resultc as $value) {
                        echo $value["Car_Name"] . "  ";
                      } ?>
                  </td>
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
                      <span class="slider round"></span>
                    </label>

                  </td>
                  <td>
                    <div class='row'>
                      <div class="col-4">
                        <a href="page_update.php?Report_ID=<?php echo $row["Report_ID"]; ?>" title='แก้ไขข้อมูล'>
                          <button type=button class="btn btn-warning btn-sm"><i class="far fa-edit"></i>
                            แก้ไข</button></a>
                      </div>
                      <div class="col-4">
                        <button title='รายละเอียด' type=button class="btn btn-primary btn-sm view" name="view" value="ข้อมูล" id="<?php echo $row["Report_ID"]; ?>">
                          <i class="fas fa-eye"></i>
                          ดู</button>
                      </div>
                      <div class="col-4">

                        <button title='ไฟล์' type=button class="btn btn-info btn-sm file" name="file" value="ไฟล์" id="<?php echo $row["Report_ID"]; ?>">
                          <i class="fas fa-folder"></i>
                          ไฟล์</button>
                      </div>
                    </div>
                  </td>

                </tr>
              <?php
                $num++;
              }
              ?>
            </tbody>
          </table>

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
                  url: "change_status.php",
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

        <!-- Modal content-->
        <div id="dataModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog" role="document">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5>รายละเอียดของเอกสาร<h5>
              </div>
              <div class="modal-body" id="Report_detail">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <div id="dataModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">>

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h5>ไฟล์<h5>
              </div>
              <div class="modal-body" id="File_detail">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>





  </body>

</html>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>