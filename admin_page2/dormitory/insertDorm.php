<?php
include('../../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

if(isset($_POST['submit'])){

    $check = getimagesize($_FILES["dormPic"]["tmp_name"]);

    if($check) {
        $dir = "../../uploads/";
        $allowTypes = array('jpg','png','jpeg','gif'); // ประเภทไฟล์ที่อนุญาต
        $fileImage = $dir . basename($_FILES["dormPic"]["name"]);
    
        if(move_uploaded_file($_FILES["dormPic"]["tmp_name"], $fileImage)){
            echo "ไฟล์ภาพชื่อ ". basename( $_FILES["dormPic"]["name"]). " อัพโหลดเสร็จสิ้น";
        }else{
            echo "ไม่สามารถอัพโหลดไฟล์ภาพได้";
        }
    } else {
        echo "<script> alert('ไม่ใช่ไฟล์รูปภาพ โปรดอัพโหลดไฟล์รูปภาพ') </script>";
        echo "<script> window.location.href='addDorm.php' </script>";
    }


    isset ($_POST['dorm_ID']) ? $dorm_ID = $_POST['dorm_ID'] : $dorm_ID = '';
    $u_ID=$_POST['u_ID'];
    $dormName=$_POST['dormName'];
    $dormPrice=$_POST['dormPrice'];
    $dormPic=$_FILES["dormPic"]["name"];
    $deposit=$_POST['deposit'];
    $address=$_POST['address'];
    $room=$_POST['room'];
    $dormType=$_POST['dormType'];
    $dormStyle=$_POST['dormStyle'];
    $residentsType=$_POST['residentsType'];

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


    $sql = "INSERT INTO tb_dormitory (u_ID, dormName, dormPrice, dormPic, deposit, address, room, dormType, dormStyle, residentsType,
    service1, service2, service3, service4, service5, service6, service7, service8, service9, service10, service11, status)
    VALUES ('$u_ID','$dormName','$dormPrice', '$dormPic', '$deposit','$address','$room','$dormType','$dormStyle','$residentsType',
    '$service1', '$service2', '$service3', '$service4', '$service5', '$service6', '$service7', '$service8', '$service9', '$service10', '$service11', '0')";
    $query=mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn) > 0) {
        echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
        header("Location: showDorm.php");
    } else {
        echo "เพิ่มข้อมูลไม่สำเร็จ";
        echo mysqli_error($conn);
        exit();
    }
}
mysqli_close($conn);
?>