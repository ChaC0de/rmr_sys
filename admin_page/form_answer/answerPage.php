<?php
include('../../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM `form_question` 
    INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID
    INNER JOIN tb_form ON form_question.form_ID = tb_form.form_ID
    WHERE tb_form.status = '1' ORDER BY form_question.q_ID ASC";

$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
$row = mysqli_fetch_array($query);
$num = mysqli_num_rows($query);
$list = 0;

$sql1 = "SELECT * FROM `tb_student` ";
$query1 = mysqli_query($conn,$sql1);
$result1 = mysqli_fetch_assoc($query1);
$row1 = mysqli_fetch_array($query1);

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
    <?php include ('../../_navbar/adminNav.php') ?>
    <!-- Content -->
    <div class="col-lg-9 col-md-4 mx-auto">
      <div class="row py-lg-5">
        <div class="container px-5">           
        <?php if($num > 0){ ?>
          <form action="insertAnswer.php" method="post">
            <div class="row">
              <div class="col-12 mt-5">
                <br>
              </div>
              <div class="row">
                <div class="col-12">
                  <p class="fs-4 fw-bold">เลือกผู้ตอบแบบสอบถาม</p>
                </div>
                <br>
                <br>
                <div class="col-12 mb-5">
                  <select name="u_ID" id="u_ID" class="form-select" aria-placeholder="กรุณาเลือกผู้ตอบแบบสอบถาม" required>
                    <option value="">กรุณาเลือกผู้ตอบแบบสอบถาม</option>
                    <?php foreach($query1 as $row1){ ?>
                      <option value="<?php echo $row1['u_ID'] ?>"><?php echo $row1['st_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <p class="fs-4 fw-bold text-info"><?php echo $row['form_name'] ?></p>
                <input type="hidden" name="form_ID" class="form-control" value="<?php echo $row['form_ID'] ?>" readonly>
              </div>
              <br>
              <br>
              <hr>

              <div class="row">
                <?php foreach($query as $row){ 
                  $list++; ?>

                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 px-3">
                        <br>
                        <p class="fs-4 fw-bold"><?php echo $list ?>.<?php echo $row['q_text'] ?>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <?php
                          $sql2 = "SELECT * FROM `tb_answer` WHERE q_ID = '".$row['q_ID']."' ";
                          $query2 = mysqli_query($conn,$sql2);
                          $result2 = mysqli_fetch_assoc($query2);
                          $row2 = mysqli_fetch_array($query2);
                          ?>
                          <?php foreach($query2 as $row2){ ?>
                            <div class="col-12">
                              <div class="row ">
                                <div class="col-12 px-5">
                                  <p class="fs-5">
                                    <input type="radio" class="form-check-input" name="q_ID_<?php echo $row['q_ID']?>" 
                                    value="<?php echo $row2['ansValue'] . ',' . $row2['ans_ID'];?>" required>
                                    <?php echo $row2['a_text'] ?>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <br>
                            <br>
                          <?php } ?>
                        </div>
                        <hr>
                        <br>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <center>
                <button type="submit" class="btn btn-success">
                  ส่งคำตอบ
                </button>
                <a href="../form/form.php" class="btn btn-danger">ออก</a>
              </center>
              <br>
              <br>
            </div>
          </form>  

          <?php } else { ?>
            <div class="row">
              <div class="col-12">
                <p class="fs-4 fw-bold text-center">ไม่พบแบบสอบถาม</p>
              </div>
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