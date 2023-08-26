<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$st_ID = $_GET['st_ID'];
$sql = "SELECT * FROM tb_student 
INNER JOIN tb_st_faculty ON tb_student.st_name = tb_st_faculty.st_name 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
WHERE tb_student.st_ID = '$st_ID'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <?php foreach($query as $row) { ?>
    <title>
    <?php echo $row['st_name'];?>
    </title>
</head>
<body>
  <br>
    <p class="text-start px-3 pt-3 fs-4">ข้อมูลส่วนตัว</p>
    <!-- show details -->
    
    <div>
    <div class="row text-start px-5">
    <hr>
    <label for="st_name" class="form-label fs-5 px-5">ชื่อ: <p class="p"><?=$row['st_name']?></p></label>
    <label for="st_tel" class="form-label fs-5 px-5">เบอร์โทรศัพท์: <p class="p"><?=$row['st_tel']?></p></label>
    <label for="st_contact" class="form-label fs-5 px-5">บัญชีโซเชี่ยล: <p class="p"><?=$row['st_contact']?></p></label>
    <label for="faculty" class="form-label fs-5 px-5">คณะที่ศึกษา: <p class="p"><?=$row['faculty']?></p></label>
    <label for="st_sex" class="form-label fs-5 px-5">เพศสรีระ: <p class="p"><?=$row['st_sex']?></p></label>

        </div>
        <p class="text-start px-3 pt-3 fs-4">ข้อมูลบัญชี</p>
        <hr><br>
    <div class="row text-start px-5">
    <label for="st_email" class="form-label fs-5 px-5">อีเมล: <p class="p"><?=$row['st_email']?></p></label>
    <!-- <label for="st_pass" class="form-label fs-5 px-5">รหัสผ่าน: <p class="p"><?=$row['st_pass']?></p></label> -->
        </div>   
        <?php } ?>
  </div>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>