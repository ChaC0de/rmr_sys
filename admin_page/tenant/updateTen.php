<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$u_ID = $_POST['u_ID'];
$st_name = $_POST['st_name'];
$username = $_POST['username'];
$st_tel = $_POST['st_tel'];
$st_contact = $_POST['st_contact'];
$st_sex = $_POST['st_sex'];
$faculty_ID = $_POST['faculty_ID'];

$sql1 = "UPDATE tb_student SET st_name='$st_name',
 st_tel='$st_tel', st_contact='$st_contact', st_sex='$st_sex' WHERE u_ID='$u_ID'";

$sql2 = "UPDATE tb_st_faculty SET faculty_ID='$faculty_ID' WHERE u_ID='$u_ID'";

$sql3 = "UPDATE user SET username='$username' WHERE u_ID='$u_ID'";


if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ');";
    echo "window.location = 'viewTen.php?u_ID=$u_ID'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
    echo "window.location = 'editTen.php?u_ID=$u_ID'; ";
    echo "</script>";
}

mysqli_close($conn)
?>