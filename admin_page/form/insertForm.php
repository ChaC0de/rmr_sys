<?php 
include ('../../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$form_name = $_POST['form_name'];
$status = $_POST['status'];

$sql = "INSERT INTO tb_form (form_name, status) VALUES ('$form_name', '$status')";
$query =  mysqli_query($conn, $sql);

if($query){
    echo "<script>alert('สร้างแบบสอบถามสำเร็จ')</script>";
    header('Refresh:0; url=form.php');
}else{
    echo "<script>alert('สร้างแบบสอบถามไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
}
?>