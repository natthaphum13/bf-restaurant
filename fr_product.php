<?php
session_start();
include 'condb.php';
// ตรวจสอบการเข้าสู่ระบบ admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเมนูอาหาร</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>เพิ่มเมนูอาหาร</h4>
                    </div>
                    <div class="card-body">
                        <form name="form1" method="post" action="insert_product.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="pname" class="form-label">ชื่อสินค้า</label>
                                <input type="text" name="pname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="typeID" class="form-label">ประเภทสินค้า</label>
                                <select class="form-select" name="typeID">
                                    <?php
                                    $sql = "SELECT * FROM type ORDER BY type_name";
                                    $hand = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($hand)) {
                                        echo "<option value='{$row['type_id']}'>{$row['type_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">ราคา</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="num" class="form-label">จำนวน</label>
                                <input type="number" name="num" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="file1" class="form-label">รูปภาพ</label>
                                <input type="file" name="file1" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="admin_manage_products.php" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>