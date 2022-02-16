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

  <title>Insurance</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
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
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

  <style>
    img {
      border-radius: 50%;
    }
  </style>
</head>

<?php include "menu.php"; ?>

<?php include_once 'connect.php';?>


<div class="content-wrapper ">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6 ">
      <div class="card">
        <h2 class="card-header bg-warning">ยี่ห้อรถ</h2>
        <div class="card-body ">
          <a href="page_insert.php?brand=1" title='Insert Data'>
            <button type=button class="btn btn-info rounded-pill">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br>
          </a>

          <?php
          $sql = "SELECT * FROM brand ORDER BY Car_ID desc";
          $result = mysqli_query($con, $sql);

          ?>
          <?php


          if (mysqli_num_rows($result) > 0) {
          ?>

            <table id="example1" class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>No</th>
                  <th>รูป logo</th>
                  <th hidden>Car_ID</th>
                  <th>ชื่อยี่ห้อ</th>
                  <th>สถานะ</th>
                  <th>ฟังก์ชัน</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                      <?php if ($row["Car_Img"] != 'none.png') {
                        $scr = 'myImg/brand/';
                      } else {
                        $scr = 'myImg/brand/default_img/';
                      } ?>
                      <img src="<?php echo $scr; ?><?php echo $row["Car_Img"]; ?>" width="80px">
                    </td>
                    <td hidden><?php echo $row["Car_ID"]; ?></td>
                    <td><?php echo $row["Car_Name"]; ?></td>
                    <td> <?php if ($row["Car_Status"] == 'on') {
                            $text = "checked";
                          } else {
                            $text = "";
                          }
                          ?>
                      <label class="switch">
                        <input type="checkbox" <?php echo $text ?> class="change" name="change" id="<?php echo $row["Car_ID"] ?>">
                        <span class="slider round"></span>
                      </label>
                    </td>
                    <td>
                      <div class='row'>
                        <div class='col-auto col-sm-auto'>
                          <a type='button' class="btn btn-warning btn-sm rounded-pill " href="page_update.php?Car_ID=<?php echo $row["Car_ID"]; ?>" title='แก้ไขข้อมูล'>
                            <i class="far fa-edit"></i>
                            แก้ไข</a>
                        </div>
                        <div class='col-auto col-sm-auto'>
                          <a type='button' class="btn btn-danger btn-sm rounded-pill " href="delete.php?Car_ID=<?php echo $row["Car_ID"]; ?>&submit=6" onclick="return confirm('ต้องการจะลบเอกสารนี้หรือไม่ ?')" title='ลบข้อมูล'>
                            <i class="fas fa-trash-alt"></i>
                            ลบ</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                  $i++;
                }
                ?>
              </tbody>
            </table>

          <?php
          } else {
            echo "No result found";
          }
          ?>
        </div>
        <script>
          $(document).on('click', '.change', function() {
            var Car_ID = $(this).attr("id");
            if (Car_ID != '') {
              $.ajax({
                url: "change_status.php",
                method: "POST",
                data: {
                  Car_ID: Car_ID
                },
                success: function(data) {
                  $('#' + Car_ID).show();
                  header('Refresh:0; url=page_brand.php');
                }
              });
            }
          });
        </script>
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