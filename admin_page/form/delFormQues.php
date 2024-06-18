<?php
include ('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

$form_ID = $_GET['form_ID'];
$q_ID = $_GET['q_ID'];

$sql = "DELETE FROM form_question WHERE form_ID = '$form_ID' AND q_ID = '$q_ID'";
$query = mysqli_query($conn, $sql);

if($query){
    echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
    header('Refresh:0; url=viewFormQues.php?form_ID='.$_GET['form_ID'].'');
}else{
    echo "<script>alert('ลบข้อมูลไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
    exit(0);
}
mysqli_close($conn)
?>