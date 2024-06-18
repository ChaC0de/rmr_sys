<?php 
include ('../../connection/conn.php'); 
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');


$form_ID = $_GET['form_ID'];
$q_ID = $_GET['q_ID'];

$sql = "SELECT * FROM form_question INNER JOIN tb_question ON tb_question.q_ID = form_question.q_ID
INNER JOIN tb_form ON tb_form.form_ID = form_question.form_ID
WHERE form_question.form_ID  = '$form_ID ' AND tb_question.q_ID = '$q_ID' ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );

$sql2 = "SELECT * FROM tb_question INNER JOIN tb_answer ON tb_answer.q_ID = tb_question.q_ID WHERE tb_question.q_ID = '$q_ID' ";
$query2 = mysqli_query($conn, $sql2);
$num2 = mysqli_num_rows( $query2 );

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="../style.css">
     <title>แสดงคำตอบ</title>
 </head>
 <body>
 <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- Content -->
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <?php foreach ($query as $row) { ?>
                            <tr>
                                <th>
                                    <p class="fs-5 text-start">ชื่อแบบสอบถาม:</p>
                                    <?php echo $row["form_name"] ?>
                                </th>
                                <th>
                                    <p class="fs-5 text-end">สร้างเมื่อ:</p>
                                    <p class="fs-5 text-info text-end"><?php echo $row["created_at"] ?></p>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th>
                                    <p class="fs-5 text-start">คำถาม:</p>
                                    <?php echo $row["q_text"] ?>
                                    </th>
                            </tr>
                        </table>
                    </div>
                </div>
          <br>
                <div class="container">
                    <div class="row">
                        <table class="table">
                        <th class="fs-5">
                                    <div class="row">
                                        <div class="col-6"><p class="fs-5 text-start">คำตอบ:</p>
                                    </div>
                                            <div class="col-6 text-end">
                                                <p class="fs-5 text-end">ค่าคำตอบ:</p>
                                        </div>
                                    </div>

                            <?php foreach ($query2 as $row2) { ?>
                            <tr>
                                <th class="fs-5">
                                    <div class="row">
                                        <div class="col-6"><?php echo $row2["a_text"] ?></div>
                                            <div class="col-6 text-end"><?php echo $row2["ansValue"]?>
                                        </div>
                                    </div>

                                    
                                </th>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </table>
                        </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <a href="viewFormQues.php?form_ID=<?php echo $row["form_ID"] ?>" class="btn btn-primary col-5 align-item-center">กลับ</a>
                    </div>
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
