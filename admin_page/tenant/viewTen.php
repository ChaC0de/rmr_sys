<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql = "SELECT * FROM tb_student 
  INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID 
  INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
  INNER JOIN user ON tb_student.u_ID = user.u_ID
  WHERE tb_student.u_ID = '$u_ID'";
  
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$result = mysqli_fetch_array($query);
isset($result['st_pic']) ? $st_pic = $result['st_pic'] : $st_pic = '';
$dir = "../../uploads/";
$fileImage_st = $dir . basename($st_pic);

$sql2 = "SELECT user.username FROM user INNER JOIN tb_student ON user.u_ID = tb_student.u_ID WHERE tb_student.u_ID = '$u_ID'";
$query2 = mysqli_query($conn, $sql2);
$num2 = mysqli_num_rows( $query2 );
$row2 = mysqli_fetch_array($query2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <?php foreach($query as $row) { ?>
    <title>
    ข้อมูลส่วนตัวนักศึกษา
    </title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Include sidebar -->
    <?php include ('../../_navbar/adminNav.php')?>
    <!-- Content -->
    <div class="col-lg-9 col-md-8 mx-auto">
      <div class="row py-lg-5">
        <br>
        <!-- Personal Information Section -->
        <p class="text-center px-3 pt-3 fs-4">ข้อมูลส่วนตัว</p>
        
        <!-- Show details -->
        <div class="card-body">
        <div class="text-center">

        <?php 
              if($row['st_pic'] == null){
                  echo "<img src='../../uploads/default.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_st' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>
              
                </div>
        </div>
      </div>
      <hr>
<?php } ?>
    <?php foreach($query as $row) { ?>
    <div class="row">
      <div class="col">
          <div class="d-grid gap-2 d-md-block">
            <div class="row">
              <div class="col">
              <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัวนักศึกษา</p>

              </div>
            </div>

              <div class="row mx-5 pe-5">
              <label for="st_name" class="form-label mb-3">ชื่อ
                <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>" readonly>
                  <input type="text" class="form-control" name="st_name" value="<?php echo $row['st_name']; ?>" readonly>
                </label>

                <label for="faculty" class="form-label mb-3">ศึกษาในคณะ
                <input type="text" class="form-control" name="faculty" value="<?php echo $row['faculty']; ?>" readonly>
              </label>

                <label for="st_tel" class="form-label mb-3">เบอร์โทรศัพท์
                  <input type="text" class="form-control" name="st_tel" value="<?php echo $row['st_tel']; ?>" readonly>
                </label>

                <label for="st_contact" class="form-label mb-3">Line / Facebook
                  <input type="text" class="form-control" name="st_contact" value="<?php echo $row['st_contact']; ?>" readonly>
                </label>

                <label for="st_sex" class="form-label mb-3">เพศสรีระ
                  <input type="text" class="form-control" name="st_sex" value="<?php echo $row['st_sex']; ?>" readonly>
                </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">บัญชี</p>
              <div class="row mx-5 pe-5">

              <label for="st_email" class="form-label mb-3">อีเมล
                  <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" readonly>
                </label>
              </div>
          </div>
        </div>
      </div>

      <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a href="tenList.php" class="btn btn-primary">ตกลง</a>
      </div>
    </div>
          <!-- End of Account Information Section -->
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>