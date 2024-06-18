<?php 
include('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $u_ID['userid'] : header('location:../../login/login.php');

$u_ID = $_GET['u_ID'];
$sql = "DELETE FROM tb_admin WHERE u_ID = '$u_ID'";
$sql2 = "DELETE FROM user WHERE u_ID = '$u_ID'";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));

if ($result && $result2) {
  echo "<script type='text/javascript'>";
  echo "alert('ลบข้อมูลสำเร็จ');";
  echo "window.location = 'admin_list.php'; ";
  echo "</script>";
} else {
  echo "<script type='text/javascript'>";
  echo "alert('ลบข้อมูลไม่สำเร็จ');";
  echo "window.location = 'admin_list.php'; ";
  echo "</script>";
}
mysqli_close($conn)
?>