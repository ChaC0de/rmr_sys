<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$form_ID = $_GET['form_ID'];
$sql = "SELECT * FROM tb_form WHERE form_ID = '$form_ID' order by form_ID asc";
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
    <title>Questen</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include ('../../_navbar/adminNav2.php') ?>
            <!-- Content -->
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="row py-lg-5">
                    <br>
                    <div class="container text-center">
                        <p class="fs-3">ปรับปรุงชุดคำถาม</p><br><br>
                        <form action="updateForm.php" method="post">
                            <div class="row">
                                <div class="col d-flex justify-content-start pe-3">
                                    <input type="hidden" class="form-control" name="form_ID" value="<?php echo $row["form_ID"] ?>" readonly>
                                    <p class="fs-5">ชื่อแบบสอบถาม</p>
                                    <input type="text" class="form-control" name="form_name" value="<?php echo $row["form_name"] ?>">
                                </div>
                                <div class="col-3 d-flex justify-content-end pe-3">
                                    <select name="status" class="form-select">
                                        <option value="1" <?php if($row["status"] == 1){echo "selected";} ?>>เปิดใช้งาน</option>
                                        <option value="0" <?php if($row["status"] == 0){echo "selected";} ?>>ปิดใช้งาน</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-success justify-content-center">บันทึก</button>
                            <a href="../form.php" class="btn btn-danger" onclick="return confirm('คุณต้องการยกเลิกใช่ไหม')">ยกเลิก</a>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
