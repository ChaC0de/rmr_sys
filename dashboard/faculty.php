<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_faculty ORDER BY `tb_faculty`.`faculty_ID` ASC";
$query = mysqli_query($conn, $sql);
$list=0;
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<head>
<title>Dashboard</title>
</head>
<body>
    <br>
    <!-- start table => service -->
<div class="container text-center">
<br>
<p class="fs-3 text-center">รายชื่อคณะ</p><br>
<div class="row">
    <form action="insertFac.php" method="post">
                <table class="table table-sm">
                    
                    <tr>
                        <th> รายชื่อคณะ: </th>
                      <th><input class="form-control w-50" type="text" name="faculty" id="faculty" required></th>
                      <th><button class="btn btn-success" type="submit">เพิ่มรายชื่อคณะ</button>
                      <button class="btn btn-info" type="reset" value="Reset">ล้าง</button>
                    </tr>
                </th>
            </table>

</form>
</div>
<table class="table table-hover">
    <tr>
        <th>ลำดับ</th>
        <th>รายชื่อคณะ</th>
        <th></th>
        <th></th>

    </tr>
    <?php foreach($query as $row) { $list++; ?>
    <tr>
        <th><?php echo $list;?></th>
        <th><?=$row['faculty']?></th>

        <th><a href="editFac.php?faculty_ID=<?=$row['faculty_ID']?>&faculty=<?=$row['faculty']?>" class="btn btn-warning">แก้ไข</a></th>
        <th><a href="deleteFac.php?faculty_ID=<?=$row['faculty_ID']?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a></th>
    </tr>
    <?php } ?>
</table>
</div><br><br>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>