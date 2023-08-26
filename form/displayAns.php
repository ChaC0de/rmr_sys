<?php 
include ('../connection/conn.php'); 
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

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
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../style.css">
     <title>Document</title>
 </head>
 <body>
 <br>
 <div class="container">
   <div class="row">
   <table class="table">
     <?php foreach ($query as $row) { ?>
   <tr>
 <th> <p class="fs-5 text-start">ชื่อแบบสอบถาม:</p>
 <?php echo $row["form_name"] ?>
 </th>
 <th><p class="fs-5 text-end">สร้างเมื่อ:</p> <p class="fs-5 text-info text-end"><?php echo $row["created_at"] ?></p> </th>
   </tr>
     </table>
     </div>
     </div>
     <br>
     <div class="container">
     <div class="row">
     <table class="table">
     <tr>
     <th> <p class="fs-5 text-start">คำถาม:</p>
     <?php echo $row["q_text"] ?>
     </th>
     </tr>
     </table>
     </div>
     </div>
     <br>
     <div class="container">
     <div class="row">
     <table class="table"><p class="fs-5 text-start">คำตอบ:</p>
      <?php foreach ($query2 as $row2) { ?>
     <tr>
     <th class="fs-5">
     <?php echo $row2["a_text"] ?>
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
     <script src="../js/bootstrap.min.js"></script>
 </body>
 </html>
