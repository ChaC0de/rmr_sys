<?php
include('../../connection/conn.php');  // Connect to the database
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$faculty_ID = $_GET['faculty_ID'];
$faculty = $_GET['faculty'];
$sql = "SELECT * FROM tb_faculty WHERE faculty_ID = '$faculty_ID'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>EDIT</title>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <?php include ('../../_navbar/adminNav.php')?>
      <!-- content -->
      <div class="col-lg-6 col-md-8 mx-auto">
                <div class="row py-lg-5">
                    <div class="text-center">
                        <form action="updFac.php" method="post">
                            <table class="table table-sm">
                                <input type="hidden" value="<?php echo $row["faculty_ID"]?>" name="faculty_ID">
                                <tr>
                                    <th>ชื่อคณะ:</th>
                                    <th><input class="form-control" type="text" name="faculty" value="<?php echo $row["faculty"]?>"></th>
                                    <th>
                                        <button class="btn btn-primary" type="submit">บันทึก</button>
                                        <a href="faculty.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
