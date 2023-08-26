<?php
include('../connection/conn.php');
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$form_ID = $_GET['form_ID'];
$st_ID = $_GET['st_ID'];

$sql = "SELECT * FROM form_question INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID 
INNER JOIN form_answer ON form_question.form_ID = form_answer.form_ID
INNER JOIN tb_student ON form_answer.st_ID = tb_student.st_ID
INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
WHERE form_answer.form_ID = '$form_ID' AND form_answer.st_ID = '$st_ID'";

$query = mysqli_query($conn, $sql);
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
        <br>
        <br>

        <?php if($row = mysqli_fetch_array($query)){ ?>

        <div class="row">
            <p class="fs-5 text-start text-info">ชื่อแบบสอบถาม : <?php echo $row['form_name'] ?></p>
            <br>
            <hr>
        <div class="row">
            <p class="fs-5 text-end text-info">ชื่อนักศึกษา : <?php echo $row['st_name'] ?>
            </p>
        </div>
        <?php } ?>       
        </div>


        
        <div class="row">
            <input type="radio">
            <br>
            <p class="fs-5 text-start text-info">คำตอบ : <?php echo $row['a_text'] ?></p>
        </div>
        <div class="row">
            <a href="result.php" class="btn btn-info">ย้อนกลับ</a>
        </div>
            <br>
            <hr>
        </div>


    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>