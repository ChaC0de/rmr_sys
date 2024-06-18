<?php 
include('../../connection/conn.php');
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$sql = "SELECT * FROM form_answer
    INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
    INNER JOIN tb_student ON form_answer.u_ID = tb_student.u_ID
    WHERE tb_form.status = '1' GROUP BY tb_student.u_ID";

$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
$row = mysqli_fetch_array($query);
$list = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>VeiwResult</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include ('../../_navbar/adminNav2.php') ?>
        <!-- Content -->
        <div class="col-lg-9 col-md-9 mx-auto mt-5">
            <div class="row py-lg-12">
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>ชื่อแบบสอบถาม</th>
                                <th>คำตอบ</th>
                            </tr>
                        </thead>
                        <?php foreach($query as $sql) { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $sql['u_ID'] ?></td>
                                    <td><?php echo $sql['st_name'] ?></td>
                                    <td><?php echo $sql['form_name'] ?></td>
                                    
                                    <td>
                                        <a href="viewResult.php?form_ID=<?php echo $sql['form_ID'] ?>&u_ID=<?php echo $sql['u_ID'] ?>" class="btn btn-primary">ดูคำตอบ</a>
                                    </td>
                                   
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>