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

  <title>AdminLTE 3 | Type</title>


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

<div class="content-wrapper">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6">
      <a href="page_insert.php?Type=1" title='Insert Data'>
        <button type=button class="btn btn-info">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br>
      </a>
      <?php
      include_once 'connect.php';
      $sql = "SELECT * FROM type ;";
      $result = mysqli_query($link, $sql);

      ?> <?php


          if (mysqli_num_rows($result) > 0) {
          ?> <table id="Table" class="table table-striped">
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
                  <input type="checkbox"<?php echo $text ?> class="change" name="change" id="<?php echo $row["Type_ID"] ?>" >
                  <span class="slider"></span>
                </label>
                </td>
                <td>
                  <a href="page_update.php?Type_ID=<?php echo $row["Type_ID"]; ?>" title='แก้ไขข้อมูล'>
                    <button type=button class="btn btn-dark btn-sm"><i class="far fa-edit"></i>
                    </button></a>

                  <a title='รายละเอียด'>
                    <button type=button class="btn btn-dark btn-sm view" name="view" value="ข้อมูล" id="<?php echo $row["Type_ID"]; ?>"><i class="fas fa-sticky-note"></i>
                    </button>
                    <a>

                </td>

              </tr>
            <?php
            }
            ?>
            <script>
              //Ajax เพื่อ ดึงค่า Type_ID จาก ตาราง
              //ฟังชั่น on บันทึกการเป็นแปลงเมื่อคลิ๊ก และกำหนด element ใน class ชื่อ viwe_data เพื่อ
              //อิงการเปลี่ยนแปลงเมื่อคลิ๊กจุดนั้น
              $(document).on('click', '.view', function() {
                var Type_ID = $(this).attr("id"); //กำหนดตัวแปรเพื่อเก็บ ค่า Type_ID 
                if (Type_ID != '') {
                  $.ajax({ //เขียน Ajex เพื่อส่งค่าไปยัง url ที่กำหนด
                    url: "showType.php", //กำหนด Url
                    method: "POST",
                    data: {
                      Type_ID: Type_ID //data ที่ได้ คือ Type_ID
                    },
                    success: function(data) {
                      $('#Type_detail').html(data); //นำข้อมูลจาก ไฟล์ "showType.php"มา ใส่ใน id ชื่อ Type_detail
                      $('#dataModal').modal('show'); // แสดง modal โดยมี id ชื่อ dataModal เป็นตัวอ้างอิง
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
<script>
  $(document).ready(function() {
    $('#Table').DataTable();
  });
</script>

</html>