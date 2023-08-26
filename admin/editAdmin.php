<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$admin_ID = $_GET['admin_ID'];
$sql = "SELECT * FROM tb_admin WHERE admin_ID = '$admin_ID'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>แก้ไขผู้ดูแลระบบ</title>
</head>
<body>
    <div>
        <center>
            <br>
            <p class="fs-3 text-center">ข้อมูลส่วนตัว</p>
            <p><a href="admin_list.php"> กลับหน้าแรก</a></p>
            <hr>
            <form action="updateAdmin.php" method="post">
                <table class="table table-sm">
                    <input type="hidden" value="<?php echo $row["admin_ID"]?>" name="admin_ID">
                    <tr>
                        <th> ชื่อ:</th>
                      <th><input class="form-control w-50 text-primary" type="text" name="ad_name" value="<?php echo $row["ad_name"]?>"></th>
                    </tr>
                    <tr>
                <th>ชื่อผู้ใช้:</th>
                <th><input class="form-control w-50 text-primary" type="text" name="username" value="<?php echo $row["username"]?>"></th>
                    </tr>
                    <tr>
                <th>รหัสผ่าน:</th>
                <th><input class="form-control w-50 text-primary" type="password" name="password" value="<?php echo $row["password"]?>"></th>
                    </tr>
                    <tr>
                <th>เบอร์โทรศัพท์:</th>
                <th><input class="form-control w-50 text-primary" type="text" name="ad_tel" value="<?php echo $row["ad_tel"]?>"></th>  
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">บันทึก</button>
               <a href="admin_list.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a></th>
                  </tr>
            </table> <div class="row align-items-start">
        </center>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>