<?php
include('../../connection/conn.php');  // Connect to the database
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$q_ID = $_GET['q_ID'];
$sql = "SELECT * FROM tb_question WHERE q_ID = '$q_ID' ";
$sql2 = "SELECT * FROM tb_answer WHERE q_ID = '$q_ID' ";

$query = mysqli_query($conn, $sql);
$query2 = mysqli_query($conn, $sql2);

$num = mysqli_num_rows($query);
$num2 = mysqli_num_rows($query2);

$list = 0;
$list1 = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Questen</title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <?php include('../../_navbar/adminNav2.php')?>
      <!-- content -->
      <div class="col-lg-9 col-md-8 mx-auto">
                <div class="row py-lg-5">
                    <br>
                    <?php foreach($query as $row) { ?>
                    <div class="container">
                        <br>
                        <p class="fs-4"> คำถาม :</p> <input type="text" class="text form-control" name="q_text" value="<?php echo $row["q_text"]?>" readonly>
                    <?php } ?>
                    <br><br>
                    <hr>
                    <table class="row py-lg-5 table border border-1">
                        <tr>
                            <th style="width:40%;">คำตอบ</th>
                            <th style="width:8%;">คะแนน</th>
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
                                    <a href="deleteAns.php?ans_ID=<?php echo $row['ans_ID']?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล')">ลบ</a>
                                </th>
                            </tr>
                        </form>
                        <?php } ?>
                    </table>
                    <br>
                    <div class="row col-md-8 mx-auto">
                        <form action="insertAns.php" method="post">
                            <div class="col">
                            <input type="hidden" name="ans_ID" id="ans_ID"><br>
                                    <input type="hidden" name="q_ID" id="q_ID" value="<?php echo $q_ID; ?>"><br>
                                   คำตอบ:
                                    <input class="form-control" type="text" name="a_text" id="a_text" required>
                            </div>

                            <div class="col mt-3">
                                คะแนน:
                                <input class="form-control" type="text" name="ansValue" id="ansValue" required>
                            </div>
                            <div class="col-4 mx-auto mt-3">
                                <button class="btn btn-primary" type="submit">เพิ่มตัวเลือก</button>
                                <button class="btn btn-info" type="reset" value="Reset">ล้าง</button>
                                <a href="../question/showtenQues.php" class="btn btn-danger">กลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
