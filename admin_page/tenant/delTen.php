<?php 
include('../../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql1 = "DELETE FROM tb_student WHERE u_ID = '$u_ID'";
$sql2 = "DELETE FROM tb_st_faculty WHERE u_ID = '$u_ID'";
$sql3 = "DELETE FROM user WHERE u_ID = '$u_ID'";
$sql4 = "DELETE FROM `form_answer` WHERE u_ID = '$u_ID'";
$sql5 = "DELETE FROM `tb_result` WHERE my_ID = '$u_ID'";

$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));  
$result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error($conn));
$result4 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4 " . mysqli_error($conn));
$result5 = mysqli_query($conn, $sql5) or die ("Error in query: $sql5 " . mysqli_error($conn));

if ($result1 && $result2 && $result3 && $result4 && $result5) {
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ');";
    echo "window.location = 'tenList.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลไม่สำเร็จ');";
    echo "window.location = 'tenList.php'; ";
    echo "</script>";
  exit();
 }
mysqli_close($conn)
?>