<?php
session_start();
include 'condb.php';

if (!isset($_GET['order_id'])) {
    header('location: index.php');
    exit();
}
$order_id = $_GET['order_id'];

// ดึงข้อมูลคำสั่งซื้อหลัก
$sql_order = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result_order = mysqli_query($conn, $sql_order);
$order = mysqli_fetch_assoc($result_order);

if (!$order) {
    echo "ไม่พบข้อมูลคำสั่งซื้อ";
    exit();
}

// ดึงรายละเอียดสินค้าที่สั่ง
$sql_details = "SELECT od.*, p.pro_name, p.price FROM order_details od JOIN product p ON od.pro_id = p.pro_id WHERE od.order_id = '$order_id'";
$result_details = mysqli_query($conn, $sql_details);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันคำสั่งซื้อ</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="text-center">ยืนยันคำสั่งซื้อเรียบร้อยแล้ว</h4>
                    </div>
                    <div class="card-body">
                        <h5>รายละเอียดคำสั่งซื้อ #<?= $order_id ?></h5>
                        <p><strong>สถานะ:</strong> <?= $order['status'] == 'pending' ? 'รอดำเนินการ' : 'สำเร็จ' ?></p>
                        <?php if ($order['take_away']): ?>
                            <p><strong>ประเภท:</strong> สั่งกลับบ้าน</p>
                        <?php else: ?>
                            <p><strong>ประเภท:</strong> ทานที่ร้าน (โต๊ะที่ <?= $order['table_number'] ?>)</p>
                        <?php endif; ?>
                        <p><strong>วันที่สั่ง:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>

                        <hr>
                        <h5>รายการสินค้า</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th>ตัวเลือก</th>
                                    <th>จำนวน</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($detail = mysqli_fetch_assoc($result_details)): ?>
                                    <tr>
                                        <td>
                                            <?= $detail['pro_name'] ?>
                                            <?php if (!empty($detail['comment'])): ?>
                                                <br><small class="text-muted">หมายเหตุ: <?= $detail['comment'] ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= !empty($detail['options']) ? $detail['options'] : '-' ?></td>
                                        <td><?= $detail['quantity'] ?></td>
                                        <td><?= number_format($detail['price'], 2) ?></td>
                                        <td><?= number_format($detail['quantity'] * $detail['price'], 2) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>ราคารวมทั้งหมด</strong></td>
                                    <td><strong><?= number_format($order['total_price'], 2) ?> บาท</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="mt-4">
                            <h5>เลือกวิธีการชำระเงิน</h5>
                            <div class="row text-center">
                                <div class="col-md-6 mb-3">
                                    <div class="card p-3 h-100">
                                         <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="option[]" value="พิเศษ" id="option2">
                            <label class="form-check-label" for="option2">จ่ายเงินที่เคาน์เตอร์</label>
                        </div>
                                        
                                        <p class="card-text">โปรดนำรหัสคำสั่งซื้อนี้ไปแจ้งที่เคาน์เตอร์เพื่อชำระเงิน</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card p-3 h-100">
                                        <h6 class="card-title">จ่ายผ่าน QR Code (จำลอง)</h6>
                                        <p class="card-text">สแกน QR Code เพื่อชำระเงินผ่าน Mobile Banking</p>
                                        <img src="img/qrcode.jpg" height="100" width="150" alt="QR Code จำลอง" class="mx-auto d-block mt-2">
                                         <p class="card-text">ณัฐภูมิ กลิ่นนนวล</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-primary">กลับสู่หน้าหลัก</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>