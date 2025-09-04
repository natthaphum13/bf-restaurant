<?php
session_start();
include 'condb.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    // คำสั่ง DELETE FROM order_details จะต้องรันก่อนเพราะมี foreign key
    $sql_details = "DELETE FROM order_details WHERE order_id = '$order_id'";
    mysqli_query($conn, $sql_details);

    $sql_order = "DELETE FROM orders WHERE order_id = '$order_id'";
    mysqli_query($conn, $sql_order);
}

header('location: all_orders.php');
exit();
?>