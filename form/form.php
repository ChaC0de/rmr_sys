<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Survey Form</title>
</head>
<body>
<br>

<div class="container text-center">
<form action="addForm.php" method="post">
    <div class="row">
    <div class="col align-self-end d-flex justify-content-center pe-3">
    <button type="submit" class="btn btn-info ">สร้างแบบสอบถาม</button>
</form>
    </div>
    </div>
    <br>

    <table class="table ">
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
                <td><?php if ($row['status'] == 1) { echo "เปิดใช้งาน"; } else { echo "ปิดใช้งาน";} ?>
                 <?php
                 ?></td>
                <td><a href="viewFormQues.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-primary">จัดการแบบสอบถาม</a></td>
                <td class="text-start"><a href="delForm.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล จะไม่สามารถเปลี่ยนแปลงได้')">ลบ</a></td>
          
            </tr>
            <?php } ?>
            <?php if($num==0){ ?>
            <tr class="text-center">
                <td colspan="6">ไม่มีข้อมูล</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>


<script src="../js/bootstrap.min.js"></script>
</body>
</html>