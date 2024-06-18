<?php 
include ('connection/conn.php');
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $last = isset($_POST['last']) ? $_POST['last'] : '';

    $sql = "SELECT MAX(CAST(SUBSTRING(u_ID, 3) AS SIGNED)) AS max_u_ID FROM tb_test";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $max_u_ID = $row['max_u_ID'];

    $u_ID = 's_' . ($max_u_ID + 1);

    $sql = "INSERT INTO tb_test (u_ID, name, last) VALUES ('$u_ID', '$name', '$last')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "success";
    } else {
        echo "fail";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" name="name" id="name">
        <input type="text" class="form-control" name="last" id="last">
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>
