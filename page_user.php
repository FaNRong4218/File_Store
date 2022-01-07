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
  <link rel="stylesheet" href="dist/css/MyStyle.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2f85583488.js" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>
<?php
include "menu.php";
?>

<div class="content-wrapper">
  <div style="margin-left:4%; padding-top :4%;">
    <div class="container my-6">
      <?php
      include_once 'connect.php';
      $result = mysqli_query($link, "SELECT * FROM user");
      ?>
      <?php
      if (mysqli_num_rows($result) > 0) {
      ?>

        <table id="Table" class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th hidden></th>
              <th>ลำดับ</th>
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
                <td><?php echo $row["type"]; ?></td>
                <td>
                  <a href="page_update.php?id=<?php echo $row["id"]; ?>" title='Update Record'>
                    <button type=button class="btn btn-dark btn-sm"><i class="far fa-edit"></i>
                    </button></a>
                  <a href="delete_user.php?id=<?php echo $row["id"]; ?>&submit=DEL" onclick="return confirm('ต้องการจะลบผู้ใช้งานนี้หรือไม่ ?')" title='ลบผู้ใช้งาน'>
                    <button type=button class="btn btn-dark btn-sm"> <i class="fas fa-trash-alt"></i></button></a>
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