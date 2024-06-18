<?php 
include('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql1 = "DELETE FROM tb_landlord WHERE u_ID = '$u_ID'";
$sql2 = "DELETE FROM user WHERE u_ID = '$u_ID'";

$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));

if ($result1 && $result2) {
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ');";
    echo "window.location = 'landList.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลไม่สำเร็จ');";
    echo "window.location = 'landList.php'; ";
    echo "</script>";
  exit();
 }
mysqli_close($conn)
?>