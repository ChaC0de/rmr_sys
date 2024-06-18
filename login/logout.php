<?php 
    session_start(); // เปิด session
    session_destroy(); // ทำลาย session ทั้งหมด
    header("Location: login.php");
?>