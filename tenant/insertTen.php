<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$ten_fac_ID = $_POST['ten_fac_ID'];
$st_ID = $_POST['st_ID'];
$st_name = $_POST['st_name'];
$st_email = $_POST['st_email'];
$st_pass = $_POST['st_pass'];
$st_tel = $_POST['st_tel'];
$st_contact = $_POST['st_contact'];
$st_sex = $_POST['st_sex'];
$faculty_ID = $_POST['faculty_ID'];

$check = "SELECT * FROM tb_student WHERE st_name = '$st_name'";
$result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result1);
if ($num > 0) {
    echo "<script>";
    echo "alert('มีชื่อนี้อยู่แล้ว ไม่สามารถใช้ได้');";
    echo "window.location='addTen.php';";
    echo "</script>";
} else {

$sql1 = "INSERT INTO tb_student(st_ID, st_name, st_email, st_pass, st_tel, st_contact, st_sex) VALUES
('$st_ID', '$st_name', '$st_email', '$st_pass', '$st_tel', '$st_contact', '$st_sex')";
$query1 = mysqli_query($conn, $sql1);

$sql2 = "INSERT INTO tb_st_faculty (st_name, faculty_ID) VALUES ('$st_name', '$faculty_ID')";
$query2 = mysqli_query($conn, $sql2);

if($query1 && $query2) {
    echo "<script>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location='tenList.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('เพิ่มข้อมูลไม่สำเร็จ');";
    echo "window.location='addTen.php';";
    echo "</script>";
}
}
?>

