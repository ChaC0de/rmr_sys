<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$search = $_POST['search'];// คำสั่งค้นหา
$sql = "SELECT * FROM tb_landlord  WHERE land_name LIKE '%$search%' ORDER BY land_name ASC"; 
$query = mysqli_query($conn, $sql); 
$num = mysqli_num_rows( $query );
$list=0;
$order = 1;

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<head>
<div class="container text-center">
<title>Landlord List</title>
</head>
<body>
  <br>
<p class="text-center fs-2">รายการเจ้าของหอพัก</p>
   
<hr color="Red">
<p class="fs-5 pe-5 ps-5 text-end"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
<?php if($num >0){ ?>

<table class="table table-hover">
    <tr>
        <th>ลำดับ</th>
        <th>รหัสเจ้าของหอพัก</th>
        <th>ชื่อ</th>
        <th>อีเมล</th>
        <th>Tel number</th>
        <th>เลขประจำตัวผู้เสียภาษี</th>
        <th></th>
        <th></th>

    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?=$list?></th>
        <th><?=$row['land_ID']?></th>
        <th><?=$row['land_name']?></th>
        <th><?=$row['land_email']?></th>
        <th><?=$row['land_tel']?></th>
        <th><?=$row['tax_num']?></th>
         <!-- เพิ่มเติม -->
         <td class="text-center">
            <a href="viewLand.php?land_ID=
            <?php echo $row["land_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
        </td>
           <!-- แก้ไข -->
           <td class="text-center">
            <a href="editLand.php?land_ID=
            <?php echo $row["land_ID"]?>" class="btn btn-secondary">แก้ไข</a>
        </td>
        <!-- ลบ -->
        <td class="text-center">
            <a href="delLand.php?land_ID=
            <?php echo $row["land_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
        </td>
    </tr>
    <?php } ?>
</table></div>
<?php }else{?>
    <div class="alert alert-danger">
        <b>ไม่พบข้อมูลที่ค้นหา</b>
    </div>
    <?php } ?>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
