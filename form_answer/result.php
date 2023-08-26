<?php
include('../connection/conn.php');
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM tb_student INNER JOIN form_answer ON tb_student.st_ID = form_answer.st_ID
INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Result</title>
</head>
<body>
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
                        <td><?php echo $row['st_ID'] ?></td>
                        <td><?php echo $row['st_name'] ?></td>
                        <td><?php echo $row['form_name'] ?></td>
                        <td>
                            <a href="viewResult.php?form_ID=<?php echo $row['form_ID'] ?>&st_ID=<?php echo $row['st_ID'] ?>" class="btn btn-info">ดูคำตอบ</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>