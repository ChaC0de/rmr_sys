<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$land_ID = $_GET['land_ID'];
$sql = "SELECT * FROM tb_landlord WHERE land_ID ='$land_ID'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Edit Landlord</title>
</head>
<body>
    <div>
        <center>
            <br>
            <p class="fs-3 text-center">ข้อมูลส่วนตัว</p>
            <hr>

            <form action="updateLand.php" method="post">
                <table class="table table-sm">
                <input type="hidden" value="<?php echo $row["land_ID"]?>" name="land_ID">
                    <tr>
                        <th class="text-end"> ชื่อ:</th>
                      <th><input class="form-control w-50" type="text" name="land_name" value="<?php echo $row["land_name"]?>"></th>
                    </tr>
                    <tr>
                <th class="text-end">อีเมล:</th>
                <th><input class="form-control w-50" type="email" name="land_email" value="<?php echo $row["land_email"]?>"></th>
                    </tr>
                    <tr>
                <th class="text-end">รหัสผ่าน:</th>
                <th><input class="form-control w-50" type="password" name="land_pass" value="<?php echo $row["land_pass"]?>"></th>
                    </tr>
                    <tr>
                <th class="text-end">เบอร์โทรศัพท์:</th>
                <th><input class="form-control w-50" type="text" name="land_tel" value="<?php echo $row["land_tel"]?>"></th>  
                    </tr>
                    <tr>
                <th class="text-end">เลขประจำตัวผู้เสียภาษี: </th>
                <th><input class="form-control w-50" type="text" name="tax_num" value="<?php echo $row["tax_num"]?>"></th>  
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">บันทึก</button>
                <a href="landList.php" class="btn btn-danger">ยกเลิก</a></th>                   
            </tr>
            </table></form>

            
        </center>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>