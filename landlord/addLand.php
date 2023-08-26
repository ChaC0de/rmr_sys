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
    <title>add landlord</title>
</head>
<body>
    <div>
        <center>
            <br>
            <h1>เพิ่มเจ้าของหอพัก</h1>
            <hr><br>
            <form action="insertLand.php" method="post">
                <table class="table table-hover p-5 ">
                    <tr>
                        <th class="text-end"> ชื่อ-สกุล:</th>
                      <th><input type="text" class="form-control w-50" name="land_name" id="land_email" required></th>
                    </tr>
                    <tr>
                <th class="text-end">อีเมล:</th>
                <th><input type="email" class="form-control w-50" name="land_email" id="land_email" required></th>
                    </tr>
                    <tr>
                <th class="text-end">รหัสผ่าน:</th>
                <th><input type="password" class="form-control w-50" name="land_pass" id="land_pass" required></th>
                    </tr>
                    <tr>
                <th class="text-end">เบอร์โทรศัพท์:</th>
                <th><input type="text" class="form-control w-50" name="land_tel" id="land_tel" required></th>  
                    </tr>
                    <tr>
                <th class="text-end">เลขประจำตัวผู้เสียภาษี: </th>
                <th><input type="text" class="form-control w-50" name="tax_num" id="tax_num" required></th>  
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">เพิ่ม</button>
                <button class="btn btn-danger" type="cancel" onclick="javascript:window.location='landList.php';">ยกเลิก</button>
                </th>  
                    </tr>
            </table>
            
        </center>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>