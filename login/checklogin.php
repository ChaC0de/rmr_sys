<?php 
    include('../connection/conn.php');  // เชื่อมต่อฐานข้อมูล
    session_start();
    

    $username = $_POST['username'];
    $password = $_POST['password'];

    $password=hash('sha256',$password); // ทำการเข้ารหัส password ด้วย sha256

    $sql1 = "SELECT * FROM user WHERE username = '$username' and password = '$password' ";
    
    $result = mysqli_query($conn,$sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $userType = $row['userType'];
    
    if ($row > 0) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['st_name'] = $row['st_name'];
    $_SESSION['land_name'] = $row['land_name'];
    $_SESSION['ad_name'] = $row['ad_name'];
    $_SESSION['userid'] = $row['userid'];
    $_SESSION['u_ID'] = $row['u_ID'];

        if($userType == '1'){
            header("Location: ../admin_page/admin/index_admin.php?u_ID=".$_SESSION['u_ID']);

        }else if($userType == '2'){
            header("Location: ../landlord_page/index_land.php?u_ID=".$_SESSION['u_ID']);

        }else if($userType == '3'){
            header("Location: ../student_page/domitory.php?u_ID=".$_SESSION['u_ID']);
        
        }else if($userType == '4'){
            header("Location: ../admin_page2/admin/index_admin.php?u_ID=".$_SESSION['u_ID']);
        }
    }else{
        $_SESSION['error'] = "ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง";
        header("Location: login.php");
    }
    mysqli_close($conn);
?>