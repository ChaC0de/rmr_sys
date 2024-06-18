<?php 
include ('../../connection/conn.php');
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$form_ID = $_POST['form_ID'];
$q_ID = $_POST['q_ID'];

foreach ($q_ID as $row) {
    
    $sql = "INSERT INTO form_question (form_ID, q_ID) VALUES ('$form_ID.', '$row')";
    
    $query =  mysqli_query($conn, $sql);
}

if($query){
    echo "<script>alert('เพิ่มข้อมูลสำเร็จ')</script>";
    header('Refresh:0; url=viewFormQues.php?form_ID='.$form_ID.'');
}else{
    echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
}
?>