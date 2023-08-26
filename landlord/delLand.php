<?php 
include('../connection/conn.php');
$land_ID = $_GET['land_ID'];
$sql = "DELETE FROM tb_landlord WHERE land_ID = '$land_ID'";
$query = mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn) > 0) {
    echo "ลบข้อมูลเรียบร้อยแล้ว";
    header("Location: landList.php");
} else {
    echo
    "<div class='alert alert-danger'>
        <b>ไม่พบข้อมูลจะลบ</b>
    </div>";
    echo mysqli_error($conn);
    exit();
}
mysqli_close($conn)
?>