<?php
include('../../connection/conn.php'); // Connect to the database
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$search = $_POST['search']; // Search query
$sql = "SELECT * FROM tb_admin WHERE ad_name LIKE '%$search%' ORDER BY ad_name ASC";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
$order = 1;
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
        <?php include('../../_navbar/adminNav.php') ?>
        <!-- Content -->
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="container text-center">
                    <p class="fs-3 text-center">รายการผู้ดูแลระบบ</p>
                    <hr>
                    <div class="row">
                        <div class="col align-self-end d-flex justify-content-end pe-3">
                            <a href="addAdmin.php"><button type="button" class="btn btn-info">เพิ่มผู้ดูแลระบบ</button></a>
                        </div>
                    </div>
                    <hr>
                    <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
                    <?php if ($num > 0) { ?>
                        <table class="table table-hover">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสผู้ดูแล</th>
                                <th>ชื่อ</th>
                                <th>ชื่อผู้ใช้</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php foreach ($query as $row) {
                                $list++;
                                ?>
                                <tr>
                                    <th><?php echo $list; ?></th>
                                    <th><?= $row['u_ID'] ?></th>
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
                    <?php } else { ?>
                        <div class="alert alert-danger">
                            <b>ไม่พบข้อมูลที่ค้นหา</b>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
