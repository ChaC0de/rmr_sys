<?php 
session_start();
include('../connection/conn.php');
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$checkform = "SELECT ansValue FROM `form_answer` 
INNER JOIN tb_student ON form_answer.u_ID = tb_student.u_ID 
INNER JOIN user ON tb_student.u_ID = user.u_ID
WHERE tb_student.u_ID = '".$_SESSION['u_ID']."'
COLLATE utf8mb4_general_ci"; // Set the appropriate collation
$querycheck = mysqli_query($conn, $checkform);

$resultcheck = mysqli_fetch_assoc($querycheck);
$rowcheck = mysqli_fetch_array($querycheck);
$numcheck = mysqli_num_rows($querycheck);

if($numcheck > 0){
    echo "<script>alert('คุณได้ทำการตอบแบบสอบถามไปแล้ว ตอบใหม่อีกครั้งที่ประวัติการตอบแบบสอบถาม')</script>";
    echo "<script>window.location.href='index_st.php?u_ID = ".$_SESSION['u_ID']."'</script>";
}else{
    echo "<script>alert('ระบบยังไม่มีข้อมูลของคุณ กรุณาตอบคำถามก่อน')</script>";
    echo "<script>window.location.href='answerPage.php?u_ID = ".$_SESSION['u_ID']."'</script>";
}
?>
