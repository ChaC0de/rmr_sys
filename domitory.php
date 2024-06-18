<?php 
include ('connection/conn.php');  // เชื่อมต่อฐานข้อมูล


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
  

<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="index.php" class="navbar-brand">|Roommate |Recommendation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="domitory.php">หอพัก</a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <a href="login/login.php" class="btn btn-outline-secondary">Login</a>
            <a href="login/register_st.php" class="btn btn-secondary">Sign-up</a>
        </div>
    </div>
</header>

<br>
  <h2 class="text-center">รายการหอพักทั้งหมด</h2>
  <br>

<?php 
$sql= "SELECT * FROM tb_dormitory 
INNER JOIN tb_landlord ON tb_dormitory.u_ID=tb_landlord.u_ID 
WHERE tb_dormitory.status = '1'
ORDER BY dorm_ID ASC"; //เลือกข้อมูลทั้งหมดจากตาราง tb_dormitory, tb_dormtype
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

?>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
      
      <div class="row row-cols-md-3">
       <?php while($row = mysqli_fetch_array($query)) { ?> 
    <?php 
          $dormPic = $row['dormPic'];
          $dir = "uploads/";
          $fileImage = $dir . basename($dormPic); ?>
        <div class="col mb-3">
          <div class="card shadow-sm">

            <div class="col">
            <div class="card-body">
                <p class="card-text">
                  <div class="row">
                    <h4 class="text-start">หอพัก : <?php echo $row['dormName'];?></h4></div>
                    <?php 
                        if($row['dormPic'] == null){
                            echo "<td colspan='3'><p class='fs-5 text-center'>ไม่มีภาพ</p></td>";

                        }else{
                            echo "<img src='$fileImage' width='250' height='auto;'>";
                                }
                        ?>

                    <div class="col-9 col-sm-9">


                    
                    </div>
                  <div class="row">
                    <p class="text-end"><?php echo $row['land_name'];?></p>
                  </div>
                </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="dorm_detail.php?dorm_ID=<?php echo $row['dorm_ID'];?>
                      " class="btn btn-sm btn-outline-info">ดูเพิ่ม</a>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>      
              </div>
            </div>
            
        </div>    
      </div>
      <?php } ?>        
      </div>
      
    </div>
  </div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>