<?php 
include('../connection/conn.php');
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar


$sql = "SELECT * FROM form_answer
INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
INNER JOIN tb_student ON form_answer.st_ID = tb_student.st_ID
WHERE tb_form.status = '1'";
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>VeiwResult</title>
</head>
<body>

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
            <?php foreach($query as $sql){ ?>
            <tbody>
                <tr>
                <tr>
                    <td><?php echo $sql['st_ID'] ?></td>
                    <td><?php echo $sql['st_name'] ?></td>
                    <td><?php echo $sql['form_name'] ?></td>
                    <!-- <td>
                        <a href="viewResult.php?form_ID=<?php echo $sql['form_ID'] ?>&st_ID=<?php echo $sql['st_ID'] ?>" class="btn btn-info">ดูคำตอบ</a>
                    </td> -->
                </tr>
                </tr>
            </tbody>        
            <?php } ?>
        </table>

    </div>

<script src="../js/bootstrap.min.js"></script>
</body>
</html>