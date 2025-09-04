<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่งข้อมูลจากตะกร้าหรือไม่
if (!isset($_SESSION['strProductID']) || count($_SESSION['strProductID']) == 0) {
    header('location: cart.php');
    exit();
}

$table_number = isset($_POST['table_number']) ? (int)$_POST['table_number'] : NULL;
$take_away = isset($_POST['take_away']) ? 1 : 0;
$total_price = 0;

// คำนวณราคารวมทั้งหมด
foreach ($_SESSION['strProductID'] as $i => $pro_id) {
    $sql_pro = "SELECT price FROM product WHERE pro_id = '$pro_id'";
    $result_pro = mysqli_query($conn, $sql_pro);
    $row_pro = mysqli_fetch_array($result_pro);
    $total_price += $_SESSION['strQty'][$i] * $row_pro['price'];
}

// บันทึกข้อมูลคำสั่งซื้อหลักลงในตาราง orders
$sql_order = "INSERT INTO orders (table_number, take_away, total_price) VALUES ('$table_number', '$take_away', '$total_price')";
mysqli_query($conn, $sql_order);
$order_id = mysqli_insert_id($conn);

// บันทึกรายละเอียดสินค้าแต่ละรายการลงในตาราง order_details
foreach ($_SESSION['strProductID'] as $i => $pro_id) {
    $qty = $_SESSION['strQty'][$i];
    $options = $_SESSION['strOptions'][$i];
    $comment = $_SESSION['strComments'][$i];
    
    $sql_detail = "INSERT INTO order_details (order_id, pro_id, quantity, options, comment) 
                   VALUES ('$order_id', '$pro_id', '$qty', '$options', '$comment')";
    mysqli_query($conn, $sql_detail);
}

// เคลียร์ตะกร้าสินค้าใน session
unset($_SESSION['strProductID']);
unset($_SESSION['strQty']);
unset($_SESSION['strOptions']);
unset($_SESSION['strComments']);

// ส่งไปยังหน้ายืนยันคำสั่งซื้อพร้อมกับ order_id
header("location: order_confirm.php?order_id=$order_id");
exit();
?>