<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$search = $_POST['search'];// คำสั่งค้นหา

$sql = "SELECT * FROM tb_student 
INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID 
INNER JOIN user ON tb_student.u_ID = user.u_ID
WHERE tb_student.u_ID LIKE '%$search%' 
    OR tb_student.st_name LIKE '%$search%'
    OR user.username LIKE '%$search%'
    OR tb_faculty.faculty LIKE '%$search%'
ORDER BY tb_student.u_ID ASC"; 
$query = mysqli_query($conn, $sql); 
$num = mysqli_num_rows( $query );
$order = 1;
$list=0;
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<head>
<title>Tenant List</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav2.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="container text-center">
                    <p class="text-center fs-2">รายการผู้เช่าหอพัก</p>
                    <p class="fs-5 pe-5 ps-5 text-end"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
                    <?php if($num > 0){ ?>
                    <table class="table table-hover">
                        <tr class="text-center">
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th>ศึกษาในคณะ</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach($query as $row) { $list++; ?>
                        <tr>
                            <th><?php echo $list; ?></th>
                            <th><?=$row['st_name']?></th>
                            <th><?=$row['username']?></th>
                            <th><?=$row['faculty']?></th>
                            <!-- เพิ่มเติม -->
                            <td class="text-center">
                                <a href="viewTen.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-info">ดูเพิ่มเติม</a>
                            </td>
                            <!-- แก้ไข -->
                            <td class="text-center">
                                <a href="editTen.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-secondary">แก้ไข</a>
                            </td>
                            <!-- ลบ -->
                            <td class="text-center">
                                <a href="delTen.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-danger">
                    <b>ไม่พบข้อมูลที่ค้นหา</b>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
