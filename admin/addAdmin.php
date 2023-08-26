<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div>
        <center>
            <br>
            <h1>เพิ่มผู้ดูแลระบบ</h1>
            <hr>
            <form action="insertAdmin.php" method="post">
                <table class="table table-hover">

                    <tr>
                        <th> ชื่อ:</th>
                      <th><input class="form-control w-50" type="text" name="ad_name" id="ad_name" required></th>
                    </tr>
                    <tr>
                <th>ชื่อผู้ใช้:</th>
                <th><input class="form-control w-50" type="text" name="username" id="username" required></th>
                    </tr>
                    <tr>
                <th>รหัสผ่าน:</th>
                <th><input class="form-control w-50" type="password" name="password" id="password" required></th>
                    </tr>
                    <tr>
                <th>เบอร์โทรศัพท์:</th>
                <th><input class="form-control w-50" type="text" name="ad_tel" id="ad_tel" required></th>
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">เพิ่ม</button>
                <button class="btn btn-danger" type="cancel" onclick="javascript:window.location='admin_list.php';">ยกเลิก</button>
                </th>
                    </tr>
            </table>
        </center>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>