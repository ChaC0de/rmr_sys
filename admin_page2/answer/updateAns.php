<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$ans_ID = $_POST['ans_ID'];
$q_ID = $_POST['q_ID'];
$a_text = $_POST['a_text'];
$ansValue = $_POST['ansValue'];

$sql = "UPDATE tb_answer SET q_ID='$q_ID', ans_ID='$ans_ID', a_text='$a_text', ansValue='$ansValue' WHERE ans_ID='$ans_ID'";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

if($result) {
    echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
    header("refresh: 0; url=view.php?q_ID=$q_ID");
} else {
    echo "แก้ไขข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
      exit();
}
mysqli_close($conn);

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
?>