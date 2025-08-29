<?php
session_start();

// ตรวจสอบว่ามีการส่งค่า 'line' ถูกต้องหรือไม่
if(isset($_GET['line'])) {
    $line = (int)$_GET['line'];

    if(isset($_SESSION['strProductID'][$line])) {
        // ลบสินค้าออกจาก session array
        unset($_SESSION['strProductID'][$line]);
        unset($_SESSION['strQty'][$line]);

        // จัดเรียงอาร์เรย์ใหม่เพื่อไม่ให้มีดัชนีที่ว่าง
        $_SESSION['strProductID'] = array_values($_SESSION['strProductID']);
        $_SESSION['strQty'] = array_values($_SESSION['strQty']);
        
        // ลดจำนวนรายการทั้งหมดในตะกร้า
        $_SESSION['intLine']--;
    }
}

header('location: cart.php');
exit();
?>