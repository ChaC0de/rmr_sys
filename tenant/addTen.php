<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_faculty"; 
$query = mysqli_query($conn, $sql)// คำสั่ง sql

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Add Student</title>
</head>
<body>
    <div class="container p-5 bg-body-tertiary">
            <br>
            <p class="text-center fs-2">เพิ่มนักศึกษา</p>
            <hr>
            <form action="insertTen.php" method="post">
                <table class="table table-hover ">
                    <tr>          
                        <th> ชื่อ:</th>
                      <th><input class="form-control w-50" type="text" name="st_name" id="st_name" placeholder="กรุณาระบุชื่อ" required></th>
                    </tr>
                    <tr>
                <th>อีเมล:</th>
                <th><input class="form-control w-50" type="email" name="st_email" id="st_email" placeholder="กรุณาระบุอีเมล" required></th>
                    </tr>
                    <tr>
                <th>รหัสผ่าน:</th>
                <th><input class="form-control w-50" type="password" name="st_pass" id="st_pass" placeholder="รหัสผ่านของคุณ" required></th>
                    </tr>
                    <tr>
                <th>เบอร์โทรศัพท์:</th>
                <th><input class="form-control w-50" type="text" name="st_tel" id="st_tel" placeholder="กรุณาระบุเบอร์โทรศัพท์" required></th>  
                    </tr>
                    <tr>
                <th>Facebook:</th>
                <th><input class="form-control w-50" type="text" name="st_contact" id="st_contact" placeholder="ชื่อบัญชี Facebook " required></th>  
                    </tr>
                    <tr>
                <th>ศึกษาในคณะ:</th>
                <th><select class="form-control w-50" name="faculty_ID" id="faculty_ID" required>
                    <option value="">กรุณาเลือกคณะที่ศึกษา</option>
                    <?php while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                    <option value="<?php echo $result["faculty_ID"];?>"><?php echo $result["faculty"];?></option>
                    <?php } ?>
                    </select></th>
                    </tr>
                    <tr>
                <th>เพศสรีระของคุณ:</th>
                <th><select class="form-control w-50" name="st_sex" id="st_sex" required>
                    <option value="">กรุณาเลือกเพศสรีระ</option>
                    <option value="เพศชาย">เพศชาย</option>
                    <option value="เพศหญิง">เพศหญิง</option>
                    </select></th>
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">เพิ่ม</button>
                <button class="btn btn-danger" type="cancel" onclick="javascript:window.location='tenList.php';">ยกเลิก</button>

              </th>  
                    </tr>
            </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>