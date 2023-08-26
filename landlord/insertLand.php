<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
$land_ID = $_POST['land_ID'];
$land_name = $_POST['land_name'];
$land_email = $_POST['land_email'];
$land_pass = $_POST['land_pass'];
$land_tel = $_POST['land_tel'];
$tax_num = $_POST['tax_num'];

$check = "SELECT * FROM tb_landlord WHERE land_name = '$land_name'";
$result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result1);
if ($num > 0) {
    echo "<script>";
    echo "alert('มีชื่อเจ้าของหอพักนี้อยู่แล้ว กรุณาใช้ชื่ออื่น');";
    echo "window.location='addLand.php';";
    echo "</script>";
} else {
    $sql1 = "INSERT INTO tb_landlord (land_ID, land_name, land_email, land_pass, land_tel, tax_num) 
    VALUES ('$land_ID', '$land_name', '$land_email', '$land_pass', '$land_tel', '$tax_num')";

   // $sql2 = " INSERT INTO tb_dormitory (land_name) VALUES ('$land_name')";
    //$result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));

    $result1 = mysqli_query($conn, $sql1) or die("Error in query: $sql1 " . mysqli_error($conn));

    mysqli_close($conn);
    if ($result1) {
        echo "<script>";
        echo "alert('เพิ่มข้อมูลเจ้าของหอพักสำเร็จ');";
        echo "window.location='landList.php';";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('เพิ่มข้อมูลเจ้าของหอพักไม่สำเร็จ!');";
        echo "window.location='addLand.php';";
        echo "</script>";
    }
}
?>
