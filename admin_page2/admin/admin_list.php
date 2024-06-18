<?php
include('../../connection/conn.php'); // Connect to the database
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_admin ORDER BY `tb_admin`.`u_ID` ASC";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
$list = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin List</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('../../_navbar/adminNav2.php') ?>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="col-lg-12">
                    <h3 class="fw-light text-center mb-5">แสดงข้อมูลผู้ดูแลระบบทั้งหมด</h3>
                    <form action="searchAdmin.php" method="post">
                        <div class="input-group flex-nowrap pe-5 ps-5 ">
                            <span class="input-group-text" id="addon-wrapping">ค้นหาผู้ดูแลระบบ</span>
                            <input type="text" class="form-control" name="search" placeholder="กรอกคำค้นหา" required>
                            <input class="btn btn-primary" type="submit" value="ค้นหา">
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col align-self-end d-flex justify-content-end pe-3">
                            <a href="addAdmin.php"><button type="button" class="btn btn-info">เพิ่มผู้ดูแลระบบ</button></a>
                        </div>
                    </div>
                    <hr>
                    <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($query as $row) {
                            $list++; ?>
                            <tr>
                                <th><?php echo $list; ?></th>
                                <th><?= $row['ad_name'] ?></th>
                                <th><?= $row['username'] ?></th>
                                <th><?= $row['ad_tel'] ?></th>
                                <!-- แก้ไข -->
                                <td class="text-center">
                                    <a href="editAdmin.php?u_ID=<?php echo $row["u_ID"] ?>" class="btn btn-secondary">แก้ไข</a>
                                </td>
                                <!-- ลบ -->
                                <td class="text-center">
                                    <a href="delAdmin.php?u_ID=<?php echo $row["u_ID"] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <!-- End content -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
