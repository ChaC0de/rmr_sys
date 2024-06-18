<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$q_ID = $_POST['q_ID'];
$q_text = $_POST['q_text'];

mysqli_query($conn, "INSERT INTO tb_question (q_ID, q_text) 
VALUES ('$q_ID', '$q_text')");

if(mysqli_affected_rows($conn) > 0) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    header("Location: showtenQues.php");
} else {
    echo "เพิ่มข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
}
mysqli_close($conn);
?>