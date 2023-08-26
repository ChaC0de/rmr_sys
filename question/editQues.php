<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$q_ID = $_GET['q_ID'];

$sql = "SELECT * FROM tb_question WHERE q_ID = '$q_ID'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>edit question</title>
</head>
<body> 
<div class="container">
    <br>
        <center><h4>แก้ไขคำถาม</h4></center>
        <br>
        <form action="updateQues.php" method="post">
            <div class="col-md-6 ">
            <label for="q_text" class="form-label">คำถาม</label>
            <input type="hidden" value="<?php echo $row["q_ID"]?>" name="q_ID">
            <input type="text" class="form-control" name="q_text" value="<?php echo $row["q_text"]?>">
            </div><br>
            <!--<div class="col form-check col-md-6">
              <input class="form-check-input" type="radio"  name="q_text" id="q_text">
              <label class="form-check-label" for="q_text"></label> 
              <input type="text" class="form-control" name="q_text" id="q_text">
            </div><br>
            <div class="col form-check col-md-6">
              <input class="form-check-input" type="radio" name="q_text" id="q_text">
              <label class="form-check-label" for="q_text"></label>
              <input type="text" class="form-control" name="q_text" id="q_text"> 
            </div><br>
            <div class="col form-check col-md-6">
              <input class="form-check-input" type="radio"  name="q_text" id="q_text">
              <label class="form-check-label" for="q_text"></label>
              <input type="text" class="form-control" name="q_text" id="q_text"> 
            </div><br>
            <div class="col form-check col-md-6">
              <input class="form-check-input" type="radio" name="q_text" id="q_text">
              <label class="form-check-label" for="q_text"></label>
              <input type="text" class="form-control" name="q_text" id="q_text"> 
            </div><br>
            <div class="col form-check col-md-6">
              <input class="form-check-input" type="radio"  name="q_text" id="q_text">
              <label class="form-check-label" for="q_text"></label>
              <input type="text" class="form-control" name="q_text" id="q_text"> 
            </div>-->  
            <br><br>
        <button type="cancel" class="btn btn-danger onclick="javascript:window.location='showtenQues.php'>ยกเลิก</button>
        <button type="submit" class="btn btn-success";>บันทึก</button>
        
        </form>
</div>
    
<script src="../js/bootstrap.min.js"></script>
</body>
</html>