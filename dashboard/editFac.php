<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar
$faculty_ID = $_GET['faculty_ID'];
$faculty = $_GET['faculty'];
$sql = "SELECT * FROM tb_faculty WHERE faculty_ID = '$faculty_ID'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>EDIT</title>
</head>
<body>
    <div class="text-center">
        
    <form action="updFac.php" method="post">
    <table class="table table-sm">    
    <input type="hidden" value="<?php echo $row["faculty_ID"]?>" name="faculty_ID">
    <tr>
        <th>ชื่อคณะ:</th>
        <th><input class="form-control w-50" type="text" name="faculty" value="<?php echo $row["faculty"]?>"></th>
        <th><button class="btn btn-primary" type="submit">บันทึก</button>
               <a href="faculty.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a></th>
                  </tr>
    </tr>
    </form>
</div>
<script src="../js/bootstrap.min.js"></script> 
</body>
</html>