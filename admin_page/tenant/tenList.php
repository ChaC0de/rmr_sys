<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_student 
INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
INNER JOIN user ON tb_student.u_ID = user.u_ID ORDER BY tb_student.u_ID ASC";
$query = mysqli_query($conn, $sql); 
$num = mysqli_num_rows( $query );
$list=0;
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<head>
<title>Student List</title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Include sidebar -->
    <?php include ('../../_navbar/adminNav.php')?>
    <!-- Content -->
    <div class="col-lg-9 col-md-8 mx-auto">
      <div class="row py-lg-5">
        <br>
        <div class="container">
          <p class="fs-3 text-center">รายการนักศึกษา</p>

          <!-- Search Form -->
          <form action="searchTen.php" method="post">
            <div class="input-group flex-nowrap pe-5 ps-5 ">
              <span class="input-group-text" id="addon-wrapping">ค้นหา</span>
              <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
              <input class="btn btn-primary" type="submit" value="ค้นหา">
            </div>
          </form>
          <hr>

          <!-- Add Student Button -->
          <div class="row">
            <div class="col align-self-end d-flex justify-content-end pe-3">
              <a href="addTen.php"><button type="button" class="btn btn-info">เพิ่มนักศึกษา</button></a>
            </div>
          </div>
          <hr>

          <!-- Result Count -->
          <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
          
          <!-- Student Records Table -->
          <table class="table table-hover">
            <tr>
              <th>ลำดับ</th>
              <!-- <th>รหัสผู้เช่า</th> -->
              <th>ชื่อ</th>
              <th>ชื่อผู้ใช้</th>
              <th>ศึกษาในคณะ</th>
              <th></th>
              <th></th>
            </tr>
            <?php foreach($query as $row) { $list++; ?>
            <tr>
              <th><?php echo $list; ?></th>
              <!-- <th><?=$row['u_ID']?></th> -->
              <th><?=$row['st_name']?></th>
              <th><?=$row['username']?></th>
              <th><?=$row['faculty']?></th>
              <!-- View More Button -->
              <td class="text-center">
                <a href="viewTen.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
              </td>
              <!-- Delete Button -->
              <td class="text-center">
                <a href="delTen.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
