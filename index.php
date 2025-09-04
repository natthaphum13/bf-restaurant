<?php
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนูแนะนำ</title>
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
        <h3 class="text-center mb-4">✨ เมนูแนะนำ ✨</h3>
        <div class="row">
        <?php
        $sql = "SELECT * FROM product WHERE type_id = 1 ORDER BY pro_id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row_pro = mysqli_fetch_array($result)) {
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
        mysqli_close($conn);
        ?>
        </div>
    </div>
</body>
</html>