<?php
session_start();
include 'condb.php';

// ตรวจสอบสถานะการเข้าสู่ระบบ
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}

// ดึงข้อมูลคำสั่งซื้อที่ "รอดำเนินการ" เท่านั้น
$sql_orders = "SELECT * FROM orders WHERE status = 'pending' ORDER BY order_date DESC";
$result_orders = mysqli_query($conn, $sql_orders);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าจัดการออเดอร์</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">หน้าจัดการออเดอร์ (รอดำเนินการ)</h2>
        
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <a href="show_product.php" class="btn btn-success">เพิ่มเมนูอาหาร</a>
                <a href="daily_summary.php" class="btn btn-info text-white">สรุปยอดขายวันนี้</a>
                <a href="all_orders.php" class="btn btn-secondary">ดูออเดอร์ทั้งหมด</a>
                 <a href="admin_manage_products.php" class="btn btn-primary">จัดการเมนูอาหาร</a>
            </div>
            <a href="admin_logout.php" class="btn btn-danger">ออกจากระบบ</a>
        </div>
        
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
                            <a href="complete_order.php?id=<?= $order['order_id'] ?>" class="btn btn-success btn-sm" onclick="return confirm('ยืนยันว่าออเดอร์นี้ทำเสร็จแล้วใช่หรือไม่?');">ทำรายการเสร็จสิ้น</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
<?php
// ... (โค้ด PHP ส่วนบนเหมือนเดิม) ...
?>
<body>
    
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                </table>
        </div>
    </div>
</body>
</html>