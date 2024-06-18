<?php 
include ('../../connection/conn.php'); 
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$form_ID = $_GET['form_ID'];
$sql = "SELECT * FROM tb_form WHERE form_ID = '$form_ID' ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );

$sql2 = "SELECT * FROM form_question WHERE form_ID = '$form_ID' ";
$query2 = mysqli_query($conn, $sql2);
$num2 = mysqli_num_rows( $query2 );
$row = mysqli_fetch_array($query2);

$list = 0;


$sql3 = "SELECT * FROM form_question INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID WHERE form_question.form_ID = '$form_ID' ORDER BY `form_question`.`q_ID` ASC ";
$query3 = mysqli_query($conn, $sql3);
$num3 = mysqli_num_rows( $query3 );

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
        <?php include ('../../_navbar/adminNav2.php') ?>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 mx-auto">
            <div class="row py-lg-5">
                <br>

                <!-- Survey form -->
                <form action="updateForm.php" method="post">
                    <?php foreach ($query as $row) { ?>
                        <div class="container">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <th>
                                            <p class="fs-5 text-start">ชื่อแบบสอบถาม:</p>
                                            <input type="text" name="form_name" class="form-control" value="<?php echo $row["form_name"] ?>">
                                            <input type="hidden" name="form_ID" value="<?php echo $row["form_ID"] ?>">
                                        </th>
                                        <th>
                                            <p class="fs-5 text-end">สร้างเมื่อ:</p>
                                            <p class="fs-5 text-info text-end"><?php echo $row["created_at"] ?></p>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <table>
                            <tr>
                                <td>
                                    <div class="col">
                                        <p class="fs-5 text-start">คำถาม: 
                                            <?php 
                                            if ($num3 > 0) {
                                                echo $num3;
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </td>
                                <td class="d-flex justify-content-end">
                                    <p class="fs-5">สถานะ:</p>
                                </td>
                                <td class="d-flex justify-content-end">
                                    <div class="col-3">
                                        <select name="status" class="form-select">
                                            <option value="1" <?php if($row["status"] == 1) { echo "selected"; } ?>>เปิดใช้งาน</option>
                                            <option value="0" <?php if($row["status"] == 0) { echo "selected"; } ?>>ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-end pt-5">
                                    <a href="addFormQues.php?form_ID=<?php echo $row['form_ID']; ?>" class="btn btn-warning col-2">ปรับปรุงคำถาม</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th>คำถาม</th>
                                        <th></th>
                                    </tr>
                                    <!-- Display questions -->
                                    <?php foreach ($query2 as $row2) { $list++ ?>
                                        <tr>
                                            <td class="text-center"><?php echo $list ?></td>
                                            <td>
                                                <p class="fs-5">
                                                    <?php foreach ($query3 as $row3) { ?>
                                                        <?php if ($row2["q_ID"] == $row3["q_ID"]) { ?>
                                                            <?php echo $row3["q_text"] ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </p>
                                            </td>
                                            <td>
                                                <a href="displayAns.php?form_ID=<?php echo $row2["form_ID"] ?>&q_ID=<?php echo $row2["q_ID"] ?>" class="btn btn-primary">ดูคำตอบ</a>
                                                <!-- Delete question -->
                                                <a href="delFormQues.php?form_ID=<?php echo $row2["form_ID"] ?>&q_ID=<?php echo $row2["q_ID"] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล จะไม่สามารถเปลี่ยนแปลงได้')">ลบ</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if ($num2 == 0) { ?>
                                        <tr>
                                            <td colspan="3"><p class="fs-5 text-center">ไม่มีคำถาม</p></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <center>
                                    <button type="submit" class="btn btn-primary">
                                        บันทึก
                                    </button>
                                    <a href="form.php" class="btn btn-secondary">ยกเลิก</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
      <!-- end survey form -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>