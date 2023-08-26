<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_admin  ORDER BY `tb_admin`.`admin_ID` ASC";
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
<title>Admin List</title>
</head>
<body>
    <br>
<div class="container text-center">
<p class="fs-3 text-center">รายการผู้ดูแลระบบ</p>
<form action="searchAdmin.php" method="post">
<div class="input-group flex-nowrap pe-5 ps-5 ">
  <span class="input-group-text" id="addon-wrapping">ค้นหาผู้ดูแลระบบ</span>
  <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
  <input class="btn btn-primary" type="submit" value="ค้นหา">
</div>
</form>
<hr>
<div class="row">
<div class="col align-self-end d-flex justify-content-end pe-3">
<a href="addAdmin.php"><button type="button" class="btn btn-info ">เพิ่มผู้ดูแลระบบ</button></a>
    </div>
</div>
้<hr>
<p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
<table class="table table-hover">
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อ</th>
        <th>ชื่อผู้ใช้</th>
        <th>รหัสผ่าน</th>
        <th>เบอร์โทรศัพท์</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?php echo $list;?></th>
       <th><?=$row['ad_name']?></th>
        <th><?=$row['username']?></th>
        <th><?=$row['password']?></th>

        <th><?=$row['ad_tel']?></th>

        <!-- แก้ไข -->
        <td class="text-center">
            <a href="editAdmin.php?admin_ID=
            <?php echo $row["admin_ID"]?>" class="btn btn-secondary">แก้ไข</a>
        </td>
        <!-- ลบ -->
        <td class="text-center">
            <a href="delAdmin.php?admin_ID=
            <?php echo $row["admin_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
        </td>
    </tr>
    <?php } ?>
</table>
</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
