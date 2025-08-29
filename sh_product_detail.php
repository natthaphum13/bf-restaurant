<?php include 'condb.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include 'menu.php' ; ?>
    <div class="container text-center">
        <div class="row">
            <?php
            // ตรวจสอบว่ามีค่า 'id' ใน URL หรือไม่
            if(isset($_GET['id'])) {
                $ids = $_GET['id'];
                
                // คำสั่ง SQL ที่ถูกต้อง: ใช้ WHERE เพื่อเลือกข้อมูลเฉพาะสินค้านั้น
                $sql = "SELECT * FROM product, type WHERE product.type_id = type.type_id AND product.pro_id = '$ids'";
                $result = mysqli_query($conn, $sql);
                
                // ใช้ if แทน while เพราะต้องการข้อมูลแค่ชิ้นเดียว
                if($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="col-md-4">
                        <img src="img/<?=$row['image']?>" width="350px" class="mt-5 p-2 my-2 border"/> <br>
                    </div>
                    <div class="col-md-6">
                        <br><br>
                        ID: <?=$row['pro_id']?> <br>
                        <h5 class="text-success"><?=$row['pro_name']?></h5> <br>
                        ประเภทสินค้า : <?=$row['type_name']?> <br>
                        รายละเอียด : <?=$row['detail']?> <br>
                        ราคา <b class="text-danger"><?=$row['price']?> บาท</b> <br>
                          <a href="order.php?id=<?=$row['pro_id']?>" class="btn btn-outline-success mt-3">เพิ่มลงตะกร้า</a>
                    </div>
            <?php
                } else {
                    echo "ไม่พบข้อมูลสินค้า";
                }
            } else {
                echo "ไม่พบ ID สินค้าที่ต้องการ";
            }
            ?>
        </div>
    </div>
<?php
mysqli_close($conn);
?>
</body>
</html>