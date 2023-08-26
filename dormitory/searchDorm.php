<?php 
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

if($_POST)
{
$land_name = $_POST['search'];//ชื่อที่ตั้งใน form เช่น <input type='text' name='year'>
$search = $_POST['search'];// คำสั่งค้นหา

}

//$sql="SELECT * FROM TABLENAME WHERE field1 LIKE '%$year%' AND field2 LIKE '%$agency%' AND field3 LIKE '%$keyword%'"

$sql= "SELECT * FROM tb_dormitory WHERE dormName
LIKE '%$search%' ORDER BY dormName ASC"; //เลือกข้อมูลทั้งหมดจากตาราง tb_dormitory โดยเรียงจากชื่อ

$query = mysqli_query($conn, $sql); 
$num = mysqli_num_rows( $query ); //นับจำนวนแถวที่ได้จากการเลือกข้อมูล
$list=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>search dormitory</title>
</head>
<body>     
<div class="container text-center">
    <br><h3>ข้อมูลหอพัก</h3>
    <br>
    <?php if($num > 0) 
    { ?> 


    <table class="table"> 
        <tr>
            <th>ลำดับ</th>
            <th>รหัสหอพัก</th>
            <th>ชื่อหอพัก</th>
            <th>เจ้าของหอพัก</th>
            <th></th>
            <th></th>
            <th></th>
            
        </tr>
        </div>
        <?php foreach($query as $row) {  $list++; ?>
    <tr>
        <th><?php echo $list; ?></th>
        <th><?=$row['dorm_ID']?></th>
        <th><?=$row['dormName']?></th>
        <th><?=$row['land_name']?></th>
            <!-- เพิ่มเติม -->
            <td class="text-center">
        <a href="viewDorm.php?dorm_ID=
        <?php echo $row["dorm_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
        </td>
        <th><a href="editDorm.php?dorm_ID=<?=$row['dorm_ID']?>"class="btn btn-primary">แก้ไข</a></th>
        <th><a href="deleteDorm.php?dorm_ID=<?=$row['dorm_ID']?>"class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่ไหม')">ลบ</a></th>

        
    </tr>
    <?php }  ?>

    </table>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        ไม่พบข้อมูลที่ค้นหา
    </div>
<?php } ?>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>