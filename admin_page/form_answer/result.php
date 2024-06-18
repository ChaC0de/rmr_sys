<?php
include('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_student INNER JOIN form_answer ON tb_student.u_ID = form_answer.u_ID
INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Result</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>
                <br>
                <div class="container">
                    <div class="row">
                        <p class="fs-3 text-center">ผลการตอบแบบสอบถาม</p>
                    </div>

                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>รหัสนักศึกษา</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ชื่อแบบสอบถาม</th>
                                    <th>คำตอบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($conn->query($sql) as $row){ ?>
                                    <tr>
                                        <td><?php echo $row['u_ID'] ?></td>
                                        <td><?php echo $row['st_name'] ?></td>
                                        <td><?php echo $row['form_name'] ?></td>
                                        <td>
                                            <a href="viewResult.php?form_ID=<?php echo $row['form_ID'] ?>&u_ID=<?php echo $row['u_ID'] ?>" class="btn btn-info">ดูคำตอบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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