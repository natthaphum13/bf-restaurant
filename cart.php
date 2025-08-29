<?php
session_start();
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="form1" method="POST" action="">
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>ลบ</th>
                        </tr>
                        <?php
                        // ตรวจสอบว่า session มีสินค้าในตะกร้าหรือไม่
                        if (isset($_SESSION['strProductID']) && count($_SESSION['strProductID']) > 0) {
                            $total = 0;
                            // แก้ไขการวนลูปให้ถูกต้อง
                            foreach ($_SESSION['strProductID'] as $i => $pro_id) {
                                $sql1 = "select * from product where pro_id = '" . $pro_id . "' ";
                                $result = mysqli_query($conn, $sql1);
                                $row_pro = mysqli_fetch_array($result);

                                $Total = $_SESSION['strQty'][$i];
                                $sum = $Total * $row_pro['price'];
                                $total += $sum;
                        ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <img src="img/<?=$row_pro['image']?>" width="80" height="100" class="border">
                                    </td>
                                    <td><?= $row_pro['pro_name'] ?></td>
                                    <td><?= number_format($row_pro['price'], 2) ?></td>
                                    <td><?= $_SESSION['strQty'][$i] ?></td>
                                    <td><?= number_format($sum, 2) ?></td>
                                    <td>
                                        <a href="pro_delete.php?line=<?=$i?>" class="btn btn-danger">ยกเลิก</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>ตะกร้าสินค้าว่างเปล่า</td></tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="6" class="text-end">ราคารวมทั้งหมด</td>
                            <td><?= isset($total) ? number_format($total, 2) : '0.00' ?></td>
                        </tr>
                    </table>
                    <div style="text-align:right">
                        <a href="show_product2.php" class="btn btn-secondary">เลือกสินค้า</a>
                        <button type="button" class="btn btn-primary">ยืนยันคำสั่งซื้อ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>