<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>add landlord</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav2.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-5 mx-auto">
            <div class="row py-lg-5">
                <div>
                        <br>
                        <h3 class="text-center">เพิ่มเจ้าของหอพัก</h3>
                        <hr><br>
                        <form action="insertLand.php" method="POST">
                <br>
                <!-- Username -->
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <!-- Password -->
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" required>
                    </div>
                </div>
                <!-- Confirm Password -->
                <div class="mb-3 row">
                    <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="c_password" required>
                    </div>
                </div>
                <!-- Full Name -->
                <div class="mb-3 row">
                    <label for="land_name" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="land_name" id="land_name" required>
                    </div>
                </div>
                <!-- Tax ID -->
                <div class="mb-3 row">
                    <label for="tax_num" class="col-sm-2 col-form-label">เลขประจำตัวผู้เสียภาษี</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tax_num" id="tax_num" required>
                    </div>
                </div>
                <!-- Phone Number -->
                <div class="mb-3 row">
                    <label for="land_tel" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="land_tel" id="land_tel" required>
                    </div>
                </div>
                <!-- Sex -->
                <div class="mb-3 row">
                    <label for="inputSex" class="col-sm-2 col-form-label">เพศสรีระ</label>
                    <div class="col-sm-10">
                        <select id="inputSex" name="land_sex" class="form-select" required>
                            <option value="">กรุณาเลือก</option>
                            <option value="เพศชาย">เพศชาย</option>
                            <option value="เพศหญิง">เพศหญิง</option>
                        </select>
                    </div>
                </div>
                <!-- Contact (Line ID) -->
                <div class="mb-3 row">
                    <label for="land_contact" class="col-sm-2 col-form-label">Line ID / Facebook</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="land_contact" id="land_contact" required>
                    </div>
                </div>
                <!-- Sign Up Button -->
                <div class="col-12 d-flex justify-content-end">
                    <a href="landlist.php" class="btn btn-secondary" onclick="return confirm('ยกเลิกการเพิ่มเจ้าของหอพัก')">ยกเลิก</a> &nbsp;
                    <button type="submit" name="submit" class="btn btn-primary">เพิ่มเจ้าของหอพัก</button>
                    
                </div>
                <hr>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>