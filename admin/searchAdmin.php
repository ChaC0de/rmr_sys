<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

@$search = $_POST['search'];// คำสั่งค้นหา
$sql = "SELECT * FROM tb_admin WHERE ad_name LIKE '%$search%' ORDER BY ad_name ASC";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$order = 1;
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

<div class="container text-center">
<p class="fs-3 text-center">รายการผู้ดูแลระบบ</p>
<hr>
<div class="row">
<div class="col align-self-end d-flex justify-content-end pe-3">
<a href="addAdmin.php"><button type="button" class="btn btn-info ">เพิ่มผู้ดูแลระบบ</button></a>
    </div>
</div>
้<hr>
<p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
<?php if($num > 0){ ?>

<table class="table table-hover">
    <tr>
        <th>ลำดับ</th>
        <th>รหัสผู้ดูแล</th>
        <th>ชื่อ</th>
        <th>ชื่อผู้ใช้</th>
        <th>เบอร์โทรศัพท์</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?php echo $list;?></th>
        <th><?=$row['admin_ID']?></th>
        <th><?=$row['ad_name']?></th>
        <th><?=$row['username']?></th>
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
</table></div>
<?php } else { ?>
    <div class="alert alert-danger">
       <b> ไม่พบข้อมูลที่ค้นหา</b>
    </div>
<?php } ?>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
