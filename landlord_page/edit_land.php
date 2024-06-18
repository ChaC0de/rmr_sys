<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql = "SELECT * FROM tb_landlord
  INNER JOIN user  ON tb_landlord.u_ID = user.u_ID
  WHERE tb_landlord.u_ID = '".$_SESSION['u_ID']."' ";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


if(isset($_POST['submit'])){
  $check = getimagesize($_FILES["land_pic"]["tmp_name"]);

  if($check) {
      $dir = "../uploads/land_pic/";
      $allowTypes = array('jpg','png','jpeg','gif'); // ประเภทไฟล์ที่อนุญาต
      $fileImage_LAND = $dir . basename($_FILES["land_pic"]["name"]);

      if(move_uploaded_file($_FILES["land_pic"]["tmp_name"], $fileImage_LAND)){
          header('Refresh:0; url=profile_land.php?u_ID='.$u_ID.'');

      }else{
          echo "ไม่สามารถอัพโหลดไฟล์ภาพได้";
      }
  } else {
      echo "<script> alert('ไม่ใช่ไฟล์รูปภาพ โปรดอัพโหลดไฟล์รูปภาพ') </script>";
          header('Refresh:0; url=profile_land.php?u_ID='.$u_ID.'');
  }

  $sql = " UPDATE `tb_landlord` SET `land_pic` = '$fileImage_LAND'
  WHERE `tb_landlord`.`land_ID` = '".$_SESSION['land_ID']."' ";

  $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

  if ($result) {
      echo "<script type='text/javascript'>";
      echo "alert('แก้ไขภาพโพร์ไฟล์สำเร็จ');";
      echo "window.location = 'profile_land.php?u_ID=".$u_ID."'; ";
      echo "</script>";
  } else {
      echo "<script type='text/javascript'>";
      echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
      echo "window.location = 'profile_land.php?u_ID=".$u_ID."'; ";
      echo "</script>";
  }
}

$result = mysqli_fetch_array($query);
$land_pic = $row['land_pic'];
$dir = "../uploads/land_pic/";
$fileImage_LAND = $dir . basename($land_pic);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Profilelandlord</title>
</head>
<body>
  <?php include ('landNav.php'); ?>
  <br>
  <h2 class="text-center">ข้อมูลส่วนตัว</h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-body">
            <div class="text-center">
            <?php 
              if($row['land_pic'] == null){
                  echo "<img src='../uploads/default.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_LAND' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>
              
            </div>
        </div>
      </div>
      <hr>
      <form action="updateLand.php?u_ID = <?php echo $row["u_ID"]; ?> AND u_ID = <?php echo $row["u_ID"]; ?>" method="post">
      <div class="row">
        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัวเจ้าของหอพัก</p>

              <div class="row mx-5 pe-5">
                <label for="username" class="form-label mb-3">ชื่อ
                  <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>">
                  <input type="text" class="form-control" name="land_name" value="<?php echo $row['land_name']; ?>">
                </label>

                <label for="land_tel" class="form-label mb-3">เลขประจำตัวผู้เสียภาษี
                  <input type="text" class="form-control" name="tax_num" value="<?php echo $row['tax_num']; ?>">
                </label>
                
                <label for="land_sex" class="form-label mb-3">เพศสรีระ
                <select class="form-control w-50" name="land_sex">
                    <option value="">กรุณาเลือก</option>
                    <option value="เพศชาย" <?php if ($row["land_sex"] == "เพศชาย") { echo "SELECTED"; } ?>>เพศชาย</option>
                    <option value="เพศหญิง" <?php if ($row["land_sex"] == "เพศหญิง") { echo "SELECTED"; } ?>>เพศหญิง</option>
                </select>


                </label>
              </div>
          </div>
        </div>

        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">ข้อมูลการติดต่อ</p>
              <div class="row mx-5 pe-5">

              <label for="tax_num" class="form-label mb-3">เบอร์โทรศัพท์
                  <input type="text" class="form-control" name="land_tel" value="<?php echo $row['land_tel']; ?>">
                </label>

                <label for="land_contact" class="form-label mb-3">Line / Facebook
                  <input type="text" class="form-control" name="land_contact" value="<?php echo $row['land_contact']; ?>">
                </label>
              </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">บัญชี</p>
              <div class="row mx-5 pe-5 col-4">
                <label for="username" class="form-label mb-3">อีเมล
                  <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
              </label>
          </div>
        </div>
      </div>
      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="profile_land.php?u_ID=<?php echo $row["u_ID"]?>" class="btn btn-secondary">ยกเลิก</a>
        <button  class="btn btn-primary me-md-2" type="submit">บันทึก</button>
      </div>
    </form>
    </div>
  </div>

  <!-- Button trigger modal -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>