<?php
include('../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');
$sql = "SELECT * FROM `tb_student`
INNER JOIN form_answer ON tb_student.u_ID = form_answer.u_ID 
INNER JOIN user ON tb_student.u_ID = user.u_ID
WHERE user.u_ID = '".$_SESSION['u_ID']."' ";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
$row = mysqli_fetch_array($query);
$list = 0;

$sql1 = "SELECT * FROM form_answer 
INNER JOIN tb_answer ON form_answer.ans_ID = tb_answer.ans_ID
INNER JOIN tb_question ON tb_question.q_ID = tb_answer.q_ID
INNER JOIN tb_form ON form_answer.form_ID = tb_form.form_ID
INNER JOIN tb_student ON form_answer.u_ID = tb_student.u_ID
INNER JOIN user ON tb_student.u_ID = user.u_ID
WHERE form_answer.u_ID = '".$_SESSION['u_ID']."'
ORDER BY tb_question.q_ID ASC
";

$query1 = mysqli_query($conn,$sql1);
$result1 = mysqli_fetch_assoc($query1);
$row1 = mysqli_fetch_array($query1);
$num1 = mysqli_num_rows($query1);
$list1 = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Answer Page</title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <?php include ('stNav.php') ?>
    <!-- Content -->
    <div class="col-lg-9 col-md-4 mx-auto">
      <div class="row py-lg-5">
        <div class="container px-5">            
          <div class="row gx-5 justify-content-center">
            <?php if ($num1==0) { ?>
              <div class="alert alert-secondary text-center mt-5" role="alert">
              ยังไม่มีประวัติการตอบแบบสอบถาม
              </div>
            <?php }else{ ?>
              <div class="card">
              <div class="card-body">
              <div class="text-center">
                <h1 class="fs-3 fw-bold mb-3 mt-5">ประวัติการตอบแบบสอบถาม</h1>
              </div>
              <form action="insertAnswer.php" method="post">
            <div class="row">
              <div class="col-12">
                <br>
              </div>
              <div class="row">
              <div class="row">
                <div class="col-12 mb-5 fs-4">
                    <input type="hidden" class="form-control" name="form_ID" value="<?php echo $row1['form_ID'] ?>">
                    <?php echo $row1['form_name'] ?>           
                </div>
                <div class="col-6">
                  <p class="fs-4 fw-bold">ผู้ตอบแบบสอบถาม</p>
                  <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID'] ?>">

                  <input type="text" class="form-control" name="st_name" value="<?php echo $row['st_name'] ?>" readonly>                    

                </div>
                <div class="col-6 text-end">
                  <p class="fs-4 fw-bold">วันที่ตอบ</p>
                  <?php echo $row['ansDate'] ?>
                </div>
                <div class="col-12 mt-5">
                  <p class="fs-4 fw-bold">คำถาม</p>
                </div>
                <br>

                <?php foreach($query1 as $row1) {
                  $list1 ++; ?>
                <div class="col-12 mb-5">
                    <input type="hidden" class="form-control" name="q_ID" value="<?php echo $row1['q_ID'] ?>">
                    <div class="fs-5">
                      <?php echo $list1 ?>.
                      <?php echo $row1['q_text'] ?>
                    </div>
                    <div class="mt-2">
                      <input type="text" class="form-control" name="a_text" value="<?php echo $row1['a_text'] ?>" readonly>                      
                    </div>
                </div>
                    <?php } ?>
              </div>
              <div class="col-3 mx-auto">
                <div class="d-grid">
                  <a href="answerPage.php?u_ID = <?php echo $row['u_ID'] ?>" class="btn btn-warning" onclick="return confirm('ทำแบบสอบถามอีกครั้งหรือไม่? คำตอบของคุณจะถูกแทนที่ด้วยคำตอบใหม่')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                  </svg>  
                  ทำแบบสอบถามอีกครั้ง</a>
                </div>
          </form>
              </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>