<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>add Questen</title>
</head>
<body>
<br>
<div class="container">
    <br>
        <h4 class="text-center">เพิ่มคำถาม</h4>
        <br>
        <form action="insertQues.php" method="post">
            <div class="col-md-6 ">
            <label for="q_text" class="form-label">คำถาม</label>
            <input type="text" class="form-control" id="q_text" name="q_text" required>
            </div><br>
            <br><br>
        <button type="cancel" class="btn btn-danger" onclick="javascript:window.location='showtenQues.php';">ยกเลิก</button>
        <button type="submit" class="btn btn-success"  >บันทึก</button>
        </form>
</div>

</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>