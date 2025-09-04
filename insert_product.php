<?php
include 'condb.php';

// ป้องกัน SQL Injection
$p_name = mysqli_real_escape_string($conn, $_POST['pname']);
$typeID = mysqli_real_escape_string($conn, $_POST['typeID']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$num = mysqli_real_escape_string($conn, $_POST['num']);

// ตรวจสอบและอัปโหลดไฟล์ภาพ
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $ext = pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);
    $new_image_name = 'pr_' . uniqid() . "." . $ext;

    $image_upload_path = "./img/" . $new_image_name;

    // ตรวจสอบว่าสามารถอัปโหลดไฟล์ได้สำเร็จหรือไม่
    if (move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path)) {
        // อัปโหลดสำเร็จ
    } else {
        // อัปโหลดไม่สำเร็จ
        $new_image_name = "";
    }
} else {
    $new_image_name = "";
}

// บันทึกข้อมูลลงฐานข้อมูล
$sql = "INSERT INTO product(pro_name, type_id, price, amount, image) 
        VALUES ('$p_name', '$typeID', '$price', '$num', '$new_image_name')";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('บันทึกข้อมูลเรียบร้อย');</script>";
    // เปลี่ยนเส้นทางไปหน้าแสดงสินค้า
    echo "<script>window.location='show_product.php';</script>"; 
} else {
    echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้: " . mysqli_error($conn) . "');</script>";
}
?>