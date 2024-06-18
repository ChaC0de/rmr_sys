<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>เพิ่มผู้ดูแลระบบ</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('../../_navbar/adminNav.php')?>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="col-lg-12 col-md-12 mx-auto">
                    <center>
                        <h1>เพิ่มผู้ดูแลระบบ</h1>
                        <hr>
                        <form action="insertAdmin.php" method="post">
                            <table class="table table-hover">
                                <tr>
                                    <th>ชื่อ:</th>
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
                                    <th>ประเภทผู้ดูแลระบบ:</th>
                                    <th>
                                        <select name="adminType" id="adminType" class="form-select w-50">
                                            <option value="1">General Admin</option>
                                            <option value="4">Super Admin</option>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>
                                        <button class="btn btn-primary" type="submit">เพิ่ม</button>
                                        <button class="btn btn-danger" type="button" onclick="javascript:window.location='admin_list.php';">ยกเลิก</button>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </center>
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
