<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล


$sql = "SELECT * FROM tb_faculty"; 
$query = mysqli_query($conn, $sql)
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">

<title>Register</title>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
</head>
<body>
<br>
<div class="container">
    <div class="row text-start">
    <div class="col-md-6 badge bg-white text-dark mx-auto p-5">
            <img src="../img/logo.png" width="600" alt="">
        </div>
        <div class="col-md-6 badge bg-white text-dark mx-auto p-5">
            <h3 class="text-center">สมัครสมาชิกนักศึกษา</h3>
            <form action="insertregister_st.php" method="POST">
                <br>
                <!-- Hidden fields for user ID and student ID -->
                <input type="hidden" class="form-control" name="u_ID" id="u_ID">
              
                <!-- Username -->
                <div class="mb-3 row mt-3">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                    </div>
                </div>
                <!-- Password -->
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                    </div>
                </div>
                <!-- Confirm Password -->
                <div class="mb-3 row">
                    <label for="confirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="c_password" placeholder="Confirm your password" required>
                    </div>
                </div>
                <!-- Full Name -->
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label">ชื่อ-สกุล</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="st_name" id="st_name" placeholder="Enter firstname - lastname" required>
                        <input type="hidden" class="form-control" name="usertype">
                    </div>
                </div>
                <!-- Phone Number -->
                <div class="mb-3 row">
                    <label for="st_tel" class="col-sm-3 col-form-label">เบอร์โทรศัพท์</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="st_tel" id="st_tel" placeholder="Enter your phone number" required>
                    </div>
                </div>
                <br>
                <!-- Sex -->
                <div class="mb-3 row">
                    <label for="inputsex" class="col-sm-3 col-form-label">เพศสรีระ</label>
                    <div class="col-sm-9">
                        <select id="inputsex" name="st_sex" class="form-select" required>
                            <option value="">กรุณาเลือกเพศสรีระ</option>
                            <option value="เพศชาย">เพศชาย</option>
                            <option value="เพศหญิง">เพศหญิง</option>
                        </select>
                    </div>
                </div>
                <!-- Faculty -->
                <div class="mb-3 row">
                    <label for="inputfaculty" class="col-sm-3 col-form-label">ศึกษาในคณะ</label>
                    <div class="col-sm-9">
                        <select class="form-control w-50" name="faculty_ID" id="faculty_ID" required>
                            <option value="">กรุณาเลือกคณะที่ศึกษา</option>
                            <?php while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $result["faculty_ID"]; ?>"><?php echo $result["faculty"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <!-- Contact (Facebook) -->
                <div class="mb-3 row">
                    <label for="st_contact" class="col-sm-3 col-form-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="st_contact" id="st_contact" placeholder="Enter your contact" required>
                    </div>
                </div>
                <br>
                <!-- Sign Up Button -->
                <div class="col-12">
                    <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                </div>
                <hr>
                <!-- Login Link -->
                <p>เข้าสู่ระบบ <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
<br>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>