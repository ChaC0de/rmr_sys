<?php 
include('../../connection/conn.php');
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

if ($_POST) {
    $search = $_POST['search']; // คำสั่งค้นหา

}

//$sql="SELECT * FROM TABLENAME WHERE field1 LIKE '%$year%' AND field2 LIKE '%$agency%' AND field3 LIKE '%$keyword%'"

$sql1 = "SELECT * FROM tb_dormitory
INNER JOIN tb_landlord ON tb_dormitory.u_ID = tb_landlord.u_ID
 WHERE 
 dormName LIKE '%' '$search' '%'
    OR land_name LIKE '%$search%'
    OR dormStyle LIKE '%$search%'
    OR dormType LIKE '%$search%'
    OR residentsType LIKE '%$search%'
    OR address LIKE '%$search%'";

$query1 = mysqli_query($conn, $sql1); 
$num1 = mysqli_num_rows($query1); //นับจำนวนแถวที่ได้จากการเลือกข้อมูล
$list1 = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>search dormitory</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php include ('../../_navbar/adminNav2.php')?>
        <div class="col-lg-9 col-md-8 mx-auto">
        <div class="container overflow-hidden" id="approved">
        <div class="row gx-5">
          <div class="row">
            <div class="p-3 border bg-success text-light px-5">ค้นหาหอพัก</div>
            <div class="row">
      <p class="fs-5 text-end pe-5 mt-2"><?php echo "ผลลัพธ์ทั้งหมด $num1 รายการ"; ?></p>
      <form action="searchDorm.php" method="post">
      <div class="input-group">
          <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
          <button type="submit" class="btn btn-outline-primary">search</button>
        </div>
      </form>

        <?php if ($num1 == 0) { ?>
          <p class="fs-5 mt-5 text-center">ไม่มีข้อมูล</p>
        
        <?php } ?>


        <?php foreach($query1 as $row1) {
          $list1++ ?>
          <?php 
          $dormPic = $row1['dormPic'];
          $dir = "../../uploads/";
          $fileImage = $dir . basename($dormPic);
          ?>
        <div class="card m-5" style="width: 70rem;" >
          <div class="card-body">
          <div class="container">
        <div class="row">
          <div class="col col-sm-8">
          <h5>หอพัก <?php echo $list1; ?>:  <?php echo $row1['dormName']; ?></h5>
          <?php 
        if($row1['dormPic'] == null){
            echo "<img src='/uploads/No_image_available.svg.webp' width='250' height='auto;'>";

        }else{
            echo "<img src='$fileImage' width='250' height='auto;'>";
                }
        ?>
          </div>
          <div class="col-sm-4 text-end">
                  <h5 class="p-2">เจ้าของ: <?php echo $row1['land_name']; ?></h5>
                  <h6>สไตล์: <?php echo $row1['dormStyle']; ?></h6>
                  <h6>ประเภทหอพัก: <?php echo $row1['dormType']; ?></h6>
                  <h6>ประเภทผู้อยู่อาศัย: <?php echo $row1['residentsType']; ?></h6>
                  <h6>ที่อยู่: <?php echo $row1['address']; ?></h6>
                  <br>
                  <br>
                    <a href="viewDormApproved.php?dorm_ID=<?php echo $row1['dorm_ID']; ?>" class="btn btn-outline-info">ดูเพิ่มเติม</a>
                  </div>
                </div>
              </div>
            </div>   
          </div>
        </div>
      <?php } ?>
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
