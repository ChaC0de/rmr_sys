<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$dorm_ID=$_GET['dorm_ID'];

$sql="DELETE FROM tb_dormitory WHERE dorm_ID='$dorm_ID'"; 
$result=mysqli_query($conn,$sql);

if($result){
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("Location: showDorm.php");
    exit(0);
}else {
    echo "ลบข้อมูลไม่สำเร็จ";
    echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล: " . mysqli_error($conn);
     exit();
}

?>