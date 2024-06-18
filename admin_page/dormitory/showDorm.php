<?php 
include('../../connection/conn.php');
session_start();
if (!isset($_SESSION['u_ID'])) {
    header('location:../../login/login.php');
}

$sql = "SELECT * FROM tb_dormitory INNER JOIN tb_landlord 
    ON tb_dormitory.u_ID = tb_landlord.u_ID 
    WHERE tb_dormitory.status = '1' ORDER BY createDate DESC";

$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
$list = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>รายการหอพักที่อนุมัติแล้ว</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="container" id="approved">
                <div class="row gx-5">
                    <div class="col-12">
                        <div class="p-3 border bg-success text-light px-5">หอพักที่ได้รับการอนุมัติแล้ว</div>
                    </div>
                    <div class="col-12 mb-4 mt-4">
                        <form action="searchDorm.php" method="post">
                            <div class="input-group">
                                <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-outline-primary">search</button>
                            </div>
                        </form>
                    </div>
                    
                    <?php if ($num == 0) { ?>
                        <p class="fs-5 text-center">ไม่มีข้อมูล</p>
                    <?php } ?>
                    <p class="fs-5 text-end pe-5 mt-2"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>

                    <?php foreach($query as $row) { $list++ ?>
                        
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card" style="width: 100%;">
                                <?php 
                                $dormPic = $row['dormPic'];
                                $dir = "../../uploads/";
                                $fileImage = $dir . basename($dormPic);
                                ?>
                                <div class="card-body">
                                    <h5>หอพัก <?php echo $list; ?>:  <?php echo $row['dormName']; ?></h5>
                                    <center>
                                    <?php 
                                    if($row['dormPic'] == null){
                                        echo "<img src='/uploads/No_image_available.svg.webp' width='250' height='auto;'>";
                                    } else {
                                        echo "<img class='img-fluid mb-2' src='$fileImage' width='250' height='auto;'>";
                                    }
                                    ?>
                                    </center>
                                    <p class="card-text">เจ้าของ: <span class="text-info"><?php echo $row['land_name']; ?></span> </p>
                                    <p class="card-text">สไตล์: <span class="text-info"><?php echo $row['dormStyle']; ?></span></p>
                                    <p class="card-text">ประเภทหอพัก: <span class="text-info"><?php echo $row['dormType']; ?></span></p>
                                    <p class="card-text">ประเภทผู้อยู่อาศัย: <span class="text-info"><?php echo $row['residentsType']; ?></span></p>
                                    <p class="card-text">สร้างเมื่อ: <span class="text-info"><?php echo $row['createDate']; ?></span></p>
                                    <a href="viewDormApproved.php?dorm_ID=<?php echo $row['dorm_ID']; ?>" class="btn btn-outline-info">ดูเพิ่มเติม</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
