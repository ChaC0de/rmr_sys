<?php 
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$dorm_ID=$_GET['dorm_ID'];

$sql1 = "SELECT tb_landlord.land_name FROM tb_dormitory INNER JOIN tb_landlord ON tb_dormitory.land_name=tb_landlord.land_name WHERE dorm_ID = '$dorm_ID'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);

$sql = "SELECT * FROM tb_dormitory WHERE dorm_ID = '$dorm_ID' AND (service1 = 1 OR service2 = 1 OR service3 = 1 OR service4 = 1 
OR service5 = 1 OR service6 = 1 OR service7 = 1 OR service8 = 1 OR service9 = 1 OR service10 = 1 OR service11 = 1)";
$result=mysqli_query($conn,$sql); 
$row=mysqli_fetch_array($result); 

isset($_POST['service1']) ? $service1=$_POST['service1'] : $service1=$row['service1'];
isset($_POST['service2']) ? $service2=$_POST['service2'] : $service2=$row['service2'];
isset($_POST['service3']) ? $service3=$_POST['service3'] : $service3=$row['service3'];
isset($_POST['service4']) ? $service4=$_POST['service4'] : $service4=$row['service4'];
isset($_POST['service5']) ? $service5=$_POST['service5'] : $service5=$row['service5'];
isset($_POST['service6']) ? $service6=$_POST['service6'] : $service6=$row['service6'];
isset($_POST['service7']) ? $service7=$_POST['service7'] : $service7=$row['service7'];
isset($_POST['service8']) ? $service8=$_POST['service8'] : $service8=$row['service8'];
isset($_POST['service9']) ? $service9=$_POST['service9'] : $service9=$row['service9'];
isset($_POST['service10']) ? $service10=$_POST['service10'] : $service10=$row['service10'];
isset($_POST['service11']) ? $service11=$_POST['service11'] : $service11=$row['service11'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>edit dormitory</title>
</head>
<body> 

    <div class="container">
        <br>
        <h3 class="text-left">แก้ไขข้อมูลหอพัก</h3>
        <br>
        <form action="updateDorm.php" method="post">
        <div class="col-md-3">
            <input type="hidden" class="form-control"  id="dorm_ID" name="dorm_ID" value="<?php echo $row["dorm_ID"]; ?>">
            
            <label for="dormName" class="form-label">ชื่อหอพัก</label>
            <input type="text" class="form-control" id="dormName" name="dormName" value="<?php echo $row["dormName"]; ?>">
        </div><br><br>
        <div class="col-md-3">
            <label for="land_name" class="form-label" >ชื่อเจ้าของหอพัก</label>
            <!-- <select class="form-select" name="land_name" id="land_name">
            <option value="<?php echo $row1["land_name"]; ?>"><?php echo $row1["land_name"]; ?></option>
            <?php
                $sql1 = "SELECT * FROM tb_landlord";
                $result1 = mysqli_query($conn, $sql1);
                while($row1 = mysqli_fetch_array($result1)){
            ?>
            <option value="<?php echo $row1["land_name"]; ?>"><?php echo $row1["land_name"]; ?></option>
            <?php } ?>
            </select> -->

            <input type="text" name="land_name" class="form-control" value="
            <?php
            $sql1 = "SELECT tb_landlord.land_name FROM tb_dormitory INNER JOIN tb_landlord 
            ON tb_dormitory.land_name=tb_landlord.land_name WHERE dorm_ID = '$dorm_ID'";
            $result1 = mysqli_query($conn, $sql1);
                while($row1 = mysqli_fetch_array($result1)){ echo $row1["land_name"]; } ?>" readonly>

            </div><br><br>


         


        <div class="col-md-2">
            <label for="dormPrice" class="form-label">ราคาหอพัก</label>
            <input type="text" class="form-control" id="dormPrice" name="dormPrice" value="<?php echo $row["dormPrice"]; ?>">
        </div><br><br>
        <div class="col-md-2">
            <label for="deposit" class="form-label">ค่าประกัน</label>
            <input type="text" class="form-control" id="deposit" name="deposit" value="<?php echo $row["deposit"]; ?>">
        </div><br><br>
        <div class="col-md-5">
            <label for="address" class="form-label">ที่อยู่</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row["address"]; ?>">
        </div><br><br>
        <div class="col-md-2">
            <label for="room" class="form-label">จำนวนห้อง :</label>
            <input type="text" class="form-control" id="room" name="room" value="<?php echo $row["room"]; ?>">
        </div><br><br>
                <!-- ประเภทที่พัก -->
                <div class="col"><label for="dormType" class="form-label">ประเภทที่พัก</label>
        <br>  
            <div class="container" name="dormType">
            <div class="row align-items-start px-5">
             <div class="col form-check">
            <input class="form-check-input" type="radio" value="บ้านเดี่ยว" name="dormType" id="dormType" 
            <?php if ($row["dormType"] == "บ้านเดี่ยว") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>บ้านเดี่ยว</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/h1.jpg"> 
            </label>
            </div>
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="คอนโด" name="dormType" id="dormType"
            <?php if ($row["dormType"] == "คอนโด") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>คอนโด</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/con.jpg"> 
            </label>
            </div>
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="ห้องแถว" name="dormType" id="dormType" 
            <?php if ($row["dormType"] == "ห้องแถว") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>ห้องแถว</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/row.jpg"> 
            </label>
            </div>
            </div>
            <div class="row align-items-end px-5">
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="อะพาร์ตเมนท์" name="dormType" id="dormType" 
            <?php if ($row["dormType"] == "อะพาร์ตเมนท์") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>อะพาร์ตเมนท์</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/part.jpg"> 
            </label>
            </div>            
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="อาคารพาณิชย์" name="dormType" id="dormType" 
            <?php if ($row["dormType"] == "อาคารพาณิชย์") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>อาคารพาณิชย์</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/panich.jpg"> 
            </label>
            </div>            
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="บ้านเดี่ยวติดกัน" name="dormType" id="dormType"
            <?php if ($row["dormType"] == "บ้านเดี่ยวติดกัน") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormType">
            <p>บ้านเดี่ยวติดกัน</p>
                <img class="img-fluid" width="300px" height="200px" src="../img/h2.jpg"> 
            </label>
            </div>
            </div>
            </div><br><hr>




            <!-- style ของหอพัก -->
            <div class="col"><label for="dormStyle" class="form-label">สไตล์ที่พัก</label>
        <br>  
            <div class="container" name="dormStyle" for="dormStyle">
            <div class="row align-items-start px-5">
             <div class="col form-check">
            <input class="form-check-input" type="radio" value="รีสอร์ท" name="dormStyle" id="dormStyle" 
            <?php if ($row["dormStyle"] == "รีสอร์ท") {
                        echo ' checked '; } ?>> 

            <label class="form-check-label" for="dormStyle">
            <p>รีสอร์ท</p>
                <img class="img-fluid" width="250px" height="200px" src="../img/resort.jpg"> 
            </label>
            </div>
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="ลอฟท์" name="dormStyle" id="dormStyle" 
            <?php if ($row["dormStyle"] == "ลอฟท์") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormStyle">
            <p>ลอฟท์</p>
                <img class="img-fluid" width="300px" src="../img/loft2.jpg" > 
            </label>
            </div>
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="มินิมอล" name="dormStyle" id="dormStyle" 
            <?php if ($row["dormStyle"] == "มินิมอล") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormStyle">
            <p>มินิมอล</p>
                <img class="img-fluid" width="250px" width="300px" src="../img/minimal.jpg" > 
            </label>
            </div>
            </div>
            <br>
            <div class="row align-items-start  px-5">
            <div class="col form-check">
            <input class="form-check-input" type="radio" value="ทั่วไป" name="dormStyle" id="dormStyle"
            <?php if ($row["dormStyle"] == "ทั่วไป") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="dormStyle">
            <p>ทั่วไป</p>
                <img class="img-fluid" width="250px" height="200px" src="../img/general.jpg" > 
            </label>
            </div>            
            </div>
            </div><br><hr>



                <!-- ประเภทการเข้าพัก -->
            <label for="residentsType" class="form-label">ประเภทการเข้าพัก</label>
            <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักหญิง" id="residentsType"<?php if ($row["residentsType"] == "หอพักหญิง") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="residentsType">
                หอพักหญิง
            </label>
            </div>
            <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักชาย" id="residentsType" <?php if ($row["residentsType"] == "หอพักชาย") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="residentsType">
                หอพักชาย
            </label>
            </div>
             <div class="form-check px-5">
            <input class="form-check-input" type="radio" name="residentsType" value="หอพักรวม" id="residentsType" <?php if ($row["residentsType"] == "หอพักรวม") {
                        echo ' checked '; } ?>>

            <label class="form-check-label" for="residentsType">
                หอพักรวม
            </label>
            </div>
            <br>



            <!-- บริการที่มีในหอพัก -->
            <label for="service1" class="form-label">บริการที่มีในหอพัก</label><br>
            <div class="container" for="service1">
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service1" <?php if ($service1 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">พื้นที่จอดรถ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service2" <?php if ($service2 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">ลิฟต์</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service3" <?php if ($service3 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">เครื่องซักผ้าหยอดเหรียญ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service4" <?php if ($service4 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">ร้านซักรีด</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service5" <?php if ($service5 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">สระว่ายน้ำ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service6" <?php if ($service6 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">มินิมาร์ท-ร้านขายของ</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service7" <?php if ($service7 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">บริการอินเตอร์เน็ตไร้สาย-Wifi</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service8" <?php if ($service8 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">Co-working-space</label>
            </div>
     
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service9" <?php if ($service9 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">Fitness-center</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service10" <?php if ($service10 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">คาเฟ่-ร้านอาหาร</label>
            </div>
            <div class="form-check form-check-inline px-5">
            <input class="form-check-input" type="checkbox" name="service11" <?php if ($service11 == '1') echo 'checked'; ?>>
            <label class="form-check-label" for="service">ครัวส่วนกลาง</label>
            </div><br><br>
            

        <br>
        <button type="submit" class="btn btn-success">บันทึก</button>
        <a href="showDorm.php" class="btn btn-danger">ยกเลิก</a>
    </div></form>
    
<script src="../js/bootstrap.min.js"></script>
</body>
</html>