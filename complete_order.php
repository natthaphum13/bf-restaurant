<?php
session_start();
include 'condb.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('location: admin_login.php');
    exit();
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "UPDATE orders SET status = 'completed' WHERE order_id = '$order_id'";
    mysqli_query($conn, $sql);
}

header('location: admin_order.php');
exit();
?>