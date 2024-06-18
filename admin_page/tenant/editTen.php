<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql = "SELECT * FROM tb_student INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID 
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID 
INNER JOIN user ON tb_student.u_ID = user.u_ID WHERE u_ID = '$u_ID'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit student</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div>
                    <center>
                        <br>
                        <p class="fs-3 text-center">ข้อมูลส่วนตัว</p>
                        <hr>
                        <form action="updateTen.php" method="post">
                            <table class="table table-sm">
                                <input type="hidden" value="<?php echo $row["u_ID"]?>" name="u_ID">
                                <tr>
                                    <th>ชื่อ:</th>
                                    <th>
                                        <input class="form-control w-50 input" type="text" name="st_name" value="<?php echo $row["st_name"]?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th>ชื่อผู้ใช้:</th>
                                    <th>
                                        <input class="form-control w-50 input" type="text" name="username" value="<?php echo $row["username"]?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th>เบอร์โทรศัพท์:</th>
                                    <th>
                                        <input class="form-control w-50 input" type="text" name="st_tel" value="<?php echo $row["st_tel"]?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Facebook/Line:</th>
                                    <th>
                                        <input class="form-control w-50 input" type="text" name="st_contact" value="<?php echo $row["st_contact"]?>">
                                    </th>
                                </tr>
                                <tr>
                                    <th>ศึกษาในคณะ:</th>
                                    <th>
                                        <select class="form-control w-50" name="faculty_ID">
                                            <option value="">กรุณาเลือก</option>
                                            <?php
                                            $sql = "SELECT * FROM tb_faculty";
                                            $query = mysqli_query($conn,$sql);
                                            while($row2 = mysqli_fetch_array($query)){
                                            ?>
                                            <option value="<?php echo $row2["faculty_ID"];?>" <?php if ($row["faculty_ID"] == $row2["faculty_ID"]) { echo "SELECTED"; } ?>>
                                                <?php echo $row2["faculty"];?>
                                            </option>
                                            <?php }?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th>เพศสรีระของคุณ:</th>
                                    <th>
                                        <select class="form-control w-50" name="st_sex">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="เพศชาย" <?php if ($row["st_sex"] == "เพศชาย") { echo "SELECTED"; } ?>>เพศชาย</option>
                                            <option value="เพศหญิง" <?php if ($row["st_sex"] == "เพศหญิง") { echo "SELECTED"; } ?>>เพศหญิง</option>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>
                                        <button class="btn btn-primary" type="submit">บันทึก</button>
                                        <a href="tenList.php" class="btn btn-danger">ยกเลิก</a>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>