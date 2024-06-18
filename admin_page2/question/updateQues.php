<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$q_ID = $_POST['q_ID'];
$q_text = $_POST['q_text'];
$query = "SELECT * FROM tb_question WHERE q_text = '$q_text'";

$sql = "UPDATE tb_question SET q_text='$q_text' WHERE q_ID='$q_ID'";

if (mysqli_query($conn, $sql)) {
    echo "แก้ไขข้อมูลสำเร็จ";
    header("Location: showtenQues.php");


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    
}
?>