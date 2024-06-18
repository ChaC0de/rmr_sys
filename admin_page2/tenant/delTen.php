<?php 
include('../../connection/conn.php');
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$st_name = $_GET['st_name'];
$sql1 = "DELETE FROM tb_student WHERE u_ID = '$u_ID'";
$sql2 = "DELETE FROM tb_st_faculty WHERE u_ID = '$u_ID'";

$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "ลบข้อมูลสำเร็จ";
    header("Location: ../tenant/tenList.php");
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>