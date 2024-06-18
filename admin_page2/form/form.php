<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_form ORDER BY form_ID ASC ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$row = mysqli_fetch_array($query);
$list=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Survey Form</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include ('../../_navbar/adminNav2.php') ?>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>
                <div class="container text-center">
                    <form action="addForm.php" method="post">
                        <div class="row py-lg-5">
                            <div class="col align-self-end d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">สร้างแบบสอบถาม</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อชุดคำถาม</th>
                                <th scope="col">วันที่สร้าง</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($query as $row) {
                                $list++;
                            ?>
                            <tr class="text-center">
                                <td><?php echo $list; ?></td>
                                <td class="text-start px-5"><?php echo $row['form_name']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <?php if ($row['status'] == 1) {
                                        echo "เปิดใช้งาน";
                                    } else {
                                        echo "ปิดใช้งาน";
                                    } ?>
                                </td>
                                <td><a href="viewFormQues.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-primary">จัดการแบบสอบถาม</a></td>
                                <td class="text-start">
                                    <a href="delForm.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล จะไม่สามารถเปลี่ยนแปลงได้')">ลบ</a>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if($num==0){ ?>
                            <tr class="text-center">
                                <td colspan="6">ไม่มีข้อมูล</td>
                            </tr>
                            <?php } ?>
                        </tbody>
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