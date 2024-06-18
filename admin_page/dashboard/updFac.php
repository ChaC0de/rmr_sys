<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$faculty_ID = $_POST['faculty_ID'];
$faculty = $_POST['faculty'];
$check = "SELECT * FROM tb_faculty WHERE faculty = '$faculty'";
$result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result1);
if ($num > 0) {
    echo "<script>";
    echo "alert('มีชื่อคณะนี้อยู่แล้ว ไม่สามารถใช้ได้');";
    echo "window.location='../faculty.php';";
    echo "</script>";
} else {
    $sql = "UPDATE tb_faculty SET faculty ='$faculty' WHERE faculty_ID='$faculty_ID'";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        echo "window.location = 'faculty.php'; ";
        echo "</script>";        
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
        echo "window.location = 'faculty.php'; ";
        echo "</script>";
        echo mysqli_error($conn);
        exit();
    }
    mysqli_close($conn);
}
?>