<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

// $land_name = $_POST['land_name'];
print_r($_POST); // ดูข้อมูลทั้งหมดที่ส่งมาจากฟอร์ม
$dorm_ID=$_POST['dorm_ID'];
$dormName=$_POST['dormName'];
$dormPrice=$_POST['dormPrice'];
$deposit=$_POST['deposit'];
$address=$_POST['address'];
$room=$_POST['room'];
$dormType=$_POST['dormType'];
$dormStyle=$_POST['dormStyle'];
$residentsType=$_POST['residentsType'];

isset($service1)? $service1=$_POST['service1'] : $service1="";
isset($service2)? $service2=$_POST['service2'] : $service2="";
isset($service3)? $service3=$_POST['service3'] : $service3="";
isset($service4)? $service4=$_POST['service4'] : $service4="";  
isset($service5)? $service5=$_POST['service5'] : $service5="";
isset($service6)? $service6=$_POST['service6'] : $service6="";
isset($service7)? $service7=$_POST['service7'] : $service7="";
isset($service8)? $service8=$_POST['service8'] : $service8="";
isset($service9)? $service9=$_POST['service9'] : $service9="";
isset($service10)? $service10=$_POST['service10'] : $service10="";
isset($service11)? $service11=$_POST['service11'] : $service11="";

$service1 = isset($_POST['service1']) ? 1 : 0;
$service2 = isset($_POST['service2']) ? 1 : 0;
$service3 = isset($_POST['service3']) ? 1 : 0;
$service4 = isset($_POST['service4']) ? 1 : 0;
$service5 = isset($_POST['service5']) ? 1 : 0;
$service6 = isset($_POST['service6']) ? 1 : 0;
$service7 = isset($_POST['service7']) ? 1 : 0;
$service8 = isset($_POST['service8']) ? 1 : 0;
$service9 = isset($_POST['service9']) ? 1 : 0;
$service10 = isset($_POST['service10']) ? 1 : 0;
$service11 = isset($_POST['service11']) ? 1 : 0;


$sql = "UPDATE tb_dormitory SET dormName='$dormName',  dormPrice='$dormPrice', deposit='$deposit', 
address='$address', room='$room', dormType='$dormType', dormStyle='$dormStyle', residentsType='$residentsType', service1='$service1', service2='$service2', service3='$service3', service4='$service4', service5='$service5',
 service6='$service6', service7='$service7', service8='$service8', service9='$service9', service10='$service10', 
 service11='$service11'
WHERE dorm_ID='$dorm_ID'";

$query=mysqli_query($conn,$sql);

if(mysqli_affected_rows($conn) > 0) {
    echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
    header("Location: viewDorm.php?u_ID=".$u_ID."&dorm_ID=".$dorm_ID."");
} else {
    echo "แก้ไขข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
    exit();
}
?>