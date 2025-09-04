<?php
session_start();
include 'condb.php';
include 'menu.php';

// รับค่าจากช่องค้นหา
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการค้นหา</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">ผลการค้นหาสำหรับ: "<?= htmlspecialchars($keyword) ?>"</h3>
        <div class="row">
        <?php
        // สร้างคำสั่ง SQL สำหรับการค้นหาสินค้า
        $sql = "SELECT * FROM product WHERE pro_name LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%' ORDER BY pro_id DESC";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            while ($row_pro = mysqli_fetch_array($result)) {
        ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>">
                        <img src="img/<?= $row_pro['image'] ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row_pro['pro_name'] ?></h5>
                        <p class="card-text text-danger"><?= number_format($row_pro['price'], 2) ?> บาท</p>
                    </div>
                    <div class="card-footer">
                        <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-success w-100">
                            ดูรายละเอียด
                        </a>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning">ไม่พบสินค้าที่ตรงกับคำค้นหา</div></div>';
        }
        mysqli_close($conn);
        ?>
        </div>
    </div>
</body>
</html>