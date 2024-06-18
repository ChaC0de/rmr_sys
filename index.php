<?php 
include ('connection/conn.php');  // เชื่อมต่อฐานข้อมูล

$sql = "SELECT tb_dormitory.dormPic FROM tb_dormitory 
INNER JOIN tb_landlord ON tb_dormitory.u_ID=tb_landlord.u_ID 
ORDER BY dorm_ID ASC";

$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>indexstudent</title>
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

<div class="container">
    <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/22.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/33.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/66.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div> -->
    <hr class="my-5">
</div>

<section class="py-5 text-center container">
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light"></h1>
            <p class="lead text-muted">คุณกำลังมองหารูมเมทอยู่ใช่ไหม มาเริ่มหารูมเมทที่เข้ากับคุณกันเถอะ</p>
            <p>
                <a href="login/login.php" class="btn btn-primary my-2">เริ่มการแนะนำรูมเมท</a>
            </p>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
