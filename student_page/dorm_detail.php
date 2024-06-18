<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql1 = "SELECT * FROM tb_dormitory INNER JOIN tb_landlord ON tb_dormitory.u_ID=tb_landlord.u_ID 
WHERE dorm_ID = '".$_GET['dorm_ID']."'
AND (service1 = 1 OR service2 = 1 OR service3 = 1 OR service4 = 1 
OR service5 = 1 OR service6 = 1 OR service7 = 1 OR service8 = 1 OR service9 = 1 OR service10 = 1 OR service11 = 1)";
$query1 = mysqli_query($conn, $sql1);
$num = mysqli_num_rows( $query1 );
$result = mysqli_fetch_array($query1);

$query1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($query1);
$dormPic = $result['dormPic'];
$dir = "../uploads/";
$fileImage = $dir . basename($dormPic);

$sql2 = "SELECT land_pic FROM tb_landlord INNER JOIN tb_dormitory ON tb_landlord.u_ID=tb_dormitory.u_ID
WHERE dorm_ID = '".$_GET['dorm_ID']."'";
$query2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($query2);
$land_pic = $row2['land_pic'];
$dir = "../uploads/land_pic/";
$fileImage_LAND = $dir . basename($land_pic);



$sql = "SELECT * FROM tb_student
  INNER JOIN user 
  ON tb_student.u_ID = user.u_ID
  WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
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
    <title>profileStudent</title>

</head>
<body>
<?php include('stNav.php'); ?>
<br>
  <h2 class="text-center">รายละเอียดหอพัก</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <?php foreach ($query1 as $row1) { ?>
        <p class="fs-5 px-5 text-dark">ชื่อหอพัก:  <span class="text-info"><?php echo $row1['dormName']; ?></span></p>

        <br>
        <div class="card-body">
          <div class="col-3 mx-auto">
          <?php 
                        if($row1['dormPic'] == null){
                            echo "<td colspan='3'><p class='fs-5 text-center'>ไม่มีภาพ</p></td>";

                        }else{
                            echo "<img src='$fileImage' class='img-fluid' width='250' height='auto;'>";
                                }
                        ?>
          </div>
        </div>

      <br><br>
      <div class="container overflow-hidden">
        <div class="row row-cols-md-2 gx-5">
          <div class="col">
            <div class="p-3 border bg-light fs-5 fw-bold">รายละเอียดหอพัก</div>

            <div class="row p-2">
              <div class="col">
              <span class=" text-dark fs-5">ราคาหอพัก: <span class="text-info"><?php echo $row1['dormPrice']; ?></span> / เดือน</span>
              </div>
              <div class="col">
              <span class=" text-dark fs-5">ค่าประกันสัญญาเช่า: <span class="text-info"><?php echo $row1['deposit']; ?></span></span>
              </div>
            </div>

            <div class="row p-2">
              <div class="col">
              <span class=" text-dark fs-5">ประเภทหอพัก: <span class="text-info"><?php echo $row1['dormType']; ?></span></span>
              </div>

              <div class="col">
              <span class=" text-dark fs-5">ผู้เข้าพัก: <span class="text-info"><?php echo $row1['residentsType']; ?></span></span>
              </div>
            </div>

              <div class="row p-2">
              <div class="col">
              <span class=" text-dark fs-5">สไตล์: <span class="text-info"><?php echo $row1['dormStyle']; ?></span></span>
              </div>

              <div class="col">
              <span class=" text-dark fs-5">จำนวนห้อง: <span class="text-info"><?php echo $row1['room']; ?></span></span>
              </div>
            </div>
            
            <div class="p-3 border bg-light mb-3 fs-5 fw-bold">บริการที่มีในหอพัก</div>
            <div class="col px-5 fs-5">
            <?php 
          if($row1['service1'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

               พื้นที่จอดรถ
             </p>";
          }
          if($row1['service2'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              ลิฟต์</p>";
          }
          if($row1['service3'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              เครื่องซักผ้าหยอดเหรียญ</p>";
          }
          if($row1['service4'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              ร้านซักรีด</p>";
          }
          if($row1['service5'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>

              สระว่ายน้ำ</p>";
          }
          if($row1['service6'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                มินิมาร์ท-ร้านขายของ</p>";
          }
          if($row1['service7'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                บริการอินเตอร์เน็ตไร้สาย-Wifi</p>";
          }
          if($row1['service8'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                Co-working-space</p>";
          }
          if($row1['service9'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                Fitnes-center</p>";
          }
          if($row1['service10'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                คาเฟ่-ร้านอาหาร</p>";
          }
          if($row1['service11'] == 1){
              echo "<p class='text-info';>
              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'/>
                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
                </svg>
                
                ครัวส่วนกลาง</p></p>";
          }
          ?> 
      </p>
    </div>
          </div>
          <div class="col">
            <div class="p-3 border bg-light fs-5 fw-bold">ข้อมูลเจ้าของหอพัก</div>
            <div class="row p-2">
            <span class="px-5 text-dark fs-5">ชื่อเจ้าของ: <span class="text-info"><?php echo $row1['land_name']; ?></span></span>
            </div>

            <div class="row p-2">
            <span class="px-5 text-dark fs-5">เพศ: <span class="text-info"><?php echo $row1['land_sex']; ?></span></span>
            </div>

            <div class="row p-2">
            <span class="px-5 text-dark fs-5">เบอร์โทรศัพท์: <span class="text-info"><?php echo $row1['land_tel']; ?></span></span>
            </div>
            
            <div class="row p-2">
            <span class="px-5 text-dark fs-5">Line/Facebook: <span class="text-info"><?php echo $row1['land_contact']; ?></span></span>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <?php 
              if($row2['land_pic'] == null){
                  echo "<img src='../img/propic.png' alt='profile Pic' width='70' height='70' class='rounded-circle'>";

              }else{
                  echo "<img src='$fileImage_LAND' width='70' height='70' class='rounded-circle'>";
                  
                      }
              ?>  
              
            </div>
            <hr>
            <div class="col p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                  <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                </svg> 
                ที่อยู่หอพัก: <span class="text-info fs-5"><?php echo $row1['address']; ?></span>          
              </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <br>
  </div>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>