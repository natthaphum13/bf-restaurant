<?php
session_start();

if(isset($_GET['line'])) {
    $line = (int)$_GET['line'];

    if(isset($_SESSION['strProductID'][$line])) {
        // ลบสินค้าและข้อมูลที่เกี่ยวข้องออกจาก session array
        unset($_SESSION['strProductID'][$line]);
        unset($_SESSION['strQty'][$line]);
        unset($_SESSION['strOptions'][$line]); // เพิ่มส่วนนี้
        unset($_SESSION['strComments'][$line]); // เพิ่มส่วนนี้

        // จัดเรียงอาร์เรย์ใหม่เพื่อไม่ให้มีดัชนีที่ว่าง
        $_SESSION['strProductID'] = array_values($_SESSION['strProductID']);
        $_SESSION['strQty'] = array_values($_SESSION['strQty']);
        $_SESSION['strOptions'] = array_values($_SESSION['strOptions']); // เพิ่มส่วนนี้
        $_SESSION['strComments'] = array_values($_SESSION['strComments']); // เพิ่มส่วนนี้
        
        // ลดจำนวนรายการทั้งหมดในตะกร้า
        if(isset($_SESSION['intLine'])) {
            $_SESSION['intLine']--;
        }
    }
}

header('location: cart.php');
exit();
?>