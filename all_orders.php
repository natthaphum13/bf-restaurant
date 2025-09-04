<?php
session_start();
include 'condb.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}

$sql_orders = "SELECT * FROM orders ORDER BY order_date DESC";
$result_orders = mysqli_query($conn, $sql_orders);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออเดอร์ทั้งหมด</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">ประวัติออเดอร์ทั้งหมด</h2>
        <a href="admin_order.php" class="btn btn-secondary mb-3">กลับหน้าจัดการออเดอร์</a>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>รหัสสั่งซื้อ</th>
                    <th>ประเภท</th>
                    <th>รายการสินค้า</th>
                    <th>ราคารวม</th>
                    <th>วันที่สั่ง</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($result_orders)): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td>
                            <?php if ($order['take_away']): ?>
                                สั่งกลับบ้าน
                            <?php else: ?>
                                โต๊ะที่ <?= $order['table_number'] ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $order_id = $order['order_id'];
                            $sql_details = "SELECT od.*, p.pro_name FROM order_details od JOIN product p ON od.pro_id = p.pro_id WHERE od.order_id = '$order_id'";
                            $result_details = mysqli_query($conn, $sql_details);
                            echo "<ul>";
                            while ($detail = mysqli_fetch_assoc($result_details)) {
                                echo "<li>" . $detail['pro_name'] . " (x" . $detail['quantity'] . ")</li>";
                                if (!empty($detail['options'])) {
                                    echo "<ul><li>ตัวเลือก: " . $detail['options'] . "</li></ul>";
                                }
                                if (!empty($detail['comment'])) {
                                    echo "<ul><li>หมายเหตุ: " . $detail['comment'] . "</li></ul>";
                                }
                            }
                            echo "</ul>";
                            ?>
                        </td>
                        <td><?= number_format($order['total_price'], 2) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                        <td><?= $order['status'] == 'pending' ? 'รอดำเนินการ' : 'สำเร็จ' ?></td>
                        <td>
                            <a href="delete_order.php?id=<?= $order['order_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบออเดอร์นี้หรือไม่?');">ลบ</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>