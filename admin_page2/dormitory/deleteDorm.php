<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$dorm_id=$_GET['dorm_ID'];

$sql="DELETE FROM tb_dormitory WHERE dorm_ID='$dorm_id'"; //ลบข้อมูลจากตาราง tb_dormitory โดยใช้คำสั่ง DELETE จากข้อมูลที่มี dorm_ID ตรงกับ $dorm_id
$result=mysqli_query($conn,$sql); //เก็บค่าที่ได้จากการทำงานของคำสั่ง sql ไว้ในตัวแปร $result โดยเชื่อมต่อกับฐานข้อมูลด้วย $conn

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