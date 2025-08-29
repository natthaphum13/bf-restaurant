<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่งค่า 'id' ถูกต้องหรือไม่
if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    $qty = 1;

    // ตรวจสอบว่าตะกร้าสินค้ายังไม่มีการสร้าง
    if (!isset($_SESSION['strProductID'])) {
        $_SESSION['strProductID'] = array();
        $_SESSION['strQty'] = array();
    }
    
    // ตรวจสอบว่าสินค้ามีอยู่ในตะกร้าแล้วหรือยัง
    $found = false;
    foreach ($_SESSION['strProductID'] as $key => $value) {
        if ($value == $pro_id) {
            $_SESSION['strQty'][$key] += $qty;
            $found = true;
            break;
        }
    }
    
    // ถ้าไม่พบสินค้าเดิม ให้เพิ่มสินค้าใหม่เข้าไป
    if (!$found) {
        array_push($_SESSION['strProductID'], $pro_id);
        array_push($_SESSION['strQty'], $qty);
    }
}

// Redirect ไปยังหน้าตะกร้าสินค้า
header("location:cart.php");
exit();
?>