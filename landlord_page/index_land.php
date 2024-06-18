<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql = "SELECT * FROM tb_landlord
  INNER JOIN user 
  ON tb_landlord.u_ID = user.u_ID
  WHERE tb_landlord.u_ID = '".$_SESSION['u_ID']."' ";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$result = mysqli_fetch_array($query);

$land_pic = $row['land_pic'];
$dir = "../uploads/land_pic/";
$fileImage_LAND = $dir . basename($land_pic);

$sql1 ="SELECT * FROM tb_dormitory
INNER JOIN tb_landlord ON tb_landlord.u_ID = tb_dormitory.u_ID
WHERE tb_landlord.u_ID = '".$_SESSION['u_ID']."' ";
$query1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($query1);
$num1 = mysqli_num_rows( $query1 );
$list1 = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>indexlandlord</title>
</head>
<body>
  
  <?php include ('landNav.php'); ?>

<!-- ----------------------------------------------------   -->
<p class="text-end mb-2 mt-5">
    <a href="addDorm.php?u_ID=<?php echo $_SESSION['u_ID']; ?>"
      class="btn btn-primary m-5">ลงทะเบียนหอพัก</a>
  </p>
<div class="container overflow-hidden" id="unapprove">
        <div class="row gx-5">
          <div class="row">
            <div class="p-3 border bg-info text-light px-5 fw-bold fs-5">รายการหอพักของคุณ</div>
            <div class="row">
      <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num1 รายการ"; ?></p>
        <?php if ($num1 == 0) { ?>
          <p class="fs-5 text-center">ไม่มีข้อมูล</p>
        
          <?php } else { ?>

        <?php foreach($query1 as $row1) {
          $list1++ ?>
          <?php
          isset($row1['dormPic']) ? $dormPic = $row1['dormPic'] : $dormPic = '';
          $dir = "../uploads/";
          $fileImage = $dir . basename($dormPic);
          ?>

        <div class="card m-5" style="width: 70rem;" >
          <div class="card-body">
          <div class="container">
        <div class="row">
          <div class="col-12 col-sm-4 ">
            <h5>หอพัก<?php echo $list1; ?>:  <?php echo $row1['dormName']; ?></h5>


          <?php 
          if($row1['dormPic'] == null){
              echo "<img src='/uploads/No_image_available.svg.webp' width='250' height='auto;'>";

          }else{
              echo "<img src='$fileImage' width='250' height='auto;'>";
                  }
        ?>
          </div>
          <div class="col-sm-8 text-start">
          <h5 class="mt-1 text-end">สถานะ: 
            <?php $sql3 = "SELECT status FROM tb_dormitory WHERE dorm_ID = '".$row1['dorm_ID']."' ";
            $query3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($query3);
            $status = $row3['status'];
            if($status == 0){
              echo "<span class='text-danger'> ยังไม่ได้รับการอนุมัติ<span>";
            }else{
              echo "<span class='text-success'>อนุมัติแล้ว<span>";
            }

          ?></h5>
                  <h5 class="mt-1">สไตล์: <?php echo $row1['dormStyle']; ?></h5>
                  <h5>ประเภทหอพัก: <?php echo $row1['dormType']; ?></h5>
                  <h5>ประเภทผู้อยู่อาศัย: <?php echo $row1['residentsType']; ?></h5>
                  <h5>ที่อยู่: <?php echo $row1['address']; ?></h5>

                  </div>
                  <div class="d-flex justify-content-end">
                  <a href="viewDorm.php?u_ID=<?php echo $_SESSION['u_ID']; ?>&dorm_ID=<?php echo $row1['dorm_ID']; ?>" class="btn btn-primary col-3">ดูเพิ่มเติม</a>
                  </div>

                </div>
              </div>
            </div>   
          </div>
        </div>
      <?php } ?>
      <?php } ?>
        </div>
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