<?php
include('../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql = "SELECT * FROM tb_student
  INNER JOIN user 
  ON tb_student.u_ID = user.u_ID
  WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'
   ";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);


isset($row['st_pic']) ? $st_pic = $row['st_pic'] : $st_pic = '';
$dir = "../uploads/st_pic/";
$fileImage_st = $dir . basename($st_pic);


$sql1 = "SELECT * FROM `form_question` 
    INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID
    INNER JOIN tb_form ON form_question.form_ID = tb_form.form_ID
    WHERE tb_form.status = '1' ORDER BY form_question.q_ID ASC";

$query1 = mysqli_query($conn,$sql1);
$result1 = mysqli_fetch_assoc($query1);
$row1 = mysqli_fetch_array($query1);
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
        <div class="card">
            <div class="card-body">            
          <form action="insertAnswer.php" method="post">
            <div class="row">
              <div class="row">

                <div class="col-12">
                </div>
                <br>
                <br>
                <div class="row mb-5">
                <label for="st_name" class="col-sm-3 col-form-label fw-bold fs-5 text-end">ผู้ตอบแบบสอบถาม</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="st_name" value=" <?php echo $_SESSION['username']; ?>" readonly>
                  <input type="hidden" name="u_ID" value="<?php echo $_SESSION['u_ID'] ?>" readonly>
                </div>
              </div>  
              <div class="col-6 mb-5 text-start">
                </div>
                
              </div>
              <div class="row fs-4 fw-bold px-5">
                <?php echo $row1['form_name'] ?>
                <input type="hidden" name="form_ID" class="form-control" value="<?php echo $row1['form_ID'] ?>" readonly>
              </div>
              <br>
              <br>
              <hr>

              <div class="row">
                <?php foreach($query1 as $row1){ 
                  $list1++; ?>

                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 px-3">
                        <br>
                        <p class="fs-4 fw-bold"><?php echo $list1 ?>.<?php echo $row1['q_text'] ?>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <?php
                          $sql3 = "SELECT * FROM `tb_answer` WHERE q_ID = '".$row1['q_ID']."' ";
                          $query3 = mysqli_query($conn,$sql3);
                          $result3 = mysqli_fetch_assoc($query3);
                          $row3 = mysqli_fetch_array($query3);
                          ?>
                          <?php foreach($query3 as $row3){ ?>
                            <div class="col-12">
                              <div class="row ">
                                <div class="col-12 px-5">
                                  <p class="fs-5">
                                    <input type="radio" class="form-check-input" name="q_ID_<?php echo $row1['q_ID']?>" 
                                    value="<?php echo $row3['ansValue'] . ',' . $row3['ans_ID'];?>" required>
                                    <?php echo $row3['a_text'] ?>
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
                <a href="index_st.php" class="btn btn-danger">ออก</a>
              </center>
              <br>
              <br>
            </div>
          </form>
          </div>
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