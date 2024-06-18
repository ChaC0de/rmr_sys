<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$q_ID = $_GET['q_ID'];

$sql = "SELECT * FROM tb_question WHERE q_ID = '$q_ID'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>edit question</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <div class="container">
                    <br>
                    <center><h4>แก้ไขคำถาม</h4></center>
                    <br>
                    <form action="updateQues.php" method="post">
                        <div class="col-md-6">
                            <label for="q_text" class="form-label">คำถาม</label>
                            <input type="hidden" value="<?php echo $row["q_ID"]?>" name="q_ID">
                            <input type="text" class="form-control" name="q_text" value="<?php echo $row["q_text"]?>">
                        </div>
                        <br><br>
                        <button type="cancel" class="btn btn-danger" onclick="javascript:window.location='showtenQues.php'">ยกเลิก</button>
                        <button type="submit" class="btn btn-success">บันทึก</button>
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