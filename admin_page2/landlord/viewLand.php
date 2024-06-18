<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql = "SELECT * FROM tb_landlord
  INNER JOIN user 
  ON tb_landlord.u_ID = user.u_ID
  WHERE tb_landlord.u_ID = '$u_ID'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );

$result = mysqli_fetch_array($query);
$land_pic = $result['land_pic'];
$dir = "../../uploads/land_pic/";
$fileImage_LAND = $dir . basename($land_pic);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>
        viewLand
    </title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav2.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <p class="fw-bold fs-5 mt-5 text-center">ข้อมูลเจ้าของหอพัก</p>
            <?php foreach($query as $row) { ?>
            <div class="col">
        <div class="card-body">
            <div class="text-center">
            <?php 
              if($row['land_pic'] == null){
                  echo "<img src='../../uploads/default.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_LAND' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>                       
            </div>
        </div>
      </div>
            <hr>
            <div class="row mt-5">
                
                <div class="col-6">
                    <div class="d-grid gap-2 d-md-block">
                        <p class="text-dark fs-5 fw-bold">ข้อมูลส่วนตัวเจ้าของหอพัก</p>
                            <label for="username" class="form-label mb-3">ชื่อ
                            <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>" readonly>
                            <input type="text" class="form-control" value="<?php echo $row['land_name']; ?>" readonly>

                            <label for="land_tel" class="form-label mt-3">เลขประจำตัวผู้เสียภาษี
                            <input type="text" class="form-control" value="<?php echo $row['tax_num']; ?>" readonly>
                            </label>
                                                        
                            <label for="land_contact" class="form-label mt-3">เพศสรีระ
                            <input type="text" class="form-control " value="<?php echo $row['land_sex']; ?>" readonly>
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2 d-md-block">
                            <p class="px-5 text-dark fs-5 fw-bold">ข้อมูลการติดต่อ</p>
                            <div class="row mx-5 pe-5">

                            <label for="tax_num" class="form-label mb-3">เบอร์โทรศัพท์
                            <input type="text" class="form-control" value="<?php echo $row['land_tel']; ?>" readonly>
                            </label>

                            <label for="land_contact" class="form-label mb-3">Line / Facebook
                            <input type="text" class="form-control" value="<?php echo $row['land_contact']; ?>" readonly>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p class="fs-5 fw-bold">หอพักที่เป็นเจ้าของ</p>

                        <?php $showDorm = "SELECT * FROM tb_dormitory INNER JOIN tb_landlord 
                        ON tb_landlord.u_ID = tb_dormitory.u_ID WHERE tb_landlord.u_ID = '$u_ID'";
                        $queryDorm = mysqli_query($conn, $showDorm);
                        $numDorm = mysqli_num_rows($queryDorm);
                        $i = 0;
                        if ($numDorm == 0) {
                            echo '<p class="text-center text-secondary fs-5 fw-bold">ไม่มีข้อมูล</p>';
                        } else { ?>
                        
                        <?php foreach($queryDorm as $rowDorm) { $i++ ?>

                                <?php 
                                $dormPic = $rowDorm['dormPic'];
                                $dir = "../../uploads/";
                                $fileImage = $dir . basename($dormPic);
                                ?>
                                <div class="card m-5" style="width: 70rem;" >
                                <div class="card-body">
                                <div class="container">
                                <div class="row">
                                <div class="col col-sm-8">
                                <h5>หอพัก <?php echo $i; ?>:  <?php echo $rowDorm['dormName']; ?></h5>

                                    <?php 
                                    if($rowDorm['dormPic'] == null){
                                        echo "<img src='../../uploads/No_image_available.svg.webp' width='250' height='auto;'>";

                                    }else{
                                        echo "<img src='$fileImage' width='250' height='auto;'>";
                                            }
                                    ?>
                                </div>
                                        <div class="col-sm-4 text-end">
                                                <h5 class="p-2">เจ้าของ: <?php echo $rowDorm['land_name']; ?></h5>
                                                <h6>สไตล์: <?php echo $rowDorm['dormStyle']; ?></h6>
                                                <h6>ประเภทหอพัก: <?php echo $rowDorm['dormType']; ?></h6>
                                                <h6>ประเภทผู้อยู่อาศัย: <?php echo $rowDorm['residentsType']; ?></h6>
                                                <h6>ที่อยู่: <?php echo $rowDorm['address']; ?></h6>
                                                <br>
                                                <br>
                                                    <a href="../dormitory/viewDormApproved.php?dorm_ID=<?php echo $rowDorm['dorm_ID']; ?>" class="btn btn-outline-info">ดูเพิ่มเติม</a>
                                                </div>

                                                </div>
                                            </div>
                                            </div>   
                                        </div>
                                    <?php } ?>
                                        </div>

                            <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>