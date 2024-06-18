<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$search = $_POST['search'];// คำสั่งค้นหา
$sql = "SELECT * FROM tb_landlord
INNER JOIN user ON tb_landlord.u_ID = user.u_ID
 WHERE tb_landlord.land_name LIKE '%$search%' 
    OR tb_landlord.land_tel LIKE '%$search%'
    OR user.username LIKE '%$search%'
 ORDER BY tb_landlord.land_name ASC"; 
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<head>
<div class="container text-center">
<title>Landlord search</title>
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
                <!-- show landlists -->
                <div class="container text-center">
                    <p class="fs-3 text-center">รายการเจ้าของหอพัก</p>
                    <form action="searchLand.php" method="post">
                        <div class="input-group flex-nowrap pe-5 ps-5">
                            <span class="input-group-text" id="addon-wrapping">ค้นหาเจ้าของหอพัก</span>
                            <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
                            <input class="btn btn-primary" type="submit" value="ค้นหา">
                        </div>
                    </form>
                    <hr>
                    <?php if ($num == 0) { ?>
                        <div class="alert alert-danger">
                            <b>ไม่พบข้อมูลที่ค้นหา</b>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col align-self-end d-flex justify-content-end pe-3">
                        </div>
                    </div>
                    <?php foreach($query as $row)  { $list++ ?>
                    <th>
                        <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
                    </th>
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th>Tel number</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th><?php echo $list;?></th>
                            <th><?=$row['land_name']?></th>
                            <th><?=$row['username']?></th>
                            <th><?=$row['land_tel']?></th>
                            <!-- end landlists -->
                            <!-- เพิ่มเติม -->
                            <td class="text-center">
                                <a href="viewLand.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
                            </td>
                            <!-- แก้ไข -->
                            <td class="text-center">
                                <a href="editLand.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-secondary">แก้ไข</a>
                            </td>
                            <!-- ลบ -->
                            <td class="text-center">
                                <a href="delLand.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
                            </td>
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
