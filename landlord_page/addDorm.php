<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql2 = "SELECT * FROM tb_dormitory INNER JOIN tb_landlord ON tb_dormitory.u_ID = tb_landlord.u_ID";
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($query2);


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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>add dormitory</title>
</head>
<body
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <?php include ('landNav.php')?>
      <!-- content -->
      <div class="col-lg-12 col-md-8 mx-5 px-5">
                <div class="row py-lg-5">
<br>
<!-- add dormitory -->
<div class="container">
    <div class="col fs-5">
      <h3 class="text-center">เพิ่มข้อมูลหอพัก</h3>
      
        <br>
        <form action="insertDorm.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6 mb-5 mx-auto">
                <label for="dormName" class="form-label" >ชื่อหอพัก</label>
                <input type="text" class="form-control" id="dormName" name="dormName" placeholder="ระบุชื่อหอพัก" required>
            </div>
            <div class="col-md-6 mb-5 mx-auto">
                <label for="land_name" class="form-label" >เจ้าของหอพัก</label><br>
                <input type="hidden" name="u_ID" class="form-control" value="<?php echo $_SESSION['u_ID']; ?>" readonly>
                <input type="text" name="land_name" class="form-control" value="<?php echo $row['land_name']; ?>" readonly>
            </div>

            <div class="col-md-6 mb-5 mx-auto">
                <label for="dormPrice" class="form-label">ราคาหอพัก/เดือน</label>
                <input type="number" min="1" max="10000" step="any" class="form-control" id="dormPrice" name="dormPrice" placeholder="ระบุราคาค่าเช่าต่อเดือน" required>
            </div>
            <div class="col-md-6 mb-5 mx-auto">
                <label for="deposit" class="form-label">ค่าประกัน</label>
                <input type="number" min="1" max="10000" step="any" class="form-control" id="deposit" name="deposit" placeholder="ระบุค่าประกันหอพัก" required>
            </div>
            <div class="col-md-6 mb-5 mx-auto">
                <label for="address" class="form-label">ที่อยู่</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="ระบุที่ตั้งของหอพัก" required>
            </div>
            <div class="col-md-6 mb-5 mx-auto">
                <label for="room" class="form-label">จำนวนห้องพัก</label>
                <input type="number" class="form-control" id="room" name="room" placeholder="จำนวนห้องพักทั้งหมด" required>
            </div>
                    <!-- ประเภทการเข้าพัก -->
            <div class="col-md-6 mb-5 mx-auto fs-5">
            <label for="residentsType" class="form-label">ประเภทการเข้าพัก</label>
            <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักหญิง" id="residentsType">
            <label class="form-check-label" for="residentsType">
                หอพักหญิง
            </label>
            </div>
            <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักชาย" id="residentsType">
            <label class="form-check-label" for="residentsType">
                หอพักชาย
            </label>
            </div>
             <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักรวม" id="residentsType">
            <label class="form-check-label" for="residentsType">
                หอพักรวม
            </label>
            </div>
            </div>
        <hr>

        <!-- ประเภทที่พัก -->
        <div class="col-md-12 mb-5 mx-auto fs-5">
            <label for="dormType" class="form-label">ประเภทที่พัก</label>
        <br>  
            <div class="container" name="dormType_ID">
            <div class="row align-items-start ">
             <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="บ้านเดี่ยว" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>บ้านเดี่ยว</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/h1.jpg">
            </label>
            </div>
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="คอนโด" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>คอนโด</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/con.jpg"> 
            </label>
            </div>
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="ห้องแถว" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>ห้องแถว</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/row.jpg"> 
            </label>
            </div>
            </div>
            <div class="row align-items-end">
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="อะพาร์ตเมนท์" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>อะพาร์ตเมนท์</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/part.jpg"> 
            </label>
            </div>            
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="อาคารพาณิชย์" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>อาคารพาณิชย์</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/panich.jpg"> 
            </label>
            </div>            
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="บ้านเดี่ยวติดกัน" name="dormType" id="dormType">
            <label class="form-check-label" for="dormType">
            <p>บ้านเดี่ยวติดกัน</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/dormTypePic/h2.jpg"> 
            </label>
            </div>
            </div>
            </div><br><hr>
            <!-- style ของหอพัก -->
            <div class="col-md-12"><label for="dormStyle" class="form-label">สไตล์ที่พัก</label>
        <br>  
            <div class="container" name="style_ID" for="dormStyle">
            <div class="row align-items-start px-5">
             <div class="col form-check">
            <input class="form-check-input" type="radio" value="รีสอร์ท" name="dormStyle" id="dormStyle">
            <label class="form-check-label" for="dormStyle">
            <p>รีสอร์ท</p>
                <img class="img-fluid" width="250px" height="200px" src="../img/DormStyle/resort.jpg" > 
            </label>
            </div>
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="ลอฟท์" name="dormStyle" id="dormStyle">
            <label class="form-check-label" for="dormStyle">
            <p>ลอฟท์</p>
                <img class="img-fluid" width="300px" src="../img/DormStyle/loft2.jpg" > 
            </label>
            </div>
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="มินิมอล" name="dormStyle" id="dormStyle">
            <label class="form-check-label" for="dormStyle">
            <p>มินิมอล</p>
                <img class="img-fluid" width="250px" width="300px" src="../img/DormStyle/minimal.jpg" > 
            </label>
            </div>
            </div>
            <br>
            <div class="row align-items-start  px-5">
            <div class="col-md-4 form-check">
            <input class="form-check-input" type="radio" value="ทั่วไป" name="dormStyle" id="dormStyle">
            <label class="form-check-label" for="dormStyle">
            <p>ทั่วไป</p>
                <img class="img-fluid" width="250px" height="200px" src="../img/DormStyle/general.jpg" > 
            </label>
            </div>            
            </div>
            </div><br><hr>
            
            <label for="service1" class="form-label">บริการที่มีในหอพัก</label><br>
            <div class="container" for="service1">
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service1">
            <label class="form-check-label" for="service">พื้นที่จอดรถ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service2">
            <label class="form-check-label" for="service">ลิฟต์</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service3">
            <label class="form-check-label" for="service">เครื่องซักผ้าหยอดเหรียญ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service4">
            <label class="form-check-label" for="service">ร้านซักรีด</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service5">
            <label class="form-check-label" for="service">สระว่ายน้ำ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service6">
            <label class="form-check-label" for="service">มินิมาร์ท-ร้านขายของ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service7">
            <label class="form-check-label" for="service">บริการอินเตอร์เน็ตไร้สาย-Wifi</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service8">
            <label class="form-check-label" for="service">Co-working-space</label>
            </div>
     
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service9">
            <label class="form-check-label" for="service">Fitness-center</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service10">
            <label class="form-check-label" for="service">คาเฟ่-ร้านอาหาร</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service11">
            <label class="form-check-label" for="service">ครัวส่วนกลาง</label>
            </div><br><br>
            <label for="dormPic" class="form-label">ภาพในหอพัก</label><br>
            <div class="container" for="dormPic">
            <input type="file" class="form-control w-50" name="dormPic" id="dormPic">
            </div><br><br>
        <div class="container">
        <button type="submit" class="btn btn-success" name="submit">บันทึก</button></form>
        <button class="btn btn-danger" type="cancel" onclick="javascript:window.location='index_land.php?u_ID=<?php echo $_SESSION['u_ID']; ?>''">ยกเลิก</button>
        </div>
    </div>
    <!-- end add dormitory -->
</div>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>