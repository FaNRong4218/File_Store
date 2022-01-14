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

  <title>Type</title>


  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="dist/css/myCSS.css" type="text/css">
  <script src="dist/css/myCSS.css"></script>

  <style>
  </style>
</head>

<?php
include "menu.php";
?>

<div class="content-wrapper">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6">
      <div class="card">
        <h2 class="card-header bg-primary">ประเภทประกันภัย</h2>
        <div class="card-body ">
          <a href="page_insert.php?Type=1" title='Insert Data'>
            <button type=button class="btn btn-info float-lg-right">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br>
          </a>
          <?php
          include_once 'connect.php';
          $sql = "SELECT * FROM type";
          $result = mysqli_query($con, $sql);

          ?> <?php


              if (mysqli_num_rows($result) > 0) {
              ?> <table id="example1" class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อประเภทประกัน</th>
                  <th>สถานะ</th>
                  <th>ฟังก์ชัน</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row["Type_ID"]; ?></td>
                    <td><?php echo $row["Type_Name"]; ?></td>
                    <td> <?php if ($row["Type_Status"] == 'on') {
                            $text = "checked";
                          } else {
                            $text = "";
                          }
                          ?>
                      <label class="switch">
                        <input type="checkbox" <?php echo $text ?> class="change" name="change" id="<?php echo $row["Type_ID"] ?>">
                        <span class="slider"></span>
                      </label>
                    </td>
                    <td>
                      <a href="page_update.php?Type_ID=<?php echo $row["Type_ID"]; ?>" title='แก้ไขข้อมูล'>
                        <button type=button class="btn btn-warning btn-sm"><i class="far fa-edit"></i>
                          แก้ไข</button></a>
                      <button title='รายละเอียด' type=button class="btn btn-primary btn-sm view" name="view" value="ข้อมูล" id="<?php echo $row["Type_ID"]; ?>">
                        <i class="fas fa-eye"></i>
                        ดู</button>
                    </td>

                  </tr>
                <?php
                }
                ?>
                <script>
                  $(document).on('click', '.view', function() {
                    var Type_ID = $(this).attr("id");
                    if (Type_ID != '') {
                      $.ajax({
                        url: "showType.php",
                        method: "POST",
                        data: {
                          Type_ID: Type_ID
                        },
                        success: function(data) {
                          $('#Type_detail').html(data);
                          $('#dataModal').modal('show');
                        }
                      });
                    }
                  });
                  $(document).on('click', '.change', function() {
                    var Type_ID = $(this).attr("id");
                    if (Type_ID != '') {
                      $.ajax({
                        url: "Change_status.php",
                        method: "POST",
                        data: {
                          Type_ID: Type_ID
                        },
                        success: function(data) {
                          console.log(data);
                        }
                      });
                    }
                  });
                </script>
              </tbody>
            </table>
          <?php
              } else {
                echo "No result found";
              }
          ?>
          <!-- Modal content-->
          <div id="dataModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5>รายละเอียดของประเภทประกัน<h5>
                </div>
                <div class="modal-body" id="Type_detail">
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




    <!-- jQuery -->
    <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    </body>

</html>

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