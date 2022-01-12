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

  <title>AdminLTE 3 | Brand</title>

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
  <!-- <style>
    img {
      border-radius: 50%;
    }
  </style> -->
</head>

<?php
include "menu.php";
?>


<div class="content-wrapper ">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6 ">
      <a href="page_insert.php?brand=1" title='Insert Data'>
        <button type=button class="btn btn-info">เพิ่มข้อมูล <i class="fas fa-plus-circle"></i></button><br><br>
      </a>

      <?php
      include_once 'connect.php';
      $sql = "SELECT * FROM brand ;";
      $result = mysqli_query($con, $sql);

      ?>
      <?php


      if (mysqli_num_rows($result) > 0) {
      ?>

        <table id="Table" class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th>รูป logo</th>
              <th>ลำดับ</th>
              <th>ชื่อยี่ห้อ</th>
              <th>สถานะ</th>
              <th>ฟังก์ชัน</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
              <tr>
                <td>
                  <div class='card img-circle' style="width: 40%; margin-left:2%">
                    <div class='card-body'>
                      <img src="myImg/brand/<?php echo $row["Car_Img"]; ?>" width="70px">
                    </div>
                  </div>
                </td>
                <td><?php echo $row["Car_ID"]; ?></td>
                <td><?php echo $row["Car_Name"]; ?></td>
                <td> <?php if ($row["Car_Status"] == 'on') {
                        $text = "checked";
                      } else {
                        $text = "";
                      }
                      ?>
                  <label class="switch">
                    <input type="checkbox" <?php echo $text ?> class="change" name="change" id="<?php echo $row["Car_ID"] ?>">
                    <span class="slider"></span>
                  </label>
                </td>
                <td>
                  <a href="page_update.php?Car_ID=<?php echo $row["Car_ID"]; ?>" title='แก้ไขข้อมูล'>
                    <button type=button class="btn btn-dark btn-sm"> <i class="far fa-edit"></i>
                    </button>
                  </a>
                </td>
              </tr>
            <?php
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
            url: "Change_status.php",
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




<!-- jQuery
  <script src="plugins/jquery/jquery.min.js"></script> -->
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