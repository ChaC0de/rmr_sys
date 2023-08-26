<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$st_ID = $_GET['st_ID'];
$sql = "SELECT * FROM tb_student INNER JOIN tb_st_faculty ON tb_student.st_name = tb_st_faculty.st_name 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID WHERE tb_student.st_ID = '$st_ID'";
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
    <title>Edit student</title>
</head>
<body>
    <div>
        <center>
            <br>
            <p class="fs-3 text-center">ข้อมูลส่วนตัว</p>
            <hr>

            <form action="updateTen.php" method="post">
                <table class="table table-sm">
                    <input type="hidden" value="<?php echo $row["st_ID"]?>" name="st_ID">
                    <tr>
                        <th> ชื่อ:</th>
                      <th><input class="form-control w-50 input" type="text" name="st_name" value="<?php echo $row["st_name"]?>"></th>
                    </tr>
                    <tr>
                <th>อีเมล:</th>
                <th><input class="form-control w-50 input" type="email" name="st_email" value="<?php echo $row["st_email"]?>" ></th>
                    </tr>
                    <tr>
                <th>รหัสผ่าน:</th>
                <th><input class="form-control w-50 input" type="password" name="st_pass" value="<?php echo $row["st_pass"]?>" ></th>
                    </tr>
                    <tr>
                <th>เบอร์โทรศัพท์:</th>
                <th><input class="form-control w-50 input" type="text" name="st_tel" value="<?php echo $row["st_tel"]?>" ></th>  
                    </tr>
                    <tr>
                <th>Facebook/Line:</th>
                <th><input class="form-control w-50 input" type="text" name="st_contact" value="<?php echo $row["st_contact"]?>" ></th>  
                    </tr>
                    <tr>
                <th>ศึกษาในคณะ:</th>
                <th>
                <select class="form-control w-50" name="faculty_ID" value="
                <?php echo $row["faculty_ID"]?>">
                    <option value="">กรุณาเลือก</option>
                    <?php
                    $sql = "SELECT * FROM tb_faculty";
                    $query = mysqli_query($conn,$sql);
                    while($row2 = mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row2["faculty_ID"];?>"
                    <?php if ($row["faculty_ID"] == $row2["faculty_ID"]) {
                        echo "SELECTED"; } ?>>
                    <?php echo $row2["faculty"];?>
                    </option>
                    <?php }?>
                    </select></th>
                    </tr>
                    <tr>
                <th>เพศสรีระของคุณ:</th>
                <th><select class="form-control w-50" name="st_sex">
                    <option value="">กรุณาเลือก</option>
                    <option value="เพศชาย"<?php if ($row["st_sex"] == "เพศชาย") {
                        echo "SELECTED"; } ?>>เพศชาย</option>
                    <option value="เพศหญิง"<?php if ($row["st_sex"] == "เพศหญิง") {
                        echo "SELECTED"; } ?>>เพศหญิง</option>
                    </select></th>
                    </tr>
                    <tr>
                <th></th>
                <th><button class="btn btn-primary" type="submit">บันทึก</button>
               <a href="tenList.php" class="btn btn-danger">ยกเลิก</button></a></th>
                  </tr>
            </table></form>

        </center>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>