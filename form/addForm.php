<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_question ORDER BY q_ID ASC ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$list=0;
$row = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Questen</title>
</head>
<body>
<br>

<div class="container text-center">
  <br><br>
    <!-- <p class="fs-3 ">สร้างแบบสอบถาม</p><br> -->



    <form action="insertForm.php" method="post" >
    <div class="row">
    <div class="col d-flex justify-content-start pe-3">
    <p class="fs-5 ">ชื่อแบบสอบถาม</p>&nbsp;
    <input type="text" class="form-control" name="form_name" placeholder="ชื่อแบบสอบถาม" required>
    </div><br>
    <div class="col d-flex justify-content-end">
    
    <select name="status" id="status" class="form">
    <option value="0">ปิดใช้งาน</option>
    <option value="1">เปิดใช้งาน</option>
    </select>
    </div><br>
    </div>
    <br>

    <button type="submit"  class="btn btn-success justify-content-center">สร้างแบบสอบถาม</button>
    <a href="form.php" class="btn btn-danger">ยกเลิก</a>
     </div>  
</form>
</div>
    <br>



<script src="../js/bootstrap.min.js"></script>
</body>
</html>
