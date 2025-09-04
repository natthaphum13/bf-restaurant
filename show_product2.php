<?php
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนูทั้งหมด</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
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
    <?php include 'menu.php'; ?>
    <div class="container mt-4">
        <h3 class="text-center mb-4">🍽️ เมนูทั้งหมดของร้าน 🍽️</h3>

        <?php
        $sql_type = "SELECT * FROM type ORDER BY type_id ASC";
        $result_type = mysqli_query($conn, $sql_type);

        if (mysqli_num_rows($result_type) > 0) {
            while ($row_type = mysqli_fetch_assoc($result_type)) {
                $current_type_id = $row_type['type_id'];
                $current_type_name = $row_type['type_name'];
        ?>
                <h4 class="mt-5 mb-3 text-gold text-center"><?= $current_type_name ?></h4>
                <hr>
                
                <div class="row">
                <?php
                $sql_pro = "SELECT * FROM product WHERE type_id = '$current_type_id' ORDER BY pro_id DESC";
                $result_pro = mysqli_query($conn, $sql_pro);

                if (mysqli_num_rows($result_pro) > 0) {
                    while ($row_pro = mysqli_fetch_array($result_pro)) {
                ?>
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow-sm card-theme">
                                <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>">
                                    <img src="img/<?= $row_pro['image'] ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row_pro['pro_name'] ?></h5>
                                    <p class="card-text text-danger"><?= number_format($row_pro['price'], 2) ?> บาท</p>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-success w-100">
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12 text-center text-muted mb-4'>ไม่มีสินค้าในหมวดหมู่นี้</div>";
                }
                ?>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-12 text-center text-muted'>ยังไม่มีประเภทเมนูในระบบ</div>";
        }
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>