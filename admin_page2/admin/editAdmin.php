<?php
include('../../connection/conn.php'); // Connect to the database
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql = "SELECT * FROM tb_admin
  INNER JOIN user 
  ON tb_admin.u_ID = user.u_ID WHERE user.u_ID = '$u_ID'";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>แก้ไขผู้ดูแลระบบ</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php include('../../_navbar/adminNav2.php')?>
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="col-lg-12 col-md-12 mx-auto">
               <h2 class="text-center">ข้อมูลส่วนตัว</h2>
                <div class="text-center py-2">
                    <img src="..." class="rounded" alt="...">&nbsp; <br>
                    <a href="#" class="btn btn-link text-decoration-none">แก้ไขรูปภาพ</a>
                </div>
                   
                </div>
                <hr>
                <form action="updateAdmin.php" method="post">
            <div class="row">
                <div class="col">
                    <div class="d-grid gap-2 d-md-block">
                        <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัว</p> 

                        <form action="updateAdmin.php" method="post">
                        <div class="row mx-5 pe-2">
                            <label for="username" class="form-label mb-2s col-6">ชื่อ
                                <input type="text" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>" hidden>
                            <input type="text" class="form-control" name="ad_name" value="<?php echo $row['ad_name']; ?>" >
                            </label>
                            <label for="ad_tel" class="form-label mb-3 col-6">เบอร์โทรศัพท์
                            <input type="text" class="form-control" name="ad_tel" value="<?php echo $row['ad_tel']; ?>" >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            
            <div class="row">
                <div class="col">
                    <div class="d-grid gap-2 d-md-block">
                        <p class="fs-10 px-5 text-dark">บัญชี</p>
                        <div class="row mx-5 pe-5 col-4">
                            <label for="username" class="form-label mb-3">ชื่อผู้ใช้
                            <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" s>
                        </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-danger" type="button" onclick="javascript:window.location='admin_list.php?u_ID=<?php echo $_SESSION['u_ID']; ?>';">ยกเลิก</button>
                <button class="btn btn-success" type="submit">บันทึก</button>
            </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>