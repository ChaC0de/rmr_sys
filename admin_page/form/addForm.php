<?php
include('../../connection/conn.php');  // Connect to the database
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_question ORDER BY q_ID ASC ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
$list = 0;
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Questen</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include ('../../_navbar/adminNav.php') ?>
        <!-- Content -->
        <div class="col-lg-9 col-md-9 mx-auto">
            <div class="row py-lg-12">
                <br>
                <div class="container text-center">
                    <br><br>
                    <form action="insertForm.php" method="post">
                        <div class="row">
                            <div class="col-9 d-flex justify-content-start pe-3">
                                <p class="fs-5">ชื่อแบบสอบถาม</p>&nbsp;
                                <input type="text" class="form-control" name="form_name" placeholder="ชื่อแบบสอบถาม" required>
                            </div><br>
                            <div class="col d-flex justify-content-end">
                                <select name="status" id="status" class="form">
                                    <option value="0">ปิดใช้งาน</option>
                                    <!-- <option value="1">เปิดใช้งาน</option> -->
                                </select>
                            </div><br>
                            <small class="text-danger text-end">*สามารถเปิดใช้แบบสอบถามได้เพียง 1 แบบสอบถาม</small>

                            
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success justify-content-center">สร้างแบบสอบถาม</button>
                        <a href="form.php" class="btn btn-secondary">ยกเลิก</a>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
