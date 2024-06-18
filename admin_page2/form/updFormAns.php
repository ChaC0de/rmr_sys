<?php
include('../../connection/conn.php');
session_start(); 
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

$q_ID = $_POST['q_ID'];
$form_ID = $_POST['form_ID'];

foreach ($q_ID as $row) {

    $check = "SELECT * FROM form_question WHERE form_ID = '$form_ID' AND q_ID = '$row' ";
    $query1 = mysqli_query($conn, $check);
    $num = mysqli_num_rows( $query1 );

    if($num < 1){
        $sql = "INSERT INTO form_question (form_ID, q_ID) VALUES ('$form_ID', '$row')";
        $query =  mysqli_query($conn, $sql);

    }else{
        $sql = "UPDATE form_question SET form_ID = '$form_ID', q_ID = '$row' WHERE form_ID = '$form_ID' AND q_ID = '$row'";
        $query =  mysqli_query($conn, $sql);
    }
}

if($query){
    echo "<script>alert('เพิ่มข้อมูลสำเร็จ')</script>";
    header('Refresh:0; url=viewFormQues.php?form_ID='.$form_ID.'');
}else{
    echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
}

?>