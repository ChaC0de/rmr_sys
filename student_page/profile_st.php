<?php 
include ('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$sql = "SELECT * FROM tb_student
INNER JOIN user 
ON tb_student.u_ID = user.u_ID
WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);


if(isset($_POST['submit'])){
  $check = getimagesize($_FILES["st_pic"]["tmp_name"]);

  if($check) {
      $dir = "../uploads/";
      $allowTypes = array('jpg','png','jpeg','gif'); // ประเภทไฟล์ที่อนุญาต
      $fileImage_st = $dir .basename($_FILES["st_pic"]["name"]);

      if(move_uploaded_file($_FILES["st_pic"]["tmp_name"], $fileImage_st)){
          header('Refresh:0; url=profile_st.php?u_ID= '.$_SESSION['u_ID'].'');
      }else{
          echo "ไม่สามารถอัพโหลดไฟล์ภาพได้";
      }
  } else {
      echo "<script> alert('ไม่ใช่ไฟล์รูปภาพ โปรดอัพโหลดไฟล์รูปภาพ') </script>";
      echo "<script> window.location.href='profile_st.php?u_ID=".$_SESSION['u_ID']."'</script>";
  }

  $sql = "UPDATE `tb_student` SET `st_pic` = '$fileImage_st' WHERE `tb_student`.`u_ID` = '".$_SESSION['u_ID']."'";
  
  $result = mysqli_query($conn, $sql);

  if ($result) {
      echo "<script type='text/javascript'>";
      echo "alert('แก้ไขภาพโพร์ไฟล์สำเร็จ');";
      echo "window.location = 'profile_st.php?u_ID=".$_SESSION['u_ID']."'; ";
      echo "</script>";
  } else {
      echo "<script type='text/javascript'>";
      echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
      echo "window.location = 'profile_st.php?u_ID=".$_SESSION['u_ID']."'; ";
      echo "</script>";
  }
}

$result = mysqli_fetch_array($query);
$st_pic = $row['st_pic'];
$dir = "../uploads/";
$fileImage_st = $dir . basename($st_pic);

$showFac = "SELECT * FROM tb_student INNER JOIN tb_st_faculty ON tb_student.u_ID = tb_st_faculty.u_ID
INNER JOIN tb_faculty ON tb_st_faculty.faculty_ID = tb_faculty.faculty_ID
WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'";
$queryFac = mysqli_query($conn,$showFac);
$rowFac = mysqli_fetch_array($queryFac);
$faculty_ID = isset($rowFac['faculty_ID']) ? $rowFac['faculty_ID'] : null;
$faculty = isset($rowFac['faculty']) ? $rowFac['faculty'] : null;

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
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card-body">
        <div class="text-center">
              <?php 
              if($row['st_pic'] == null){
                  echo "<img src='../uploads/default.png' alt='profile Pic' width='150' height='150' class='img-fluid mx-auto d-block rounded'>";

              }else{
                  echo "<img src='$fileImage_st' width='200' height='200' class='img-fluid mx-auto d-block rounded'>";
                  
                      }
              ?>
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

                <a type="button" class=" text-decoration-none mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  เปลี่ยนภาพโพรไฟล์
                </a>
                </div>
        </div>
      </div>
      <hr>


    <?php foreach($query as $row) { ?>
    <div class="row">
      <div class="col">
          <div class="d-grid gap-2 d-md-block">
            <div class="row">
              <div class="col">
              <p class="fs-10 px-5 text-dark">ข้อมูลส่วนตัวนักศึกษา</p>

              </div>
                  <div class="col text-end">
                  <a href="edit_st_pro.php?u_ID=<?php echo $_SESSION['u_ID']; ?> AND u_ID=<?php echo $row['u_ID']; ?>
                  " class="text-info text-decoration-none">แก้ไขข้อมูล</a>
                  </div>              
            </div>

              <div class="row mx-5 pe-5">
              <label for="st_name" class="form-label mb-3">ชื่อ
                <input type="hidden" class="form-control" name="u_ID" value="<?php echo $row['u_ID']; ?>" readonly>
                  <input type="text" class="form-control" name="st_name" value="<?php echo $row['st_name']; ?>" readonly>
                </label>

                <label for="faculty" class="form-label mb-3">ศึกษาในคณะ
                <input type="text" class="form-control" name="faculty" value="<?php echo $faculty; ?>" readonly>
              </label>

                <label for="st_tel" class="form-label mb-3">เบอร์โทรศัพท์
                  <input type="text" class="form-control" name="st_tel" value="<?php echo $row['st_tel']; ?>" readonly>
                </label>

                <label for="st_contact" class="form-label mb-3">Line / Facebook
                  <input type="text" class="form-control" name="st_contact" value="<?php echo $row['st_contact']; ?>" readonly>
                </label>

                <label for="st_sex" class="form-label mb-3">เพศสรีระ
                  <input type="text" class="form-control" name="st_sex" value="<?php echo $row['st_sex']; ?>" readonly>
                </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="d-grid gap-2 d-md-block">
              <p class="fs-10 px-5 text-dark">บัญชี</p>
              <div class="row mx-5 pe-5">

              <label for="st_email" class="form-label mb-3">อีเมล
                  <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" readonly>
                </label>
              </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="index_st.php?u_ID=<?php echo $_SESSION['u_ID']; ?> AND u_ID=<?php echo $row['u_ID']; ?>" class="btn btn-primary">บันทึก</a>
      </div>
    </div>

      <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uploads profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="file" name="st_pic" id="st_pic" > 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>