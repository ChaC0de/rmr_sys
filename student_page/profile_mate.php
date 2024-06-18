<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');
$u_ID = $_GET['u_ID'];


$sql = "SELECT * FROM tb_student
INNER JOIN user 
ON tb_student.u_ID = user.u_ID
WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$result = mysqli_fetch_array($query);



$sql1 = "SELECT * FROM tb_student
  INNER JOIN user ON tb_student.u_ID = user.u_ID
  INNER JOIN tb_result ON tb_student.u_ID = tb_result.u_ID
  INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID
  INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
  WHERE tb_result.u_ID = '$u_ID' LIMIT 1
   ";

$query1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($query1);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>profileStudent</title>

</head>
<body>
<?php include('stNav.php'); ?>
<br>
  <?php foreach($query1 as $row1) { ?>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-body">
        <div class="text-center">

        <?php 
              $st_pic = $row1['st_pic'];
              $dir = "../uploads/";
              $fileImage_st = $dir . basename($st_pic);

              if($row1['st_pic'] == null){
                  echo "<img src='../uploads/default.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_st' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>
                
                </div>
        </div>
      </div>
      <hr>

    <div class="row">
      <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <div class="row mx-5 pe-5 col-12 mx-auto">
                <div class="col">
                <p class="fs-5 text-dark fw-bold fs-5">ข้อมูลส่วนตัว</p>
                </div>
                <label for="st_name" class="form-label mb-3">ชื่อ
                <input type="hidden" class="form-control" value="<?php echo $row1['u_ID']; ?>" readonly>
                  <input type="text" class="form-control" value="<?php echo $row1['st_name']; ?>" readonly>
                </label>

                <label for="st_sex" class="form-label mb-3">เพศสรีระ
                  <input type="text" class="form-control" value="<?php echo $row1['st_sex']; ?>" readonly>
                </label>

                <label for="st_name" class="form-label mb-3">คณะที่ศึกษา
                  <input type="text" class="form-control" value="<?php echo $row1['faculty']; ?>" readonly>
                </label>
                <hr>
                <div class="col">
                <p class="fs-5 text-dark fw-bold fs-5">ข้อมูลการติดต่อ</p>
                </div>

                <label for="st_contact" class="form-label mb-3">Line / Facebook
                  <input type="text" class="form-control" value="<?php echo $row1['st_contact']; ?>" readonly>
                </label>

                <label for="st_tel" class="form-label mb-3">เบอร์โทรศัพท์
                  <input type="text" class="form-control" value="<?php echo $row1['st_tel']; ?>" readonly>
                </label>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>