<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$username = $_POST['username'];
$password = $_POST['password'];
$land_name = $_POST['land_name'];
$land_tel = $_POST['land_tel'];
$tax_num = $_POST['tax_num'];
$land_contact = $_POST['land_contact'];
$land_sex = $_POST['land_sex'];

$password=hash('sha256',$password); // ทำการเข้ารหัส password ด้วย sha256

$sqlMax = "SELECT MAX(CAST(SUBSTRING(u_ID, 3) AS SIGNED)) AS max_u_ID FROM tb_landlord";
$resultMax = mysqli_query($conn, $sqlMax);
$rowMax = mysqli_fetch_assoc($resultMax);
$max_u_ID = $rowMax['max_u_ID'];

$u_ID = 'l_' . ($max_u_ID + 1);

$sql3 = "SELECT * FROM user WHERE username = '$username'
        OR password = '$password'"; 
$result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error($conn));
$num3 = mysqli_num_rows($result3);

if($num3 > 0) {
    echo "<script type='text/javascript'>";
    echo "alert('มีผู้ใช้นี้อยู่แล้ว ไม่สามารถเพิ่มได้');";
    header ('Refresh:0; url=addLand.php');
    echo "</script>";
    exit();
}
$sql1 = "INSERT INTO user (u_ID, username, password, userType)
value ('$u_ID', '$username', '$password', '2')";

$sql2 = "INSERT INTO tb_landlord (u_ID, land_name, land_tel, tax_num, land_sex, land_contact, land_pic)
Values ('$u_ID', '$land_name', '$land_tel', '$tax_num', '$land_sex', '$land_contact', '../uploads/default.png')";

$result = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'landList.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลไม่สำเร็จ');";
    echo "window.location = 'landList.php';";
    echo "</script>";
}

mysqli_close($conn);
?>