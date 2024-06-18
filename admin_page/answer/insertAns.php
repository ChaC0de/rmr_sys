<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$ans_ID = $_POST['ans_ID'];
$q_ID = $_POST['q_ID'];
$ansValue = $_POST['ansValue'];
$a_text = $_POST['a_text'];

mysqli_query($conn, "INSERT INTO tb_answer (ans_ID, q_ID, a_text, ansValue) 
VALUES ('$ans_ID', '$q_ID', '$a_text', '$ansValue')");

if(mysqli_affected_rows($conn) > 0) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    header("refresh: 0; url=view.php?q_ID=$q_ID");
} else {
    echo "เพิ่มข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
    exit(0);
}
mysqli_close($conn);
?>