<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');


isset($_POST['u_ID']) ? $u_ID = $_POST['u_ID'] : $u_ID = '';
isset($_POST['ad_name']) ? $ad_name = $_POST['ad_name'] : $ad_name = '';
isset($_POST['ad_tel']) ? $ad_tel = $_POST['ad_tel'] : $ad_tel = '';
isset($_POST['username']) ? $username = $_POST['username'] : $username = '';

$sql1 = "UPDATE tb_admin SET ad_name = '$ad_name',username = '$username', ad_tel = '$ad_tel' WHERE u_ID = '$u_ID' ";
$sql2 = "UPDATE user SET username = '$username' WHERE u_ID = '" . $_SESSION['u_ID'] . "' ";

$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));


if ($result1 && $result2) {
  echo "<script type='text/javascript'>";
  echo "alert('แก้ไขข้อมูลสำเร็จ');";
  echo "window.location = 'profile_admin.php?u_ID=$u_ID'; ";
  echo "</script>";
} else {
  echo "<script type='text/javascript'>";
  echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
  echo "window.location = 'profile_admin.php?u_ID=$u_ID'; ";
  echo "</script>";
}

mysqli_close($conn)




?>