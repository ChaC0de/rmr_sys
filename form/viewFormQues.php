<?php 
include ('../connection/conn.php'); 
include('../_navbar/adminnavbar.php');  // เรียกใช้ Navbar

$form_ID = $_GET['form_ID'];
$sql = "SELECT * FROM tb_form WHERE form_ID = '$form_ID' ";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows( $query );

$sql2 = "SELECT * FROM form_question WHERE form_ID = '$form_ID' ";
$query2 = mysqli_query($conn, $sql2);
$num2 = mysqli_num_rows( $query2 );
$row = mysqli_fetch_array($query2);

$list = 0;


$sql3 = "SELECT * FROM form_question INNER JOIN tb_question ON form_question.q_ID = tb_question.q_ID WHERE form_question.form_ID = '$form_ID' ORDER BY `form_question`.`q_ID` ASC ";
$query3 = mysqli_query($conn, $sql3);
$num3 = mysqli_num_rows( $query3 );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>View Form</title>
</head>
<body>
<br>

<!-- survey form -->
<form action="updateForm.php" method="post">
<?php 
foreach ($query as $row) { ?>
<div class="container">
  <div class="row">
  <table class="table">
  <tr>
<th> <p class="fs-5 text-start">ชื่อแบบสอบถาม:</p>  
<input type="text" name="form_name" class="form-control" value="<?php echo $row["form_name"] ?>">
<input type="hidden" name="form_ID" value="<?php echo $row["form_ID"] ?>">
</th>
<th><p class="fs-5 text-end">สร้างเมื่อ:</p> <p class="fs-5 text-info text-end"><?php echo $row["created_at"] ?></p> </th>

</tr>
</table>
</div>
<?php } ?>

<div class="row">
  <table>
    <tr> 
      <td>
        <div class="col">
          <p class="fs-5 text-start">คำถาม: <?php 
        if($num3 > 0){
          echo $num3;
        }else{
          echo "0";
        }
        ?>
          </p>
        </div>
      </td> 
      <td class="d-flex justify-content-end">
        <p class="fs-5">สถานะ:
      </td>
      <td class="d-flex justify-content-end">
        <div class="col-3">
          <select name="status" class="form-select" >
            <option value="1" <?php if($row["status"] == 1){echo "selected";} ?>>เปิดใช้งาน</option>
            <option value="0" <?php if($row["status"] == 0){echo "selected";} ?>>ปิดใช้งาน</option>
          </select>
        </div>
        </p>
    </div>
  </td>
</tr>
    <tr>
      <td>

      </td>
    <td class="text-end pt-5">
      <a href="addFormQues.php?form_ID=<?php echo $row['form_ID']; ?>" 
    class="btn btn-warning col-2">ปรับปรุงคำถาม
  </a>
</td>
    </tr>
</table>
</div>
</div>

<br>
  <div class="container">
    <div class="row"></div>
      <div class="col">
        <table class="table">
          <tr>
            <th class="text-center">ลำดับ</th>
              <th>คำถาม</th>
            <th></th>
          </tr>
          <!-- แสดงข้อมูลคำถาม -->
            <?php foreach ($query2 as $row2) { $list++ ?>
          <tr>
            <td class="text-center"><?php echo $list ?></td>
            <td><p class="fs-5">
              <?php foreach ($query3 as $row3) { ?>
              <?php if($row2["q_ID"] == $row3["q_ID"]){ ?>
              <?php echo $row3["q_text"] ?>

              <?php } ?>
              <?php } ?>
            </p>
          </td>
          <td><a href="displayAns.php?form_ID=<?php echo $row2["form_ID"] ?>&q_ID=<?php echo $row2["q_ID"] ?>" class="btn btn-primary">ดูคำตอบ</a></td>


          <!-- ลบคำถาม -->
          <td>
            <a href="delFormQues.php?form_ID=<?php echo $row2["form_ID"] ?>&q_ID=<?php echo $row2["q_ID"] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล จะไม่สามารถเปลี่ยนแปลงได้')">ลบ
          </a>
        </td>
              <?php } ?>

              <?php if($num2==0){ ?>
          <td colspan="3"><p class="fs-5 text-center">ไม่มีคำถาม</p></td>
              <?php } ?>
          </tr>
        </table>
        <center>
          <button type="submit" class="btn btn-primary">
            บันทึก
          </button>
          <a href="form.php" class="btn btn-secondary">ยกเลิก</a>
        </center>
      </div>
    </form>
</div>
      <!-- end survey form -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>