<?php 
include('../../connection/conn.php'); 
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$form_ID = $_GET['form_ID'];

$sql = "SELECT * FROM tb_form WHERE form_ID = '$form_ID' ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);

$sql1 = "SELECT * FROM tb_question WHERE q_ID NOT IN (SELECT q_ID FROM form_question WHERE form_ID = '$form_ID')";
$query1 = mysqli_query($conn, $sql1);
$num1 = mysqli_num_rows($query1);

$num2 = 0;

if (!empty($q_ID)) { 
    foreach ($q_ID as $row) {
        $check = "SELECT * FROM form_question INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID 
        WHERE form_question.form_ID = '$form_ID' AND form_question.q_ID = '$row'";
        $query2 = mysqli_query($conn, $check);
        $num2 += mysqli_num_rows($query2);
        $row2 = mysqli_fetch_array($query2);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>View Form</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include ('../../_navbar/adminNav.php')?>
        <!-- Content -->
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>

                <!-- Survey form -->
                <form action="updFormAns.php" method="post">
                    <?php 
                    foreach ($query as $row) { ?>
                        <div class="container fs-5">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <th>
                                            <p class="fs-5 text-start">ชื่อแบบสอบถาม:</p>
                                            <p class="fs-5 text-info"><?php echo $row["form_name"] ?></p>  
                                            <input type="hidden" name="form_ID" value="<?php echo $row["form_ID"] ?>">
                                        </th>
                                        <th>
                                            <p class="fs-5 text-end">สร้างเมื่อ:</p>
                                            <p class="fs-5 text-info text-end"><?php echo $row["created_at"] ?></p>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col"><p class="fs-5 text-start">คำถามที่ยังไม่ถูกเพิ่ม: </p></div>

                            <script>
                                function toggle(source) {
                                    checkboxes = document.getElementsByName('q_ID[]');
                                    for(var i=0, n=checkboxes.length;i<n;i++) {
                                        checkboxes[i].checked = source.checked;
                                    }
                                }
                            </script>

                            <input type="checkbox" class="form-check-input me-1" onClick="toggle(this)" /> เลือกทั้งหมด 
                            <?php 
                            if($num1 > 0){
                                echo $num1;
                            } else {
                                echo "0";
                            }
                            ?> 
                            &nbsp;คำถาม<br/>
                        </div>

                        <?php if ($num1 > 0) { ?>
                            <?php foreach ($query1 as $row1) { ?>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input me-1" type="checkbox" name="q_ID[]" value="<?php echo $row1["q_ID"] ?>">
                                        <label class="form-check-label" for="flexCheckDefault"><?php echo $row1["q_text"] ?>
                                        </label>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <br><br>
                    <center>
                        <button type="submit" class="btn btn-success">เพิ่มคำถาม</button>
                        <a href="viewFormQues.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-danger">ยกเลิก</a>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
