<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$dorm_ID=$_GET['dorm_ID'];

$sql = "SELECT * FROM tb_dormitory WHERE dorm_ID = '$dorm_ID' AND (service1 = 1 OR service2 = 1 OR service3 = 1 OR service4 = 1 
OR service5 = 1 OR service6 = 1 OR service7 = 1 OR service8 = 1 OR service9 = 1 OR service10 = 1 OR service11 = 1)";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$result = mysqli_fetch_array($query);
$dormPic = $result['dormPic'];
$dir = "../uploads/";
$fileImage = $dir . basename($dormPic);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <?php foreach($query as $row) { ?>
    <title>
    <?php echo $row['dormName'];?>
    </title>
</head>
<body>
    <p class="text-start px-3 pt-3 fs-4">ข้อมูลหอพัก</p>
    <!-- show details -->
    <hr>
    
    <div>
    <div class="row text-center px-5">

    <div class="col px-5">
        <?php 
        if($row['dormPic'] == null){
            echo "<td colspan='3'><p class='fs-5 text-center'>ไม่มีภาพ</p></td>";

        }else{
            echo "<img src='$fileImage' width='300' height='300'>";
                }
        ?>
    </div>
    <hr>

    <div class="col px-5">
        <label for="dormName" class="form-label fs-5 px-5">ชื่อหอพัก: <p class="text-info"><?=$row['dormName']?></p></label>
        <label for="dormPrice" class="form-label fs-5 px-5">ราคา/เดือน: <p class="text-info"><?=$row['dormPrice']?></p></label>
        <label for="deposit" class="form-label fs-5 px-5">ค่าประกันหอพัก: <p class="text-info"><?=$row['deposit']?></p></label>
        <label for="address" class="form-label fs-5 px-5">ที่ตั้งหอพัก: <p class="text-info"><?=$row['address']?></p></label>
        <label for="room" class="form-label fs-5 px-5">จำนวนห้องพัก: <p class="text-info"><?=$row['room']?></p></label>
    </div>    
    <hr>

    <div class="col px-5">
        <label for="dormType" class="form-label fs-5 px-5">ประเภทที่พัก: <p class="text-info"><?=$row['dormType']?></p></label>
        <label for="dormStyle" class="form-label fs-5 px-5">สไตล์ที่พัก: <p class="text-info"><?=$row['dormStyle']?></p></label>
        <label for="residentsType" class="form-label fs-5 px-5">ประเภทผู้เข้าพัก: <p class="text-info"><?=$row['residentsType']?></p></label>
    </div>
        <hr>
        
    <div class="col px-5">
    <label for="service" class="form-label fs-5 px-5">บริการที่มีในหอพัก: </label><br>
    <div class="col px-5"><p class="text-info">
    <?php 
          if($row['service1'] == 1){
              echo "<p class='fs-5 px-3 text-info'>พื้นที่จอดรถ<br>";
          }
          if($row['service2'] == 1){
              echo "ลิฟต์<br>";
          }
          if($row['service3'] == 1){
              echo "เครื่องซักผ้าหยอดเหรียญ<br>";
          }
          if($row['service4'] == 1){
              echo "ร้านซักรีด<br>";
          }
          if($row['service5'] == 1){
              echo "สระว่ายน้ำ<br>";
          }
          if($row['service6'] == 1){
              echo "มินิมาร์ท-ร้านขายของ<br>";
          }
          if($row['service7'] == 1){
              echo "บริการอินเตอร์เน็ตไร้สาย-Wifi<br>";
          }
          if($row['service8'] == 1){
              echo "Co-working-space<br>";
          }
          if($row['service9'] == 1){
              echo "Fitnes-center<br>";
          }
          if($row['service10'] == 1){
              echo "คาเฟ่-ร้านอาหาร<br>";
          }
          if($row['service11'] == 1){
              echo "ครัวส่วนกลาง</p><br>";
          }
          ?> 
        <?php } ?></p>
    </div>

  </div>

  </div>

    <!-- end show details -->
    
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>