<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql = "SELECT * FROM tb_student
  INNER JOIN user 
  ON tb_student.u_ID = user.u_ID
  WHERE user.u_ID = '".$_SESSION['u_ID']."'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

$sql1 = "SELECT * FROM tb_dormitory 
INNER JOIN tb_landlord 
ON tb_dormitory.u_ID=tb_landlord.u_ID WHERE tb_dormitory.status = '1'";
$query1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($query1);
$num1 = mysqli_num_rows($query1);

$result1 = mysqli_fetch_array($query1);
isset($row1['dormPic']) ? $dormPic = $row1['dormPic'] : $dormPic = '';
$dir = "../uploads/";
$fileImage = $dir . basename($dormPic);

$result = mysqli_fetch_array($query);
$st_pic = $row['st_pic'];
$dir = "../uploads/st_pic/";
$fileImage_st = $dir . basename($st_pic);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <title>profileStudent</title>
</head>
<body>
  <?php include('stNav.php'); ?>
  <br>
  <br>
    <div class="container pb-5">


    </div>
    <div class="album py-5 bg-light">
    <h2 class="text-center bg-light">รายการหอพักทั้งหมด</h2>
    <div class="col-12">
    <form class="d-flex justify-content-end mt-5" action="searchDorm.php" method="POST">
      <input class="form-control me-2" type="text" name="search" placeholder="ค้นหา" aria-label="ค้นหา" style="width: 300px;">
      <button class="btn btn-outline-success" type="submit">ค้นหา</button>
    </form>
      </div>

      <?php if ($num1 == 0 ) { ?>
      <tr>
          <td colspan="3"><p class="fs-5 text-center">ไม่มีข้อมูลหอพัก</p></td>
      </tr>
  <?php } else { ?>
    <p class="fs-5 text-end mt-3 pe-5">
    <?php echo "ผลลัพธ์ทั้งหมด <span class='text-info'>$num1</span> รายการ"; ?>
    </p>

      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php foreach($query1 as $row1) { ?>

            <div class="col mb-3">
              <div class="card shadow-sm">
                <div class="col">
                  <div class="card-body">
                    <p class="card-text">
                      <center>
                        <div class="row">
                          <h4 class="text-start">หอพัก : <span class="text-info"><?php echo $row1['dormName']; ?></span></h4>
                        </div>
                        <?php
                        if ($row1['dormPic'] == null) {
                          echo "<img src='../img/No_image_available.svg.webp' width='250' height='auto;' class='img-fluid'>";
                        } else {
                          $fileImage = $dir . basename($row1['dormPic']);
                          echo "<img src='$fileImage' width='400' height='400' class='img-fluid'>";
                        }
                        ?>
                      </center>
                      <div class="row">
                        <p class="text-end mt-3 px-5 text-info"><?php echo $row1['land_name']; ?></p>
                        <p class="text-end px-5">สร้าง: <span class="text-info"><?php echo $row1['createDate']; ?></span> </p>
                        <a href="dorm_detail.php?dorm_ID=<?php echo $row1['dorm_ID']; ?>" class="btn btn-sm btn-outline-info">ดูเพิ่ม</a>
                      </div>
                    </p>

                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>    
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
