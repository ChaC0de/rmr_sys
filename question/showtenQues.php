<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Question</title>
</head>
<body>
<br>
<br>

<div class="container">
    <h3 class="text-center">จัดการคำถาม คำตอบ</h3>
    <form>
    <div class="row">
    <div class="col align-self-end d-flex justify-content-end pe-3">
    <a href="addtenQues.php"><button type="button" class="btn btn-info ">เพิ่มคำถาม</button></a>
    </div>
</div>
<hr>
    </form>
    <th><p class="fs-5 text-end pe-5"><?php echo "ผลลัพธ์ทั้งหมด $num รายการ"; ?></th></p>
    <table class="table table-hover border border-1"> 
        <tr>
            <th class="text-center">ลำดับ</th>
            <th class="text-center">คำถาม</th>
            <th></th>
            <th></th>
            <th></th>
            
        </tr>
        </div>
        <?php foreach($query as $row) { 
            $list++;
 ?>
            

    <tr>
        <th class="text-center"><?php echo $list; ?></th>
        <th><?=$row['q_text']?></th>     

        <!-- เพิ่มเติม -->
        <td class="text-center"> <a href="../answer/view.php?q_ID= <?php echo $row["q_ID"]?>" class="btn btn-info">จัดการคำตอบ</a></td>
        </td>
        <th><a href="editQues.php?q_ID=<?=$row['q_ID']?>"class="btn btn-primary">แก้ไข</a></th>
        <th><a href="deleteQues.php?q_ID=<?=$row['q_ID']?>"class="btn btn-danger" onclick="return confirm('คุณต้องการลบใช่ไหม')">ลบ</a></th>
    </tr>
    <?php } ?>
    
    </table>
    </div>
</div><br><br>





    
</div>

<script src="../js/bootstrap.min.js"></script>
</body>
</html>
