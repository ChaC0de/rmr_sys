<?php 
include ('../connection/conn.php');

$form_ID = $_POST['form_ID'];
$form_name = $_POST['form_name'];
$status = $_POST['status'];

$sql = "UPDATE tb_form SET form_name = '$form_name', status = '$status' WHERE form_ID = '$form_ID'";
$query =  mysqli_query($conn, $sql);

if($query){
    echo "<script>alert('ปรับปรุงข้อมูลสำเร็จ')</script>";
    header('Refresh:0; url=form.php');
}else{
    echo "<script>alert('ปรับปรุงข้อมูลไม่สำเร็จ กรุณาลองใหม่')</script>";
    header('Refresh:0; url=form.php');
    exit(0);
}
?>