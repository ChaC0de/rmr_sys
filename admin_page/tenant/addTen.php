<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_faculty"; 
$query = mysqli_query($conn, $sql)// คำสั่ง sql

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add Student</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="container p-5 bg-body-tertiary">
                    <br>
                    <p class="text-center fs-2">เพิ่มนักศึกษา</p>
                    <hr>
                    <form action="insertTen.php" method="POST">
                        <br>
                        <!-- Hidden fields for user ID and student ID -->
                        <input type="hidden" class="form-control" name="userid" id="userid">
                        <input type="hidden" class="form-control" name="u_ID" id="u_ID">
                        
                        <!-- Username -->
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" required>
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
                            <label for="name" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="st_name" id="st_name" required>
                                <input type="hidden" class="form-control" name="usertype">
                            </div>
                        </div>
                        <!-- Phone Number -->
                        <div class="mb-3 row">
                            <label for="st_tel" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="st_tel" id="st_tel" required>
                            </div>
                        </div>
                        <br>
                        <!-- Sex -->
                        <div class="mb-3 row">
                            <label for="inputsex" class="col-sm-2 col-form-label">เพศสรีระ</label>
                            <div class="col-sm-10">
                                <select id="inputsex" name="st_sex" class="form-select" required>
                                    <option value="">กรุณาเลือก</option>
                                    <option value="เพศชาย">เพศชาย</option>
                                    <option value="เพศหญิง">เพศหญิง</option>
                                </select>
                            </div>
                        </div>
                        <!-- Faculty -->
                        <div class="mb-3 row">
                            <label for="inputfaculty" class="col-sm-2 col-form-label">ศึกษาในคณะ</label>
                            <div class="col-sm-10">
                                <select class="form-control w-50" name="faculty_ID" id="faculty_ID" required>
                                    <option value="">กรุณาเลือก</option>
                                    <?php while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                                        <option value="<?php echo $result["faculty_ID"]; ?>"><?php echo $result["faculty"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <!-- Contact (Facebook) -->
                        <div class="mb-3 row">
                            <label for="st_contact" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="st_contact" id="st_contact" required>
                            </div>
                        </div>
                        <br>
                        <!-- Sign Up Button -->
                        <div class="col-12 d-flex justify-content-end">
                            <a href="tenList.php" class="btn btn-secondary">ยกเลิก</a> &nbsp;
                            <button type="submit" name="submit" class="btn btn-primary">เพิ่มนักศึกษา</button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>