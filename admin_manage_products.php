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
    <title>จัดการเมนูอาหาร</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script language="JavaScript">
        function Del(mypage){
            var agree = confirm("ยืนยันการลบข้อมูลนี้หรือไม่?");
            if (agree) {
                window.location = mypage;
            }
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">จัดการเมนูอาหาร</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="fr_product.php" class="btn btn-success">เพิ่มเมนูใหม่</a>
            <a href="admin_order.php" class="btn btn-secondary">กลับหน้าจัดการออเดอร์</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ชื่อเมนู</th>
                        <th>ประเภท</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รูปภาพ</th>
                        <th>แก้ไข</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT p.*, t.type_name FROM product p JOIN type t ON p.type_id = t.type_id ORDER BY p.pro_id DESC";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['pro_id'] ?></td>
                        <td><?= $row['pro_name'] ?></td>
                        <td><?= $row['type_name'] ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['amount'] ?></td>
                        <td><img src="img/<?= $row['image'] ?>" width="100px" class="img-fluid"></td>
                        <td><a href="edit_product.php?id=<?= $row['pro_id'] ?>" class="btn btn-warning btn-sm">Edit</a></td>
                        <td><a href="delete_product.php?id=<?= $row['pro_id'] ?>" class="btn btn-danger btn-sm" onclick="return Del(this.href);">Delete</a></td>
                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>