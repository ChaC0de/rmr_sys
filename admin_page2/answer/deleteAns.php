<?php 
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$ans_ID = $_GET['ans_ID'];
$q_ID = $_GET['q_ID'];
$sql = "DELETE FROM tb_answer WHERE ans_ID='$ans_ID' OR q_ID='$q_ID'"; 

$result=mysqli_query($conn,$sql);

if($result){
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("refresh: 0; url=view.php?q_ID=$q_ID'");
}else {
    echo "ลบข้อมูลไม่สำเร็จ";
    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
     exit();
}
mysqli_close($conn)

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
?>