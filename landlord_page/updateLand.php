<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$u_ID = $_POST['u_ID'];
$land_name = $_POST['land_name'];
$land_tel = $_POST['land_tel'];
$tax_num = $_POST['tax_num'];
$land_sex = $_POST['land_sex'];
$land_contact = $_POST['land_contact'];
$username = $_POST['username'];

$sql = "UPDATE tb_landlord SET land_name='$land_name', land_contact='$land_contact', land_sex='$land_sex',
land_tel='$land_tel', tax_num='$tax_num' WHERE u_ID='$u_ID'";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

$sql2 = "UPDATE user SET username='$username' WHERE u_ID='$u_ID'";
$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));
if ($result && $result2) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ');";
    header('location:../login/logout.php');

} else {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลไม่สำเร็จ');";
    header('location:../login/logout.php');
    echo "</script>";
}

?>