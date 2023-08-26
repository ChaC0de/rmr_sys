<?php 
include('../connection/conn.php');
$admin_ID = $_GET['admin_ID'];
$sql = "DELETE FROM tb_admin WHERE admin_ID = '$admin_ID'";
$query = mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn) > 0) {
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("Location: admin_list.php");
} else {
    echo "ลบข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>