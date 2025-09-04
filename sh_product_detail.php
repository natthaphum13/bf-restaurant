<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่งค่า 'id' ถูกต้องหรือไม่
if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE pro_id = '$pro_id'";
    $result = mysqli_query($conn, $sql);

    // ถ้าพบสินค้า ให้ดึงรายละเอียดออกมา
    if (mysqli_num_rows($result) > 0) {
        $row_pro = mysqli_fetch_array($result);
    } else {
        echo "ไม่พบสินค้านี้";
        exit();
    }
} else {
    echo "ไม่พบรหัสสินค้า";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสินค้า</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <img src="img/<?= $row_pro['image'] ?>" width="350px" class="img-fluid border">
            </div>
            <div class="col-md-6">
                <h3 class="mt-4"><?= $row_pro['pro_name'] ?></h3>
                <p>ราคา: <span class="text-danger fs-3"><?= number_format($row_pro['price'], 2) ?></span> บาท</p>
                
                <form action="cart.php" method="POST">
                    <input type="hidden" name="pro_id" value="<?= $row_pro['pro_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">ตัวเลือก</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="option[]" value="น้ำซุป" id="option1">
                            <label class="form-check-label" for="option1">น้ำซุป</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="option[]" value="พิเศษ" id="option2">
                            <label class="form-check-label" for="option2">พิเศษ</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="option[]" value="ไม่ใส่ผัก" id="option3">
                            <label class="form-check-label" for="option3">ไม่ใส่ผัก</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">รายละเอียดเพิ่มเติม</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="ระบุรายละเอียดเพิ่มเติม"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">เพิ่มลงตะกร้า</button>
                    <a href="show_product2.php" class="btn btn-secondary mt-3">กลับไปหน้าสินค้า</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>