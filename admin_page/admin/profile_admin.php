<?php
include('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = 'SELECT * FROM tb_admin INNER JOIN user ON tb_admin.u_ID = user.u_ID WHERE tb_admin.u_ID = "'.$_SESSION['u_ID'].'"';
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>profileStudent</title>

</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php include('../../_navbar/adminNav.php')?>
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="col-lg-12 col-md-12 mx-auto">
                <h2 class="text-center">ข้อมูลส่วนตัว</h2>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="editAdmin.php?u_ID=<?php echo $row['u_ID']; ?> " class="text-decoration-none">แก้ไขข้อมูลส่วนตัว</a>
                </div>
                </div>
                <hr>
                <?php foreach($query as $row) { ?>
            <div class="row">
                <div class="col">
                    <div class="d-grid gap-2 d-md-block">
                        <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัว</p> 
                        <div class="row mx-5 pe-2">
                            <label for="username" class="form-label mb-2s col-6">ชื่อ
                            <input type="text" class="form-control" value="<?php echo $row['ad_name']; ?>" readonly>
                            </label>

                            <label for="ad_tel" class="form-label mb-3 col-6">เบอร์โทรศัพท์
                            <input type="text" class="form-control" value="<?php echo $row['ad_tel']; ?>" readonly>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php } ?>
            <div class="row">
                <div class="col">
                    <div class="d-grid gap-2 d-md-block">
                        <p class="fs-10 px-5 text-dark">บัญชี</p>
                        <div class="row mx-5 pe-5 col-4">
                            <label for="username" class="form-label mb-3">อีเมล
                            <input type="text" class="form-control" value="<?php echo $row['username']; ?>" readonly>

                        </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="index_admin.php?u_ID=<?php echo $row['u_ID']; ?>" class="btn btn-primary me-md-2" type="button">บันทึก</a>
                <!-- <button class="btn btn-primary" type="button" onclick="javascript:window.location='profile_admin.php';">บันทึก</button> -->
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>