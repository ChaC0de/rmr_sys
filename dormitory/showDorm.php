<?php 
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql= "SELECT * FROM tb_dormitory ORDER BY dorm_ID ASC";
$sql= "SELECT tb_dormitory.dorm_ID,tb_dormitory.dormName,tb_landlord.land_name 
FROM tb_dormitory 
INNER JOIN tb_landlord ON tb_dormitory.land_name=tb_landlord.land_name 
ORDER BY dorm_ID ASC"; //เลือกข้อมูลทั้งหมดจากตาราง tb_dormitory, tb_dormtype


$query = mysqli_query($conn, $sql); //เก็บค่าที่ได้จากการ query ลงในตัวแปร $query
$num = mysqli_num_rows( $query );
$list=0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>
    ข้อมูลหอพัก
    </title>
</head>
<body>
<br>
    <!-- show dormitory -->
<div class="container text-center">
    <h3>ข้อมูลหอพัก</h3>
    <form action="searchDorm.php" class="form-group my-3" method="post">
    <div class="input-group flex-nowrap pe-5 ps-5 ">
        <span class="input-group-text" id="addon-wrapping">ค้นหาหอพัก</span>
        <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
        <input class="btn btn-primary" type="submit" value="ค้นหา">
        </div>
    </form>
    <hr>
<div class="row">
<div class="col align-self-end d-flex justify-content-end pe-3">
<a href="addDorm.php"><button type="button" class="btn btn-info ">เพิ่มหอพัก</button></a>
    </div>
</div>
<hr>
<th><p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></th></p>
    <table class="table"> 
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อหอพัก</th>
           <th>เจ้าของหอพัก</th>
            <th></th>
            <th></th>
            <th></th>
            
        </tr>
        </div>
        <?php foreach($query as $row) { 
            $list++;
 ?>
            

    <tr>
        <th><?php echo $list; ?></th>
        <th><?=$row['dormName']?></th>
       <th><?=$row['land_name']?></th>
        <!-- เพิ่มเติม -->
        <td class="text-center">
            <a href="viewDorm.php?dorm_ID=
            <?php echo $row["dorm_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
        </td>
        <th><a href="editDorm.php?dorm_ID=<?=$row['dorm_ID']?>"class="btn btn-secondary">แก้ไข</a></th>
        <th><a href="deleteDorm.php?dorm_ID=<?=$row['dorm_ID']?>"class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่ไหม')">ลบ</a></th>
    </tr>
    <?php } ?>
    
    </table>
    </div>
    <!-- end show dormitory -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>