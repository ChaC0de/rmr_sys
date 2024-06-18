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

$sql1 = "SELECT similarity.id, similarity.similarity FROM `similarity` 
INNER JOIN tb_student ON similarity.u_ID = tb_student.u_ID 
WHERE similarity.u_ID = '".$row['u_ID']."' AND similarity.id != '".$row['u_ID']."'";

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
  <div class="album bg-light">
    <div class="container">
      <hr>
        <div class="row mb-1">
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

                <?php $percentage = $row1['similarity']; ?>
                <span class="prefix">คล้ายกัน
                  </span>
                  <span class="similarity-text <?php echo ($similarity > 80) ? 'green' : (($similarity > 49) ? 'orange' : 'red'); ?>">
                    <?php echo $similarity; ?>%
                  </span>
                  </button>
                </small>
                
          <?php
              $sql3 = "SELECT tb_student.st_pic FROM similarity 
              INNER JOIN tb_student ON similarity.u_ID = tb_student.u_ID 
              WHERE similarity.u_ID = '".$row1['u_ID']."' ";
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
                
                <?php echo $row1['st_name']; ?>
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