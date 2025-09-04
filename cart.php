<?php
session_start();
include 'condb.php';
// ... (โค้ด PHP ส่วนบนเหมือนเดิม) ...
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pro_id'])) {
    $pro_id = $_POST['pro_id'];
    $qty = 1;
    $options = isset($_POST['option']) ? implode(', ', $_POST['option']) : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    if (!isset($_SESSION['strProductID'])) {
        $_SESSION['strProductID'] = array();
        $_SESSION['strQty'] = array();
        $_SESSION['strOptions'] = array();
        $_SESSION['strComments'] = array();
    }
    $found = false;
    foreach ($_SESSION['strProductID'] as $key => $value) {
        if ($value == $pro_id) {
            $_SESSION['strQty'][$key] += $qty;
            $_SESSION['strOptions'][$key] = $options;
            $_SESSION['strComments'][$key] = $comment;
            $found = true;
            break;
        }
    }
    if (!$found) {
        array_push($_SESSION['strProductID'], $pro_id);
        array_push($_SESSION['strQty'], $qty);
        array_push($_SESSION['strOptions'], $options);
        array_push($_SESSION['strComments'], $comment);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="form1" method="POST" action="process_order.php">
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-hover">
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ตัวเลือก</th>
                            <th>รายละเอียดเพิ่มเติม</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>ลบ</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['strProductID']) && count($_SESSION['strProductID']) > 0) {
                            $total = 0;
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
                                    <td><?= isset($_SESSION['strOptions'][$i]) ? $_SESSION['strOptions'][$i] : '' ?></td>
                                    <td><?= isset($_SESSION['strComments'][$i]) ? $_SESSION['strComments'][$i] : '' ?></td>
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
                            echo "<tr><td colspan='9'>ตะกร้าสินค้าว่างเปล่า</td></tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="7" class="text-end">ราคารวมทั้งหมด</td>
                            <td><?= isset($total) ? number_format($total, 2) : '0.00' ?></td>
                        </tr>
                    </table>
                    
                    <div class="mb-3">
                        <label for="table_number" class="form-label">เลือกโต๊ะ</label>
                        <select class="form-select" id="table_number" name="table_number">
                            <?php for ($i = 1; $i <= 20; $i++): ?>
                                <option value="<?= $i ?>">โต๊ะที่ <?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="take_away" value="1" id="take_away">
                        <label class="form-check-label" for="take_away">
                            สั่งกลับบ้าน
                        </label>
                    </div>

                    <div style="text-align:right">
                        <a href="show_product2.php" class="btn btn-secondary">เลือกสินค้า</a>
                        <button type="submit" class="btn btn-primary">ยืนยันคำสั่งซื้อ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>