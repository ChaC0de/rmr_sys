<?php
include('../../connection/conn.php');
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

if(isset($_POST['submit'])){
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $sql = "UPDATE `tb_dormitory` SET `status` = '1' WHERE `dorm_ID` = '".$_POST['dorm_ID']."'";
    $query = mysqli_query($conn, $sql);
    if($query){
      echo "<script type='text/javascript'>";
      echo "alert('อนุมัติหอพักเรียบร้อยแล้ว');";
      header('Refresh:0; url=dorm_approval.php');
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "alert('ไม่สามารถอนุมัติหอพักได้');";
      header('Refresh:0; url=approval.php');
      echo "</script>";
    }
  }

?>