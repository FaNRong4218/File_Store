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

  <title>User</title>


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





</head>
<?php
include "menu.php";
?>

<div class="content-wrapper">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6">
      <div class="card">
        <h2 class="card-header bg-success">ผู้ใช้งาน</h2>
        <div class="card-body ">
          <a href="register.php" title='Insert Data'>
            <button type=button class="btn btn-info  rounded-pill">เพิ่มผู้ใช้งาน <i class="fas fa-plus-circle"></i></button><br><br>
          </a>
          <?php
          include_once 'connect.php';
          $result = mysqli_query($con, "SELECT * FROM user");
          ?>
          <?php
          if (mysqli_num_rows($result) > 0) {
          ?>

            <table id="example1" class="table table-striped">
              <thead class="bg-dark">
                <tr>
                  <th hidden></th>
                  <th>No</th>
                  <th>ผู้ใช้</th>
                  <th>ชื่อผู้ใช้</th>
                  <th>อีเมล</th>
                  <th>เบอร์โทรศัพท์</th>
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
                    <td><?php echo $i ?></td>
                    <td hidden><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["user"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["tel"]; ?></td>
                    <?php
                    if ($row["type"] == 'admin') {
                      $text = 'badge-danger';
                    }
                    if ($row["type"] == 'employee') {
                      $text = 'badge-info';
                    }
                    if ($row["type"] == 'member') {
                      $text = 'badge-success';
                    }
                    ?>
                    <td>
                      <h5><span class="badge <?php echo $text; ?>"><?php echo $row["type"]; ?><span></h5>
                    </td>
                    <td>
                      <div class='row'>
                        <div class='col-md-auto'>
                          <a href="page_update.php?id=<?php echo $row["id"]; ?>" title='Update Record'>
                            <button type=button class="btn btn-warning rounded-pill btn-sm"><i class="far fa-edit">แก้ไข</i>
                            </button></a>
                        </div>
                        <div class='col-md-auto'>
                          <a href="delete.php?id=<?php echo $row["id"]; ?>&submit=1" onclick="return confirm('ต้องการจะลบผู้ใช้งานนี้หรือไม่ ?')" title='ลบผู้ใช้งาน'>
                            <button type=button class="btn btn-danger rounded-pill btn-sm"> <i class="fas fa-trash-alt"></i> ลบ</button></a>
                        </div>
                        <div class='col-md-auto'>
                          <a href="edit_password.php?id=<?php echo $row["id"]; ?>&name=<?php echo $row["user"]; ?>" title='Update Record'>
                            <button type=button class="btn btn-info rounded-pill btn-sm"><i class="far fa-edit">รีเซ็ตพาสเวิร์ด</i>
                            </button></a>
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