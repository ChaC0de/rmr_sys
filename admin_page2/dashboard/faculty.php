<?php
include('../../connection/conn.php');  // Connect to the database
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_faculty ORDER BY `tb_faculty`.`faculty_ID` ASC";
$query = mysqli_query($conn, $sql);
$list = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav2.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>
                <!-- Start table for listing faculty -->
                <div class="container text-start">
                    <br>
                    <p class="fs-3 text-center">รายชื่อคณะ</p><br>
                    <div class="row">
                        <form action="insertFac.php" method="post">
                            <table class="table table-sm">
                                <tr>
                                    <th> รายชื่อคณะ: </th>
                                    <th>
                                        <input class="form-control w-50" type="text" name="faculty" id="faculty" required>
                                    </th>
                                    <th>
                                        <button class="btn btn-success" type="submit">เพิ่มรายชื่อคณะ</button>
                                        <button class="btn btn-info" type="reset" value="Reset">ล้าง</button>
                                    </th>
                                </tr>
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
                            <th>
                                <a href="editFac.php?faculty_ID=<?=$row['faculty_ID']?>&faculty=<?=$row['faculty']?>" class="btn btn-warning">แก้ไข</a>
                            </th>
                            <th>
                                <a href="deleteFac.php?faculty_ID=<?=$row['faculty_ID']?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
                            </th>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
