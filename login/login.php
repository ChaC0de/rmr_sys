<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>
<style>
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: left;
            height: 90vh;
            
        }
</style>
<body>
    <br>
    <div class="container justify-center">
    <div class="row" style>
        <div class="col-md-4 badge bg-dark text-light">
            <h1>Login</h1>
            <form action="checklogin.php" method="POST"> 
                <br>
                <div class="col-12">
                    <input type="text" name="username" class="form-control" required placeholder="Username">
                </div><br>
                <div class="col-12">
                    <input type="password" name="password" class="form-control" required placeholder="Password">
                </div>
                <br>
                <?php
                if(isset($_SESSION['error'])){ 
                    echo "<div class='text-danger'>";
                    echo $_SESSION['error'];
                    echo "</div>";
                }
                ?>
                <br><br>
                <div class="col-12">
                    <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
                </div>
                <hr>
                <p class="fs-6 mt-3">สมัครสมาชิก "เจ้าของหอพัก" <a href="register_land.php">Sign Up</a></p>
                <p class="fs-6">สมัครสมาชิก "นักศึกษา" <a href="register_st.php">Sign Up</a></p>

            </form>
        </div>
    </div>
</div>
</body>
</html>