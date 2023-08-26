<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$land_ID=$_GET['land_ID'];

$sql1 = "SELECT * FROM tb_landlord WHERE land_ID='$land_ID'";
// $sql2 = "SELECT * FROM tb_landlord 
// INNER JOIN tb_dormitory ON tb_landlord.land_ID=tb_dormitory.land_ID 
// WHERE tb_landlord.land_ID='$land_ID'";

$query = mysqli_query($conn, $sql1);
$num = mysqli_num_rows( $query );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <?php foreach($query as $row) { ?>
    <title>
    <?php echo $row['land_name'];?>
    </title>
</head>
<body>
<br>
    <p class="text-start px-3 pt-3 fs-4">ข้อมูลส่วนตัว</p>
    <!-- show details -->
    <hr><br>

    <div>
    <div class="row text-start px-5">
    <!-- <label for="land_img" class="form-label fs-5 px-5">ภาพโพรไฟล์ <br><?=$row['land_img']?></label> -->
    
    <!-- <label for="land_ID" class="form-label fs-5 px-5">รหัสเจ้าของหอพัก: <?=$row['land_ID']?></label> -->
    <label for="land_name" class="form-label fs-5 px-5">ชื่อเจ้าของหอพัก: <p class="text-info"><?=$row['land_name']?></p></label>
    <label for="land_tel" class="form-label fs-5 px-5">เบอร์โทรศัพท์: <p class="text-info"><?=$row['land_tel']?></p></label>
    <label for="tax_num" class="form-label fs-5 px-5">เลขประจำตัวผู้เสียภาษี: <p class="text-info"><?=$row['tax_num']?></p></label>

        </div>
        <p class="text-start px-3 pt-3 fs-4">ข้อมูลบัญชี</p>
        <hr><br>
    <div class="row text-start px-5">
    <label for="land_email" class="form-label fs-5 px-5">อีเมล: <p class="text-info"><?=$row['land_email']?></p></label>
    <label for="land_pass" class="form-label fs-5 px-5">รหัสผ่าน: <p class="text-info"><?=$row['land_pass']?></p></label>
        </div>   <hr>
        <?php } ?>
  </div>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>