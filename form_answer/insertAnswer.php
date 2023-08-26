<?php
include('../connection/conn.php');

foreach ($_POST as $key => $value) {
    if($key != 'form_ID' && $key != 'st_ID'){
        $sql[] = "('".$_POST['form_ID']."','".$_POST['st_ID']."','".$value."','".explode(',',$value)[1]."')";
    }
}

$sql = "INSERT INTO `form_answer` (`form_ID`, `st_ID`, `ansValue`, `ans_ID`) VALUES ".implode(',', $sql);

if(mysqli_query($conn, $sql)){
    echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
    echo "<script>window.location.href='answerPage.php'</script>";
}else{
    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    echo "<script>window.location.href='answerPage.php'</script>";
}
?>