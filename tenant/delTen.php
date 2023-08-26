<?php 
include('../connection/conn.php');
$st_ID = $_GET['st_ID'];
$st_name = $_GET['st_name'];
$sql1 = "DELETE FROM tb_student WHERE st_ID = '$st_ID'";
$sql2 = "DELETE FROM tb_st_faculty WHERE st_name = '$st_name'";

$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "ลบข้อมูลสำเร็จ";
    header("Location: ../tenant/tenList.php");
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>