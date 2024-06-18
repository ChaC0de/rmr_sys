<?php
include('../../connection/conn.php');
session_start();
isset($_SESSION['userid']) ? $_SESSION['userid'] : header('location:../../login/login.php');


$ad_name = $_POST['ad_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$ad_tel = $_POST['ad_tel'];
$adminType = $_POST['adminType'];

$password=hash('sha256',$password);

$sqlMax = "SELECT MAX(CAST(SUBSTRING(u_ID, 3) AS SIGNED)) AS max_u_ID FROM tb_admin";
$resultMax = mysqli_query($conn, $sqlMax);
$rowMax = mysqli_fetch_assoc($resultMax);
$max_u_ID = $rowMax['max_u_ID'];

$u_ID = 'a_' . ($max_u_ID + 1);

$check = "SELECT * FROM tb_admin WHERE username = '$username' OR ad_tel = '$ad_tel'";
$result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result1);

if ($num > 0) {
    echo "<script>";
    echo "alert('มีชื่อผู้ใช้นี้อยู่แล้ว กรุณาสมัครใหม่อีกครั้ง');";
    echo "window.location='admin_list.php';";
    echo "</script>";

} else {
    $sql2 = "INSERT INTO tb_admin (u_ID, ad_name, username, ad_tel, adminType) 
            VALUES ('$u_ID', '$ad_name', '$username', '$ad_tel', '$adminType')";
    $result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));

    $sql3 = "INSERT INTO user (u_ID, username, password, ad_name, usertype)
    VALUES ('$u_ID', '$username', '$password', '$ad_name', '$adminType')";
    $result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3 " . mysqli_error($conn));

    if ($result3 && $result2) {
        echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
        header("Location: admin_list.php");
        exit();
    } else {
        echo "เพิ่มข้อมูลไม่สำเร็จ";
        header("Location: admin_list.php");
        exit();
    }
}

?>
