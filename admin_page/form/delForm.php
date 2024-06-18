<?php 
include ('../../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$form_ID = $_GET['form_ID'];
$q_ID = $_GET['q_ID'];

$sql = "DELETE FROM tb_form WHERE form_ID = '$form_ID'";
$query =  mysqli_query($conn, $sql);

$sql2 = "DELETE FROM form_question WHERE form_ID = '$form_ID'";
$query2 =  mysqli_query($conn, $sql2);

$result = mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) or 
die("Error in query: $sql " . mysqli_error($conn) . "Error in query: $sql2 " . mysqli_error($conn));

if($result){
    echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
    header('Refresh:0; url=form.php');
}else{
    echo "<script>alert('ลบข้อมูลไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
    exit(0);
}
?>