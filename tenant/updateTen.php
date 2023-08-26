<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
$st_ID = $_POST['st_ID'];
$st_name = $_POST['st_name'];
$st_email = $_POST['st_email'];
$st_pass = $_POST['st_pass'];
$st_tel = $_POST['st_tel'];
$st_contact = $_POST['st_contact'];
$st_sex = $_POST['st_sex'];
$faculty_ID = $_POST['faculty_ID'];



$sql1 = "UPDATE tb_student SET st_name='$st_name', st_email='$st_email', st_pass='$st_pass',
 st_tel='$st_tel', st_contact='$st_contact', st_sex='$st_sex' WHERE st_ID='$st_ID'";

$sql2 = "UPDATE tb_st_faculty SET faculty_ID='$faculty_ID' WHERE st_name='$st_name'";

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "แก้ไขข้อมูลสำเร็จ";
    header("Location: ../tenant/tenList.php");
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>