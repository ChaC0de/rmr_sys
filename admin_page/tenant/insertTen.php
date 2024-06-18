<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');


$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];
$st_tel = $_POST['st_tel'];
$st_sex = $_POST['st_sex'];
$st_contact = $_POST['st_contact'];
$faculty_ID = $_POST['faculty_ID'];
$st_name = $_POST['st_name'];


$password=hash('sha256',$password); // ทำการเข้ารหัส password ด้วย sha256

$sqlMax = "SELECT MAX(u_ID) FROM tb_student";
$resultMax = mysqli_query($conn, $sqlMax);
$rowMax = mysqli_fetch_assoc($resultMax);
$max_u_ID = $rowMax['MAX(u_ID)'];


$u_ID = ($max_u_ID + 1);

$sql1 = "INSERT INTO user (u_ID, username, password, usertype)
VALUES ('$u_ID', '$username', '$password', '3')";

$sql2 = "INSERT INTO tb_student (u_ID, st_name, st_tel, st_contact, st_sex, st_pic)
VALUES ('$u_ID', '$st_name', '$st_tel', '$st_contact', '$st_sex', '../uploads/default.png')";

$sql3 = "INSERT INTO tb_st_faculty (u_ID, faculty_ID) 
VALUES ('$u_ID', '$faculty_ID')";


$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));
$result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error($conn));


if ($result1 && $result2 && $result3) {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    // echo "window.location = 'tenList.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลไม่สำเร็จ');";
    // echo "window.location = 'tenList.php'; ";
    echo "</script>";
}
mysqli_close($conn);
?>