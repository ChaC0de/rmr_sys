<?php
include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล

$admin_ID = $_POST['admin_ID'];
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

    exit();
  
} else {
  $sql = "UPDATE tb_admin SET ad_name='$ad_name', username='$username', password='$password', ad_tel='$ad_tel' WHERE admin_ID='$admin_ID'";
  $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

  if($result) {
      echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
      header("Location: admin_list.php");
  } else {
      echo "แก้ไขข้อมูลไม่สำเร็จ";
      echo mysqli_error($conn);
        exit();
  }
}
mysqli_close($conn);
?>