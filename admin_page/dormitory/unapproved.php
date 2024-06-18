<?php
include('../../connection/conn.php');
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../../login/login.php');

if(isset($_POST['submit'])){

    $sql = "UPDATE `tb_dormitory` SET `status` = '0' WHERE `dorm_ID` = '".$_POST['dorm_ID']."'";
    $query = mysqli_query($conn, $sql);
    if($query){
      echo "<script type='text/javascript'>";
      echo "alert('ถอนการอนุมัติหอพักเรียบร้อยแล้ว');";
      header('Refresh:0; url=showDorm.php');
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "alert('ไม่สามารถถอนการอนุมัติหอพักได้');";
      header('Refresh:0; url=viewDormApproved.php');
      echo "</script>";
    }
  }

?>