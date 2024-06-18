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
$result = mysqli_fetch_array($query);

$sql2 = "SELECT result FROM tb_result
INNER JOIN user ON tb_result.u_ID = user.u_ID
 WHERE tb_result.my_ID = '".$_SESSION['u_ID']."' 
 AND tb_result.u_ID = '".$_SESSION['u_ID']."'";
$query2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($query2);

$sql1 = "SELECT tb_result.u_ID, tb_result.student_Name, tb_result.result, tb_percent.r_percentage
FROM tb_result 
INNER JOIN tb_student 
ON tb_result.my_ID = tb_student.u_ID 
INNER JOIN tb_percent
ON tb_result.u_ID = tb_percent.u_ID
WHERE tb_result.my_ID = '".$row['u_ID']."'
AND tb_percent.my_ID = '".$row['u_ID']."'
AND tb_result.u_ID != '".$row['u_ID']."' 
AND tb_result.st_sex = tb_student.st_sex
AND tb_percent.r_percentage > 50
ORDER BY tb_percent.r_percentage DESC
";
$query1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($query1);
$result1 = mysqli_fetch_array($query1);
$num1 = mysqli_num_rows($query1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <title>indexstudent</title>
    <style>
.loader {
  align-items: center;
    width: 100px; /* ปรับขนาดตามที่คุณต้องการ */
    height: 100px; /* ปรับขนาดตามที่คุณต้องการ */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999; /* ให้ Loader อยู่ด้านหน้าทุกอย่าง */
}
.green {
  color: green;
}

.orange {
  color: orange;
}

.red {
  color: red;
}

</style>
</head>
<body>
<?php include('stNav.php'); ?>
  <main>
  <section class="py-1 text-center container">
    <div class="row py-lg-2">
      <div class="col-lg-6 col-md-8 mx-auto">
        <p class="lead text-dark fw-bold fs-5">คุณกำลังมองหารูมเมทอยู่ใช่ไหม มาเริ่มหารูมเมทที่เข้ากับคุณกันเถอะ</p>
        <p>
          <button id="runPythonScript" class="btn btn-primary my-2" onclick="return runPythonScript()">เริ่มการแนะนำรูมเมท</button>
      </p>
      <div id="loadingSpinner" class="spinner-border text-primary mx-auto" role="status" style="display: none;">
        <span class="visually-hidden">Loading...</span>
      </div>

      <div id="resultDiv"></div>
      </div>
    </div>
  </section>

  <div class="album bg-light">
    <div class="container">
      <hr>
        <div class="row">
          <h4 class="text-end">
          ผลการแนะนำรูมเมท <span class="text-primary"><?php echo $num1 ?></span>  คน
          </h4>
        </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <?php foreach ($query1 as $row1) { ?>
        <div class="col">
          <div class="card shadow-sm">
          <small class="text-muted text-end mb-3 mt-2 pe-2">
            
                <button type="button" class="btn btn-sm btn-outline-dark fs-5">
                  <!-- <?php echo $row1['result']; ?>
                  <?php echo $row2['result']; ?> -->
                <?php $percentage = $row1['r_percentage']; ?>
                <span class="prefix">เข้ากัน
                  </span>
                  <span class="percentage-text <?php echo ($percentage > 80) ? 'green' : (($percentage > 49) ? 'orange' : 'red'); ?>">
                    <?php echo $percentage; ?>%
                  </span>
                  </button>
                </small>
                
          <?php
              $sql3 = "SELECT tb_student.st_pic FROM tb_result 
              INNER JOIN tb_student ON tb_result.u_ID = tb_student.u_ID 
              WHERE tb_result.u_ID = '".$row1['u_ID']."' ";
              $query3 = mysqli_query($conn,$sql3);
              $row3 = mysqli_fetch_array($query3);
              $result3 = mysqli_fetch_array($query3);
              
              $st_pic = $row3['st_pic'];
              $dir = "../uploads/";
              $fileImage_st = $dir . basename($st_pic);

            if($row3['st_pic'] == null){
                echo "<img src='../uploads/default.png' alt='profile Pic' width='100%' height='225' class='img-fluid mx-auto d-block rounded'>";
            } else {
                echo "<img src='$fileImage_st' width='60%' height='225' class='img-fluid mx-auto d-block rounded'>";
            }?>
            <div class="card-body">
              
              <p class="card-text fs-5">
                <input type="hidden" name="u_ID" value="<?php echo $row1['u_ID']; ?>" disabled>
                
                <?php echo $row1['student_Name']; ?>
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="profile_mate.php?u_ID=<?php echo $row1['u_ID']; ?>" class="btn btn-sm btn-outline-secondary fs-5">ดูข้อมูล</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
function runPythonScript() {
    var u_ID = <?php echo json_encode($row['u_ID']); ?>;
    const resultDiv = document.getElementById('resultDiv');
    const runButton = document.getElementById('runPythonScript');
    const loadingSpinner = document.getElementById('loadingSpinner');

    if (runButton.disabled) {
        console.log('กระบวนการกำลังทำงานอยู่');
        return;
    }

    runButton.disabled = true;
    loadingSpinner.style.display = 'block';
    resultDiv.innerHTML = '';

    fetch('http://localhost:5000/rmr_sys/ga_process/run_script?u_ID=' + u_ID)
        .then(response => response.json())
        .then(data => {
            resultDiv.innerHTML = data.message; // Display the result
            loadingSpinner.style.display = 'none'; // Hide the loading spinner
            runButton.disabled = false; // Enable the button

            location.reload();
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาด: ', error);
            loadingSpinner.style.display = 'none';
            runButton.disabled = false;
        });
}
</script>


</body>
</html>