<?php
include('../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

foreach ($_POST as $key => $value) {
    if($key != 'form_ID' && $key != 'u_ID'){
        $explodedValue = explode(',', $value);
        if (isset($explodedValue[1])) {
            $sql[] = "('".$_POST['form_ID']."','".$_POST['u_ID']."','".$value."','". $explodedValue[1] ."')";
        } else {
        }
    }
}

$sql = "INSERT INTO `form_answer` (`form_ID`, `u_ID`, `ansValue`, `ans_ID`) VALUES ".implode(',', $sql);
if(mysqli_query($conn, $sql)){
    echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}else{
    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    echo "<script>window.location.href='login.php';</script>";
}

?>
