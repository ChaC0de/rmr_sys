<?php
include('../connection/conn.php');
session_start(); 
isset($_SESSION['u_ID']) ? $_SESSION['u_ID'] : header('location:../login/login.php');

$form_ID = $_POST['form_ID'];
$u_ID = $_POST['u_ID'];

$deleteSql = "DELETE FROM form_answer WHERE form_ID = ? AND u_ID = ?";
$stmt = mysqli_prepare($conn, $deleteSql);
mysqli_stmt_bind_param($stmt, "ii", $form_ID, $u_ID);

if (mysqli_stmt_execute($stmt)) {
    // ดำเนินการเพิ่มข้อมูลใหม่
    foreach ($_POST as $key => $value) {
        if($key != 'form_ID' && $key != 'u_ID'){
            $explodedValue = explode(',', $value);
            if (isset($explodedValue[1])) {
                $sql[] = "('" . $_POST['form_ID'] . "','" . $_POST['u_ID'] . "','" . $value . "','" . $explodedValue[1] . "')";
            }
        }
    }

    $insertSql = "INSERT INTO `form_answer` (`form_ID`, `u_ID`, `ansValue`, `ans_ID`) VALUES " . implode(',', $sql);
    
    if(mysqli_query($conn, $insertSql)){
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location.href='index_st.php?u_ID=" . $_SESSION['u_ID'] . "'</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
        echo "<script>window.location.href='answerPage.php?u_ID=" . $_SESSION['u_ID'] . "'</script>";
    }
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn) . "')</script>";
    echo "<script>window.location.href='answerPage.php?u_ID=" . $_SESSION['u_ID'] . "'</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
