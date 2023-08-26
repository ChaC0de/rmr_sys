<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$search = $_POST['search'];// คำสั่งค้นหา

$sql = "SELECT * FROM tb_student 
INNER JOIN tb_st_faculty ON tb_student.st_name = tb_st_faculty.ten_name 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID  
WHERE st_name LIKE '%$search%' ORDER BY st_name ASC"; 


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
<title>Tenant List</title>
</head>
<body>
<div class="container text-center">
<p class="text-center fs-2">รายการผู้เช่าหอพัก</p>
   
<hr color="Red">
<p class="fs-5 pe-5 ps-5 text-end"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
<?php if($num > 0){ ?>
<table class="table table-hover">
    <tr class="text-center">
        <th>ลำดับ</th>
        <th>รหัสผู้เช่า</th>
        <th>ชื่อ</th>
        <th>อีเมล</th>
        <th>ศึกษาในคณะ</th>
        <th></th>
        <th></th>

    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?php echo $list; ?></th>
        <th><?=$row['st_ID']?></th>
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
<?php }else{?>
    <div class="alert alert-danger">
        <b>ไม่พบข้อมูลที่ค้นหา</b>
    </div>
    <?php } ?>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
