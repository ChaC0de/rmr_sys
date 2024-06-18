<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$u_ID = $_POST['u_ID'];
$land_name = $_POST['land_name'];
$land_tel = $_POST['land_tel'];
$tax_num = $_POST['tax_num'];
$land_contact = $_POST['land_contact'];
$land_sex = $_POST['land_sex'];
$username = $_POST['username'];

$sql1 = "UPDATE tb_landlord SET land_name='$land_name', land_contact='$land_contact', land_sex='$land_sex',
 land_tel='$land_tel', tax_num='$tax_num' WHERE tb_landlord.u_ID = '$u_ID' ";

$sql2 = "UPDATE user SET username='$username' WHERE user.u_ID = '$u_ID' ";

$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));

if ($result1 && $result2) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ');";
    echo "window.location = 'landList.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
    echo "window.location = 'editLand.php'; ";
    echo "</script>";
}

mysqli_close($conn)
?>