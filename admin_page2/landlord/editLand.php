<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql= "SELECT * FROM tb_landlord
    INNER JOIN user ON tb_landlord.u_ID = user.u_ID
    WHERE tb_landlord.u_ID = '$u_ID'";

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
    <title>Edit Landlord</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav2.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div>
                    <center>
                        <br>
                        <p class="fs-3 text-center">ข้อมูลส่วนตัว</p>
                        <hr>
                        <form action="updateLand.php?u_ID=<?php echo $row["u_ID"]?>" method="post">
                            <table class="table table-sm">
                                <input type="hidden" value="<?php echo $row["u_ID"]?>" name="u_ID" readonly>
                                <tr>
                                    <th class="text-end p-4">ชื่อ:</th>
                                    <th><input class="form-control w-50 mt-3" type="text" name="land_name" value="<?php echo $row["land_name"]?>"></th>
                                </tr>
                                <tr>
                                    <th class="text-end p-4">เลขประจำตัวผู้เสียภาษี:</th>
                                    <th><input class="form-control w-50 mt-3" type="text" name="tax_num" value="<?php echo $row["tax_num"]?>"></th>  
                                </tr>
                                <tr>
                                    <th class="text-end p-4">อีเมล:</th>
                                    <th><input class="form-control w-50 mt-3" type="email" name="username" value="<?php echo $row["username"]?>"></th>  
                                </tr>
                                <tr>
                                    <th class="text-end p-4">เพศสรีระ:</th>
                                    <th>
                                    <select class="form-control w-50 mt-3" name="land_sex">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="เพศชาย" <?php if ($row["land_sex"] == "เพศชาย") { echo "SELECTED"; } ?>>เพศชาย</option>
                                            <option value="เพศหญิง" <?php if ($row["land_sex"] == "เพศหญิง") { echo "SELECTED"; } ?>>เพศหญิง</option>
                                        </select>
                                    </th>  
                                </tr>
                                <tr>
                                    <th class="text-end p-4">เบอร์โทรศัพท์:</th>
                                    <th><input class="form-control w-50 mt-3" type="text" name="land_tel" value="<?php echo $row["land_tel"]?>"></th>  
                                </tr>
                                <tr>
                                    <th class="text-end p-4">Line ID / Facebook:</th>
                                    <th>  <input type="text" class="form-control w-50 mt-3" name="land_contact" value="<?php echo $row["land_contact"]?>"></th>  
                                </tr>
                                <tr>
                                    <th></th>
                                    <th class="p-5">
                                        <button class="btn btn-primary" type="submit">บันทึก</button>
                                        <a href="landList.php" class="btn btn-danger">ยกเลิก</a>
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