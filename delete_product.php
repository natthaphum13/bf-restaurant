<?php
session_start();
include 'condb.php';
// ตรวจสอบการเข้าสู่ระบบ admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}
$ids = $_GET['id'];
$sql = "DELETE FROM product WHERE pro_id='$ids' ";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('ลบข้อมูลเรียบร้อย');</script>";
    echo "<script>window.location='admin_manage_products.php';</script>";
} else {
    echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
mysqli_close($conn);
?>