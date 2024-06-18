<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$sql = "SELECT * FROM tb_question ORDER BY q_ID ASC ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );
$list=0;
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Question</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- content -->
        <div class="col-lg-9 mx-auto">
            <div class="row py-lg-5">
                    <h3 class="text-center">จัดการคำถาม คำตอบ</h3>
                    <form>
                            <div class="col d-flex justify-content-end pe-3">
                                <a href="addtenQues.php"><button type="button" class="btn btn-info">เพิ่มคำถาม</button></a>
                            </div>
                        <hr>
                    </form>
                    <p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></p>
                    <table class="table table-hover border border-1"> 
                        <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">คำถาม</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach($query as $row) { 
                            $list++;
                        ?>
                        <tr>
                            <th class="text-center"><?php echo $list; ?></th>
                            <th><?=$row['q_text']?></th>     
                            <!-- เพิ่มเติม -->
                            <td class="text-center">
                                <a href="../answer/view.php?q_ID=<?php echo $row["q_ID"]?>" class="btn btn-info">จัดการคำตอบ</a>
                            </td>
                            <th>
                                <a href="editQues.php?q_ID=<?=$row['q_ID']?>" class="btn btn-primary">แก้ไข</a>
                            </th>
                            <th>
                                <a href="deleteQues.php?q_ID=<?=$row['q_ID']?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่ไหม')">ลบ</a>
                            </th>
                        </tr>
                        <?php } ?>
                    </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
