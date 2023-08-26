<?php
include('C:\xampp\htdocs\rmr_sys\connection\conn.php');

$ad_name = $_POST['ad_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$ad_tel = $_POST['ad_tel'];

$check = "SELECT * FROM tb_admin WHERE username = '$username' OR ad_tel = '$ad_tel'";
$result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result1);

if ($num > 0) {
    echo "<script>";
    echo "alert('มีชื่อผู้ใช้ หรือ เบอร์โทรศัพท์ นี้อยู่แล้ว กรุณาสมัครใหม่อีกครั้ง');";
    echo "window.location='admin_list.php';";
    echo "</script>";

} else {
    $sql = "INSERT INTO tb_admin (ad_name, username, password, ad_tel) 
            VALUES ('$ad_name', '$username', '$password', '$ad_tel')";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

    if ($result) {
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
