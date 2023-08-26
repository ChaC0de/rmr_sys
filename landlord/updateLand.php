<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล

$land_ID = $_POST['land_ID'];
$land_name = $_POST['land_name'];
$land_email = $_POST['land_email'];
$land_pass = $_POST['land_pass'];
$land_tel = $_POST['land_tel'];
$tax_num = $_POST['tax_num'];

$sql = "UPDATE tb_landlord SET land_ID='$land_ID', land_name='$land_name', land_email='$land_email', land_pass='$land_pass',
 land_tel='$land_tel', tax_num='$tax_num' WHERE land_ID='$land_ID'";

$query=mysqli_query($conn,$sql);

if(mysqli_affected_rows($conn) > 0) {
    echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
    header("Location: landList.php");
} else {
    echo "แก้ไขข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>