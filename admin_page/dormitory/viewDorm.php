<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$dorm_ID = $_GET['dorm_ID'];
$sql = "SELECT * FROM tb_dormitory
INNER JOIN tb_landlord ON tb_dormitory.u_ID = tb_landlord.u_ID
 WHERE dorm_ID = '$dorm_ID' AND (service1 = 1 OR service2 = 1 OR service3 = 1 OR service4 = 1 
OR service5 = 1 OR service6 = 1 OR service7 = 1 OR service8 = 1 OR service9 = 1 OR service10 = 1 OR service11 = 1)";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$result = mysqli_fetch_array($query);
$dormPic = $result['dormPic'];
$dir = "../../uploads/";
$fileImage = $dir . basename($dormPic);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php foreach($query as $row) { ?>
    <title>
    <?php echo $row['dormName'];?>
    </title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <?php include ('../../_navbar/adminNav.php')?>
      <!-- content -->
      <div class="col-lg-9 col-md-8 mx-auto">
                <div class="row py-lg-5">
    <p class="text-start px-3 pt-3 fs-4">ข้อมูลหอพัก</p>

    <!-- show details -->
    <hr>
    <div class="card">
    <div class="card-body">
    <div class="row px-5">
    <div class="col px-5">
        <?php 
        if($row['dormPic'] == null){
            echo "<td colspan='3'><p class='fs-5 text-center'>ไม่มีภาพ</p></td>";

        }else{
            echo "<br><img src='$fileImage' width='300' height='300' class='img-fluid mx-auto d-block rounded'> <hr><br>";
            
                }
        ?>
    </div>
    <form action="approved.php" method="post">
    <div class="row">
    <div class="col px-5">
        <input type="hidden" name="dorm_ID" value="<?=$row['dorm_ID']?>"> 
        <input type="hidden" name="status" value="<?=$row['status']?>"> 

        <label for="dormName" class="form-label fs-5 px-5">ชื่อหอพัก: <p style="color: #4c137e" ><?=$row['dormName']?></p></label>
        <label for="dormPrice" class="form-label fs-5 px-5">ราคา/เดือน: <p style="color: #4c137e"><?=$row['dormPrice']?> บาท/ต่อเดือน</p></label>
        <label for="deposit" class="form-label fs-5 px-5">ค่าประกันหอพัก: <p style="color: #4c137e"></p><?=$row['deposit']?>บาท/ต่อเดือน</p></label>
        <label for="address" class="form-label fs-5 px-5">ที่ตั้งหอพัก: <p style="color: #4c137e"><?=$row['address']?></p></label>
        <label for="room" class="form-label fs-5 px-5">จำนวนห้องพัก: <p style="color: #4c137e"><?=$row['room']?></p></label>
        <label for="residentsType" class="form-label fs-5 px-5">ประเภทผู้เข้าพัก: <p style="color: #4c137e"><?=$row['residentsType']?></p></label>

    </div>    


    <div class="col px-5">
        <label for="dormType" class="form-label fs-5 px-5">
        เจ้าของ: <p style="color: #4c137e"><?=$row['land_name']?></p> 
        ประเภทที่พัก: <p style="color: #4c137e"><?=$row['dormType']?></p>
        <?php if($row['dormType'] == 'บ้านเดี่ยว'){
          echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/h1.jpg'>";
        } 
              if($row['dormType'] == 'คอนโด'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/con.jpg'>";
        } 
              if($row['dormType'] == 'ห้องแถว'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/row.jpg'>";
        }
              if($row['dormType'] == 'อะพาร์ตเมนท์'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/part.jpg'>";
        } 
              if($row['dormType'] == 'อาคารพาณิชย์'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/panich.jpg'>";
        }
              if($row['dormType'] == 'บ้านเดี่ยวติดกัน'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/dormTypePic/h2.jpg'>";
        }
        ?>
      
      </label>


        <label for="dormStyle" class="form-label fs-5 px-5">สไตล์ที่พัก: <p style="color: #4c137e"><?=$row['dormStyle']?></p>
        <?php if($row['dormStyle'] == 'รีสอร์ท'){
          echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/DormStyle/resort.jpg'>";
        } 
              if($row['dormStyle'] == 'มินิมอล'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/DormStyle/minimal.jpg'>";
        } 
              if($row['dormStyle'] == 'ทั่วไป'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/DormStyle/general.jpg'>";
        }
              if($row['dormStyle'] == 'ลอฟท์'){
                echo "<img class='figure-img img-fluid rounded px-5' width='250px' height='auto;' src='../../img/DormStyle/loft2.jpg'>";
        } 
        ?>
      
      </label>
    </div>
</div>
<hr>
    <div class="row">
    <div class="col px-5">
    <label for="service" class="form-label fs-5 px-5">
    บริการที่มีในหอพัก: 

    </label><br>
    <div class="col px-5">
    <?php 
          if($row['service1'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

               พื้นที่จอดรถ
             </p>";
          }
          if($row['service2'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              ลิฟต์</p>";
          }
          if($row['service3'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              เครื่องซักผ้าหยอดเหรียญ</p>";
          }
          if($row['service4'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              ร้านซักรีด</p>";
          }
          if($row['service5'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              สระว่ายน้ำ</p>";
          }
          if($row['service6'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                มินิมาร์ท-ร้านขายของ</p>";
          }
          if($row['service7'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                บริการอินเตอร์เน็ตไร้สาย-Wifi</p>";
          }
          if($row['service8'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                Co-working-space</p>";
          }
          if($row['service9'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                Fitnes-center</p>";
          }
          if($row['service10'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                คาเฟ่-ร้านอาหาร</p>";
          }
          if($row['service11'] == 1){
              echo "<p style='color: #4c137e';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                ครัวส่วนกลาง</p></p>";
          }
          ?> 
        <?php } ?></p>
    </div>

  </div>
    </div>

  </div>

    </div>
    <div class="row">
    <div class="col d-flex justify-content-end m-5">
                    <a href="dorm_approval.php" class="btn btn-secondary">กลับ</a> &nbsp;
                    <button type="submit" name="submit" class="btn btn-success">อนุมัติหอพัก</button>
                    </form>
                    </div>
    </div>

    </div>
    </div>
    <div>
    <!-- end show details -->
    </div>
    </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>