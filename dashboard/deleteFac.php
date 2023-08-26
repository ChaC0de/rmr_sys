<?php
include('../connection/conn.php');
$faculty_ID = $_GET['faculty_ID'];
$sql = "DELETE FROM tb_faculty WHERE faculty_ID = '$faculty_ID'";
$result = mysqli_query($conn, $sql);
if($result) {
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("Location: faculty.php");
} else {
    echo "ลบข้อมูลไม่สำเร็จ";
    echo mysqli_error($conn);
    exit();
}
?>