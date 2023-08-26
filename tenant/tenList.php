<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_student 
INNER JOIN tb_st_faculty ON tb_student.st_name = tb_st_faculty.st_name 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID";
$query = mysqli_query($conn, $sql); 
$num = mysqli_num_rows( $query );
$list=0;
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<head>
<title>Student List</title>
</head>
<body>
    <br>
    <div class="container text-center">
<p class="fs-3 text-center">รายการนักศึกษา</p>

    <!-- search  -->
<form action="searchTen.php" method="post">
<div class="input-group flex-nowrap pe-5 ps-5 ">
  <span class="input-group-text" id="addon-wrapping">ค้นหา</span>
  <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
  <input class="btn btn-primary" type="submit" value="ค้นหา">
</div>
</form>
<hr>
<div class="row">
<div class="col align-self-end d-flex justify-content-end pe-3">
<a href="addTen.php"><button type="button" class="btn btn-info ">เพิ่มนักศึกษา</button></a>
    </div>
</div>
<hr>
<p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
<table class="table table-hover">
    <tr>
        <th>ลำดับ</th>
        <!-- <th>รหัสผู้เช่า</th> -->
        <th>ชื่อ</th>
        <th>อีเมล</th>
        <th>ศึกษาในคณะ</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?php echo $list; ?></th>
        <!-- <th><?=$row['st_ID']?></th> -->
        <th><?=$row['st_name']?></th>
        <th><?=$row['st_email']?></th>
        <th><?=$row['faculty']?></th>
        <!-- เพิ่มเติม -->
            <td class="text-center">
            <a href="viewTen.php?st_ID=
            <?php echo $row["st_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
        </td>
        <!-- แก้ไข -->
        <td class="text-center">
            <a href="editTen.php?st_ID=
            <?php echo $row["st_ID"]?>" class="btn btn-secondary">แก้ไข</a>
        </td>
        <!-- ลบ -->
        <td class="text-center">
            <a href="delTen.php?st_ID=
            <?php echo $row["st_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
        </td>
    </tr>
    <?php } ?>
</table>
</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
