<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$q_ID = $_GET['q_ID'];
$sql = "DELETE FROM tb_question WHERE q_ID = '$q_ID'";
$result=mysqli_query($conn,$sql); //เก็บค่าที่ได้จากการทำงานของคำสั่ง sql ไว้ในตัวแปร $result โดยเชื่อมต่อกับฐานข้อมูลด้วย $conn

if($result){
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("Location: showtenQues.php");
    exit(0);
}else {
    echo "ลบข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
}
?>