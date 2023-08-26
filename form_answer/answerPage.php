<?php
include('../connection/conn.php');
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$sql = "SELECT * FROM `form_question` INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID
INNER JOIN tb_form ON form_question.form_ID = tb_form.form_ID
 WHERE tb_form.status = '1'";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
$row = mysqli_fetch_array($query);
$list = 0;

$sql1 = "SELECT * FROM `tb_student` ";
$query1 = mysqli_query($conn,$sql1);
$result1 = mysqli_fetch_assoc($query1);
$row1 = mysqli_fetch_array($query1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Answer Page</title>
</head>
<body>
    <div class="container px-5">            
        <form action="insertAnswer.php" method="post">
        <div class="row">
            <div class="col-12 mt-5">
                <br>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="fs-4 fw-bold">เลือกผู้ตอบแบบสอบถาม</p>
                </div>
                <br>
                <br>
                <div class="col-12">
                    <select name="st_ID" id="st_ID" class="form-select" required>
                        <option value="">กรุณาเลือกผู้ตอบแบบสอบถาม</option>
                        <?php foreach($query1 as $row1){ ?>
                        <option value="<?php echo $row1['st_ID'] ?>"><?php echo $row1['st_ID'] ?> <?php echo $row1['st_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
               <p class="fs-4 fw-bold text-info"><?php echo $row['form_name'] ?></p>
               <input type="hidden" name="form_ID" class="form-control" value="
               <?php echo $row['form_ID'] ?>" readonly>
            </div>
            <br>
            <br>
            <hr>

            <div class="row">
                <?php foreach($query as $row){
                    $list++; ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 px-3">
                            <br>
                            <p class="fs-4 fw-bold"><?php echo $list ?>.<?php echo $row['q_text'] ?>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php
                                $sql2 = "SELECT * FROM `tb_answer` WHERE q_ID = '".$row['q_ID']."' ";
                                $query2 = mysqli_query($conn,$sql2);
                                $result2 = mysqli_fetch_assoc($query2);
                                $row2 = mysqli_fetch_array($query2);
                                 ?>
                                <?php foreach($query2 as $row2){ ?>
                                <div class="col-12">
                                    <div class="row ">
                                        <div class="col-12 px-5">
                                        <p class="fs-5"><input type="radio" class="form-check-input" name="q_ID_<?php echo $row['q_ID']?>" 
                                        value="<?php echo $row2['ansValue'] . ',' . $row2['ans_ID'];?>" required><?php echo $row2['a_text'] ?>
                                    </p>
                                        </div>
                                    </div>
                            </div>
                            <br>
                            <br>
                            <?php } ?>
                        </div>
                        <hr>
                        <br>
                        
                    </div>

            </div>
            <?php } ?>
        </div>
    <center>
        <button type="submit" class="btn btn-success">
            ส่งคำตอบ
        </button>
        <a href="../form/form.php" class="btn btn-danger">ออก</a>
    </center>
                                  
        <br>
        <br>
    </form>      
    </div>


    
<script src="../js/bootstrap.min.js"></script>
</body>
</html>