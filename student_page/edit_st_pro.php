<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$u_ID = isset($row['u_ID']) ? $row['u_ID'] : null;
$st_name = isset($row['st_name']) ? $row['st_name'] : null;
$st_contact = isset($row['st_contact']) ? $row['st_contact'] : null;
$st_tel = isset($row['st_tel']) ? $row['st_tel'] : null;
$st_sex = isset($row['st_sex']) ? $row['st_sex'] : null;
$faculty_ID = isset($row['faculty_ID']) ? $row['faculty_ID'] : null;
$username = isset($row['username']) ? $row['username'] : null;

$sql = "SELECT * FROM tb_student
  INNER JOIN user ON tb_student.u_ID = user.u_ID
  INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID 
  INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
  WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'";


$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$st_pic = isset($row['st_pic']) ? $row['st_pic'] : null;

$dir = "../uploads/st_pic/";
$fileImage_st = $dir . basename($st_pic);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>edit pro</title>
</head>
<body>
<?php include('stNav.php'); ?>
<br>  
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-body">
        <div class="text-center">

        <?php 
              if($row['st_pic'] == null){
                  echo "<img src='../img/propic.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_st' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>
        </div>
      </div>
      <hr>

      <form action="updateSt.php" method="post">
    <div class="row">
      <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัวนักศึกษา</p>
              <?php foreach ($query as $row) { ?>

              <div class="row mx-5 pe-5">
              <label for="st_name" class="form-label mb-3">ชื่อ
                <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>">
                  <input type="text" class="form-control" name="st_name" value="<?php echo $row['st_name']; ?>">
                </label>

                <label for="faculty" class="form-label mb-3">ศึกษาในคณะ
                <select class="form-select" name="faculty_ID">
                    <option value="">กรุณาเลือก</option>
                    <?php
                    $sql = "SELECT * FROM tb_faculty";
                    $query = mysqli_query($conn,$sql);
                    while($row2 = mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row2["faculty_ID"];?>" <?php if ($row["faculty_ID"] == $row2["faculty_ID"]) { echo "SELECTED"; } ?>>
                        <?php echo $row2["faculty"];?>
                    </option>
                    <?php }?>
                </select>
                </label>

                <label for="st_tel" class="form-label mb-3">เบอร์โทรศัพท์
                  <input type="text" class="form-control" name="st_tel" value="<?php echo $row['st_tel']; ?>" >
                </label>

                <label for="st_contact" class="form-label mb-3">Line / Facebook
                  <input type="text" class="form-control" name="st_contact" value="<?php echo $row['st_contact']; ?>">
                </label>
                
                <label for="st_sex" class="form-label mb-3">เพศสรีระ
                <select class="form-select" name="st_sex">
                      <option value="">กรุณาเลือก</option>
                      <option value="เพศชาย" <?php if ($row["st_sex"] == "เพศชาย") { echo "SELECTED"; } ?>>เพศชาย</option>
                      <option value="เพศหญิง" <?php if ($row["st_sex"] == "เพศหญิง") { echo "SELECTED"; } ?>>เพศหญิง</option>
                  </select>
                </label>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">บัญชี</p>
              <div class="row mx-5 pe-5">

              <label for="st_email" class="form-label mb-3">ชื่อผู้ใช้
                  <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
                </label>
              </div>
          </div>
        </div>
      </div>
<?php } ?>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a href="index_st.php?u_ID=<?php echo $_SESSION['u_ID']; ?>" class="btn btn-secondary">ยกเลิก</a>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
      
    </div>
   </form>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>