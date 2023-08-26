<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$q_ID = $_GET['q_ID'];
$sql = "SELECT * FROM tb_question WHERE q_ID = '$q_ID' ";
$sql2 = "SELECT * FROM tb_answer WHERE q_ID = '$q_ID' ";

$query = mysqli_query($conn, $sql);
$query2 = mysqli_query($conn, $sql2);

$num = mysqli_num_rows( $query );
$num2 = mysqli_num_rows( $query2 );

$list=0;
$list1=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Questen</title>
</head>
<body>
<br>
<?php foreach($query as $row) { ?>
<div class="container">
    <br>
    <p class="fs-4"> คำถาม :</p> <input type="text" class="text form-control" name="q_text" value="<?php echo $row["q_text"]?>" readonly>

    <?php } ?>


    <br>
    <br>
    <hr>

    <table class="table border border-1">
      <tr>
        <th style="width:40%;">
          คำตอบ
        </th>
        <th style="width:8%;">
          คะแนน
        </th>
        <th style="width:8%;"></th>
        <th style="width:10%;"></th>
        <th style="width:10%;"></th>
      </tr>
    <?php foreach($query2 as $row) { ?>
    <br>
  <form action="updateAns.php" method="post">
      <tr>
        <th>
        <input type="hidden" class="text form-control" name="q_ID" value="<?php echo $row["q_ID"]?>">

          <input type="text" class="text form-control" name="a_text" value="<?php echo $row["a_text"]?>">
        </th>
        <th>
          <input type="text" class="text form-control text-center" name="ansValue" value="<?php echo $row["ansValue"]?>">
        </th>
        <th>          
          <input type="hidden" class="text form-control text-center" name="ans_ID" value="<?php echo $row["ans_ID"]?>" readonly>
        </th>
        
        <th class="d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">บันทึก</button>
        </th>
        <th>
          <a href="deleteAns.php?ans_ID=
            <?php echo $row['ans_ID']?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
        </th>
        </form>
      </tr>
      <?php } ?>
    </table>
    <br>
    <div class="row">
    <form action="insertAns.php" method="post">
                <table class="table table-borderless d-flex justify-content-center">
                    
                    <tr>
                        <input type="hidden" name="ans_ID" id="ans_ID"><br>
                        <input type="hidden" name="q_ID" id="q_ID" value="<?php echo $q_ID; ?>"><br>
                        <th><label for="q_text"> คำตอบ: </label></th>
                      <th><input class="form-control" type="text" name="a_text" id="a_text" required></th>
                    </tr>
                    <tr>
                        <th><label for="ansValue"> คะแนน: </label></th>
                      <th><input class="form-control" type="text" name="ansValue" id="ansValue" required></th>
                    </tr>
                    <tr class="d-flex justify-content-center">
                      <th><button class="btn btn-primary" type="submit">เพิ่มตัวเลือก</button>
                      <button class="btn btn-info" type="reset" value="Reset">ล้าง</button>
                      <a href="../question/showtenQues.php" class="btn btn-danger ">กลับ</a>
                    </tr>
                  
                </th>
            </table>

</form>
</div>


</div><br><br>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
