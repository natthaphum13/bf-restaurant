<?php
session_start();
include 'condb.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}

// คำนวณยอดขายและจำนวนออเดอร์ของวันนี้
$sql = "SELECT SUM(total_price) AS total_sales, COUNT(order_id) AS total_orders FROM orders WHERE DATE(order_date) = CURDATE()";
$result = mysqli_query($conn, $sql);
$summary = mysqli_fetch_assoc($result);
$total_sales = $summary['total_sales'] ?? 0;
$total_orders = $summary['total_orders'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปยอดขายวันนี้</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">สรุปยอดขายประจำวัน</h2>
        <div class="mb-3">
            <a href="admin_order.php" class="btn btn-secondary">กลับหน้าจัดการออเดอร์</a>
        </div>
        <div class="row text-center">
            <div class="col-md-6">
                <div class="card bg-success text-white p-4">
                    <h3>จำนวนออเดอร์วันนี้</h3>
                    <h4><?= $total_orders ?> ออเดอร์</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-primary text-white p-4">
                    <h3>ยอดขายรวมวันนี้</h3>
                    <h4><?= number_format($total_sales, 2) ?> บาท</h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>