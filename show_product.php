<?php
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=EDGE">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script scr="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container">
    <div class="h4 text-center alert alert-success mb-4 mt-4" role="alert">
        แสดงข้อมูลสินค้า
    </div>
    <a href="fr_product.php" class="btn btn-success mb-4">Add+</a>
    <a href="admin_order.php" class="btn btn-success mb-4">ย้อนกลับ</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ประเภท</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>รูปภาพ</th>
        </tr>

        <?php
        $sql = "SELECT * FROM product ,type WHERE product.type_id =type.type_id ";
        $hand = mysqli_query($conn,$sql);
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($hand)) {
        ?>
        <tr>
            <td><?=$row["pro_id"]?></td>
            <td><?=$row["pro_name"]?></td>
            <td><?=$row["type_name"]?></td>
            <td><?=$row["price"]?></td>
            <td><?=$row["amount"]?></td>
            <td><img src="img/<?=$row['image']?>" width="150px" hieght="100px"></td>
            <td><a href="edit_product.php?id=<?=$row["pro_id"]?>" class="btn btn-warning">Edit</a></td>
            <td><a href="delete_product.php?id=<?=$row["pro_id"]?>" class="btn btn-danger" onclick="return Del(this.href);">Delete</a></td>
        </tr>
        
        <?php
        }
        mysqli_close($conn);
        ?>
    </table>
    
</div>

<script language="JavaScript">
    function Del(mypage) {
        if (confirm("คุณต้องการลบข้อมูลหรือไม่?")) {
            window.location = mypage;
        }
        return false;
    }
</script>
</body>
</html>
